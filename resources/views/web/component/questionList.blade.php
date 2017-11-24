<ul class="list-group">
    @foreach($questionList as $question)
        <div class="form-group" style="width: 100%">
            <a href="{{config('custom.root_url')}}/question/content/{{$question->id}}" style="color: black">
                <h3 class="list-group-item">{{$question->title}}</h3>
            </a>
            <li class="list-group-item">提问者：{{\App\User::find($question->post_man_id)->name}}</li>
            <li class="list-group-item">
                提问时间：{{$question->updated_at}}
            </li>
            <li class="list-group-item">{{str_limit($question->content, $limit = 200, $end = '...')}}</li>
        </div>
    @endforeach
</ul>