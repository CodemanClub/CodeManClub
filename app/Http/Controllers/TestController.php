<?php

namespace App\Http\Controllers;

use App\Mail;

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
}
