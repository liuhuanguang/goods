<?php

namespace Modules\Goods\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class FlowController extends Controller
{
    protected $user=1;
    public function __construct()
    {
//        if(!session('user')){
//            return redirect()->route('login');
//        }
//        $this->request = request();
        // 验证是否登录
        $this->middleware(function ($request, $next) {
            if (!session('user')) {
                redirect('user/login')->send();exit();
            }
            $this->user=session('user')['id'];
            return $next($request);
        });
    }


    public function addcart(Request $request)
    {

        $goods_id = $request->input('id');
        $number = $request->input('number');
        //查询商品
        $goods = DB::table('goods')->find($goods_id);
        if (false == $goods) {
            $msg = '商品不存在';
            return json_encode($msg);
            die;
        }
        if ($number > $goods->goods_number) {
            $msg = '库存不足';
            return json_encode($msg);
            die;
        }
        $data = [
            'user_id' => $this->user,
            'goods_id' => $goods_id,
            'goods_sn' => $goods->goods_sn,
            'goods_price' => $goods->goods_price,
            'market_price' => $goods->market_price,
            'goods_number' => $number
        ];
        //判断存在购物车就相加
        $cart = DB::table('cart')->where('user_id', 1)->where('goods_id', $goods_id)->value('id');
        if (false == $cart) {
            DB::beginTransaction();
            try {
                DB::table('cart')->insert($data);
                DB::commit();
                $msg = '添加购物车成功';
                return json_encode($msg);
                die;
            } catch (\Exception $e) {

                DB::rollBack();
                $msg = '添加购物车失败';
                return json_encode($msg);
                die;
            }
        } else {
            DB::table('cart')->increment('goods_number', $number);
            $msg = '添加购物车成功';
            return json_encode($msg);die;
        }
    }

  //购物车信息
    public function cart(){
        $cart_list=DB::table('cart')
            ->select('cart.id','cart.goods_id','cart.goods_number','goods.goods_name','goods.goods_price','goods.goods_images')
            ->join('goods','cart.goods_id','=','goods.id')
            ->where('cart.user_id',$this->user)
            ->get();
        return view('goods::cart',['cart_list'=>$cart_list]);

    }
    //确认订单
    public function buy(Request $request){
        $form=$request->input('cart_id');
            $msg =  $form;
            return json_encode($msg);die;

    }

    public function cart_buy(Request $request){
        $cart_id=$request->input('cart_id');
        if($cart_id=="null"){
            echo '<script>alert("请选择商品");window.history.go(-1)</script>';die;
        }
        $id=explode(',', $cart_id);
        $cart_list=DB::table('cart')
            ->select('cart.id','cart.goods_id','cart.goods_number','goods.goods_name','goods.goods_price','goods.goods_images')
            ->join('goods','cart.goods_id','=','goods.id')
            ->where('cart.user_id',$this->user)
            ->whereIn('cart.id',$id)
            ->get();
        return view('goods::buy',['cart_list'=>$cart_list,'cart_id'=>$cart_id]);

    }
    //直接下单
    public function zj_buy(Request $request){
        $form=$request->input();
        return view('goods::zj_buy',['cart_list'=>$cart_list]);

    }


}