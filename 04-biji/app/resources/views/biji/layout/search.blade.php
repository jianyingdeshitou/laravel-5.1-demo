
    <form method="GET" action="{{ url('/biji/') }}">
        <input type="text" name="search_biji" class="form-control" placeholder="按笔记内容搜索笔记" style="height: 50px;"/><br/>
        <div class="form-group">
            <div class="col-md-12">
                <label>选择笔记本</label>
                <select class="form-control" name="book_id">
                    @foreach($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div style="float: right;">
            <input type="submit" value="搜索" class="btn btn-default" style="width: 100%;"/>
        </div>
    </form>
