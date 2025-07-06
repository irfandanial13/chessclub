<?php
namespace App\Controllers;

use App\Models\MerchandiseModel;
use App\Models\CartModel;
use App\Models\CartItemModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use CodeIgniter\Controller;

class MerchandiseController extends BaseController
{
    public function index()
    {
        $model = new MerchandiseModel();
        $items = $model->getAllMerchandise();
        return view('merchandise/index', ['items' => $items]);
    }

    public function addToCart($id)
    {
        $userId = session()->get('user_id');
        $sessionId = session_id();
        $cartModel = new CartModel();
        $cartItemModel = new CartItemModel();
        $merchModel = new MerchandiseModel();
        $item = $merchModel->getItem($id);
        if (!$item) return redirect()->to('/merchandise');

        // Cari cart aktif
        $cart = $cartModel
            ->where('user_id', $userId)
            ->orWhere('session_id', $sessionId)
            ->first();
        if (!$cart) {
            $cartId = $cartModel->insert([
                'user_id' => $userId,
                'session_id' => $sessionId
            ]);
        } else {
            $cartId = $cart['id'];
        }

        // Cek apakah item sudah ada di cart
        $existing = $cartItemModel
            ->where('cart_id', $cartId)
            ->where('item_id', $id)
            ->first();
        if ($existing) {
            $cartItemModel->update($existing['id'], [
                'quantity' => $existing['quantity'] + 1
            ]);
        } else {
            $cartItemModel->insert([
                'cart_id' => $cartId,
                'item_id' => $id,
                'quantity' => 1,
                'price' => $item['price']
            ]);
        }
        session()->setFlashdata('success', esc($item['name']) . ' added to cart!');
        return redirect()->to('/merchandise');
    }

    public function cart()
    {
        $userId = session()->get('user_id');
        $sessionId = session_id();
        $cartModel = new CartModel();
        $cartItemModel = new CartItemModel();
        $merchModel = new MerchandiseModel();
        $cart = $cartModel
            ->where('user_id', $userId)
            ->orWhere('session_id', $sessionId)
            ->first();
        $cartItems = [];
        if ($cart) {
            $items = $cartItemModel->where('cart_id', $cart['id'])->findAll();
            foreach ($items as $item) {
                $merch = $merchModel->getItem($item['item_id']);
                $cartItems[] = [
                    'id' => $item['item_id'],
                    'name' => $merch['name'],
                    'price' => $item['price'],
                    'qty' => $item['quantity']
                ];
            }
        }
        return view('merchandise/cart', ['cart' => $cartItems]);
    }

    public function removeFromCart($id)
    {
        $userId = session()->get('user_id');
        $sessionId = session_id();
        $cartModel = new CartModel();
        $cartItemModel = new CartItemModel();
        $cart = $cartModel
            ->where('user_id', $userId)
            ->orWhere('session_id', $sessionId)
            ->first();
        if ($cart) {
            $cartItem = $cartItemModel
                ->where('cart_id', $cart['id'])
                ->where('item_id', $id)
                ->first();
            if ($cartItem) {
                $cartItemModel->delete($cartItem['id']);
            }
        }
        return redirect()->to('/merchandise/cart');
    }

    public function checkout()
    {
        $userId = session()->get('user_id');
        $sessionId = session_id();
        $cartModel = new CartModel();
        $cartItemModel = new CartItemModel();
        $merchModel = new MerchandiseModel();
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();

        $cart = $cartModel
            ->where('user_id', $userId)
            ->orWhere('session_id', $sessionId)
            ->first();
        if ($cart) {
            $items = $cartItemModel->where('cart_id', $cart['id'])->findAll();
            $total = 0;
            foreach ($items as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            // Simpan ke tabel orders
            $orderId = $orderModel->insert([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'total' => $total
            ], true); // true = return insertID
            // Simpan order_items
            foreach ($items as $item) {
                $orderItemModel->insert([
                    'order_id' => $orderId,
                    'item_id' => $item['item_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }
            // Hapus cart
            $cartModel->delete($cart['id']);
        }
        return view('merchandise/checkout');
    }

    public function processPayment()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('merchandise/checkout');
        }

        $paymentMethod = $this->request->getPost('paymentMethod');
        
        if (!$paymentMethod) {
            session()->setFlashdata('error', 'Please select a payment method.');
            return redirect()->back();
        }

        // Store payment method in session for next step
        session()->set('selected_payment_method', $paymentMethod);

        // Redirect based on payment method
        switch ($paymentMethod) {
            case 'cash':
                return redirect()->to('merchandise/cash-payment');
            case 'bank':
                return redirect()->to('merchandise/bank-payment');
            case 'online':
                return redirect()->to('merchandise/card-payment');
            default:
                return redirect()->back();
        }
    }

    public function cashPayment()
    {
        return view('merchandise/cash_payment');
    }

    public function bankPayment()
    {
        return view('merchandise/bank_payment');
    }

    public function cardPayment()
    {
        return view('merchandise/card_payment');
    }

    public function completeOrder()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('merchandise/checkout');
        }

        // Validate input
        $rules = [
            'name' => 'required|min_length[2]',
            'email' => 'required|valid_email',
            'phone' => 'required|min_length[10]',
            'address' => 'required|min_length[10]',
            'payment_method' => 'required|in_list[cash,bank,card]'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', 'Please check your input and try again.');
            return redirect()->back()->withInput();
        }

        // Get form data
        $orderData = [
            'customer_name' => $this->request->getPost('name'),
            'customer_email' => $this->request->getPost('email'),
            'customer_phone' => $this->request->getPost('phone'),
            'shipping_address' => $this->request->getPost('address'),
            'payment_method' => $this->request->getPost('payment_method'),
            'order_date' => date('Y-m-d H:i:s'),
            'status' => 'pending',
            'total_amount' => 0 // Will be calculated from cart
        ];

        // Add payment-specific data
        $paymentMethod = $this->request->getPost('payment_method');
        if ($paymentMethod === 'bank') {
            $orderData['payment_details'] = json_encode([
                'transfer_reference' => $this->request->getPost('transfer_reference')
            ]);
        } elseif ($paymentMethod === 'card') {
            $orderData['payment_details'] = json_encode([
                'card_last4' => substr($this->request->getPost('card_number'), -4),
                'card_type' => 'credit/debit'
            ]);
            $orderData['status'] = 'paid'; // Mark as paid for card payments
        }

        // Add delivery notes if provided
        if ($this->request->getPost('notes')) {
            $orderData['order_notes'] = $this->request->getPost('notes');
        }

        // Get cart items and calculate total
        $cartModel = new CartModel();
        $cartItems = $cartModel->getCartItems(session()->get('user_id'));
        
        if (empty($cartItems)) {
            session()->setFlashdata('error', 'Your cart is empty.');
            return redirect()->to('merchandise/cart');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        $total += 10.00; // Delivery cost
        $orderData['total_amount'] = $total;

        // Save order
        $orderModel = new OrderModel();
        $orderId = $orderModel->insert($orderData);

        if (!$orderId) {
            session()->setFlashdata('error', 'Failed to create order. Please try again.');
            return redirect()->back()->withInput();
        }

        // Save order items
        $orderItemModel = new OrderItemModel();
        foreach ($cartItems as $item) {
            $orderItemData = [
                'order_id' => $orderId,
                'merchandise_id' => $item['merchandise_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity']
            ];
            $orderItemModel->insert($orderItemData);
        }

        // Clear cart
        $cartModel->clearCart(session()->get('user_id'));

        // Set success message and redirect
        $successMessage = 'Order placed successfully! Order ID: #' . $orderId;
        if ($paymentMethod === 'cash') {
            $successMessage .= ' - Pay with cash on delivery';
        } elseif ($paymentMethod === 'bank') {
            $successMessage .= ' - Please complete bank transfer';
        } elseif ($paymentMethod === 'card') {
            $successMessage .= ' - Payment processed successfully';
        }
        
        session()->setFlashdata('success', $successMessage);
        return redirect()->to('merchandise/thank-you/' . $orderId);
    }
} 