@extends('goods::layouts.head')
<body class="bfff">
<div class="order_head"><a class="fanhui" href="javascript:history.go(-1)"><i class="iconfont icon-jiantou"></i></a><p>订单确认</p></div>
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
		<input type="hidden" name="cart_id" value="{{$goods->id}}">
	<div class="goods p3">
		<a class="cl-a" href="list_ny.html">
			<img class="fl img" src="{{ URL::asset($goods->goods_images)}}" alt="">
			<div class="fl center">
				<p class="name">{{$goods->goods_name}}</p>
				{{--<div class="guige">规格：<span>红色</span><span>M号</span></div>--}}
				<div class="cl-a down"><p class="number fl">×{{$goods->number}}</p><p class="price fr">￥{{$goods->goods_price}}</p></div>
			</div>
		</a>
	</div>
	<input type="hidden" name="number" id="number" value="{{$goods->number}}">
	<!-- <div class="xiaoji">
		<p class="left fl">商品小计</p>
		<p class="right fr">￥<span>48</span></p>
	</div> -->
	<div class="gobuy">
		<a class="bnt fr" onclick="buy()">去结算</a>
		<div class="fr price">需付：<p><span>￥{{$goods->count}}</span></p></div>
	</div>
</div>

<script type="text/javascript" src="{{ URL::asset('static/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('static/js/swiper-4.2.2.min.js')}}"></script>
{{--<script type="text/javascript" src="{{ URL::asset('static/js/area.js')}}"></script>--}}
<script type="text/javascript" src="{{ URL::asset('static/js/js.js')}}"></script>
<script>
    function buy(){
	var id=$('input[name=cart_id]').val();
	var number=$('#number').val();
        $.ajax({
            url:'/payments/order_pay',
            type: 'post',
            data : {"cart_id" :id,'number':number},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType:'json',
            success : function (res){
                if(res.code == 200){
                    window.location.href = '/payments/pay?order_id='+res.order_id+'&type=buy';
                }else{
                    alert(data.msg);
                }

            }
        });
    }


</script>
</body>
</html>