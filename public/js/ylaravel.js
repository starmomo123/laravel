//在ajax启动之前加这个信息到请求头中，以便通过csrf验证
$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
})

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


$(".like-button").click(function(e){
    var target=$(this);
    var like_value=$(this).attr("like-value");
    var like_user=$(this).attr("like-user");
    if(like_value==1){
        //取消关注
        $.ajax({
            url:'/user/'+like_user+'/dounstar',
            method:"post",
            dataTyoe:"json",
            success:function(data){
                if(data.code==0){
                    alert(data.msg);
                    return ;
                }
                target.attr("like-value",0);
                target.text("关注");
            }
        })
    }else{
        //关注
        $.ajax({
            url:'/user/'+like_user+'/dostar',
            method:"post",
            dataTyoe:"json",
            success:function(data){
                if(data.code==0){
                    alert(data.msg);
                    return ;
                }
                target.attr("like-value",1);
                target.text("取消关注");
            }
        })
    }
});