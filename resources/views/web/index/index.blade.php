@component('web.head')@endcomponent

<div class="container" style="margin-top: 20px">
	<div style="max-width: 700px;width: 100%;float: left">
    	@component('web.component.articleList',['articleList'=>$articles])@endcomponent
    </div>
    <div style="float: right">
        @component('web.component.location')@endcomponent
    </div>
</div>