@section('footer')
<div class="footer_nav container between">
    <a class="list " href="index/">
        <i class="nav_box i_home"></i>
        <p>首页</p>
    </a>
    <a class="list active" href="category/">
        <i class="nav_box i_cate"></i>
        <p>分类</p>
    </a>
    <a class="list" href="integral/">
        <i class="nav_box i_shop"></i>
        <p>积分商城</p>
    </a>
    <a class="list" href="user/">
        <i class="nav_box i_user"></i>
        <p>我的</p>
    </a>
</div>
<!-- 返回顶部 -->
<div class="gotop">
    <i class="iconfont icon-dingbu"></i>
</div>
<script type="text/javascript" src="{{ URL::asset('static/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('static/js/swiper-4.2.2.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('static/js/js.js')}}"></script>

</body>
</html>
@show