/* Copyright  2007 - 2010 YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

/* Fix hovers */
function addHover(selector, hoverclass) {

	if (hoverclass == undefined) {
		hoverclass = 'hovered';
	}
	
	$$(selector).addEvents({
		mouseenter: function() {
			this.addClass(hoverclass);
		},
		mouseleave: function() {
			this.removeClass(hoverclass);
		}
	});
}

/* Fix focus */
function addFocus(selector, focusclass) {

	if (focusclass == undefined) {
		focusclass = 'focused';
	}
	
	$$(selector).addEvents({
		focus: function() {
			this.addClass(focusclass);
		},
		blur: function() {
			this.removeClass(focusclass);
		}
	});
}

/* Correctly handle PNG transparency in Win IE 5.5 & 6. */
/* Inline elements */
function correctPngInline() {

	var className = 'correct-png';
	var arVersion = navigator.appVersion.split("MSIE");
	var version = parseFloat(arVersion[1]);

	if ((version >= 5.5) && (document.body.filters)) {

		var imgs = document.getElementsByTagName('img');
		var reg = new RegExp("\\b" + className + "\\b");

		for(var i=0; i<imgs.length; i++) {

			var img = imgs[i];
			var imgName = img.src.toUpperCase();

			if ((imgName.substring(imgName.length-3, imgName.length) == "PNG") && (reg.test(img.className))) {
				var imgID = (img.id) ? "id='" + img.id + "' " : "";
				var imgClass = (img.className) ? "class='" + img.className + "' " : "";
				var imgTitle = (img.title) ? "title='" + img.title + "' " : "title='" + img.alt + "' ";
				var imgStyle = "display:inline-block;" + img.style.cssText;
				if (img.align == "left") {
					imgStyle = "float:left;" + imgStyle;
				}
				if (img.align == "right") {
					imgStyle = "float:right;" + imgStyle;
				}
				if (img.parentElement.href) {
					imgStyle = "cursor:hand;" + imgStyle;
				}
				
				filterSizingMethod = "crop";

				var strNewHTML = "<span " + imgID + imgClass + imgTitle
								+ " style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";"
								+ "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
								+ "(src=\'" + img.src + "\', sizingMethod='" + filterSizingMethod + "');\"></span>";
				imgs[i].outerHTML = strNewHTML;
				i = i - 1;
			}
		}
	}
}

/* Background images */
function correctPngBackground(selector, sizing) {
	var sizingMethod = sizing || 'scale';
	$ES(selector).each(function(element){
		if (element.getTag() != 'img' && element.getStyle('background-image').match(/\.png/i) != null) {
			fnFixPng(element, sizingMethod);
			element.attachEvent('onpropertychange', fnPropertyChanged);
		}
	});
}

function fnFixPng(obj, sizing) {
	var bg	= obj.currentStyle.backgroundImage;
	var src = bg.substring(5,bg.length-2);
	obj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + src + "', sizingMethod='" + sizing + "')";
	obj.style.backgroundImage = "url(x.gif)";
}

function fnPropertyChanged() {
	if (window.event.propertyName == "style.backgroundImage") {
		var el = window.event.srcElement;
		if (!el.currentStyle.backgroundImage.match(/x\.gif/i)) {
			var bg	= el.currentStyle.backgroundImage;
			var src = bg.substring(5,bg.length-2);
			el.filters.item(0).src = src;
			el.style.backgroundImage = "url(x.gif)";
		}
	}
}