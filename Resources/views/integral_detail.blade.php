@extends('goods::layouts.head')
<body>
<style type="text/css">
    .list_ny_code{
        position: absolute;
        top: .3rem;
        right: .3rem;
        width: 1rem;
        height: 1rem;
        line-height: 1rem;
        text-align: center;
        border-radius: 100%;
        background-color: rgba(0,0,0,.5);
        z-index: 22;
    }
    .list_ny_code img{
        width: .6rem;
        height: .6rem;
        margin-top: .2rem;
    }
    .show_code{
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 33;
        display: none;
    }
    .show_code .mask{
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0,.5);
    }
    .show_code .code_box{
        position: absolute;
        top: 50%;
        margin-top: -3.5rem;
        left: 50%;
        margin-left: -3.5rem;
        width: 7rem;
        height: 7rem;
        border-radius: 4px;
        text-align: center;
        background-color: #fff;
    }
    .show_code .code_box img{
        width: 5rem;
        height: 5rem;
        margin-top: 1rem;
    }
</style>
<div class="list_ny_top">
	<div class="swiper-container" id="swiper2">
		<div class="swiper-wrapper">
		    <div class="swiper-slide"><img src="{{URL::asset($goods_detail->goods_images)}}" alt=""></div>
		    {{--<div class="swiper-slide"><img src="img/TB1g2FWFVXXXXbIXVXXXXXXXXXX_!!0-item_pic.jpg" alt=""></div>--}}
		</div>
		<div class="swiper-pagination"></div>
	</div>
	<div class="return"><a href="integral.html"><i class="iconfont icon-jiantou"></i></a></div>
	<div class="list_ny_code"><img src="{{URL::asset('static/img/ewm1.png')}}"></div>
</div>
<div class="show_code">
	<div class="mask"></div>
	<div class="code_box">
		<img src="img/1534128646.png">
	</div>
</div>
<div class="list_ny_price p3 db">
	<h1 class="titles">{{$goods_detail->goods_name}}</h1>
	<div class="price"><p class="left"><span>￥{{$goods_detail->goods_price}}元</span>+<span>{{$goods_detail->integral}}积分</span> </p></div>
	<div class="sc_price">市场价：<del>￥{{$goods_detail->market_price}}元</del></div>
	<div class="cl-a number"><p class="fl">销量：<span>{{$goods_detail->spu_count}}</span></p> <p class="fr">库存：<span>{{$goods_detail->goods_number}}</span></p></div>

</div>
<div class="list_ny_describe mb3">
	<p class="titles">商品描述</p>
	<div class="p3 concent">
		<div class="none">
			@if($goods_detail->goods_desc!='')
				{{$goods_detail->goods_desc}}
				@else
			<i class="iconfont icon-biaoqingleiben"></i>
			<p>亲，此处没有内容～！</p>
				@endif
		</div>
	</div>
</div>
<div class="fix_bnt p3 container between">
	<div class="left"><a href="index"><i class="iconfont icon-shouye"></i><p>首页</p></a></div>
	<div class="right_c" onclick="buy({{$goods_detail->id}})">立即兑换</div>
</div>



<script type="text/javascript" src="{{ URL::asset('static/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('static/js/swiper-4.2.2.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('static/js/js.js')}}"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
      pagination: {
        el: '.swiper-pagination',
        type: 'fraction',
      },
    });
    function buy(id){
        $.ajax({
            url:'/payments/integral_order_pay',
            type: 'post',
            data : {"id" :id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType:'json',
            success : function (res){
                if(res.code == 200){
                    window.location.href = '/payments/pay?order_id='+res.order_id;
                }else{
                    alert(data.msg);
                }

            }
        });
    }
  </script>
</body>
</html>