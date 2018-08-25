<?php

namespace Modules\Goods\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        //查出广告轮播
        $ad=DB::table('ad')->orderBy('sort','id','desc')->get();

        //查出导航栏
        $nav=DB::table('nav')->orderBy('sort','id','desc')->get();

        //查出推荐商品
        $goods=DB::table('goods')->select('id','goods_name','goods_price','goods_images')->where('is_hot',1)->orderBy('sort','id','desc')->get();
       return view('goods::index',['ad'=>$ad,'nav'=> $nav,'goods'=>$goods]);
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
     *
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
