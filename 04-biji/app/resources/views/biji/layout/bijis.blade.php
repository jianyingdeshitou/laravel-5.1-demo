
            @foreach($bijis as $biji)
                <form class="biji_list_form" method="GET" action="{{ url('/biji/') }}">
                    <input type="hidden" name="biji_id" value="{{ $biji->id }}"/>
                    <a class="list-group-item active list">
                        <div style="white-space:nowrap;text-overflow:ellipsis;-o-text-overflow:ellipsis;overflow:hidden;">
                            {{ $biji->title }}
                        </div>
                        <div>
                            {{ $biji->created_at->format('Y-m-d') }}
                        </div>
                    </a>
                        <button class="biji_list_btn" type="submit" style="min-width:100%;border: none; text-overflow:ellipsis;-o-text-overflow:ellipsis;overflow:hidden;background-color: #fff">
                            <a class="list-group-item list">
                            <div style="height: 100px;text-overflow:ellipsis;-o-text-overflow:ellipsis;overflow:hidden;">
                                <div style=" float:left;height:80px;text-overflow:ellipsis;-o-text-overflow:ellipsis;overflow:hidden;">
                                    <p>{!! $biji->content !!}</p>
                                </div>
                            </div>
                            </a>
                        </button>
                </form>
            @endforeach
        </div>
