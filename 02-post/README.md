# Laravel 5.1 示例 － post

## 基本功能

>来源：http://www.zhangxihai.cn/archives/120

创建新项目

```
$ composer create-project --prefer-dist laravel/laravel . 5.1.*
```

修改命名空间

```
$ php artisan app:name Post
```

修改 .env

```
$ vim .env
```

创建Posts的模型

```
php artisan make:model --migration Post
```

修改数据迁移表

```
vim database/migrations/{timestamps}_create_posts_table.php
```

```
<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreatePostsTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::create('posts', function (Blueprint $table) {
      $table->increments('id');
      $table->string('slug')->unique();
      $table->string('title');
      $table->text('content');
      $table->timestamps();
      $table->timestamp('published_at')->index();
    });
  }
  /**
   * Reverse the migrations.
   */
  public function down()
  {
    Schema::drop('posts');
  }
}
```

在数据迁移创建时默认生成的列外，我们额外添加了4个数据列；

- Slug

我们将每篇文章的标题转换为slug值，并用它作为文章URI的一部分，这样可以使博客对搜索引擎更加友好。

- Title

每篇文章都需要一个标题。
- 
- Content

每篇文章都需要一些内容。

- Published_at

我们想控制文章何时被发布。

数据迁移已经被修改，现在运行迁移来生成表：

```
php artisan migrate
```

修改 Post 模型

```
<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Post extends Model
{
  protected $dates = ['published_at'];
  public function setTitleAttribute($value)
  {
    $this->attributes['title'] = $value;
    if (! $this->exists) {
      $this->attributes['slug'] = str_slug($value);
    }
  }
}
```

在database/factories/ModelFactory.php中添加测试数据

```
$factory->define(App\Post::class, function ($faker) {
  return [
    'title' => $faker->sentence(mt_rand(3, 10)),
    'content' => join("\n\n", $faker->paragraphs(mt_rand(3, 6))),
    'published_at' => $faker->dateTimeBetween('-1 month', '+3 days'),
  ];
});
```

添加 seeder

```
$ php artisan make:seeder PostsTableSeeder
```

修改 PostsTableSeeder

```
vim database/seeds/PostsTableSeeder.php
```

```
<?php

use Illuminate\Database\Seeder;

use Post\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Post::truncate();
        factory(Post::class, 20)->create();
    }
}
```

修改 DatabaseSeeder

```
vim database/seeds/DatabaseSeeder.php
```

```
$this->call(PostsTableSeeder::class);
```

填充数据

```
artisan db:seed
```

创建config/blog.php，添加配置


```
vim config/blog.php
```

```
<?php
return [
    'title' => 'My Blog',
    'posts_per_page' => 5
];
```

使用config('blog.title')将返回站点名称。

>提示：可以修改config/app.php 将时区从UTC改成本地时区。

创建 BlogController

```
artisan make:controller BlogController
```

```
vim app/Http/Controllers/BlogController.php
```

```
<?php
namespace App\Http\Controllers;
use App\Post;
use Carbon\Carbon;
class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->paginate(config('blog.posts_per_page'));
        return view('blog.index', compact('posts'));
    }
    public function showPost($slug)
    {
        $post = Post::whereSlug($slug)->firstOrFail();
        return view('blog.post')->withPost($post);
    }
}
```

创建resources/views/blog文件夹

```
mkdir resources/views/blog
```

接着在此文件夹下创建index.blade.php

```
vim resources/views/blog/index.blade.php
```

```
<html>
<head>
  <title>{{ config('blog.title') }}</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"
        rel="stylesheet">
</head>
<body>
  <div class="container">
    <h1>{{ config('blog.title') }}</h1>
    <h5>Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</h5>
    <hr>
    <ul>
      @foreach ($posts as $post)
        <li>
          <a href="/blog/{{ $post->slug }}">{{ $post->title }}</a>
          <em>({{ $post->published_at->format('M jS Y g:ia') }})</em>
          <p>
            {{ str_limit($post->content) }}
          </p>
        </li>
      @endforeach
    </ul>
    <hr>
    {!! $posts->render() !!}
  </div>
</body>
</html>
```

创建resources/views/blog/post.blade.php

```
<html>
<head>
    <title>{{ $post->title }}</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"
        rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <h5>{{ $post->published_at->format('M jS Y g:ia') }}</h5>
        <hr>
        {!! nl2br(e($post->content)) !!}
        <hr>
        <button class="btn btn-primary" onclick="history.go(-1)">
        « Back
        </button>
    </div>
</body>
</html>
```

## 快速添加注册登录功能

> 来源：http://laravelacademy.org/post/1258.html

### 从配置文件说起

Laravel 登录认证对应的配置文件为config/auth.php

```
return [
    'driver' => 'eloquent',
    'model' => App\User::class,
    'table' => 'users',
    'password' => [
        'email' => 'emails.password',
        'table' => 'password_resets',
        'expire' => 60,
    ],
];
```

默认的认证驱动是eloquent，对应的模型类文件为App\User.php，用户信息存放在users表中，重置密码表是password_resets。App\User模型类已经有了，users表和password_resets表对应的迁移文件在安装完Laravel后就有了，只需运行php artisan migrate即可。

### 定义认证路由

关于用户认证，Laravel还自带了两个控制器App\Http\Controllers\Auth\AuthController.php和App\Http\Controllers\Auth\PasswordController.php，分别用于处理注册登录和密码重置。

有了控制器，我们接下来定义访问认证相关页面的路由：

```
// 认证路由...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
// 注册路由...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
```

### 创建认证视图

首先我们创建注册视图resources/views/auth/register.blade.php

```
<form method="POST" action="/auth/register">
{!! csrf_field() !!}

<div>
    用户名
    <input type="text" name="name" value="{{ old('name') }}">
</div>

<div>
    Email
    <input type="email" name="email" value="{{ old('email') }}">
</div>

<div>
    密码
    <input type="password" name="password">
</div>

<div>
    确认密码
    <input type="password" name="password_confirmation">
</div>

<div>
    <button type="submit">注册</button>
</div>
</form>
```

### 用户注册

注册成功页面跳转到 http://laravel.app:8000/home ，这是Laravel默认认证成功后的跳转页面，由于我们没有定义相应路由，也没有定义相应控制器，这里我们可以通过在AuthController中定义 $redirectPath 属性来修改跳转链接：

```
protected $redirectPath = '/profile';
```

接下来我们定义一个UserController：

```
artisan make:controller UserController --plain
```

```
<!--app\Http\Controllers\UserController.php-->

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        echo $user['name'].'登录成功！';
    }
}
```

然后我们定义一个路由：

```
Route::get('profile','UserController@profile');
```

### 用户登录

接下来我们测试下登录功能，首先我们在浏览器中访问http://laravel.app:8000/auth/logout退出登录，然后访问http://laravel.app:8000/auth/login进入登录页面：

登录成功后即可跳转到http://laravel.app:8000/profile并显示

#### 使用用户名登录

Laravel默认使用邮箱作为用户名登录，在Laravel 5.1中，可以在AuthController中设置$username属性来指定登录账号选项，该属性默认值是email，如果要使用用户名登录可设置其值如下：

```
protected $username = 'name';
```

然后我们修改登录视图：


```
<div>
    用户名
    <input type="text" name="name" value="{{ old('name') }}">
</div>
```

在浏览器地址栏输入http://laravel.app:8000/auth/login：

#### 登录失败次数限制

此外需要注意的是Laravel 5.1还引入了登录失败次数限制，默认情况下，一分钟内登录5次失败就不能再登录了（基于用户名/邮箱+IP），该功能通过ThrottlesLoginstrait实现。

### 显示错误信息

上面的测试我们都使用了正确的数据进行输入，实际情况下，往往出现输入错误或者达到登录失败次数上限不能继续登录的情况，那么我们又该如何友好的提示用户呢，这里我们先简单通过在上述两个视图文件顶部添加如下代码：

```
@if (count($errors) > 0)
    <div class="alert alert-danger">
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div>
@endif
```

再次访问http://laravel.app:8000/auth/login，输入错误信息，报错如下：

