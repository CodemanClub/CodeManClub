@extends('web.head')
@section('content')
<div class="container">
    <link rel="stylesheet" href="{{config('custom.root_url')}}/../css/form.css">
    <div class="form-center">
        <form method="post" action="{{config('custom.root_url')}}/user/regist">
            {{ csrf_field() }}
            {{--用户昵称--}}
            <div class="form-group">
                <label for="exampleInputName">NickName</label>
                <input name="name" type="text" class="form-control" placeholder="NickName">
            </div>
            {{--邮箱--}}
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <p id="remind"></p>
                <button id="sendCode" type="button" class="btn btn-primary">Send Code</button>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                <script>
                    $("#sendCode").click(function(){
                        var e_mail = $(" input[ name='email' ] ").val()
                        $.ajax({
                            url:"{{config('custom.root_url')}}/send/eamil",
                            data: { email: e_mail},
                            success:function(result){
                                $("#sendCode").attr("disabled", true);
                                if (result)
                                    $("#remind").append(result.remind);
                                else
                                    $("#remind").append("验证码已发送");
                            }
                        });
                    });
                </script>
                @if ($errors->first('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>
            {{--验证码--}}
            <div class="form-group">
                <label for="code">Code</label>
                <input name="code" type="text" class="form-control" placeholder="Code">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                @if ($errors->first('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>
            {{--密码区--}}
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                @if ($errors->first('password'))
                    <span class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">ConfirmPassword</label>
                <input name="password_confirmation" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>

            <button type="submit" class="form-control btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection