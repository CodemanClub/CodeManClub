var article_id = null;
function autosave(){
	var title_val = $(" input[ name='title' ] ").val()
	var content_val = $(" textarea[ name='content'] ").val()

	if ($(" input[ name='id'] ").val())	//如果有值，则说明用户在更新文章
		article_id = $(" input[ name='id'] ").val()
	if (title_val&&content_val)
		$.ajax({
			url:"/article/autosave",
			data: { title: title_val,content:content_val,id:article_id },
			success:function(result){
				document.getElementById('articleId').value = result.articleid
				article_id = result.articleid

			}
		});
}
$(document).ready(function(){
	setInterval("autosave()",3000);
});