<?php

namespace App\Http\Controllers;

use App\Mail;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    public function emailTest(){
        $mailto='zhangsugan@qq.com';
        $mailsubject="测试邮件";
        $mailbody='这里是邮件内容';
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

    public function test_redis(){
        Redis::set('name', 'Taylor');
        $values = Redis::get('name');
        return $values;
    }

    public function map($id){
        if ($id==1){
            return view('test.map');
        }
        if ($id==2){
            Redis::geoadd('user_ids',13.361389,38.115556,1);
            Redis::geoadd("user_ids",13.361389,38.115557,2);
            return Redis::GEORADIUSBYMEMBER('user_ids',1,10,'km');

        }
    }
}
