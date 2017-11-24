<ul class="list-group">
    @foreach($articleList as $article)
        <div class="form-group" style="width: 100%">
            <a href="{{config('custom.root_url')}}/article/getArticleById/{{$article->id}}" style="color: black">
                <h3 class="list-group-item">{{$article->title}}</h3>
            </a>
            <li class="list-group-item">作者：{{\App\User::find($article->post_man_id)->name}}</li>
            <li class="list-group-item">
                编辑状态：
                @if($article->status_id==2)
                    已发布
                @else
                    未发布
                @endif
            </li>
            <li class="list-group-item">
                最后更新于：{{$article->updated_at}}
            </li>
            <li class="list-group-item">{{str_limit($article->content, $limit = 200, $end = '...')}}</li>
        </div>
    @endforeach
</ul>