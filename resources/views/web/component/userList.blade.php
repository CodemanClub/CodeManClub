<ul class="list-group">
    @foreach($userList as $user)
        <div class="form-group" style="width: 100%">
            <a href="{{config('custom.root_url')}}/user/center/{{$user->id}}/article" style="color: black">
                <h3 class="list-group-item">{{$user->name}}</h3>
            </a>
        </div>
    @endforeach
</ul>