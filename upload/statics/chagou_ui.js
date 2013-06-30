/* 
	@名称: 内架构js
	@功能: 网站浏览器样式渲染
*/
$(function(){
	/*主页自动适应*/
	if( document.getElementById("footer_index") ){
		var home_height_all = $(window).height(); 
		var home_height = home_height_all - 142 + 'px'; 
		$("#footer_index").css({
						"margin-top":""+ home_height +""
						});
		
		  $(window).resize(function() {
		var home_height_all = $(window).height(); 
		var home_height = home_height_all - 142 + 'px'; 
		$("#footer_index").css({
						"margin-top":""+ home_height +""
						});
		  });
	}
	/*筛选价格自动适应*/
	if( document.getElementById("left_box") ){
		var left_box_all = $(window).width(); 
		if ( left_box_all > 1000 ){
			    $('#left_box').removeClass('left_box_on');
			} else {
				//var left_box = left_box_all - 60 + 'px'; 
				$('#left_box').addClass('left_box_on');
				$('#price').addClass('price_on');
				//$("#left_box").width(left_box);
				$(".price_l,.price_r").hide();
			}
		
		  $(window).resize(function() {
		var left_box_all = $(window).width(); 
		if ( left_box_all > 1000 ){
			    $('#left_box').removeClass('left_box_on');
				$('#price').removeClass('price_on');
				$(".price_l,.price_r").show();
			} else {
				var left_box = left_box_all - 60 + 'px'; 
				$('#left_box').addClass('left_box_on');
				$('#price').addClass('price_on');
				//$("#left_box").width(left_box);
				$(".price_l,.price_r").hide();
			}
		  });
	}
	/*右面宽度*/
	if( document.getElementById("right_box") ){
		var right_width_all = $(window).width(); 
		if ( right_width_all > 1000 ){
		var right_width = right_width_all - 430 + 'px'; 
		$("#right_box").width(right_width);
		} else {
				$("#right_box").width("95%");
				$('#right_box').addClass('right_box_on');
			}
		
		  $(window).resize(function() {
		var right_width_all = $(window).width(); 
				if ( right_width_all > 1000 ){
		var right_width = right_width_all - 430 + 'px'; 
		$("#right_box").width(right_width);
		} else {
				$("#right_box").width("95%");
				$('#right_box').addClass('right_box_on');
			}
		  });
	}
	/*输出弹出层*/
	if( document.getElementById("right_box") ){
	  $(".tc_js").click(function () {
		 /*关闭弹出层*/
		function item_remove(){ 
		  $("#tc_content .tc_content_close,#tc_bj").click(function () {
			$("#tc_content,#tc_bj").remove();
		  });
		}
		  var tc_id = $(this).attr("id");
		  var tc_show = tc_id + ".html";
		$("#tishi").html("<div id='tc_content'><div class='tc_content_close'></div><iframe src=" + tc_show + " width='900px' height='500px' scrolling='no' marginheight='0' marginwidth='0' frameborder='0' border='0'></iframe></div><div id='tc_bj' style='opacity: 0.5;'></div>");
		item_remove();
	  });
	}
});