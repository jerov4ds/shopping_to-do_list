<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $page_size = ($request->page_size ?? 10);
        $page_num = ($request->page_num ?? 1);
        $sort_by = ($request->sort_by ?? 'id');
        $sort_type = ($request->sort_type ?? 'ASC');
        $title = ($request->title ?? '');

        $categories = Category::whereRaw('name LIKE "%'. $title . '%"')
            ->orderBy($sort_by, $sort_type)
            ->paginate($page_size, ['*'], 'page', $page_num);

        return response()->json([
            'code'=> '200',
            'status'=> 'success',
            'data'=> $categories
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:categories,title'
        ]);

        if($validator->fails()){
            return response()->json([
                'code' => '403',
                'status'=>"Validation Failure",
                'message'=> $validator->messages()], 403);
        }

        $category = new Category();
        $category->title = $request->title;

        if($category->save()){
            return response()->json([
                'code'=> 200,
                'message'=> 'New list created successfully',
                'data'=> $category
            ]);
        } else {
            return response()->json([
                'code'=>'501',
                'status'=> 'failed',
                'message'=> 'Issuer could not be saved'
            ], 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $category = Category::where('id', $id)->with('items')->first();
        if($category == null){
            return response([
                'code'=>'404',
                'status'=> 'Not Found',
                'message'=> 'No such list exists'
            ], 404);
        }

        return response([
            'code'=> '200',
            'status'=> 'success',
            'data'=> $category
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
        $category = Category::find($id);
        if($category == null){
            return response([
                'code'=>'404',
                'status'=> 'Not Found',
                'message'=> 'Security type does not exist or deleted'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'code' => '403',
                'status'=>"Validation Failure",
                'message'=> $validator->messages()], 403);
        }

        $category->title = $request->title;

        if($category->save()){
            return response()->json([
                'code'=>'200',
                'status'=> 'List title updated',
                'data'=> $category
            ], 200);
        } else {
            return response()->json([
                'code'=>'400',
                'status'=> 'failed',
                'message'=> 'List title could not be updated'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::find($id);
        if($category == null){
            return response([
                'code'=>'404',
                'status'=> 'Not Found',
                'message'=> 'List does not exist or deleted'
            ], 404);
        }

        $category->delete();
        return response()->json([
            'code'=>'200',
            'status'=> 'success',
            'data'=> 'deletion successful'
        ], 200);
    }
}