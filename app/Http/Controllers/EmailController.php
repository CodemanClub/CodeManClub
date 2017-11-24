<?php

namespace App\Http\Controllers;

use App\Email;
use App\Mail;
use App\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    private function sendMail($mailsubject,$mailbody,$mailto){
//        $mailto='zhangsugan@qq.com';
//        $mailsubject="测试邮件";
//        $mailbody='这里是邮件内容';
        $smtpserver     = "smtpdm.aliyun.com";
        $smtpserverport = 80;
        $smtpusermail   = "nongbaike@mail.agrising.com";
        $smtpuser       = "nongbaike@mail.agrising.com";
        $smtppass       = "2016AgrisingMail";
        $mailsubject    = "=?UTF-8?B?" . base64_encode($mailsubject) . "?=";
        $mailtype       = "HTML";
        $smtp           = new Mail($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);
        $smtp->debug    = false;
        $smtp->sendmail($mailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
    }

    public function send(Request $request){
        $mailto =$request->input('email');//获取邮箱
        $formData['created_at']=$formData['updated_at']=date('Y-m-d H:i:s',time());
        $formData['code']=rand(1000,9999);
        $formData['email']=$mailto;
        if (User::where('email',$mailto)->first()){
            return ['remind'=>'此邮箱已经被占用'];
        }

        if (Email::where('email',$mailto)->first()){//邮箱已存在
            Email::where('email',$mailto)->update($formData);
        }else{
            Email::create($formData);
        }
        $mailsubject='CodeManClub邮箱验证';
        $mailbody='[CodeManClub]您的验证码是: '.$formData['code']." 5分钟内有效,如果不是您本人的操作，请忽略";
        $this->sendMail($mailsubject,$mailbody,$mailto);
    }
}
