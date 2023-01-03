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

    public function modal(Request $request){
        $list = '';
        $type = $request->type;
        if(!empty($request->list_id)){
            $response = ApiGateway::getAction('lists/'. $request->list_id);
            $data = json_decode($response->body());
            $list = $data->data;
        }

        return view('modals.list', compact('list', 'type'));
    }

    public function create(Request $request){

    }
}
