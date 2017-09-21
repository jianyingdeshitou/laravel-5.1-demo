<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Article;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //        return view('admin.article.index')->withArticles(Article::all());
        return view('admin.article.index')
            ->withArticles(Article::where('user_id', Auth::user()->id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 数据验证
        $this->validate($request, [
            // 必填、在 articles 表中唯一、最大长度 255
            'title' => 'required|unique:articles|max:255',
            // 必填
            'body' => 'required',
        ]);

        // 通过 Article Model 插入一条数据进 articles 表
        // 初始化 Article 对象
        $article = new Article;
        // 将 POST 提交过了的 title 字段的值赋给 article 的 title 属性
        $article->title = $request->get('title');
        // 同上
        $article->body = $request->get('body');
        // 获取当前 Auth 系统中注册的用户，并将其 id 赋给 article 的 user_id 属性
        $article->user_id = $request->user()->id;

        // 将数据保存到数据库，通过判断保存结果，控制页面进行不同跳转
        if ($article->save()) {
            // 保存成功，跳转到 文章管理 页
            return redirect('admin/article');
        } else {
            // 保存失败，跳回来路页面，保留用户的输入，并给出提示
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('admin.article.edit')->withArticle(Article::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
