// 页面提示js
$(document).ready(function(){
    
    // 如果页面上存在按钮，则添加
    if ($('.jq-x-foot-tools-html').length == 1)
    {
        $('.x-foot-tools').append($('.jq-x-foot-tools-html').html());
    }
    
    // 如果页面上存在提示层，则创建问号按钮
    if ($('.x-q-hint').length == 1)
    {
        $('.x-foot-tools').append('<li><a href="javascript:;" class="hint" title="查看相关说明"></a></li>');
        $('.x-q-hint-close').attr('title', '关闭');
    }
    
    // 问号按钮点击事件
    $('.x-foot-tools .hint').click(function(){
        showHintWindow();
    });

    // 关闭弹出层
    $('.x-q-hint-close').click(function(){
        closeHintWindow();
    });

    // 滚动条事件
    $(window).bind('scroll', function(){
        if ($(document).scrollTop() > 200 && $('.x-foot-tools li .go2top').length == 0)
        {
            $('.x-foot-tools').append('<li><a href="javascript:;" class="go2top" title="返回顶部"></a></li>');
        }
        
        else if ($(document).scrollTop() <= 200)
        {
            $('.x-foot-tools li .go2top').closest('li').remove();
        }
    });

    // 点击按钮快速返回顶部
    $('.x-foot-tools li .go2top').live('click', function(){
        $("html,body").animate({scrollTop:0});
    });

    // 快捷键操作
    $(document).keypress(function(e){
        if (e.shiftKey && e.which == 63)
        {
            showHintWindow();
        }
    });

    $(document).keyup(function(e){
        if (e.which == 27)
        {
            closeHintWindow();
        }
    });
});

// 显示提示窗口
function showHintWindow()
{
    // 获取窗口高度
    var win_h = $('.x-q-hint').height() + 22;
    var margin_top = -(win_h/2)*1.5;

    // 显示窗口
    $('.x-q-hint-overlay').show();
    $('.x-q-hint').css({
        'left':'50%',
        'margin-top':margin_top + 'px'
    });
}

// 关闭提示窗口
function closeHintWindow()
{
    $('.x-q-hint').css('left','-99999px');
    $('.x-q-hint-overlay').hide();
}