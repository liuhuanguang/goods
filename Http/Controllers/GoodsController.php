<?php

namespace Modules\Goods\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class GoodsController extends Controller
{
    protected $user_id = 1;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $id = $request->input('id');
        $goods_list = DB::table('goods')->where('goods_category_id', $id)->select('id', 'goods_name', 'goods_price', 'goods_images')->where('is_show', 1)->where('is_del', 1)->orderBy('id', 'desc')->get();
        return view('goods::goods_list', ['goods_list' => $goods_list]);
    }

    public function detail(Request $request)
    {
        $id = $request->input('id');
        $goods_detail = DB::table('goods')->where('is_del', 1)->find($id);
        //查出规格
        $goods_attr = DB::table('attribute')
            ->select('attribute.attr_name', 'attribute.id')
            ->join('goods_attr', 'attribute.id', '=', 'goods_attr.attr_id')
            ->where('attribute.is_show', 1)
            ->where('attribute.isdel', 1)
            ->where('goods_attr.goods_id', $id)
            ->groupBy('attribute.id')
            ->orderBy('attribute.id', 'desc')
            ->get()
            ->map(function ($value) {
                return (array)$value;
            })->toArray();
        $attr = array();
        foreach ($goods_attr as $key => $val) {
            $attr['attr_name'][$key] = $val;
            $attr['attr_name'][$key]['attr_value'] = DB::table('goods_attr')->select('id', 'attr_value', 'attr_price')->where('goods_id', $id)->where('attr_id', $val['id'])->get()->map(function ($value) {
                return (array)$value;
            })->toArray();


        }
        //查出购物车数量
        $cart_number = DB::table('cart')->where('user_id', $this->user_id)->count();
        return view('goods::goods_detail', ['goods_detail' => $goods_detail, 'attr' => $attr, 'cart_number' => $cart_number]);
    }

    //积分商城
    public function integral()
    {
        $goods = DB::table('integral_goods')
            ->select('integral_goods.id', 'integral_goods.goods_price', 'integral_goods.integral', 'goods.goods_name', 'goods.goods_images')
            ->join('goods', 'goods.id', '=', 'integral_goods.goods_id')
            ->orderBy('integral_goods.id', 'desc')
            ->get();


        return view('goods::integral', ['goods_list' => $goods]);

    }

    //积分商城详情
    public function integral_detail(Request $request)
    {
        $id = $request->input('id');
        $goods_detail = DB::table('integral_goods')
            ->select('integral_goods.*', 'goods.goods_name', 'goods.goods_images')
            ->join('goods', 'goods.id', '=', 'integral_goods.goods_id')
            ->where('integral_goods.id', '=', $id)
            ->first();

        return view('goods::integral_detail', ['goods_detail' => $goods_detail]);

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
