# Laravel 5.1 示例 － task

>来源：http://laravelacademy.org/post/1703.html

## 创建新项目

```
$ composer create-project --prefer-dist laravel/laravel . 5.1.*
```

修改命名空间

```
$ php artisan app:name Task
```

修改 .env

```
$ vim .env
```

## 数据库迁移

创建 Task 模型

```
artisan make:model --migration Task
```

修改数据迁移表

```
vim database/migrations/{timestamps}_create_tasks_table.php
```

```
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('tasks', function (Blueprint $table) {
             $table->increments('id');
             $table->string('name');
             $table->timestamps();
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
      public function down()
      {
          Schema::drop('tasks');
      }
  }
  ```

运行迁移来生成表：

```
php artisan migrate
```

## 创建路由

```
vim app/Http/routes.php
```

```
Route::get('/', function () {
    return view('tasks');
});
```

## 创建视图

定义布局

```
mkdir resources/views/layouts
vim resources/views/layouts/app.blade.php
```

```
<!DOCTYPE html><html lang="en">
<head>
    <title>Laravel Quickstart - Basic</title>

    <!-- CSS And JavaScript -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
    <nav class="navbar navbar-default">
    <!-- Navbar Contents -->
    </nav>
    </div>

    @yield('content')
</body>
</html>
```

定义子视图

```
vim resources/views/tasks.blade.php
```

```
@extends('layouts.app')

@section('content')

<!-- Bootstrap Boilerplate... -->

<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')

    <!-- New Task Form -->
    <form action="/task" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Task Name -->
        <div class="form-group">
            <label for="task" class="col-sm-3 control-label">Task</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="task-name" class="form-control">
            </div>
        </div>

        <!-- Add Task Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-default">
                <i class="fa fa-plus"></i> Add Task
            </button>
            </div>
        </div>
    </form>
</div>

<!-- TODO: Current Tasks -->
@endsection
```

> 注：@include('common.errors')指令将会加载resources/views/common/errors.blade.php模板中的内容，我们还没有定义这个模板，但很快就会了！

## 添加任务

### 验证表单输入

对这个表单而言，我们将name字段设置为必填项，而且长度不能超过255个字符。如果表单验证失败，将会跳转到前一个页面，并且将错误信息存放到一次性session中：

```
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    // Create The Task...
});
```

### $errors变量

让我们停下来讨论下上述代码中的->withErrors($validator)部分，->withErrors($validator)会将验证错误信息存放到一次性session中，以便在视图中可以通过$errors变量访问。

我们在视图中使用了@include('common.errors')指令来渲染表单验证错误信息，common.errors允许我们在所有页面以统一格式显示错误信息。我们定义common.errors内容如下：

```
vim resources/views/common/errors.blade.php
```

```
@if (count($errors) > 0)
<!-- Form Error List -->
<div class="alert alert-danger">
    <strong>Whoops! Something went wrong!</strong>
    <br><br>

    <ul> 
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>
@endif
```

>注：$errors变量在每个Laravel视图中都可以访问，如果没有错误信息的话它就是一个空的ViewErrorBag实例。

创建任务

```
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/');
});
```

显示已存在的任务

```
Route::get('/', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks
    ]);
});
```

数据被传递到视图后，我们可以在tasks.blade.php中以表格形式显示所有任务。Blade中使用@foreach处理循环数据：

```
@extends('layouts.app')

@section('content')
<!-- Create Task Form... -->

<!-- Current Tasks -->
@if (count($tasks) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        Current Tasks
    </div>

    <div class="panel-body">
    <table class="table table-striped task-table">

    <!-- Table Headings -->
    <thead>
        <th>Task</th>
        <th>&nbsp;</th>
    </thead>

    <!-- Table Body -->
    <tbody>
    @foreach ($tasks as $task)
    <tr>
        <!-- Task Name -->
        <td class="table-text">
            <div>{{ $task->name }}</div>
        </td>

        <td>
            <!-- TODO: Delete Button -->
        </td>
    </tr>
    @endforeach
    </tbody>
    </table>
    </div>
</div>
@endif
@endsection
```

## 删除任务

我们在tasks.blade.php视图中留了一个“TODO”注释用于放置删除按钮。当删除按钮被点击时，DELETE /task请求被发送到应用后台：

```
<tr>
    <!-- Task Name -->
    <td class="table-text">
        <div>{{ $task->name }}</div>
    </td>

    <!-- Delete Button -->
    <td>
    <form action="/task/{{ $task->id }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <button>Delete Task</button>
    </form>
    </td>
</tr>
```

### 关于方法伪造

尽管我们使用的路由是Route::delete，但我们在删除按钮表单中使用的请求方法为POST，HTML表单只支持GET和POST两种请求方式，因此我们需要使用某种方式来伪造DELETE请求。

我们可以在表单中通过输出method_field('DELETE')来伪造DELETE请求，该函数生成一个隐藏的表单输入框，然后Laravel识别出该输入并使用其值覆盖实际的HTTP请求方法。生成的输入框如下：

```
<input type="hidden" name="_method" value="DELETE">
```

## 删除任务

最后，让我们添加业务逻辑到路由中执行删除操作，我们可以使用Eloquent提供的findOrFail方法从数据库通过ID获取模型实例，如果不存在则抛出404异常。获取到模型后，我们使用模型的delete方法删除该模型在数据库中对应的记录。记录被删除后，跳转到/页面：

```
Route::delete('/task/{id}', function ($id) {
    Task::findOrFail($id)->delete();
    return redirect('/');
});
```

