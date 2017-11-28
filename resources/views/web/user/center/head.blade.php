<div class="user-info" alt="个人信息">
	<div class="jumbotron">
	  <img width="80px" src="{{$user->avatar?config('custom.root_path').$user->avatar:'http://www.photophoto.cn/m15/032/004/0320040163.jpg'}}" alt="头像" class="rounded-circle">
	  <div class="card-title">
	  	<h4 class="card-title">{{$user->name}}</h4>
	  @if(\Illuminate\Support\Facades\Auth::id()===$user->id)
		  <a href="{{config('custom.root_url')}}/user/update"><button type="button" class="btn btn-info" style="float: right">编辑</button></a>
	  @else
	  	<button type="button" class="btn btn-info" style="float: right">关注</button>
	  @endif
	  </div>
	  
		<p style="color: #333">
			<h6 class="card-title">一句话介绍</h6>：{{$user->intro}}
		</p>
		<p style="color: #333">
			<h6 class="card-title">主要兴趣</h6>：{{$user->main_interesting}}
		</p>
		<p style="color: #333">
		<h6 class="card-title">职业</h6>：{{$user->occupation}}
		</p>
		<p style="color: #333">
		<h6 class="card-title">公司/学校</h6>：{{$user->company_or_school}}
		</p>
	</div>
</div>


