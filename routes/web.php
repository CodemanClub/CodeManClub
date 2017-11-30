<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//首页
Route::get('/','IndexController@index');

/**
 * 账号路由
 */
Route::any('user/regist', 'UserController@regist');
Route::any('user/login', 'UserController@login');
Route::any('user/logout', 'UserController@logout');
Route::any('/login', 'UserController@login');
//用户进入用户中心页面
Route::any('/user/center/{user_id}/{type}','UserController@center');
//修改个人资料
Route::any('/user/update','UserController@update_me')->middleware('auth');

/**
 * Article路由
 */
//发布
Route::any('article/post','ArticleController@post')->middleware('auth');
//阅读文章
Route::any('article/getArticleById/{id}','ArticleController@getArticleById');
//自动保存
Route::any('article/autosave','ArticleController@autosave')->middleware('auth');
//更新
Route::any('article/update','ArticleController@updateArticle')->middleware('checkAuthor');
//根据用户id展示文章列表
Route::any('article/articleListByUser/{id}','ArticleController@getArticleListByUser');
//文章对我有帮助
Route::any('article/help_to_me','ArticleController@add_help_num');
//删除文章
Route::any('article/delete','ArticleController@delete')->middleware('auth');
/**
 * 文章评论
 */
Route::post('comment/post','CommentController@post')->middleware('auth');
/**
 * 邮箱控制器
 */
Route::any('send/eamil','EmailController@send');
/**
 * 小组路由
 */
Route::any('group/create','GroupController@create')->middleware('auth');
Route::any('group/content/{id}/{type}','GroupController@getGroupContent');
Route::any('group/list','GroupController@grouplist');
//用户加入或退出小组
Route::any('group/in_or_out/{group_id}','GroupController@in_or_out')->middleware('auth');


/**
 * 提问路由
 */
//提出问题
Route::any('question/ask','QuestionController@ask')->middleware('auth');
//同问
Route::any('question/same/ask','QuestionController@same_ask')->middleware('auth');
//获取问题详细内容及答案
Route::any('question/content/{id}','QuestionController@getContent');
Route::any('question/list/{cloumn}','QuestionController@getList');


/**
 *回答路由
 */
Route::post('answer/answer','AnswerController@answer')->middleware('auth');
//支持回答
Route::post('answer/work_for_me','AnswerController@work_for_me')->middleware('auth');


/**
 *文件控制器路由
 */
Route::post('file/uploade/avatar','FileController@avatar_uploade');

/**
 * 测试控制器
 */
Route::any('test/email','TestController@emailTest');
Route::any('test/redis','TestController@test_redis');
Route::any('test/map/{id}','TestController@map');

Route::get('phpinfo',function (){
    phpinfo();
});

Route::get('notAuthor',function (){
    return view('NotAuthor');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

/**
*404
*/
//Route::any('/',function(){
//	return view('errors.404');
//});
