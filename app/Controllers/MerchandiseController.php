<?php
namespace App\Controllers;

use App\Models\MerchandiseModel;
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
        $model = new MerchandiseModel();
        $item = $model->getItem($id);
        if (!$item) return redirect()->to('/merchandise');
        $cart = session()->get('cart') ?? [];
        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
        } else {
            $cart[$id] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'qty' => 1
            ];
        }
        session()->set('cart', $cart);
        session()->setFlashdata('success', esc($item['name']) . ' added to cart!');
        return redirect()->to('/merchandise');
    }

    public function cart()
    {
        $cart = session()->get('cart') ?? [];
        return view('merchandise/cart', ['cart' => $cart]);
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart') ?? [];
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->set('cart', $cart);
        }
        return redirect()->to('/merchandise/cart');
    }

    public function checkout()
    {
        // For now, just clear the cart and show a thank you message
        session()->remove('cart');
        return view('merchandise/checkout');
    }
} 