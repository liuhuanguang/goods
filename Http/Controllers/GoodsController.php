<?php
namespace Modules\Goods\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $id = $request->input('id');
        $goods_list = DB::table('goods')->where('goods_category_id', $id)->select('id','goods_name','goods_price','goods_images')->where('is_show', 1)->where('is_del', 1)->orderBy('id', 'desc')->get();
        return view('goods::goods_list',['goods_list'=>$goods_list]);
    }
    public function detail(Request $request)
    {
        $id = $request->input('id');
        $goods_detail = DB::table('goods')->where('is_del', 1)->find($id);
        return view('goods::goods_detail',['goods_detail'=>$goods_detail]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('goods::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('goods::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('goods::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
