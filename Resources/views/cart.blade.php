@extends('goods::layouts.head')
<body>
<div class="order_head">
	<a class="fanhui" href="my.html"><i class="iconfont icon-jiantou"></i></a>
	<p>购物车</p>
	<a class="rig_shai" id="rem_s" href="javascript:void(0)">编辑</a>
</div>
<form action="flow/buy/" id="form" enctype="application/x-www-form-urlencoded" method="post"  onsubmit="return  mySubmit(false)">
<div class="con carts_box ">
	<div class="content">
		<ul class="carts">
			@if($cart_list!='')
			 @foreach($cart_list as $key=>$val)
			<li class="cl-a">
				<div class="label fl">
					<label>
						<input type="checkbox" name="cart_id" value="{{$val->id}}"  />
						<img src="{{ URL::asset('static/img/c_checkbox_off.png')}}" /> </label>
				</div>
				<div class="img fl"> <img src="{{ URL::asset($val->goods_images)}}" /> </div>
				<div class="text fl">
					<h3>{{$val->goods_name}}</h3>
					{{--<div class="guige">规格：<span>红色</span><span>M号</span></div>--}}
					<div class="cl-a">
						<span class="fl price">￥{{$val->goods_price}}</span>
						<sapn class="div_right">
							<input type="button" value="-" class="btn1" />
							<span class="number">{{$val->goods_number}}</span>
							<input type="button" value="+" class="btn2" />
							</span>
					</div>
				</div>
			</li>
		  @endforeach
				@endif
		</ul>
		<p class="total">一共<number></number>件商品：<span></span></p>
	</div>
</div>
<div class="carts_fix">
	<div class="bottom">
		<div class="fl bottom-label">
			<label>
				<input type="checkbox" checked="" />
				<img src="{{ URL::asset('static/img/c_checkbox_off.png')}}" class="fl" /> 全选
			</label>
		</div>
		<div class="fr price"> 需要支付：<span></span>
			<button class="sett" onclick="buy()" >结算</button>
		</div>
	</div>
	<div class="bottom" style="display: none;">
		<div class="fl bottom-label">
			<label>
				<input type="checkbox" checked="" />
				<img src="{{ URL::asset('static/img/c_checkbox_off.png')}}" class="fl" /> 全选
			</label>
		</div>
		<div class="fr">
			<button class="delete">删除</button>
		</div>
	</div>
	<div class="text1">

			<input type="number" oninput="checkNum(this.value)" id="input" />
			<input type="button" value="确定" />
		</form>
		<script>
            function checkNum(val) {
                document.getElementById('input').value = val >= 0 ? val : 0
            }
		</script>
	</div>
</div>
<div class="no_goods">
	<p>暂无数据，快去逛逛吧！</p>
</div>
<script src="{{ URL::asset('static/js/zepto.js')}}"></script>
<script src="{{ URL::asset('static/js/carts.js')}}"></script>
<script>

    function mySubmit(flag){
        return flag;
    }

    function buy(){
        var obj = $('#form').serialize();
        var card_id = "";
        $('input[name=cart_id]:checked').each(function(i){
            if(0==i){
                card_id= $(this).val();

            }else{
                card_id += (","+$(this).val());
            }
        });


        // var arr=[];
        // for(var i=0;i<list.length;i++){
        //     // alert($(".show_goods .goods_box .add .spec .active:eq("+i+")").html())
        //     arr.push($(".show_goods .goods_box .add .spec .active:eq("+i+")").html())
        // }
        $.ajax({
            url:'flow/buy',
            type: 'post',
            data : {"cart_id" : card_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType:'json',
            success : function (res){
                window.location.href = "flow/cart_buy?cart_id="+res;

            }
        });
    }






</script>
</body>
</html>