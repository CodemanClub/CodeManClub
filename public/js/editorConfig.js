$(function() {
    var editor = editormd("editormd", {
        path : "{{config('custom.root_url')}}/editor/lib/",// Autoload modules mode, codemirror, marked... dependents libs path
        emoji : true,
        height: 500
    });

});