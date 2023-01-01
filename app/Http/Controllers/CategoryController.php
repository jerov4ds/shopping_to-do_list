<?php

namespace App\Http\Controllers;

use App\Helper\ApiGateway;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $response = ApiGateway::getAction('lists', ['page_size'=>1000, 'page_num'=>1]);
        $data = json_decode($response->body());
        $lists = $data->data;

        return view('welcome', compact('lists'));
    }

    public function create(Request $request){

    }
}
