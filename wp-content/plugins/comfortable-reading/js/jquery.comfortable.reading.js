(function( $ ){
 
  var methods = {
    init : function( options, initLink ) { 
		$.cookie.json = true;

		lastSettings = $.cookie('sver-last-options')||{};
		var settings = $.extend( {
			'base-style' : '',
			'default-background' : '#fff',
			'default-text-color' : '#000',
			'back-link-text' : 'Обычная версия',
			'container' : 'body'
			}, lastSettings, options);
		
		$.cookie('sver-last-options',settings, { path: '/' });

		if (settings['base-style' ]){
			$("head").append($("<link rel='stylesheet' id='special-version-base-style' href='"+settings['base-style' ]+"' type='text/css' media='screen' />"));
		}
		
		container = $('<div id="special-version-container"></div>');
		$(settings['container']).children().each(function(){
			$(this).appendTo(container);
			});
		$(settings['container']).html('').append(container);


		$.fn.specialVersion('changeParams',
		settings['default-text-size'],
		settings['default-text-color'],
		settings['default-background'],
		settings['default-imgH'],
		settings['default-letter-spacing'],
		settings['default-line-height'],
		settings['default-font-family']
		
		);
		$('<div id="special-version-controls"></div>').prependTo('body');
		
		$('<table><tr><th>Размер шрифта:</th><th>Цветовая схема:</th><th>Изображения:</th><th>Кернинг:</th><th>Интервал:</th><th>Гарнитура:</th></tr><tr><td id="crfont-style"><a href="#" a-font-size="16" style="font-size:16px">A</a><a href="#" a-font-size="20" style="font-size:20px">A</a><a href="#" a-font-size="24" style="font-size:24px">A</a><a href="#" a-font-size="28" style="font-size:28px">A</a></td><td id="cr-font-color"><a href="#" a-bg-color="#fff" a-color="#000" style="background:#fff!important;color:#000">A</a><a href="#" a-bg-color="#000" a-color="#fff" style="background:#000!important;color:#fff">A</a><a href="#" a-bg-color="#9DD1FF" a-color="#063462" style="background:#9DD1FF!important;color:#063462">A</a><a href="#" a-bg-color="#f7f3d6" a-color="#4d4b43" style="background:#f7f3d6!important;color:#4d4b43;">A</a><a href="#" a-bg-color="#3b2716" a-color="#a9e44d" style="background:#3b2716!important;color:#a9e44d">A</a></td><td><span id="cr-img-hide-off"><a href="#" a-img-hide="none">Выкл.</a></span>|<span id="cr-img-hide-on"><a href="#" a-img-hide="block">Вкл.</a></span></td><td><a href="#" a-bukv-size="initial">Маленький</a>|<a href="#" a-bukv-size="2px" >Средний</a>|<a href="#" a-bukv-size="4px">Большой</a></td><td><a href="#" a-strok-size="normal">Маленький</a>|<a href="#" a-strok-size="2">Средний</a>|<a href="#" a-strok-size="4">Большой</a></td><td><a href="#" a-font-garnitura="Arial, Helvetica, sans-serif">Без засечек</a>|<a href="#" a-font-garnitura="Times New Roman", Times, serif">С засечками</a>|<a href="#" a-font-garnitura="Braille">Брайля</a></td></tr></table>').appendTo('#special-version-controls');
		

		$('#special-version-controls a').click(function(event){
			event.preventDefault();
			size=$(this).attr('a-font-size')||false;
			color=$(this).attr('a-color')||false;
			bgColor=$(this).attr('a-bg-color')||false;
			imgH=$(this).attr('a-img-hide')||false;
			letSpace=$(this).attr('a-bukv-size')||false;
			linHeight=$(this).attr('a-strok-size')||false;
			fontStyle=$(this).attr('a-font-garnitura')||false;			

			$.fn.specialVersion('changeParams',size,color,bgColor,imgH,letSpace,linHeight,fontStyle);
			
			});

		initLink.hide();

		backLink = $(initLink).clone().appendTo('#special-version-controls');
		backLink.text(settings['back-link-text']).show();
		backLink.click(function(event){event.preventDefault();
		$.fn.specialVersion('return',backLink, initLink);});
	},
    bind : function(options) {
		
		this.click(function(event){
			event.preventDefault();
			initLink = $(this);
			$.cookie('sver-initLinkId', initLink.attr('id'), { path: '/' });
			return methods.init(options, initLink);
		});
      
    },
    return : function(backLink, initLink) {
		$('#special-version-container').children().each(function(){$(this).insertBefore($('#special-version-container'))})
		 $('#special-version-container').remove();
		 $('#special-version-base-style').remove();
		 $('#special-version-controls').remove();
		 

		 $('*').each(function(){
			if ($(this).attr('original-font-size'))
				$(this).css('font-size',$(this).attr('original-font-size'));
			if ($(this).attr('original-line-height'))
				$(this).css('line-height',$(this).attr('original-line-height'));
			$(this).css('background',$(this).attr('original-bg-color'));
			$(this).css('color',$(this).attr('original-text-color'));
			$(this).css('display',$(this).attr('original-imgH-display'));
			$(this).css('letter-spacing',$(this).attr('original-letter-spacing'));
			$(this).css('line-height',$(this).attr('original-strok-height'));
			$(this).css('font-family',$(this).attr('original-font-family'));
			});

		 backLink.remove();
		 initLink.show();

		 $.cookie.json = false;
		 $.removeCookie('sver-size', { path: '/' });
		 $.removeCookie('sver-color', { path: '/' }); 
		 $.removeCookie('sver-bgColor', { path: '/' }); 
		 $.removeCookie('sver-imgH', { path: '/' }); 
		 $.removeCookie('sver-initLinkId', { path: '/' }); 
		 $.removeCookie('sver-last-options', { path: '/' });
		 $.removeCookie('sver-letter-spacing', { path: '/' }); 
		 $.removeCookie('sver-line-height', { path: '/' });
		 //new
		 $.removeCookie('sver-font-family', { path: '/' });
		},
    changeParams : function(size,color,bgColor,imgH,letSpace,linHeight,fontStyle) {
		if (size) $.cookie('sver-size', size, { path: '/' });
		if (color) $.cookie('sver-color', color, { path: '/' });
		if (bgColor) $.cookie('sver-bgColor', bgColor, { path: '/' });
		if (imgH) $.cookie('sver-imgH', imgH, { path: '/' });
		if (letSpace) $.cookie('sver-letter-spacing', letSpace, { path: '/' });
		if (linHeight) $.cookie('sver-line-height', linHeight, { path: '/' });
		//new
		if (fontStyle) $.cookie('sver-font-family', fontStyle, { path: '/' });
      
		$('#special-version-container *').each(function(){
			if (!$(this).attr('original-font-size')) $(this).attr('original-font-size',$(this).css('font-size'));
			if (!$(this).attr('original-line-height'))$(this).attr('original-line-height',$(this).css('line-height'));
			});
		$('*').each(function(){
			if (!$(this).attr('original-bg-color'))$(this).attr('original-bg-color',$(this).css('background'));
			if (!$(this).attr('original-text-color'))$(this).attr('original-text-color',$(this).css('color'));
			if (!$(this).attr('original-imgH-display'))$(this).attr('original-imgH-display',$(this).css('display'));
			if (!$(this).attr('original-letter-spacing'))$(this).attr('original-letter-spacing',$(this).css('letter-spacing'));
			if (!$(this).attr('original-line-height'))$(this).attr('original-strok-height',$(this).css('line-height'));
			if (!$(this).attr('original-font-family'))$(this).attr('original-font-family',$(this).css('font-family'));
		});

		if (size){		
			$('#special-version-container *').each(function(){
				if ($(this).css('font-weight')=='bold')
					$(this).css({'font-size':(Math.round(size*1.2)) + 'px','line-height':Math.round(size*1.4) + 'px'});
				else
					$(this).css({'font-size':size + 'px','line-height':Math.round(size*1.4) + 'px'});
				});
			}
		if (color){	
			$('*').not('#special-version-controls,#special-version-controls *').each(function(){
				$(this).css({'color':color});
				});
			}
		if (bgColor){	
			$('*').not('#special-version-controls,#special-version-controls *').each(function(){
				$(this).css({'background':bgColor});
				});
			}
		if (imgH){	
			$('*').not('#special-version-controls,#special-version-controls *').each(function(){
				$("img").css({'display':imgH});
				});
			}
		if (letSpace){	
			$('*').not('#special-version-controls,#special-version-controls *').each(function(){
				$(this).css({'letter-spacing':letSpace});
				});
			}
		if (linHeight){	
			$('*').not('#special-version-controls,#special-version-controls *').each(function(){
				$(this).css({'line-height':linHeight});
				});
			}
		if (fontStyle){	
		$('*').not('#special-version-controls,#special-version-controls *').each(function(){
				$(this).css({'font-family':fontStyle});
				});
			}
    },
    newMethod : function( ) {
     
    }
  };

  $.fn.specialVersion = function( method ) {
    if ( methods[method] ) {
      return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return methods.bind.apply( this, arguments );
    } else {
      $.error( 'Method named ' +  method + ' exists for jQuery.specialVersion' );
    } 
  };

})( jQuery );

jQuery( document ).ready(function( $ ) {
  if($.cookie('sver-initLinkId')&&( $.cookie('sver-size')|| $.cookie('sver-color')|| $.cookie('sver-font-family')|| $.cookie('sver-letter-spacing')|| $.cookie('sver-line-height')|| $.cookie('sver-bgColor')|| $.cookie('sver-imgH'))){

	$.fn.specialVersion('init',{
		'default-background' : $.cookie('sver-bgColor'),
		'default-text-color' : $.cookie('sver-color'),
		'default-imgH' : $.cookie('sver-imgH'),
		'default-text-size' : $.cookie('sver-size'),
		'default-letter-spacing' : $.cookie('sver-letter-spacing'),
		'default-line-height' : $.cookie('sver-line-height'),
		'default-font-family' : $.cookie('sver-font-family')
		}, $('#'+$.cookie('sver-initLinkId')));
		
	};
});