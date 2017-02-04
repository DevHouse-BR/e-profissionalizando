/* Copyright  2007 - 2010 YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

Warp.Menu = new Class({
	
	initialize: function(element, options) {
		this.setOptions({
			mode: 'default',
			itemSelector: 'li',
			dropdownSelector: 'ul',
			duration: 600,
			remainTime: 800,
			remainClass: 'remain',
            firstLevelSelector: 'li.level1',
			transition: Fx.Transitions.linear,
			wait: false
		}, options);

		var obj = this;

		this.menu = $(element);
		this.timer = null;
		this.hovered = null;
		this.dropdowns = [];
		this.remain = [];
		
		if (!this.menu) return;
		
        this.firstLevelItems = this.menu.getElements(this.options.firstLevelSelector);
        
		this.menu.addEvents({
			mouseenter: function(event) {	
				obj.remain = [];
				obj.removeRemain(10,true);
			},
			mouseleave: function(event) {
				obj.remain.each(function(item) {
					item.addClass(obj.options.remainClass);
				});
				obj.removeRemain(obj.options.remainTime);
                
                if(!obj.menu.getElement("li."+obj.options.remainClass)){
                    obj.fireMenuEvent('menu:leave');
                }
			}
		});
        

        this.firstLevelItems.addEvent("mouseenter", function(){
            obj.fireMenuEvent('menu:leave');
            obj.fireMenuEvent('menu:enter', this);
        });
        
		
		this.menu.getElements(this.options.itemSelector).each(function(item) {
			var dropdown = item.getElement(this.options.dropdownSelector);
            
			if (dropdown) {
				this.dropdowns.include(item);
				
				if (this.options.mode == 'slide') {
					this.attachSlideFx(item, dropdown);
				} else {
					this.attachDefaultFx(item, dropdown);
				}
				
				item.addEvents({
					mouseenter: function(event) {
						item._dropdownhover = true;
						obj.remain = [];
                        
						if (!item.hasClass(obj.options.remainClass) && !window.opera) {
							item.fireEvent('fx:dropdown');
						}
					},
					mouseleave: function(event) {
						item._dropdownhover = false;
						if (obj.menu != event.relatedTarget && !obj.menu.hasChild(event.relatedTarget)) {
							obj.remain.include(item);
						}
					}
				});
			}
			  
		}.bind(this));        
        
        if(this.options['fancy'] && Warp['FancyMenu']) {
            new Warp.FancyMenu(this.menu, $extend({hoverClass: obj.options.hoverClass}, obj.options.fancy));
        }
        
	},
    
    fireMenuEvent: function(event, item){
        
        if(event=='menu:leave'){
            if(!this.hovered) return;
            item = this.hovered;
        }else{
            this.hovered = item;
        }
        
        var index = 0;
        for(var i=0;i < this.firstLevelItems.length;i++){
            if(item==this.firstLevelItems[i]){
                index = i;
                break;
            }
        }
        
        this.menu.fireEvent(event, [item,index]);        
    },

	attachDefaultFx: function(item, dropdown) {
		
		var styles = dropdown.getStyles('width','height','opacity');
		var reset = {'width': 0, 'height': 0};
		var div = new Element('div').adopt(dropdown.getChildren()).injectInside(dropdown).setStyle('width', styles.width.toInt());
		var fx = new Fx.Styles(dropdown, this.options);

		switch(this.options.mode) {
			case 'width':
				reset = {'width': 0};
		  		break;    
			case 'height':
				reset = {'height': 0};
				break;
		}		
		
		item.addEvent('fx:dropdown', function() {
			fx.stop();
			fx.element.setStyles($extend(reset, window.ie ? {'overflow': 'hidden'} : {'opacity': 0, 'overflow': 'hidden'}));
			fx.start(styles).chain(function(){
				fx.element.setStyles(styles);
			});
		});

	},

	attachSlideFx: function(item, dropdown) {

		var styles = dropdown.getStyles('width','height','opacity');
		var div = new Element('div').adopt(dropdown.getChildren()).injectInside(dropdown);
		var fx1 = new Fx.Styles(dropdown, this.options);
		var fx2 = new Fx.Styles(div, this.options);

		item.addEvent('fx:dropdown', function() {
			fx1.stop();
			fx1.element.setStyles({'height': 0, 'overflow': 'hidden'});
			fx1.start(styles).chain(function(){
				fx1.element.setStyles(styles);
			});

			fx2.stop();
			fx2.element.setStyles({'margin-top': - styles.height.toInt()});
			fx2.start({'margin-top': 0});
		});

	},
	
	removeRemain: function(delaytime,mousenter) {
		$clear(this.timer);
		this.timer = (function(){
			this.dropdowns.each(function(item) {
				if (item.hasClass(this.options.remainClass) && !item._dropdownhover){
                    if(!mousenter){
                        if(!mousenter) this.fireMenuEvent('menu:leave');
                    }
				}
                item.removeClass(this.options.remainClass);
			}.bind(this));
		}).delay(delaytime, this);
	},

	matchHeight: function() {
		if (this.menu) {
			this.menu.getElements('li.level2 div.sub').each(function(sub) {
				var hover = sub.getParent().getElement('div.hover-box4');
				var height = Math.max(sub.getCoordinates().height, hover.getCoordinates().height);
				var elements = [sub, hover];

				elements.each(function(element) {
					var offset = element.getStyle('padding-top').toInt() + element.getStyle('padding-bottom').toInt() + element.getStyle('border-top-width').toInt() + element.getStyle('border-bottom-width').toInt();
					element.setStyle('height', height - offset);
				});
			});
		}
	},

	matchUlHeight: function() {
		if (this.menu) {
			this.menu.getElements('div.dropdown-3').each(function(div) {
				var elements = div.getChildren();
				var height = 0;

				elements.each(function(element) {
					height = Math.max(element.getCoordinates().height, height);
				});
				
				elements.each(function(element) {
					var offset = element.getStyle('padding-top').toInt() + element.getStyle('padding-bottom').toInt() + element.getStyle('border-top-width').toInt() + element.getStyle('border-bottom-width').toInt();
					element.setStyle('height', height - offset);
				});
			});
		}
	}
});

Warp.Menu.implement(new Events, new Options);