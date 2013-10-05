$(document).ready(function(){

    $(document).bind('contextmenu',function(){return false;});
    $(document).bind('selectstart',function(){return false;});
    //$(document).keydown(function(){return false;});

    //热键
    $(document).bind("keydown", function(event){
        if (event.ctrlKey && event.keyCode==65)
        {
            event.returnValue=false;
        }
    });

});