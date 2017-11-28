@extends('web.head')

@section('title')
    {{$user->name}}正在修改资料
@endsection

@section('content')
    
    <div class="container">
        <div style="margin:50px auto;width: 100%;max-width: 500px;">

            <form id="upload_form" enctype='multipart/form-data'>
                <div class="form-group">
                    <label>头像</label>
                    <img width="80px" id="avatar" src="{{$user->avatar?config('custom.root_path').$user->avatar:'http://www.photophoto.cn/m15/032/004/0320040163.jpg'}}" alt="头像" class="form-control rounded-circle">
                    <label class="custom-file">
                        <input type="file" id="avatar_input" class="custom-file-input">
                        <span class="custom-file-control"></span>
                    </label>
                </div>
            </form>
            
            <form action="{{config('custom.root_url')}}/user/update" method="post">
                {{ csrf_field() }}
                <input type="text" name="avatar" id="avartar_form" hidden>

                <div class="form-group">
                    <label>用户名</label>
                    <input type="text" name="name" class="form-control" value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <label>简介</label>
                    <textarea name="intro" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$user->intro}}</textarea>
                </div>

                <div class="form-group">
                    <label>主要兴趣</label>
                    <input type="text" name="main_interesting" class="form-control" value="{{$user->main_interesting}}">
                </div>
                

                <div class="form-group">
                    <label>职业</label>
                    <input type="text" name="occupation" class="form-control" value="{{$user->occupation}}">
                </div>

                <div class="form-group">
                    <label>公司/学校</label>
                    <input type="text" name="company_or_school" class="form-control" value="{{$user->company_or_school}}">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <script>
                $("#avatar_input").change(function (event) {
                    file = event.target.files[0]
                    var data = new FormData();
                    data.append('avatar', file);
                    console.log(file)
                    $.ajax({
                        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                        url:"{{config('custom.root_url')}}/file/uploade/avatar",
                        method:'post',
                        data: data,
                        processData: false,
                        contentType: false,
                        success:function (res) {
                            console.log(res);
                            console.log("{{config('custom.root_path')}}"+res)
                            $('#avatar').attr('src',"{{config('custom.root_path')}}"+res);
                            $("#avartar_form").val(res);
                        }
                    });
                });
            </script>
        </div>
    </div>
@endsection
