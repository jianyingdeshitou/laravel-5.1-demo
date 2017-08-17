{!! Form::open(['url' => 'auth/login', 'class' => 'form-horizontal']) !!}
    <div class="thumb-div"><img class="thumb" src="{{ asset('images/photo.jpg') }}"/></div>

    <div class="form-group">
        {!! Form::label('email', '电子邮箱', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::email('email', old('email'), ['class' => 'form-control', 'autofocus']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('password', '密码', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <div class="checkbox">
                <label>
                    {!! Form::checkbox('remember') !!} 记住我
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4 col-md-offset-4">
            {!! Form::submit('登录', ['class' => 'btn btn-success', 'style' => 'width:100%;height:35px']) !!}
        </div>
    </div>

    <div class="form-group" style="font-size: 1.2rem">
        <div class="col-md-6 col-md-offset-4">
            没有账号？ {!! link_to('auth/register', '马上注册') !!}
        </div>
        <div class="col-md-6 col-md-offset-9">
            {!! link_to('password/email', '忘记密码？') !!}
        </div>
    </div>

{!! Form::close() !!}
