    $(function(){
        var dialogOpts = {
            modal:true,//模态
            autoOpen:false,//自动打开
            resizable:false,
            show:{effect: "blind",duration: 1000}, 
            hide:{effect:"explode",duration: 2000}
        };
        $("#myDialog").dialog(dialogOpts);
        $("#login").click(function(){
            $("#myDialog").dialog("open");
        });
    });
