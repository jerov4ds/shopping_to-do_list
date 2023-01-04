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

    public function items($id){
        $response = ApiGateway::getAction('lists/'. $id);
        $data = json_decode($response->body());
        $list = $data->data;
        if(!empty($list)) return view('items', compact('list'));
        else return redirect()->back();
    }

    public function itemModal(Request $request){
        $cat_id = $request->category_id;
        $item = '';
        if(!empty($request->item_id)){
            $response = ApiGateway::getAction('items/'. $request->item_id);
            $data = json_decode($response->body());
            $item = $data->data;
        }

        return view('modals.item', compact( 'item', 'cat_id'));
    }

    public function itemDetails($id){
            $response = ApiGateway::getAction('items/'. $id);
            $data = json_decode($response->body());
            $item = $data->data;

        return view('modals.item_details', compact( 'item'));
    }
}
