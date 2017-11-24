<div style="margin-top: 20px"></div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

<ul class="list-group">
    <div class="card-header" style="width: 100%;">
        <form action="{{config('custom.root_url')}}/answer/answer" method="post">
            <textarea id="answer"  name="content"></textarea>
            {{ csrf_field() }}
            <input type="text" hidden name="question_id" value="{{$question->id}}">

            <script>
                var simplemde = new SimpleMDE({
                    element: document.getElementById("answer"),
                    placeholder: "我有答案",
                });

            </script>
            <button type="submit" class="btn btn-success" style="float: right">发布</button>
        </form>
    </div>
    @foreach($answerList as $answer)
        <div class="card bg-light mb-3" style="width: 100%;">
            <div class="card-header">
                <h5>{{\App\User::find($answer->post_man_id)->name}}</h5>


                <button type="button" class="btn btn-primary btn-sm" onclick="work_for_me({{$answer->id}})">
                    <span id="{{$answer->id}}helped_men_num">{{$answer->helped_men_num}}</span><span>人觉得这个答案对其有帮助</span>
                </button>

                <button type="button" class="btn btn-secondary btn-sm" data-toggle="collapse" href="#{{$answer->id}}" aria-expanded="false" aria-controls="{{$answer->id}}">回复</button>
                <div class="dropdown-divider"></div>
                <div class="collapse" id="{{$answer->id}}">
                    {{--回复别人--}}
                    <form action="{{config('custom.root_url')}}/answer/answer" method="post">
                        {{ csrf_field() }}
                        <input type="text" hidden name="question_id" value="{{$question->id}}">


                        <div>
                            <textarea id="answer+{{$answer->id}}"  name="content"></textarea>
                        </div>

                        <script>
                            var simplemde = new SimpleMDE({
                                element: document.getElementById("answer+{{$answer->id}}"),
                                initialValue: "@ {{ \App\User::find($answer->post_man_id)->name }} :"
                            });
                        </script>

                        <button type="submit" class="btn btn-success" style="float: right">发布</button>
                    </form>

                </div>
            </div>


            {{--内容--}}
            <div class="card-body" id="answer_content{{$answer->id}}">
                <textarea name="content">{{$answer->content}}</textarea>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    var wordsView;
                    wordsView = editormd.markdownToHTML("answer_content{{$answer->id}}", {
                        htmlDecode      : "style,script,iframe",  // you can filter tags decode
                        emoji           : true,
                        taskList        : true,
                        tex             : true,  // 默认不解析
                        flowChart       : true,  // 默认不解析
                        sequenceDiagram : true,  // 默认不解析
                    });
                })
            </script>
        </div>
    @endforeach
</ul>
<script>
    function work_for_me(answer_id) {
        $.ajax({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
            url:"{{config('custom.root_url')}}/answer/work_for_me",
            data:{
                answer_id: answer_id
            } ,
            method:'post',
            success:function (res) {
                $('#'+answer_id+'helped_men_num').html(res.helped_men_num);
            },
            error:function(xhr,status,error){
                if (error=='Unauthorized'){ //if not logon,jump to login page
                    $(location).attr('href', '{{config('custom.root_url')}}/user/login');
                }
            }

        })
    }
</script>