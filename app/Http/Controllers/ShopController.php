<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->primary_model = new User();
    }

    public function getShop(){

       $data = $this->primary_model->whereNull('deleted_at')->get();
        return view('shop.list',['shops'=>$data]);
    }
}
