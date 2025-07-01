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
} 