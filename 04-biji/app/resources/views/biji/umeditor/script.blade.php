<!-- 样式文件 -->
<link rel="stylesheet" href="{{ asset('umeditor/themes/default/css/umeditor.css') }}'">

<!-- 引用jquery -->
<script type="text/javascript" src="{{ asset('umeditor/third-party/jquery.min.js') }}"></script>
<!-- 配置文件 -->
<script type="text/javascript" src="{{ asset('umeditor/umeditor.config.js') }}"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="{{ asset('umeditor/umeditor.js') }}"></script>
<!-- 语言包文件 -->
<script type="text/javascript" src="{{ asset('umeditor/lang/zh-cn/zh-cn.js') }}"></script>

<!-- 实例化编辑器代码 -->
<script type="text/javascript">
    $(function(){
        var ue = UM.getEditor('container');
    });
</script>
