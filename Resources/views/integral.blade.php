@extends('goods::layouts.head')
<body class="bfff">

<div class="list_search container between p3">
	<a class="left" href="javascript:history.go(-1)"><i class="iconfont icon-jiantou"></i></a>
	<div class="center"><i class="iconfont icon-sousuo fr"></i><input class="fl" type="text" name="" placeholder="请输入您搜索的关键词!"></div>
</div>
<div class="list_screen container between">
	<div class="list active">
		<p>默认</p>
	</div>
	<div class="list">
		<p>销量<i class="iconfont icon-xiajiantou"></i></p>
	</div>
	<div class="list">
		<p>价格<i class="iconfont icon-xiajiantou"></i></p>
	</div>
</div>
<ul class="index_sp_list p3 container between mb3">
	@foreach($goods_list as $key=>$val)
	<li>
		<a href="integral_detail?id={{$val->id}}">
			<img src="{{ URL::asset($val->goods_images)}}" alt="">
			<h3>{{$val->goods_name}}</h3>
			<p><span>￥{{$val->goods_price}}元</span>+<span>{{$val->integral}}积分</span></p>
		</a>
	</li>
	@endforeach
</ul>
<!-- 底部nav -->
@extends('goods::layouts.footer')