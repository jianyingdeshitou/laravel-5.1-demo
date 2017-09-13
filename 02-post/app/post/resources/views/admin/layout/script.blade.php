@if(config('app.debug'))
<script src={{ asset('js/jquery.min.js') }}></script>
<script src={{ asset('js/bootstrap.min.js') }}></script>
<script src={{ asset('js/jquery.dataTables.min.js') }}></script>
<script src={{ asset('js/dataTables.bootstrap.min.js') }}></script>
@else
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.bootcss.com/datatables/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.bootcss.com/datatables/1.10.16/js/dataTables.bootstrap.min.js"></script>
@endif
