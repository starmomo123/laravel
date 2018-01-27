var editor = new wangEditor('content');

if(editor.config){
    //图片上传的路由
    editor.config.uploadImgUrl = '/posts/image/upload';

    // 设置 headers（举例）
    editor.config.uploadHeaders = {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    };

    editor.create();
}


$('.preview_input').change(function(e){
    var file = e.currentTarget.files[0];
    var url = window.URL.createObjectURL(file);
    $(".preview_img").attr("src",url);
});