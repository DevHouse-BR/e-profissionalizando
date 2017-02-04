/* Copyright  2007 - 2010 YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

Warp.SliderMenu = new Class({
	
	initialize: function(element, items, options) {
		this.setOptions({
			widthSliderPx: 105,
			widthSliderOpenPx: 165
		}, options);

		var wrapper = $E(element);
		var sliders = $ES(items);
		var fx = new Fx.Elements(sliders, {wait: false, duration: 200, transition: Fx.Transitions.quadOut});
		var widthSliderPx = this.options.widthSliderPx;
		var widthSliderOpenPx = this.options.widthSliderOpenPx;
		var widthSliderCollapsedPx = parseInt(widthSliderPx - ((widthSliderOpenPx - widthSliderPx) / (sliders.length - 1)));

		sliders.each(function(slider, i) {
			slider.addEvent('mouseenter', function(event) {
				var o = {};
				o[i] = { width: [slider.getStyle('width').toInt(), widthSliderOpenPx] };
				sliders.each(function(other, j) {
					if(i != j) {
						var w = other.getStyle('width').toInt();
						if (w != widthSliderCollapsedPx) o[j] = { width: [w, widthSliderCollapsedPx] };
					}
				});
				fx.start(o);
			});
		});

		wrapper.addEvent('mouseleave', function(event) {
			var o = {};
			sliders.each(function(slider, i) {
				o[i] = { width: [slider.getStyle('width').toInt(), widthSliderPx] };
			});
			fx.start(o);
		})		
	}

});

Warp.SliderMenu.implement(new Options);