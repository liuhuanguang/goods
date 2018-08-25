@extends('goods::layouts.head')
<body>
<div class="page">
<header class="bar bar-nav">
<a class="button button-link button-nav pull-left" href="cart.html" data-transition='slide-out'>
  <span class="icon icon-left"></span>
</a>
<h1 class="title">我的生活</h1>
</header>
<div class="content">
<div class="index_top">
	<div class="swiper-container" id="swiper1">
		<div class="swiper-wrapper">
		    <div class="swiper-slide"><img src="{{ URL::asset('static/img/1475869586530689271.png')}}" alt=""></div>
		    <div class="swiper-slide"><img src="{{ URL::asset('static/img/1475947014493634167.png')}}" alt=""></div>
		</div>
		<div class="swiper-pagination"></div>
	</div>
	<div class="search">
		<div class="search_box cl-a">
			<input class="fl" type="text" placeholder="请输入您搜索的关键词！">
			<i class="iconfont icon-sousuo fr"></i>
		</div>
	</div>
</div>
<ul class="index_nav_list container between">
	<li><a href=""><img src="{{ URL::asset('static/img/nav_0.png')}}" alt=""></a><p>全部分类</p></li>
	<li><a href=""><img src="{{ URL::asset('static/img/nav_1.png')}}" alt=""></a><p>全部分类</p></li>
	<li><a href=""><img src="{{ URL::asset('static/img/nav_2.png')}}" alt=""></a><p>全部分类</p></li>
	<li><a href=""><img src="{{ URL::asset('static/img/nav_3.png')}}" alt=""></a><p>全部分类</p></li>
	<li><a href=""><img src="{{ URL::asset('static/img/nav_4.png')}}" alt=""></a><p>全部分类</p></li>
	<li><a href=""><img src="{{ URL::asset('static/img/nav_5.png')}}" alt=""></a><p>全部分类</p></li>
	<li><a href=""><img src="{{ URL::asset('static/img/nav_6.png')}}" alt=""></a><p>全部分类</p></li>
	<li><a href=""><img src="{{ URL::asset('static/img/nav_7.png')}}" alt=""></a><p>全部分类</p></li>
</ul>
<!-- <ul class="index_cate container between">
	<li><a href=""><img src="img/index-theme-icon1.gif" alt=""></a></li>
	<li><a href=""><img src="img/index-theme-icon2.gif" alt=""></a></li>
	<li><a href=""><img src="img/index-theme-icon4.gif" alt=""></a></li>
	<li><a href=""><img src="img/index-theme-icon3.gif" alt=""></a></li>
</ul> -->
<div class="index_title">
	<img src="{{ URL::asset('static/img/bejing.png')}}" alt="">
	<p class="titles"><i class="iconfont icon-cainixihuan"></i>猜你喜欢</p>
	<p class="text">实时推荐最适合您的宝贝</p>
</div>
<ul class="index_sp_list p3 container between mb3">
	<li>
		<a href="list_ny.html">
			<img src="{{ URL::asset('static/img/TB1g2FWFVXXXXbIXVXXXXXXXXXX_!!0-item_pic.jpg')}}" alt="">
			<h3>蕴蓓 孕妇洗面奶控油纯天然 孕妇专用洗面奶保湿哺乳期洁面乳正品</h3>
			<p>￥48元</p>
		</a>
	</li>
	<li>
		<a href="list_ny.html">
			<img src="{{ URL::asset('static/img/T1jljyFyBaXXXXXXXX_!!0-item_pic.jpg')}}" alt="">
			<h3>蕴蓓 孕妇洗面奶控油纯天然 孕妇专用洗面奶保湿哺乳期洁面乳正品</h3>
			<p>￥48元</p>
		</a>
	</li>
	<li>
		<a href="list_ny.html">
			<img src="{{ URL::asset('static/img/T1hWBpFq0bXXbgMN73_050332.jpg')}}" alt="">
			<h3>Apple/苹果 配备 Retina 显示屏的 MacBook Pro ME864CH/A</h3>
			<p>￥48元</p>
		</a>
	</li>
	<li>
		<a href="list_ny.html">
			<img src="{{ URL::asset('static/img/T1JuZKFFdcXXXXXXXX_!!0-item_pic.jpg')}}" alt="">
			<h3>蕴蓓 孕妇洗面奶控油纯天然 孕妇专用洗面奶保湿哺乳期洁面乳正品</h3>
			<p>￥48元</p>
		</a>
	</li>
</ul>
<!-- 底部nav -->
<div class="footer_nav container between">
	<a class="list active" href="index.html">
		<i class="nav_box i_home"></i>
		<p>首页</p>
	</a>
	<a class="list" href="screen.html">
		<i class="nav_box i_cate"></i>
		<p>分类</p>
	</a>
	<a class="list" href="integral.html">
		<i class="nav_box i_shop"></i>
		<p>积分商城</p>
	</a>
	<a class="list" href="my.html">
		<i class="nav_box i_user"></i>
		<p>我的</p>
	</a>
</div>
<!-- 返回顶部 -->
<div class="gotop">
	<i class="iconfont icon-dingbu"></i>
</div>
</div>


</div>
<script type="text/javascript" src="{{ URL::asset('static/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('static/js/swiper-4.2.2.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('static/js/js.js')}}"></script>

<script>
window.onload = function() {
	// 顶部banner
	var bannerSwiper = new Swiper('#swiper1', {
		autoplay: {
		    delay: 5000,
		},
		pagination: {
	        el: '.swiper-pagination',
	    },
	});
}

</script>
</body>
</html>