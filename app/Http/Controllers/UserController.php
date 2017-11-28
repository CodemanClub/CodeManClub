<?php

namespace App\Http\Controllers;

use App\Article;
use App\Email;
use App\Group;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpseclib\Crypt\Hash;

class UserController extends Controller
{
    protected $auth;



    public function __construct(Guard $auth){
        $this->auth = $auth;
    }
    private function email_code($email,$code){
        if (Email::where(['email'=>$email,'code'=>$code])->first()){
            return true;
        }else
            return false;
    }
    /**
     * register
     */
    public function regist(Request $request){
        /*注册表单处理*/
        if($request->isMethod('post')){
            $request->flashExcept(['password','password_confirmation']);
            if(!$this->email_code($request->input('email'),$request->input('code')))
                return ;
            /*表单数据规则*/
            $validateRules = [
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6|max:16',
            ];
            $this->validate($request,$validateRules);
            $formData = $request->all();
            $formData['password']=bcrypt($formData['password']);
            $user = User::create($formData);
            $this->auth->login($user);
            return redirect()->to('/');
        }else{
            return view('web.user.register');
        }
    }
    /**
     * 用户登录
     */
    public function login(Request $request){
        if ($request->isMethod('post')){
            $request->flashOnly('email');

            $validateRules = [
                'email' => 'required|min:8|max:128',
                'password' => 'required|min:6'
            ];
            $this->validate($request,$validateRules);
            /*只接收email和password的值*/
            $credentials = $request->only('email', 'password');
            if ($this->auth->attempt($credentials, $request->has('remember')))
            {
                return redirect()->to('/');
            }else{
                return view('web.user.login');
            }
        }else{
            return view('web.user.login');
        }

    }
    /**
     * 用户退出登录
     */
    public function logout(){

        $this->auth->logout();

        return redirect()->to('/');

    }
    /**
     * 用户中心
     * 需要展现的数据有：个人文章，个人问题（同问），关注的人，关注我的人，个人资料
     */
    public function center($user_id,$type){
        //获取用户的信息
        $user = User::find($user_id);
        //获取被访问用户的文章
        if ($type=='article'){
            if ($user_id!=Auth::id())
                $types = Article::where(['post_man_id'=>$user_id,'status_id'=>2,'is_del'=>0])->get();
            else
                $types = Article::where(['post_man_id'=>$user_id,'is_del'=>0])->get();
//            return view('web.user.center.index',['user'=>$user,'types'=>$types,'type'=>$type]);
        }
        //获取被访问用户的小组
        if ($type=='group'){
            $types = $user->groups;
        }
        //获取被访问用户所提的问题
        if ($type == 'question'){
            $types = $user->questions;
        }
        return view('web.user.center.index',['user'=>$user,'types'=>$types,'type'=>$type]);
    }
    //更新自己的资料
    public function update_me(Request $request){
        if ($request->isMethod('post')){
            $formData = $request->all();
            array_forget($formData,'_token');

            foreach ($formData as $k => $v){
                if (!$v){
                    array_forget($formData,$k);
                }
            }

            User::where('id',Auth::id())->update($formData);
            return redirect()->to('/user/center/'.Auth::id().'/article');
        }else{
            return view('web.user.update',['user'=>Auth::user()]);
        }
    }

}
