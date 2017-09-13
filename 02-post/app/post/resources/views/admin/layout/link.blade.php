@if(config('app.debug'))
<link href={{ asset('css/bootstrap.min.css') }} rel="stylesheet">
<link href={{ asset('css/font-awesome.min.css') }} rel="stylesheet">
<link href={{ asset('css/dataTables.bootstrap.min.css') }} rel="stylesheet">
@else
<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://cdn.bootcss.com/datatables/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endif

