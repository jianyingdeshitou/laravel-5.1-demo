# Laravel 5.1 示例 furbook.com

> 来源：Laravel 5 Essentials charpt 3

## 计划你的应用

### 实体、关系和属性

- Cats
    - a numeric identifier
    - a name
    - a date of birth
    - a breed
- Breeds
    - an identifier 
    - a name

### URL 结构

| Method | Route              | Description                      |
|--------|--------------------|----------------------------------|
| GET    | /cats              | Overview page                    |
| GET    | /cats/breeds/:name | Overview page for specific breed |
| GET    | /cats/:id          | Individual cat page              |
| GET    | /cats/create       | Form to create a new cat page    |
| POST   | /cats              | Handle creation of new cat page  |
| GET    | /cats/:id/edit     | Form to edit existing cat page   |
| PUT    | /cats/:id          | Handle updates to cat page       |
| GET    | /cats/:id/delete   | Form to confirm deletion of page |
| DELETE | /cats/:id          | Handle deletion of cat page      |

## 创建项目

在当前目录创建一个基于5.1版本的空项目

```
composer create-project laravel/laravel your-project-name --prefer-dist "5.1.*"
```

```bash
$ composer create-project --prefer-dist laravel/laravel . 5.1.* 
```

修改命名空间

```bash
$ php artisan app:name Furbook
```

## 编写第一个路由

修改 app/Http/routes.php 文件

```php
// GET /
Route::get('/', function() {
    return 'All cats';
});

// GET /cats/{id}
Route::get('cats/{id}', function($id) {
    return sprintf('Cat #%s', $id);
});
```

限制路由参数(只允许数字)

```php
// GET /cats/{id}
Route::get('cats/{id}', function($id) {
    sprintf('Cat #%d', $id);
})->where('id', '[0-9]+');
```

此时访问 /cats/123 会出现 404 错误

自定义的 http 异常页面位于 resources/views/errors，例如：

- 403: resources/views/errors/403.blade.php
- 404: resources/views/errors/404.blade.php

实现重定向

```php
// GET /
Route::get('/', function() {
    return redirect('cats');
});

// GET /cats
Route::get('cats', function() {
    return 'All cats';
});
```

## about 页面

创建 resources/views/about.php

```php
<h2>About this site</h2>
There are over <?php echo $number_of_cats; ?> cats on this site!
```

```php
// GET /about
Route::get('about', function() {
    return view('about')->with('number_of_cats', 9000);
});
```

## 准备数据库

修改 .env 文件：

```bash
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=furbook
DB_USERNAME=furbook
DB_PASSWORD=furbook
```

创建用户名、密码及数据库 

```bash
$ echo "CREATE USER 'furbook'@'%' IDENTIFIED BY 'furbook'" | mysql -uroot -pmysql
$ echo "GRANT ALL PRIVILEGES ON *.* TO 'furbook'@'%' WITH GRANT OPTION" | mysql -uroot -pmysql
$ echo "CREATE DATABASE furbook;" | mysql -ufurbook -pfurbook
```

新建 Model：Cat

```bash
$ php artisan make:model Cat -m
$ php artisan make:model Breed -m
```

编辑 app/Cat.php

```php
<?php namespace Furbook;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model {
     public $timestamps = false;
    protected $fillable = ['name', 'date_of_birth', 'breed_id'];
    public function breed() {
        return $this->belongsTo('Furbook\Breed');
    }
}
```

编辑 app/Breed.php

```php
<?php namespace Furbook;

use Illuminate\Database\Eloquent\Model;

class Breed extends Model {
    public $timestamps = false;
    public function cats(){
        return $this->hasMany('Furbook\Cat');
    }
}
```

编辑 database/migrations/{timestamps}_create_breeds_table.php

```php
public function up() {
    Schema::create('breeds', function($table) {
        $table->increments('id');
        $table->string('name');
    });
}

public function down() {
    Schema::drop('breeds');
}
```

编辑 database/migrations/{timestamps}_create_cats_table.php

```php
public function up() {
    Schema::create('cats', function($table) {
        $table->increments('id');
        $table->string('name');
        $table->date('date_of_birth');

        $table->integer('breed_id')->unsigned()->nullable();
        $table->foreign('breed_id')->references('id')->on('breeds');
    });
}

public function down() {
    Schema::drop('cats');
}
```

### 常用数据库类型

| command                                     | Description                                                                       |
|---------------------------------------------|-----------------------------------------------------------------------------------|
| $table->bigIncrements('name');              | It creates an auto-incrementing big integer column                                |
| $table->bigInteger('name');                 | It creates a BIGINT column                                                        |
| $table->binary('name');                     | It creates a BLOB column                                                          |
| $table->boolean('active');                  | It creates a BOOLEAN column                                                       |
| $table->char('name', 8);                    | It creates a CHAR column with the given length                                    |
| $table->date('birthdate');                  | It creates a DATE column                                                          |
| $table->dateTime('created_at');             | It creates a DATETIME column                                                      |
| $table->decimal('amount', 5, 2);            | It creates a DECIMAL column with the given precision and scale                    |
| $table->double('column', 10, 5);            | It creates a DOUBLE column, with 10 digits in total and 5 after the decimal point |
| $table->enum('gender', ['Female', 'Male']); | It creates an ENUM column                                                         |
| $table->float('amount');                    | It creates a FLOAT column                                                         |
| $table->increments('id');                   | It creates an auto-incrementing integer column                                    |
| $table->integer('rating');                  | It creates an INTEGER column                                                      |
| $table->json('options');                    | It creates a JSON column                                                          |
| $table->longText('description');            | It creates a LONGTEXT column                                                      |
| $table->mediumInteger('name');              | It creates a MEDIUMINT column                                                     |
| $table->mediumText('name');                 | It creates a MEDIUMTEXT column                                                    |
| $table->morphs('taggable');                 | It creates two columns: INTEGER taggable_ idandSTRING taggable_type               |
| $table->nullableTimestamps();               | This is similar to timestamps (next), but allows NULL values                      |
| $table->rememberToken();                    | It adds a remember_token VARCHAR column                                           |
| $table->tinyInteger('name');                | It creates a TINYINT column                                                       |
| $table->softDeletes();                      | It adds a deleted_at column for soft deletes                                      |
| $table->string('name');                     | It creates a VARCHAR column                                                       |
| $table->string('name', 255);                | It creates a VARCHAR column of the given length                                   |
| $table->text('name');                       | It creates a TEXT column                                                          |
| $table->time('name');                       | It creates a TIME column                                                          |
| $table->timestamp('name');                  | It creates a TIMESTAMP column                                                     |
| $table->timestamps();                       | It creates created_at and deleted_at columns                                      |

### 迁移数据库

```bash
$ php artisan migrate
```

如果再运行时遇到”class not found“的错误提示，尝试运行`composer dump-autoload`命令然后重新运行迁移命令。

### 填充数据

创建填充类：

```bash
$ php artisan make:seeder BreedsTableSeeder
```

编辑 database/seeds/BreedsTableSeeder.php

```php
class BreedsTableSeeder extends Seeder {
    public function run() {
        DB::table('breeds')->insert([
            ['id' => 1, 'name' => "Domestic"],
            ['id' => 2, 'name' => "Persian"],
            ['id' => 3, 'name' => "Siamese"],
            ['id' => 4, 'name' => "Abyssinian"],
        ]);
    }
}                                                }
```

为了控制填充的次序，编辑database/seeds/DatabaseSeeder.php

```php
$this->call('BreedsTableSeeder');
```

执行填充命令

```bash
$ php artisan db:seed
```

## Blade 模版

| Standard PHP syntax                    | Blade syntax           |
|----------------------------------------|------------------------|
| <?php echo $var; ?>                    | {!! $var !!}           |
| <?php echo htmlentities($var); ?>      | {{ $var }}             |
| <?php if ($cond): ?>...<?php endif; ?> | @if ($cond) ... @endif |

### 创建 master 视图模版

创建 resources/views/la youts/master.blade.php

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Furbook</title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.css">
</head>

<body>
    <div class="container">
        <div class="page-header">
            @yield('header')
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        
        @yield('content')
    </div>
</body>
</html>
```

再创建一个基于 master 模版的 about 视图模版

```bash
$ mv resources/views/about.php resources/views/about.blade.php
```

编辑 resources/views/about.blade.php

```blade
@extends('layouts.master')

@section('header')
<h2>About this site</h2>
@stop

@section('content')
<p>There are over {{ $number_of_cats }} cats on this site!</p>
@stop
```

通过 /about 查看视图

## 回到 router

编辑 app/Http/routes.php

```php
// GET /cats
Route::get('cats', function() {
    $cats = Furbook\Cat::all();
    return view('cats.index')->with('cats', $cats);
});

// GET /cats/breeds/{name}
Route::get('cats/breeds/{name}', function($name) {
    $breed = Furbook\Breed::with('cats')
                ->whereName($name)
                ->first();
    return view('cats.index')
                ->with('breed', $breed)
                ->with('cats', $breed->cats);
});
```

创建 resources/views/cats/index.blade.php

```blade
@extends('layouts.master')

@section('header')
@if (isset($breed))
    <a href="{{ url('/') }}">Back to the overview</a>
@endif

<h2>
    All @if (isset($breed)) {{ $breed->name }} @endif Cats 
    <a href="{{ url('cats/create') }}" class="btn btn-primary pull-right">
        Add a new cat
    </a>
</h2>
@stop

@section('content')
@foreach ($cats as $cat)
    <div class="cat">
        <a href="{{ url('cats/'.$cat->id) }}">
            <strong>{{ $cat->name }}</strong> - {{ $cat->breed->name }}
        </a> 
    </div>
@endforeach
@stop
```

## 显示一只猫的页面

编辑 app/Http/routes.php

```php
Route::get('cats/{id}', function($id) {
    $cat = Furbook\Cat::find($id);
    return view('cats.show')->with('cat', $cat);
});
// })->where('id', '[0-9]+');
```

### 路由 - 模型绑定

编辑 app/Providers/RouteServiceProvider.php

```php
use Furbook\Cat;

public function boot() {
    parent::boot();
    $router->model('cat', 'Furbook\Cat');
}
```

编辑 app/Http/routes.php

```php
// GET /cats/{cat}
Route::get('cats/{cat}', function(Furbook\Cat $cat) {
    return view('cats.show')->with('cat', $cat);
});
```

创建 resources/views/cats/show.blade.php

```php
@extends('layouts.master')

@section('header')
<a href="{{ url('/') }}">Back to overview</a>
<h2> {{ $cat->name }} </h2>
<a href="{{ url('cats/'.$cat->id.'/edit') }}"> 
    <span class="glyphicon glyphicon-edit"></span> Edit 
</a>
<a href="{{ url('cats/'.$cat->id.'/delete') }}">
    <span class="glyphicon glyphicon-trash"></span> Delete
</a>
<p>Last edited: {{ $cat->updated_at->diffForHumans() }}</p>
@stop

@section('content')
<p>Date of Birth: {{ $cat->date_of_birth }}</p>
<p>
@if ($cat->breed)
    Breed: {!! link_to('cats/breeds/'.$cat->breed->name, $cat->breed->name) !!}
@endif 
</p>
@stop
```

### 定制 404 页面

创建 resources/views/errors/404.blade.php

```php
@extends('layouts.master') 

@section('header')
<h2>404 Not Found</h2>
@stop

@section('content')
<p>服务器无法找到被请求的页面。</p>
@stop
```

## 添加、编辑和删除猫的信息

安装 laravelcollective/html

```bash
$ composer require laravelcollective/html v5.1
```

编辑 config/app.php

```php
'providers' => [
    ... ...
    Collective\Html\HtmlServiceProvideri::class,
],
```

```php
'aliases' => [
    ... ...
    'Form' => Collective\Html\FormFacade::class,
    'HTML' => Collective\Html\HtmlFacade::class,
],
```

创建 resources/views/partials/forms/cat.blade.php

```blade
<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    <div class="form-controls">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('date_of_birth', 'Date of Birth') !!}
    <div class="form-controls">
        {!! Form::date('date_of_birth', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('breed_id', 'Breed') !!}
    <div class="form-controls">
        {!! Form::select('breed_id', $breeds, null, ['class' => 'form-control']) !!}
    </div>
</div>
{!! Form::submit('Save Cat', ['class' => 'btn btn-primary']) !!}
```

创建 ComposerServiceProvider

```php
$ php artisan make:provider ComposerServiceProvider 
```

编辑 app/Providers/ComposerServiceProvider.php

```php
use Illuminate\Support\Facades\View;
... ...
public function boot()
{
    View::composer('partials.forms.cat',
        'Furbook\Http\Views\Composers\CatFormComposer');
}

use Illuminate\Contracts\View\Factory as ViewFactory;
... ...
public function boot(ViewFactory $view) {
    $view->composer('partials.forms.cat',
        'Furbook\Http\Views\Composers\CatFormComposer');
}
```

编辑 config/app.php

```php
'providers' => [
    ... ...
    Furbook\Providers\ComposerServiceProvider::class,
],
```

创建 app/Http/Views/Composers/CatFormComposer.php

```php
<?php
namespace Furbook\Http\Views\Composers;

use Furbook\Breed;
use Illuminate\View\View;

class CatFormComposer {
    protected $breeds;

    public function __construct(Breed $breeds) {
        $this->breeds = $breeds;
    }
    
    public function compose(View $view) {
        $view->with('breeds', $this->breeds->lists('name', 'id');
    }
}
```

创建 resources/views/cats/create.blade.php

```blade
@extends('layouts.master')

@section('header')
<h2>Add a new cat</h2>
@stop

@section('content')
{!! Form::open(['url' => '/cats']) !!}
@include('partials.forms.cat')
{!! Form::close() !!}
@stop
```

创建 resources/views/cats/edit.blade.php

```blade
@extends('layouts.master')

@section('header')
<h2>Edit a cat</h2>
@stop

@section('content')
{!! Form::model($cat, ['url' => '/cats/'.$cat->id], 'method' => 'put') !!}
@include('partials.forms.cat')
{!! Form::close() !!}
@stop
```

编辑 app/Http/routes.php

```php
Route::get('cats/create', function() {
    return view('cats.create');
});

Route::post('cats', function() {
    $cat = Furbook\Cat::create(Input::all());
    return redirect('cats/'.$cat->id)
        ->withSuccess('Cat has been created.');
});

Route::get('cats/{cat}/edit', function(Furbook\Cat $cat) {
    return view('cats.edit')->with('cat', $cat);
});

Route::put('cats/{cat}', function(Furbook\Cat $cat) {
    $cat->update(Input::all());
    return redirect('cats/'.$cat->id)
        ->withSuccess('Cat has been updated.');
});

Route::delete('cats/{cat}', function(Furbook\Cat $cat) {
    $cat->delete();
    return redirect('cats')
        ->withSuccess('Cat has been deleted.');
});
```

## Resource controllers


```
Route::resource('cat', 'CatController');
```

|Verb| Path| Action| Route Name|
|-|-|-|-|
|GET |/cat| index| cat.index|
|GET |/cat/create |create| cat.create|
|POST |/cat |store| cat.store|
|GET |/cat/{id} |show |cat.show|
|GET |/cat/{id}/edit |edit |cat.edit|
|PUT/PATCH |/cat/{id} |update| cat.update|
|DELETE |/cat/{id} |destroy| cat.destroy|

```
php artisan make:controller CatController
```

