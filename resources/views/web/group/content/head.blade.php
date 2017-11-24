<div class="user-info" alt="小组信息">
	<div class="jumbotron">
	  <img width="80px" src="http://www.photophoto.cn/m15/032/004/0320040163.jpg" alt="小组头像" class="rounded-circle">
	  <div class="card-title">
	  	<h4 class="card-title">{{$group->name}}</h4>
	  	<button id="in_or_out" type="button" class="btn btn-success">
	  		@if($is_in)
				退出
	  		@else
				加入
	  		@endif
	  	</button>
	  </div>
	  <script>
	  	$("#in_or_out").click(function(){
            $.ajax({
            	url:"{{config('custom.root_url')}}/group/in_or_out/{{$group->id}}",
            	success:function(result){
                    $("#in_or_out").html(result.button_value)
            	}
            })
         });
	  </script>




	  
	  <p style="color: #333">
	  	<h6 class="card-title">一句话介绍</h6>：{{$group->intro}}
	  </p>
	</div>
</div>


