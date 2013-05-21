var chart;

$(document).ready(function(){

    // 所有日期选择框，readonly
    $('.x-small-input-date').attr('readonly', true);
    
    // 全局搜索效果
    $('.x-search .x-small-input').focus(function(){
        $(this).addClass('jq-x-search-input-focus');
        $(this).siblings('a').addClass('enter');
    }).blur(function(){
        $(this).removeClass('jq-x-search-input-focus');
        $(this).siblings('a').removeClass('enter');
    });
    
    $(document).bind('keydown', function(e){
        switch (e.which)
        {
            case 13 : // enter
                if ($(document.activeElement).hasClass('jq-x-search-input-focus'))
                {
                    $('.jq-x-search-input-focus').siblings('a').trigger('click');
                }
        }
    });

    // 表格中数字列处理
    var em_outer_width;
    $('.x-tbl .x-tbl-inner table').each(function(){
        $(this).children('colgroup').children('col').each(function(i){
            if ($(this).attr('is_num')==1) // 找到含有is_num标记的col
            {
                // 获取该列td中.num的最大宽度
                em_outer_width = 0;
                $(this).closest('table').find('tr').find('td:eq(' + i + ')').find('.num').each(function(){
                    if ($(this).width() > em_outer_width)
                    {
                        em_outer_width = $(this).width();
                    }
                });
                // 将最大宽度赋值给该列所有x-em-outer
                $(this).closest('table').find('tr').find('td:eq(' + i + ')').find('.num').css('width', em_outer_width+1 + 'px');

            }
        });
    });
    
    // 表格单击选中某行
    /*
    $('.x-tbl:not(.jq-no-selected-tbl) .x-tbl-inner table tbody tr').bind('click', function(){
        if ($(this).hasClass('selected'))
        {
            $(this).removeClass('selected');
        }
        else
        {
            $(this).closest('table').find('tbody tr').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('.x-tbl:not(.jq-no-selected-tbl) .x-tbl-inner table tbody tr a, .x-tbl:not(.jq-no-selected-tbl) .x-tbl-inner table tbody tr input[type=text]').click(function(e){
        e.stopPropagation();
    });
    */
    
    // 模拟文件上传框
    $('.jq-file-btn').click(function(){
        $('input[type=file]').click();
    });

    $('.jq-uploader input[type=file]').bind('change', function(){
        var filepath = $(this).val();
        filename = filepath.split("\\");
        $(this).next('.jq-file-box').text(filename[filename.length-1]);
        $(this).closest('.jq-uploader').attr('title', filepath);
    });
    
    // 获取文件真实路径
    function getPath(obj)
    {
        if (obj)
        {
            if (window.navigator.userAgent.indexOf("MSIE") >= 1)
            {
                obj.select();
                return document.selection.createRange().text;
            }
            else if (window.navigator.userAgent.indexOf("Firefox") >= 1)
            {
                if (obj.files)
                {
                    return obj.files.item(0).getAsDataURL();
                }
                return obj.value;
            }
            return obj.value;
        }
    }
    
    // 为表格编号
    $('.x-tbl:not(.x-tbl-fixed, .x-tbl-no-fixed)').each(function(i){
        $(this).attr('fix', i + 1);
    });

    // 滚动事件，产生fix表头
    $(window).bind('scroll', function(){
        var scroll_top = $(this).scrollTop();
        $('.x-tbl:not(.x-tbl-fixed, .x-tbl-no-fixed)').each(function(){
            // 当表格有表头的时候，才生成fix表头
            if ($(this).find('thead').length == 1)
            {
                // 当tbl距离顶部的距离小于滚动条滚动距离，并且没有对应fix表头时，则创建fix表头
                if ($(this).find('thead').offset().top < scroll_top && $('.x-tbl-caption-fixed[fix=' + $(this).attr('fix') + ']').length < 1)
                {
                    $('.x-tbl-caption-fixed').remove(); // 保证同时只存在一个fix表头
                    
                    // 获取表格的宽度，和距离左边的位置
                    var fix_tbl_width = $(this).children('.x-tbl-inner').width();
                    var fix_tbl_height = $(this).find('thead').height();
                    var fix_tbl_inner_width = $(this).find('table').width();
                    var fix_tbl_offset_left = $(this).offset().left;
                    var fix_tbl_inner_scroll_left = $(this).find('.x-tbl-inner').scrollLeft();

                    var thead_html = $(this).find('thead').html() ? $(this).find('thead').html() : '';
                    var colgroup_html = $(this).find('colgroup').html() ? $(this).find('colgroup').html() : '';
                    
                    $('body').prepend('<div class="x-tbl-caption-fixed" fix="' + $(this).attr('fix') + '" style="margin-left:' + fix_tbl_offset_left + 'px;"><div class="' + $(this).attr('class') + ' x-tbl-fixed" style="width:' + fix_tbl_width + 'px;height:' + fix_tbl_height + 'px;"><div class="x-tbl-inner" style="left:-' + fix_tbl_inner_scroll_left + 'px;width:' + fix_tbl_inner_width + 'px;"><table>' + colgroup_html + '<thead>' + thead_html + '</thead>' + '</table></div></div></div>');
                }
            }
        });

        // 当有fix表头存在时，检测是否要移除
        if ($('.x-tbl-caption-fixed').length == 1)
        {
            var fix_tbl = $('.x-tbl[fix=' + $('.x-tbl-caption-fixed').attr('fix') + ']');
            
            if (fix_tbl.offset().top + fix_tbl.height() - 33 <= scroll_top || fix_tbl.find('thead').offset().top >= scroll_top)
            {
                $('.x-tbl-caption-fixed').remove();
            }
        }
    });
    
    // 有滚动条的表格，产生了fix表头，表头也要一起横向滚动
    $('.x-tbl-inner').bind('scroll', function(){
        var fix = $(this).closest('.x-tbl').attr('fix');
        if ($('.x-tbl-caption-fixed[fix=' + fix + ']').length == 1)
        {
            $('.x-tbl-caption-fixed[fix=' + fix + ']').find('.x-tbl-inner').css('left', '-' + $(this).scrollLeft() + 'px');
        }
    });
    
    // .x-cond和.x-tbl-width-auto清除浮动
    //$('.x-tbl-width-auto').after('<div style="clear:both;height:0;overflow:hidden;"></div>');
    
});

//显示提示条(已废弃)
/*
function showMsgBar(type, text)
{
    var type = arguments[0] ? arguments[0] : 'error';
    var text = arguments[1] ? arguments[1] : '';
    var selector = arguments[2] ? arguments[2] : '#tab';

    $('.x-msg-bar').remove();

    $(selector).after('<div class="x-msg-bar x-msg-bar-' + type + '"><img src="images/s.gif" class="x-icon" /><span class="txt">' + text + '</span></div>');
    showAlertMsg(type, text);
}*/

//显示alert提示信息
/*
function showAlertMsg(type, text, show_time, callback_func)
{
    var type = arguments[0] ? arguments[0] : 'success';
    var text = arguments[1] ? arguments[1] : '提示信息';
    var show_time = arguments[2] ? arguments[2] : 3000;
    var callback_func = arguments[3] ? arguments[3] : null;

    if ($('.x-msg-bar-outer .x-msg-bar-' + type).length > 0)
    {
        $('.x-msg-bar-outer .x-msg-bar-' + type).find('span.txt').text(text);
    }
    else
    {
        $('body').prepend('<div class="x-msg-bar-outer" style="display:none;"><div class="x-msg-bar x-msg-bar-' + type + '"><img src="images/s.gif" class="x-icon" /><span class="txt">' + text + '</span></div></div>');
    }

    //提示信息永远在屏幕的中间显示。add by yuhui。
    $this = $('.x-msg-bar-outer');
    $this.css("top", ($(window).height() - $this.height()) / 2 + $(window).scrollTop() +"px");
    $this.css("left", ($(window).width() - $this.width()) / 2 + $(window).scrollLeft() +"px");

    //多次重复点击，停止上次动画执行本次动画。add by yuhui.
    $('.x-msg-bar-outer').stop(true);
    $('.x-msg-bar-outer').fadeIn('fast');
    setTimeout(function(){
        $('.x-msg-bar-outer').fadeOut('fast');
        if ($.isFunction(callback_func))
        {
            callback_func();
        }
    }, show_time);
    setTimeout(function() {
            $('.x-msg-bar-outer').remove();
        },show_time + 3);
}
*/

// 显示固定信息条 (type=success, error, warning, info, box)
function showAlertMsg(type, html, show_time, show_close_btn, callback_func)
{
    var type = arguments[0] ? arguments[0] : 'success';
    var html = arguments[1] ? arguments[1] : '提交成功';
    var show_time = arguments[2] ? arguments[2] : 3000;
    var show_close_btn = arguments[3] ? arguments[3] : 0;
    var callback_func = arguments[4] ? arguments[4] : null;

    if (show_time == '0')
    {
        show_close_btn = 1;
    }
    var close_html = (show_close_btn == 1) ? '<a href="javascript:;" class="x-fixed-msg-close-btn" onclick="removeAlertMsg();">关闭</a>' : '';
    $('.x-fixed-msg').remove();
    
    // 生成top和left都为负的不可见bom
    $('body').prepend(
        '<div class="x-fixed-msg x-fixed-msg-' + type + '"><div class="x-fixed-msg-inner">' +
        close_html +
        '<div class="p">' + html + '</div>' +
        '</div></div>'
    );
        
    // 获取宽高
    $('.x-fixed-msg').css({
        'top' : '-' + (parseInt($('.x-fixed-msg').height()) + 10) + 'px',
        'left' : '50%',
        'margin-left' : '-' + parseInt($('.x-fixed-msg').width())/2 + 'px'
    });
    
    $('.x-fixed-msg').animate({'top':0},'fast','',function(){
    	setTimeout(function(){
    		$('.x-fixed-msg').animate({'top':'-' + (parseInt($('.x-fixed-msg').height()) + 10) + 'px'}, '', callback_func);
    	}, show_time);
    });
}

// 移出固定信息条
function removeAlertMsg()
{
    $('.x-fixed-msg').remove();
}

function rmMsgBar()
{
    $('.x-msg-bar').remove();
}

function ajaxLoadPage(url, container)
{
    window.location.href = url;
    return;
}

function windowReload()
{
    window.location.reload();
}

var $dialog;
function createDialog(content)
{
    var num_args = arguments.length;
    var width    = (num_args >= 2) ? arguments[1] : 400;
    var height   = (num_args >= 3) ? arguments[2] : 'auto';
    var autoOpen = (num_args >= 4) ? arguments[3] : true;

    $dialog  = $("<div id='message_dialog_module'></div>").html(content);
    $dialog.dialog({
        bgiframe:true,
        modal:true,
        autoOpen:autoOpen,
        draggable:false,
        resizable:false,
        width:width,
        height:height,
        minHeight:0,
        close:function(){
            $(this).remove();
        }
    });
    return $dialog;
}


// 结果tip
function showResultTip(msg)
{
	if($('#errorTip').length <= 0)
	{
		var str = '<div id="errorTip">' + msg + '</div>';
		$('body').append(str);
	}
	else
	{
		$('#errorTip').show();
	}

	// 5秒后关掉
	setTimeout(function(){
		$('#errorTip').hide();
	}, 5000);
}

function displayNumber(value)
{
    if (value < 10000)
    {
        return value;
    }
    else if (value < 100000000)
    {
        return (value / 10000) + ' 万';
    }
    else
    {
        return (value / 100000000) + ' 亿';
    }
}

function displayValue(_num)
{
    var fuhao='';
    if (_num<0)
    {
        fuhao = '-';
    }
    var num = Math.abs(_num);
    if (num<10000)
    {
        return fuhao+num;
    }
    else if(num<100000000)
    {
        return fuhao+(num/10000).toFixed(2)+'万';
    }
    else
    {
        return fuhao+(num/100000000).toFixed(2)+'亿';
    }
}
/**
 * 排序
 */
function sortTable(_sort_arr, obj_id)
{
    if (_sort_arr==undefined || _sort_arr==null)
    {
        _sort_arr = [];
    }
    var sort_arr = _sort_arr;
    var  tbl = $('#'+obj_id);//排序表格
    loaded(tbl,"em", sort_arr);//加载表格

    $('#'+obj_id+' th.order-th').click(function(){
        $(this).siblings('#'+obj_id+' th.order-th').removeClass('order-up').removeClass('order-down');
        if ($(this).hasClass('order-down'))
        {
            $(this).removeClass('order-down').addClass('order-up');
        }
        else
        {
            $(this).removeClass('order-up').addClass('order-down');
        }
        reColorTbl();
        reHighlightOrderTd(obj_id);
    });
}

//隔行换色
function reColorTbl()
{
    $('.g-tbl tbody tr').removeClass('odd');
    $('.g-tbl tbody tr:odd').addClass('odd');
}

//排序列高亮
function reHighlightOrderTd(table_id)
{
    var table_id = arguments[0] ? arguments[0] : 'tbl_sort';

    $('#' + table_id + ' td').removeClass('order-highlight');
    $('#' + table_id + ' th.order-th').each(function(){
        if ($(this).hasClass('order-up') || $(this).hasClass('order-down'))
        {
            var order_highlight_index = $(this).index() + 1;
            $('#' + table_id + ' td:nth-child(' + order_highlight_index + ')').addClass('order-highlight');
        }
    });
}

// 选中其他二级标签
function resetCurrent(module)
{
    $('#menu').find('.current').removeClass('current').hide();
    $('#menu').find('[href="index.php?module='+module+'&do=index"]').parent().addClass('current');
}

// dom元素target是否在另一个元素el中
function contains(el, target) {
    if (el === target) return true;
	return el.contains ? el != target && el.contains(target) : !!(el.compareDocumentPosition(target) & 16);
}

/**
 * 用隐藏iframe导出数据
 * 调用方法$('.jq-export:not(.x-btn-disable)').live('click', function() {exportByIframe($(this), 'index.php&...)});
 * 可以防止用户因为等待时间长重复点击下载
 * 
 * @author      kuangshunping
 * @param       jquery object       $obj    导出按钮
 * @param       http url            url     导出链接
 */
function exportByIframe($obj, url)
{
    var btn_txt = $obj.val();
    $obj.addClass('x-btn-disable').val('正在导出...');
    $('#export_iframe').remove();
    var iframe = document.createElement("iframe");
    iframe.id = 'export_iframe';
    iframe.style.visibility = 'hidden';
    iframe.src = url;
    if (iframe.attachEvent)
    {
        iframe.attachEvent("onload", function() 
        {
            $obj.removeClass('x-btn-disable').val(btn_txt);
        });
        iframe.onreadystatechange = function()
        {
            if (iframe.readyState == "complete" 
                || (jQuery.browser.msie && jQuery.inArray(jQuery.browser.version, ['7.0', '8.0', '9.0', '10.0']) && iframe.readyState === 'interactive')) 
            {
                $obj.removeClass('x-btn-disable').val(btn_txt);
            }
            return;
        }
    }
    else 
    {
        iframe.onload = function()
        {
            $obj.removeClass('x-btn-disable').val(btn_txt);  
        };
    }
    document.body.appendChild(iframe);
}


//ajax显示页面 
function ajaxShowPage(element_id, url, param, success_call, method)
{
	var option = {
		     url: url,
		     dataType: "html",
		     data: param
		};
		
	var full_option = {};
	
	if(method){
		$.extend(option, {type: method});
	}
	
	if($.isFunction(success_call)){
		full_option = $.extend(option, {success: success_call});
	}else{
		full_option = $.extend(option, {success: function(rs) {
	         	$("#" + element_id).html(rs);
	     	}
		});
	}
	
	$.ajax(full_option);
	return;
}


//关闭指定的对话框
function closeDialog(dialog_id){
	$("#" + dialog_id).dialog("close");
}