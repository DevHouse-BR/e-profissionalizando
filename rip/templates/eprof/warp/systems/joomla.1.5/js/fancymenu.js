/* Copyright  2007 - 2010 YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */


Warp.FancyMenu = new Class({
        
    initialize: function(menu, options) {	
        
        this.setOptions({
            transition: Fx.Transitions.sineInOut,
            duration: 500,
            wait: false,
            onClick: Class.empty,
            onEnterItem: Class.empty,
            onLeaveItem: Class.empty,
            opacity: 1,
            mode: 'move',
            slideOffset: 30,
            itemSelector: 'li.level1',
            activeSelector: 'li.active',
            dropdownSelector: 'div.dropdown'
        }, options);

        var index = 0;
        
        this.menu = $(menu);
        this.items = [];
        this.div = [];
        
        if (!this.menu) return;
        
        this.current = this.menu.getElement(this.options.activeSelector);
        
        var obj   = this;     
        

        this.menu.getElements(this.options.itemSelector).each(function(item, i){
            
            // add events

            item.addEvent('click', function(event){ this.clickItem(event, item); }.bind(this));

            // create backgrounds
            if (this.options.mode != 'move') {
                this.createBackground(i, i + 1);
            }

            // current index
            if (this.options.mode == 'move' && this.current == item) {
                index = i;
            }           

        }.bind(this));
        
        
        this.menu.addEvent("menu:enter", function(item,i){
            obj.mouseenterItem(item, i);
        });
        this.menu.addEvent("menu:leave", function(item,i){
            obj.mouseleaveItem(item, i);
        });
        
        
            
        if (this.options.mode == 'move') {
            this.createBackground(0, index + 1);

            if (this.current) {
                this.setCurrent(this.current)
            } else { 
                var first = this.menu.getElement('li');
                first.addClass('active');
                first.addClass('current');
                this.setCurrent(first);
            };
        }

    },

    createBackground: function(i, bg) {
        var css = 'fancy ' + 'bg' + bg;
        this.div[i] = new Element('div', {'class': 'fancy-1'}).adopt(new Element('div', {'class': 'fancy-2'}).adopt(new Element('div', {'class': 'fancy-3'})));
        this.div[i].fx = this.div[i].effects(this.options);
        this.items[i] = new Element('div', {'class': css}).adopt(this.div[i]).injectInside(this.menu);
        this.items[i].fx = this.items[i].effects(this.options);
    },
    
    setCurrent: function(item) {
        this.items[0].setStyles({
            'left': item.offsetLeft,
            'width': item.offsetWidth,
            'visibility': 'visible',
            'opacity': this.options.opacity
        });
        this.current = item;
    },

    clickItem: function(event, item) {
        if (!this.current) this.setCurrent(item);
        this.current = item;
        this.options.onClick(new Event(event), item);
    },
    
    mouseenterItem: function(item, i) {
        if (item._fancyactive) return;
        item._fancyactive = true;

        switch (this.options.mode) {
            case 'fade':
                this.fadeFx(item, i, true);
                break;
            case 'slide':
                this.slideFx(item, i, true);
                break;    
            default:
                this.moveFx(item, 0);
        }
        
        this.fireEvent('onEnterItem', [item, i]);
    },

    mouseleaveItem: function(item, i) {
        item._fancyactive = false;

        switch (this.options.mode) {
            case 'fade':
                this.fadeFx(item, i, false);
                break;
            case 'slide':
                this.slideFx(item, i, false);
                break;    
            default:
                this.moveFx(this.current, 0);
        }		

        this.fireEvent('onLeaveItem', [item, i]);
    },

    moveFx: function(item, i) {
        if(!this.current) return;
        this.items[i].fx.custom({
            'left': [this.items[i].offsetLeft, item.offsetLeft],
            'width': [this.items[i].offsetWidth, item.offsetWidth]
        });		
    },

    fadeFx: function(item, i, show) {
        if (show) {
            this.items[i].fx.setOptions(this.options);
            this.items[i].fx.set({
                'left': item.offsetLeft,
                'width': item.offsetWidth
            });
            this.items[i].fx.custom({
                'opacity': [0, 1]
            });		
        } else {
            var dur = this.options.duration * 2;
            this.items[i].fx.setOptions({duration: dur});
            this.items[i].fx.custom({
                'opacity': [1, 0]
            });		
        }
    },

    slideFx: function(item, i, show) {
        var offset = this.options.slideOffset;
        if (show) {
            this.items[i].fx.set({
                'opacity': 1,
                'left': item.offsetLeft,
                'width': item.offsetWidth
            });
            this.div[i].fx.set({
                'margin-top': offset
            });
            this.div[i].fx.custom({
                'margin-top': [offset, 0]
            });
        } else {
            this.div[i].fx.set({
                'margin-top': 0
            });
            this.div[i].fx.custom({
                'margin-top': [0, offset]
            });
        }
    }
});

Warp.FancyMenu.implement(new Events, new Options);