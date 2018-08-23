@extends('goods::layouts.head')
<body class="bfff">
<div class="list_search container between p3">
	<a class="left" href="screen.html"><i class="iconfont icon-jiantou"></i></a>
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
    @foreach($goods_list as $val)
	<li>
		<a href="goods_detail?id={{$val->id}}">
			<img src="{{ URL::asset($val->goods_images)}}" alt="">
			<h3>{{$val->goods_name}}</h3>
			<p>￥{{$val->goods_price}}元</p>
		</a>
	</li>
    @endforeach
</ul>
<!-- 底部nav -->
<!-- <div class="footer_nav container between">
	<a class="list active" href="index.html">
		<i class="nav_box i_home"></i>
		<p>首页</p>
	</a>
	<a class="list" href="screen.html">
		<i class="nav_box i_cate"></i>
		<p>分类</p>
	</a>
	<a class="list" href="my.html">
		<i class="nav_box i_user"></i>
		<p>我的</p>
	</a>
</div> -->
<!-- 返回顶部 -->
@extends('goods::layouts.footer2')