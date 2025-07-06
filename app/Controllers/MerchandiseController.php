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
        $items = $model->getAvailableMerchandise();
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

        // Check if user is logged in
        if (!$userId) {
            session()->setFlashdata('error', 'Please log in to proceed with checkout.');
            return redirect()->to('/login');
        }

        // Get cart and items
        $cart = $cartModel
            ->where('user_id', $userId)
            ->orWhere('session_id', $sessionId)
            ->first();
            
        if (!$cart) {
            session()->setFlashdata('error', 'Your cart is empty.');
            return redirect()->to('/merchandise/cart');
        }

        $items = $cartItemModel->where('cart_id', $cart['id'])->findAll();
        
        if (empty($items)) {
            session()->setFlashdata('error', 'Your cart is empty.');
            return redirect()->to('/merchandise/cart');
        }

        // Calculate total
        $total = 0;
        $cartItems = [];
        foreach ($items as $item) {
            $merch = $merchModel->getItem($item['item_id']);
            if ($merch) {
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
                $cartItems[] = [
                    'id' => $item['item_id'],
                    'name' => $merch['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal
                ];
            }
        }

        // Store cart data in session for checkout process
        session()->set('checkout_cart', $cartItems);
        session()->set('checkout_total', $total);

        return view('merchandise/checkout', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
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

        // Check if user is logged in
        $userId = session()->get('user_id');
        if (!$userId) {
            session()->setFlashdata('error', 'Please log in to complete your order.');
            return redirect()->to('/login');
        }

        // Get cart data from session
        $cartItems = session()->get('checkout_cart');
        $total = session()->get('checkout_total');
        
        if (empty($cartItems)) {
            session()->setFlashdata('error', 'Your cart is empty.');
            return redirect()->to('merchandise/cart');
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

        $sessionId = session_id();
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();
        $cartModel = new CartModel();

        // Start transaction
        $orderModel->db->transStart();

        try {
            // Create order
            $orderData = [
                'user_id' => $userId,
                'session_id' => $sessionId,
                'total' => $total
            ];

            $orderId = $orderModel->insert($orderData);

            if (!$orderId) {
                throw new \Exception('Failed to create order');
            }

            // Create order items
            foreach ($cartItems as $item) {
                $orderItemData = [
                    'order_id' => $orderId,
                    'item_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ];
                
                if (!$orderItemModel->insert($orderItemData)) {
                    throw new \Exception('Failed to create order item');
                }
            }

            // Clear cart
            $cart = $cartModel
                ->where('user_id', $userId)
                ->orWhere('session_id', $sessionId)
                ->first();
                
            if ($cart) {
                $cartModel->delete($cart['id']);
            }

            // Clear session data
            session()->remove('checkout_cart');
            session()->remove('checkout_total');

            $orderModel->db->transComplete();

            if ($orderModel->db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            // Set success message
            $paymentMethod = $this->request->getPost('payment_method');
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

        } catch (\Exception $e) {
            $orderModel->db->transRollback();
            session()->setFlashdata('error', 'Failed to create order. Please try again.');
            return redirect()->back()->withInput();
        }
    }
} 