/* Copyright  2007 - 2010 YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

var Warp = {};

Warp.Base = {

	/* Match height of elements */		
	matchHeight: function(elements, min) {
		var max = 0;

		$$(elements).each(function(element, i){
			var height;
			if (element.offsetHeight) {
				height = element.offsetHeight;
			} else if (element.style.pixelHeight) {
				height = element.style.pixelHeight;
			}
			max = Math.max(max, height);
		});

		if (min != undefined) {
			max = Math.max(max, min);
		}

		$$(elements).each(function(element, i){
			var offset = element.getStyle('padding-top').toInt() + element.getStyle('padding-bottom').toInt() + element.getStyle('border-top-width').toInt() + element.getStyle('border-bottom-width').toInt();
			var height = max - offset;
			var style  = window.ie6 ? 'height' : 'min-height';
			element.setStyle(style, height + 'px')	
		});
	}

};

Warp.Morph = new Class({

	initialize: function(element, enter, leave, enterFx, leaveFx, elementFx) {	
		this.setOptions({
			duration: 500,
			transition: Fx.Transitions.expoOut,
			wait: false,
			ignore: ''
		}, enterFx);
		
		var options = this.options;
		var ignore  = null;

		if ($chk(options.ignore)) {
			ignore = $$(options.ignore);
		}
		
		$$(element).each(function(el, i){
			if (ignore && ignore.contains(el)) return;

			var fxs = [];
			var elfx = [el];
			
			if (elementFx) {
				elfx = el.getElementsBySelector(elementFx);
			}
			
			elfx.each(function(elm, i){
				fxs[i] = new Fx.Styles(elm, options);
			});

			el.addEvent('mouseenter', function(e){
				fxs.each(function(fx){
					fx.setOptions(options, enterFx).start(enter);
				});
			});
			el.addEvent('mouseleave', function(e){
				fxs.each(function(fx){
					fx.setOptions(options, leaveFx).start(leave);
				});
			});
		});
	}

});

Warp.Morph.implement(new Options);

Warp.BackgroundFx = new Class({

	initialize: function(options) {	
		this.setOptions({
			transition: Fx.Transitions.linear,
			duration: 9000,
			wait: false,
			colors: ['#FFFFFF', '#999999']
		}, options);

		var body   = new Element(document.body);
		var fx     = body.effects(this.options);
		var index  = 0;
		var colors = this.options.colors;
		var timer  = animate.periodical(this.options.duration * 2);
		
		animate();
		
		function animate() {
			fx.start({
				'background-color': colors[index]
			});
			if (index + 1 >= colors.length) {
				index = 0;
			} else {
				index++;
			};
		}
	}

});

Warp.BackgroundFx.implement(new Options);