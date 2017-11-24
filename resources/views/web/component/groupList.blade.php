<ul class="list-group">
    <div class="row">
        @foreach($groupList as $group)
            @if($group->id!=0)
                <div class="col-sm" style="width: 20rem; margin-top: 20px">
                    <div class="card" style="width: 20rem;">
                        <div class="card-body">
                            <a href="{{config('custom.root_url')}}/group/content/{{$group->id}}/article"><h4 class="card-title">{{$group->name}}</h4></a>
                            <p class="card-text">{{$group->intro}}</p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    {{--@foreach($groupList as $article)--}}
        {{--<div class="form-group" style="width: 100%">--}}

        {{--</div>--}}
    {{--@endforeach--}}
</ul>