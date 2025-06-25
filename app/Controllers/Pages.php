<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function admin()
    {
        return view('admin_template');
    }
}
