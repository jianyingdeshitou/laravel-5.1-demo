{!! Form::open(['url' => 'auth/register', 'class' => 'form-horizontal']) !!}
    <div class="form-group">
        {!! Form::label('name', '设置用户名', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('name', '',['class' => 'form-control', 'autofocus']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('email', '你的电子邮箱', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('password', '设置密码', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('password_confirmation', '确认密码', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4 col-md-offset-4">
            {!! Form::submit('注册', ['class' => 'btn btn-success', 'style' => 'width:100%;height:35px']) !!}
        </div>
    </div>

    <div class="form-group" style="font-size: 1.2rem">
        <div class="col-md-6 col-md-offset-4">
            已经拥有账号？ {!! link_to('auth/login', '马上登录') !!}
        </div>
    </div>
{!! Form::close() !!}
