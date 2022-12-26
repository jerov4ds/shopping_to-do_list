<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(empty($request->category)){
            return response()->json([
                'code'      => 403,
                'status'    => "Missing parameter",
                'message'   => "Please provide a valid list id"
            ], 403);
        }
        $page_size = ($request->page_size ?? 10);
        $page_num = ($request->page_num ?? 1);
        $sort_by = ($request->sort_by ?? 'id');
        $sort_type = ($request->sort_type ?? 'ASC');
        $title = ($request->title ?? '');
        $is_complete = $request->is_complete ?? 2;

        $items = Item::where('category_id', $request->category)
            ->where(function ($query) use ($title, $is_complete){
                if(!empty($title))
                    $query->whereRaw('title LIKE "%'. $title . '%"');
                if($is_complete != 2)
                    $query->where('is_complete', $is_complete);
            })
            ->orderBy($sort_by, $sort_type)
            ->paginate($page_size, ['*'], 'page', $page_num);

        return response()->json([
            'code'=> '200',
            'status'=> 'success',
            'data'=> $items
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id = null)
    {
        //
        $validator = Validator::make($request->all(), [
            'title'         => 'required|string|max:255|unique:items,title',
            'category_id'   => 'required|number'
        ]);

        if($validator->fails()){
            return response()->json([
                'code' => '403',
                'status'=>"Validation Failure",
                'message'=> $validator->messages()], 403);
        }

        $file_path = '';
        if ($request->image) {
            $folderPath = "uploads/";

            $base64Image = explode(";base64,", $request->image);
            $explodeImage = explode("image/", $base64Image[0]);
            $imageType = $explodeImage[1];
            $image_base64 = base64_decode($base64Image[1]);
            $arr_ext = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF');
            if(in_array($imageType, $arr_ext)){
                return response()->json([
                    'code'      => '403',
                    'status'    => 'Invalid file type',
                    'message'   => 'Only jpg, jpeg, png and gif file types are supported'], 403);
            }
            $file_path = $folderPath . uniqid() . '. '.$imageType;

            file_put_contents($file_path, $image_base64);
        }
        $is_completed = $request->is_completed ?? false;

        if($id != null){
            $item = Item::find($id);
            if($item == null){
                return response()->json([
                    'code'      => '404',
                    'status'    => 'Not found',
                    'message'   => 'Item selected was not found'], 404);
            }
        } else {
            $item = new Item();
        }
        $item->title            = $request->title;
        $item->category_id      = $request->category_id;
        $item->description      = $request->description;
        $item->image            = $file_path;
        $item->is_completed     = $is_completed;

        if($item->save()){
            return response()->json([
                'code'=> 200,
                'message'=> 'Item marked as completed',
                'data'=> $item
            ]);
        } else {
            return response()->json([
                'code'=>'501',
                'status'=> 'failed',
                'message'=> 'An error occurred please try again!'
            ], 501);
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
        $item = Item::where('id', $id)->with('category')->first();
        if($item == null){
            return response([
                'code'=>'404',
                'status'=> 'Not Found',
                'message'=> 'Item not found or deleted'
            ], 404);
        }

        return response([
            'code'=> '200',
            'status'=> 'success',
            'data'=> $item
        ], 200);
    }

    public function mark_as_complete($id){
        $item = Item::find($id);
        if($item == null){
            return response([
                'code'=>'404',
                'status'=> 'Not Found',
                'message'=> 'Item not found or deleted'
            ], 404);
        }
        $item->is_complete = true;

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
        $item = Item::find($id);
        if($item == null){
            return response([
                'code'=>'404',
                'status'=> 'Not Found',
                'message'=> 'Item not found or deleted'
            ], 404);
        }

        $item->delete();
        return response()->json([
            'code'=>'200',
            'status'=> 'success',
            'data'=> 'deletion successful'
        ], 200);
    }
}
