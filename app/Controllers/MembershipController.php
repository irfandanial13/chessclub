<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PaymentModel;

class MembershipController extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id');

        $model = new UserModel();
        $user = $model->find($userId);

        if (!$user) {
            return redirect()->to('/login');
        }

        return view('membership/index', [
            'level' => $user['membership_level'] ?? 'Bronze',
            'status' => $user['status'] ?? 'Active',
            'expiry_date' => '2025-12-31', // Placeholder
        ]);
    }

    public function showPaymentUpload()
    {
        $level = $this->request->getPost('level');
        if (!in_array($level, ['Silver', 'Gold'])) {
            return redirect()->to('/membership')->with('error', 'Invalid membership level.');
        }
        return view('membership/payment_upload', ['level' => $level]);
    }

    public function submitPaymentUpload()
    {
        $userId = session()->get('user_id');
        $level = $this->request->getPost('level');
        $paymentReference = $this->request->getPost('payment_reference');
        $file = $this->request->getFile('receipt');

        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'Please upload a valid receipt file.');
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return redirect()->back()->with('error', 'Invalid file type. Only JPG, PNG, and PDF are allowed.');
        }

        $uploadPath = WRITEPATH . 'uploads/payments/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
        $newName = $userId . '_' . $level . '_' . time() . '.' . $file->getExtension();
        $file->move($uploadPath, $newName);

        $paymentModel = new PaymentModel();
        $paymentModel->save([
            'user_id' => $userId,
            'level' => $level,
            'file_path' => 'uploads/payments/' . $newName,
            'status' => 'pending',
            'payment_reference' => $paymentReference,
        ]);

        return redirect()->to('/membership')->with('success', 'Payment uploaded successfully! Your upgrade will be processed after verification.');
    }

    public function upgrade()
    {
        $level = $this->request->getPost('level');
        return $this->showPaymentUpload();
    }
}
