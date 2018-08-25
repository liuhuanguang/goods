@extends('goods::layouts.head')
<body>
<div class="page">
<header class="bar bar-nav">
<a class="button button-link button-nav pull-left" href="javascript:history.go(-1)" data-transition='slide-out'>
  <span class="icon icon-left"></span>
</a>
<h1 class="title">我的生活</h1>
</header>
<div class="content">
<div class="index_top">
	<div class="swiper-container" id="swiper1">
		<div class="swiper-wrapper">
			@foreach($ad as $val)
				<div class="swiper-slide"><a href="{{$val->ad_link}}"><img src="{{ URL::asset($val->ad_images)}}" alt=""></a></div>
		   @endforeach
		</div>
		<div class="swiper-pagination"></div>
	</div>
	<div class="search">
		<div class="search_box cl-a">
			<form action="search" method="get" id="search">
			<input class="fl" type="text" name="keywords" placeholder="请输入您搜索的关键词！">
			<i class="iconfont icon-sousuo fr" onclick="search()"></i>
			</form>
		</div>
	</div>
</div>
<ul class="index_nav_list container between">
	@foreach($nav as $val)
	<li><a href="{{$val->nav_link}}"><img src="{{ URL::asset($val->nav_images)}}" alt=""></a><p>{{$val->nav_name}}</p></li>
	@endforeach
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
	@foreach($goods as $val)
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
@extends('goods::layouts.footer')
@section('footer')
	@parent
@endsection
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
    function search() {
       $("#search").submit();
    }
	</script>