<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=pS6z4NYdPHroMrozIxRtto40kvSTHP36"></script>

<div class="card text-white bg-secondary mb-3" style="max-width: 20rem;">
    <div class="card-header">附近的CodeMan</div>
    <div class="card-body">
        <h4 class="card-title">
            <a href="{{config('custom.root_url')}}/map/open_or_close">
                <button type="button" class="btn btn-primary">
                    @if ($user = \Illuminate\Support\Facades\Auth::user())
                        @if ($user->is_show_location)
                            关闭
                        @else
                            开启
                        @endif
                    @else
                        开启
                    @endif

                </button>
            </a>
        </h4>
        <p class="card-text">
            此功能是为了让您更快的认识身边志同道合的朋友。
            开启此功能后，您可以看到附近（10km）的代码人，当然附近的代码人也会看到您。关闭后，您的地理位置将不会被任何人看到。
        </p>
    </div>
</div>


<div id="near_users"></div>


<div id="allmap" hidden></div>
<script type="text/javascript">
    // 百度地图API功能
    @if ($user = \Illuminate\Support\Facades\Auth::user())
        @if ($user->is_show_location)
            var map = new BMap.Map("allmap");
            var geolocation = new BMap.Geolocation();
            geolocation.getCurrentPosition(function(r){
                if(this.getStatus() == BMAP_STATUS_SUCCESS){
                    map.panTo(r.point);
                    $.ajax({
                        headers:{'X-CSRF-TOKEN' : '{{ csrf_token() }}'},
                        url:"{{config('custom.root_url')}}/map/post/location",
                        method: 'post',
                        data:{lng:r.point.lng,lat:r.point.lat},
                        success:function () {
                            show_near_users()
                        }
                    })
                }
                else {
                    console.log('获取地理位置失败')
                }
            },{enableHighAccuracy: true})
        @endif
    @endif
    show_near_users=function () {
        $.ajax({
            headers:{'X-CSRF-TOKEN' : '{{ csrf_token() }}'},
            url:"{{config('custom.root_url')}}/map/get/near_users",
            method: 'post',
            success:function (res) {
                console.log(res)
                var str = ''
                for (var i=0;i<res.length;i++) {
                    str=str+
                    '<div class="card text-white bg-info mb-3" style="max-width: 20rem;">\n' +
                    '<a href="{{config('custom.root_url')}}/user/center/'+res[i].id+'/article" style="color:#eee">\n'+
                    '  <div class="card-header">'+res[i].name+'</div>\n' +
                    '</a>\n'+
                    '  <div class="card-body">\n' +
                    '    <h4 class="card-title"><img width="80px" src=" {{config('custom.root_path')}}/'+res[i].avatar+' " alt="头像" class="rounded-circle"></h4>\n' +
                    '    主要兴趣：<p class="card-text">'+res[i].main_interesting+'</p>\n' +
                    '    个人介绍：<p class="card-text">'+res[i].intro+'</p>\n' +
                    '  </div>\n' +
                    '</div>'
                }
                $('#near_users').html(str)
            }
        })
    }
</script>