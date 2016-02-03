var ajaxurl = '/wp-admin/admin-ajax.php';

$(window).scroll( function(){refresh();} );

$(document).ready(function(){
	var url = document.location.href.split('max0n.com')[1].split('/');
	var getObj = new Object();

	if(url[1]!='') getObj.category = decodeURIComponent(url[1]);
	if(url[2]) getObj.article = decodeURIComponent(url[2]);
	else getObj.page = 1;
	
	history.replaceState(getObj, null, document.location.href.split('max0n.com')[1]);
	if($('.content').html() == ''){
		$('.content').append('<a href="http://max0n.com" class="logo"></a>');
		refresh();
	}
	setTimeout((function(){ $('#fading').remove(); $('html').removeClass('intro'); }), 2200);
});

$('.openMenu').click(function(){
	if( $(this).hasClass('is-active') ) {
		$('.openMenu').removeClass('is-active');
		$('body').removeClass('is-active');
	}else{
		$('.openMenu').addClass('is-active');
		$('body').addClass('is-active');
	}
});



window.onpopstate = function(event) {
	if(event.state){
		//alert( JSON.stringify(history.state) );
		if( history.state.hasOwnProperty('article') ){
			document.title= event.state.article.toUpperCase()+" » Max0n";
		}else if( history.state.hasOwnProperty('category') ){
			document.title= event.state.category.toUpperCase()+" » Max0n";
		}
		$('body').removeClass('loading');
		$('.menu').children().removeClass('is-active');
		if( $('.menu a').hasClass('is-active') ) $('.menu a').removeClass('is-active');

		var sendObj = history.state;
		sendObj.action = 'onPop';

		$.ajax({
			url: ajaxurl,
			data: sendObj,
			type: 'POST',
			async: false,
			beforeSend: function( xhr ){
				if( !$("div").is(".page") ) $('.content').before( $("<div>", {class: "page from"}) );
			},
			success : function(html){
				$('.page').html( html );
			}
		});

		setTimeout((function(){ $('.page').removeClass('from'); }),1);

		setTimeout((function(){
			$('.content').html( $('.page').html() );
			$('body').scrollTop( $('.page').scrollTop() );
			$('.page').remove();
		}), 510);

	}
};

$(document).on('click', 'a', function(e) {
	
	if( $(this).hasClass('back') ){
		$('.menu').children().removeClass('is-active');
	}

	if( $(this).hasClass('control') || $(this).hasClass('logo') ){
		e.preventDefault();
		var url = $(this).attr("href").split('max0n.com')[1].split('/');

		var getObj = new Object();
		if(url[1]!='') getObj.category = decodeURIComponent(url[1]);
		if(url[2]) getObj.article = decodeURIComponent(url[2]);
		else getObj.page = 1;
			
		if( url.length==1 && history.state.hasOwnProperty('category') ){
			$('body').removeClass('loading');
			history.pushState({page: 2}, null, "/");
			document.title= "Max0n";
			
			var sendObj = history.state;
			sendObj.action = 'goHome';

			$.ajax({
				url: ajaxurl,
				data: sendObj,
				type: 'POST',
				async: false,
				beforeSend: function(xhr){
					if( !$("div").is(".page") ) $('.content').before( $("<div>", {class: "page from"}) );
				},
				success : function(html){
					$('.page').html( html );
					if( history.state.scroll ) $('.page').scrollTop( history.state.scroll );
				},
				complete: function (data) {
					setTimeout((function(){ $('.page').removeClass('from'); }),1);
					setTimeout((function(){
						$('.content').html( $('.page').html() );
						$('body').scrollTop( $('.page').scrollTop() );
						$('.page').remove();
					}), 510);
				}
			});
		}//END if url.length == 1
		if( url.length==2 ) {
			var sendObj = getObj;
			sendObj.action = 'getCategory';
			
			if( !$('.menu').children().hasClass('is-active') ) $('.menu').children().addClass('is-active');
			$('.menu').children().eq(1).empty().append('<li><a class="back"><label>Вернуться</label></a></li>');

			$.ajax({
				url: ajaxurl,
				data: sendObj,
				type: 'POST',
				async: true,
				error : function() {
					$('.menu').children().eq(1).append('<li><label><i style="opacity:0.5;">Ошибка загрузки данных...</i></label></li>');
				},
				beforeSend: function(xhr){
					$('.menu').addClass('loading');
				},
				success : function(html){
					$('.menu').children().eq(1).append(html);
				},
				complete: function (data) {
					setTimeout((function(){ $('.menu').removeClass('loading'); $('.menu a').removeClass('loaded'); }), 100);
				}
			});		
		}//END if url.length == 2
		if( url.length==3 ) {
			history.pushState(getObj, null, "/"+url[1]+"/"+url[2]);
			document.title= url[2].toUpperCase()+" » Max0n";

			if( $('.menu a').hasClass('is-active') ) $('.menu a').removeClass('is-active');
			$(this).addClass('is-active');

			var sendObj = history.state;
			sendObj.action = 'getArticle';

			$.ajax({
				url: ajaxurl,
				data: sendObj,
				type: 'POST',
				async: false,
				beforeSend: function( xhr ){
					if( !$("div").is(".page") ) $('.content').before( $("<div>", {class: "page to"}) );
				},
				success : function(html){
					$('.page').html( html );
				}
			});

			setTimeout((function(){ $('.page').removeClass('to'); }),1);

			setTimeout((function(){
				$('.content').html( $('.page').html() );
				$('body').scrollTop( $('.page').scrollTop() );
				$('.page').remove();
			}), 510);
		}//END if url.length == 3
	}//END if href from domain
});

function refresh(){
	var bottomOffset = 70; // отступ от нижней границы сайта, до которого должен доскроллить пользователь, чтобы подгрузились новые посты
	var url = document.location.href.split('max0n.com')[1].split('/');
	
	if( ($('body').height() - $('body').scrollTop() - $(window).height()) < bottomOffset && !$('body').hasClass('loading') && url.length <= 2 ){
		var sendObj = history.state;
		sendObj.action = 'loadmore';

		$.ajax({
			url: ajaxurl,
			data: sendObj,
			type: 'POST',
			async: true,
			beforeSend: function(){
				$('body').addClass('loading');
			},
			success:function(data){
				if( data && data!=0 ) {
					$('.content').append(data);
					$('body').removeClass('loading');
					var getObj = history.state;
					getObj.page = history.state.page+1;
					history.replaceState(getObj, null, document.location.href.split('max0n.com')[1]);
				}
			}
		});
	}
}