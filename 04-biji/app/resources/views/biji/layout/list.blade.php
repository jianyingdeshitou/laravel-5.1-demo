<div class="mobile_nav">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">所有笔记</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-menu">

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('biji/create') }}">新建笔记</a></li>
                    <li><a href="{{ url('book/create') }}">新建笔记本</a></li>
                    <li><a href="{{ '/secure/' }}">个人设置</a></li>
                    <li><a href="{{ '/fedBack/' }}">用户反馈</a></li>
                    <li><a href="{{ '/circle/' }}">笔友圈</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>
    <div class="biji_list_div" style=" z-index:2;border-right:1px solid #ECECEC">
        @if($bookPage)
                <div style="background-color: #393D41;width:100%;height:157px;text-align: center;color: #fff; font-size: 1.8rem;line-height: 40px;margin-bottom:15px;padding:20px;font-weight: 300;font-family: caecilia,times,serif;">
                    <div style="float: right">
                        <a href="{{-- url('/book/'.$search_book->id) --}}" class="atip" data-toggle="tooltip" data-placement="bottom" title="笔记本信息" style="text-decoration: none;cursor: pointer;">
                            <i class="icon info-img"></i>
                        </a>
                    </div>
                    {{ $title }}<br/>
                    <h6>由{{Auth::user()->name}}创建</h6>
                    <div style="float: right;"><h6>{{ $bookBijiCount }}条笔记</h6></div>
                </div>
        @else
            <div id="list_header">
                <h3 style="color: #999">笔记</h3>
                <h6 style="color: #ccc">{{-- $bijis->count() --}}条笔记</h6>
            </div>
            <br/>
        @endif
        <div class="list-group" style="overflow-y:auto;height:90%; ">
            @include('partials.success')
    </div>
