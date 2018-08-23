@extends('goods::layouts.head')
<body>
<div class="screen_screen">
	<div class="tab-hd">
        @foreach($cat_list as $key=>$cat)
		<div @if($id==$cat['id'] || $id==''&& $key==0)class='active'@endif><a href="category?id={{$cat['id']}}">{{$cat['goods_category_name']}}</a></div>
        @endforeach
	</div>
	<div class="tab-bd">
		<div class="hidd show">
			<ul class="screen_list container p3" style="justify-content: flex-start;">
				@foreach($next_cat as $key=>$next)
				<li><a href="goodslist?id={{$cat['id']}}"><img src="{{ URL::asset($next->category_img)}}" alt=""><p>{{$next->goods_category_name}}</p></a></li>
				@endforeach
			</ul>
		</div>

	</div>
</div>
<!-- 底部nav -->
@extends('goods::layouts.footer')
@section('footer')
	@parent
@endsection