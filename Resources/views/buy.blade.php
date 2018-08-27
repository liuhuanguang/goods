@extends('goods::layouts.head')
<body class="bfff">
<div class="order_head"><a class="fanhui" href="list_ny.html"><i class="iconfont icon-jiantou"></i></a><p>订单确认</p></div>
<div class="buy">
	<div class="cl-a addmap">
		<div class="tianjia cl-a" >
			<div class='left fl'>
				<span>+</span>
				<span>选择收货地址</span>
			</div>
			<i class="iconfont icon-jiantou fr"></i>
		</div>
		<!-- <div class="dizhi">
			<div class="nametel"><span>邵斌武</span><span>18335903534</span></div>
			<div class="map"><span>广东省</span><span>广州市</span><span>天河区</span><span>东圃镇东圃路</span></div>
		</div> -->
	</div>
	@foreach($cart_list as $key=>$val)
		<input type="hidden" name="cart_id" value="{{$cart_id}}">
	<div class="goods p3">
		<a class="cl-a" href="../goods_detail?id={{$val->goods_id}}">
			<img class="fl img" src="{{ URL::asset($val->goods_images)}}" alt="">
			<div class="fl center">
				<p class="name">{{$val->goods_name}}</p>
				{{--<div class="guige">规格：<span>红色</span><span>M号</span></div>--}}
				<div class="guige">规格：{{$val->goods_attr}}</div>
				<div class="cl-a down"><p class="number fl">×{{$val->goods_number}}</p><p class="price fr">￥{{$val->goods_price}}</p></div>
			</div>
		</a>
	</div>
	@endforeach
	<div class="buy_discount">
		<p class="fl">店铺优惠</p>
		<i class="iconfont icon-jiantou fr"></i>
		<input type="hidden" name="c_id" value="">
		<span class="fr">{{$coupon_count}}</span>
	</div>
	<div class="buy_discount_box">
		<div class="mask"></div>
		<div class="list_box  p3">
			<h3>店铺优惠</h3>
			<ul class="yh_list">
				<li onclick="clear_coupon()"><input type="hidden" name="coupon_id" value="0">不使用优惠券</li>
				@foreach($coupon as $val)
					<li onclick="coupon({{$amount}},{{$val->id}})"><input type="hidden" name="coupon_id" value="{{$val->id}}">满{{$val->discount_full_money}}减{{$val->discount_price}}</li>
				@endforeach
			</ul>
			<div class="close">关闭</div>
		</div>
	</div>
	<!-- <div class="xiaoji">
		<p class="left fl">商品小计</p>
		<p class="right fr">￥<span>48</span></p>
	</div> -->
	<div class="gobuy">
		<a class="bnt fr" onclick="buy()">去结算</a>
		<div class="fr price">红包：<p><span id="coupon">-￥0</span></p> 需付：<p><span id="amount">￥{{$amount}}</span></p>积分：{{$integral}}</div>
	</div>
</div>

<script type="text/javascript" src="{{ URL::asset('static/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('static/js/swiper-4.2.2.min.js')}}"></script>
{{--<script type="text/javascript" src="{{ URL::asset('static/js/area.js')}}"></script>--}}
<script type="text/javascript" src="{{ URL::asset('static/js/js.js')}}"></script>
<script>
    function buy(){
	var id=$('input[name=cart_id]').val();
        var coupon=$('input[name=c_id]').val();
        $.ajax({
            url:'/payments/order_pay',
            type: 'post',
            data : {"cart_id" :id,"coupon_id":coupon},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType:'json',
            success : function (res){
				if(res.code == 200){
				    window.location.href = '/payments/pay?order_id='+res.order_id+'&type=cart';
				}else{
				    alert(data.msg);
				}
            }
        });
    }
    function coupon(amount,coupon_id){
        $.ajax({
            url:'flow/coupon',
            type: 'post',
            data : {"amount" :amount,'coupon_id':coupon_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType:'json',
            success : function (res){
                $("#coupon").html('-'+res.coupon);
                $("#amount").html(+res.amount);

            }
        });

    }

    function clear_coupon() {
        window.location.reload();
    }


</script>
</body>
</html>