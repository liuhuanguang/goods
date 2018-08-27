<?php

namespace Modules\Goods\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

error_reporting(E_PARSE);

class FlowController extends Controller
{
    protected $user = 1;
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
        $attr = $request->input('attr_id');
        $attr_id = implode(',', $attr);
        $attr_value = $this->get_goods_attr_info($attr);
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
            'goods_number' => $number,
            'goods_attr_id' => $attr_id,
            'goods_attr' =>$attr_value
        ];
        //判断存在购物车就相加
        $cart = DB::table('cart')->where('user_id', $this->user)->where('goods_id', $goods_id)->where('goods_attr', $attr_value)->value('id');
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
            return json_encode($msg);
            die;
        }
    }

    //购物车信息
    public function cart()
    {
        $cart_list = DB::table('cart')
            ->select('cart.id', 'cart.goods_id','cart.goods_attr','cart.goods_attr_id','cart.goods_number', 'goods.goods_name', 'goods.goods_price', 'goods.goods_images')
            ->join('goods', 'cart.goods_id', '=', 'goods.id')
            ->where('cart.user_id', $this->user)
            ->get();
        return view('goods::cart', ['cart_list' => $cart_list]);

    }

    //确认订单
    public function buy(Request $request)
    {
        $form = $request->input('cart_id');
        $msg = $form;
        return json_encode($msg);
        die;

    }

    public function cart_buy(Request $request)
    {
        $cart_id = $request->input('cart_id');
        $id = explode(',', $cart_id);
        $cart_list = DB::table('cart')
            ->select('cart.id', 'cart.goods_id','cart.goods_attr','cart.goods_number', 'goods.goods_name', 'goods.goods_price', 'goods.goods_images', 'goods.integral')
            ->join('goods', 'cart.goods_id', '=', 'goods.id')
            ->where('cart.user_id', $this->user)
            ->whereIn('cart.id', $id)
            ->get();
        $integral=array();
        foreach($cart_list as $val){
            $integral['integral']+=intval($val->goods_price)*$val->integral*$val->goods_number;
        }
        $amount = $this->cart_amount($id);
        //查出优惠券
        $time = date('Y-m-d H:i:s', time() + 8 * 3600);
        $coupon = DB::table('discount')->select('id', 'discount_name', 'discount_price', 'discount_full_money')->where('start_at', '<=', $time)->where('end_at', '>=', $time)->where('status', 0)->where('user_id', $this->user)->where('discount_full_money', '<=',$amount)->get();
        //可用优惠券数量
        $coupon_count = DB::table('discount')->where('start_at', '<=', $time)->where('end_at', '>=', $time)->where('status', 0)->where('user_id', $this->user)->where('discount_full_money', '<=',$amount)->count();
        return view('goods::buy', ['cart_list' => $cart_list, 'cart_id' => $cart_id, 'amount' => $amount,'coupon' => $coupon, 'coupon_count' => $coupon_count,'integral'=> $integral['integral']]);

    }

    public function zj_cart_buy(Request $request)
    {
        $form = $request->input();
        $msg = $form;
        return json_encode($msg);
        die;

    }

    //直接下单
    public function zj_buy(Request $request)
    {
        $data = $request->input();
        $goods = Db::table('goods')->select('id', 'goods_name', 'goods_images', 'goods_price', 'integral')->where('id', $data['id'])->first();
        $goods->number = $data['number'];
        $goods->count = $goods->goods_price * $data['number'];
        //规格字符串转array
        $attr_id = explode(',', $data['attr']);
        //查出规格
        $attr = DB::table('attribute')
            ->select('goods_attr.id', 'goods_attr.attr_value', 'attribute.attr_name')
            ->join('goods_attr', 'attribute.id', '=', 'goods_attr.attr_id')
            ->whereIn('goods_attr.id', $attr_id)
            ->get();
        //查出优惠券
        $time = date('Y-m-d H:i:s', time() + 8 * 3600);
        $coupon = DB::table('discount')->select('id', 'discount_name', 'discount_price', 'discount_full_money')->where('start_at', '<=', $time)->where('end_at', '>=', $time)->where('status', 0)->where('user_id', $this->user)->where('discount_full_money', '<=', $goods->count)->get();
        //可用优惠券数量
        $coupon_count = DB::table('discount')->where('start_at', '<=', $time)->where('end_at', '>=', $time)->where('status', 0)->where('user_id', $this->user)->where('discount_full_money', '<=', $goods->count)->count();
        $integral = intval($goods->count * $goods->inregral);
        return view('goods::zj_buy', ['goods' => $goods, 'attr' => $attr, 'coupon' => $coupon, 'coupon_count' => $coupon_count, 'integral' => $integral, 'attr_id' => $data['attr']]);

    }

    //使用优惠券减价
    public function coupon(Request $request)
    {
        $data = $request->input();
//        $goods = Db::table('goods')->select('goods_price')->where('id', $data['goods_id'])->first();
//        $count = $goods->goods_price * $data['number'];
        //查询优惠劵
        $coupon = Db::table('discount')->select('discount_price')->where('id', $data['coupon_id'])->first();
        $amount = $data['amount'] - $coupon->discount_price;
        $msg = array();
        $msg['coupon'] = $coupon->discount_price;
        $msg['amount'] = $amount;
        return json_encode($msg);
        die;

    }

    //更新购物车数量
    public function update_number(Request $request)
    {
        $data = $request->input();
        DB::table('cart')->where('id', $data['id'])->update(['goods_number' => $data['number']]);
        //查出最新的购物车数量
        $number = DB::table('cart')->select('id', 'goods_number')->where('id', $data['id'])->first();
        $msg = $number;
        return json_encode($msg);
        die;

    }

    //删除购物车
    public function delete(Request $request)
    {
        $data = $request->input('cart_id');
        $id = explode(',', $data);
        foreach ($id as $val) {
            DB::table('cart')->where('id', $val)->delete();
        }
        $msg = '删除成功';
        return json_encode($msg);
        die;

    }

    //购物车总额
    protected function cart_amount($cart_id)
    {
        $cart = Db::table('cart')->whereIn('id', $cart_id)->get()->map(function ($value) {
            return (array)$value;
        })->toArray();
        $money = '';
        foreach ($cart as $key => $val) {
            $money += $val['goods_price'] * $val['goods_number'];
        }
        return $money;
    }

    /**
     * 获得指定的商品属性
     *
     * @access      public
     * @param       array $arr 规格、属性ID数组
     * @param       type $type 设置返回结果类型：pice，显示价格，默认；no，不显示价格
     *
     * @return      string
     */
    protected function get_goods_attr_info($arr, $type = 'pice')
    {

        $attr = '';

        if (!empty($arr)) {
            $fmt = "%s:%s \n";

            $res = DB::table('goods_attr')
                ->select('attribute.attr_name', 'goods_attr.attr_value')
                ->join('attribute', 'attribute.id','=','goods_attr.attr_id')
                ->whereIn('goods_attr.id', $arr)
                ->get()->map(function ($value) {
                    return (array)$value;
                })->toArray();;
            foreach ($res as $row) {
                //$attr_price = round(floatval($row['attr_price']), 2);
                $attr .= sprintf($fmt, $row['attr_name'], $row['attr_value']);
            }

            $attr = str_replace('[0]', '', $attr);
        }

        return $attr;
    }


}