@component('web.head')@endcomponent
<link rel="stylesheet" type="text/css" href="{{config('custom.root_url')}}/../css/user_center.css">

<div class="container">
	<div class="left">
    	@component('web.component.articleList',['articleList'=>$articles])@endcomponent
    </div>
</div>