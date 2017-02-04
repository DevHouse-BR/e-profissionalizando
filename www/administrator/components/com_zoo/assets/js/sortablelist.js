/* Copyright (C) 2007 - 2010 YOOtheme GmbH, YOOtheme License (http://www.yootheme.com/license) */

var SortableList=new Class({options:{onAddItem:Class.empty,onBeforeStart:Class.empty,onStart:Class.empty,onClone:Class.empty,onDragStart:Class.empty,onSort:Class.empty,onComplete:Class.empty,clone:true,snap:5,constrain:false,opacity:0.7},initialize:function(a){this.setOptions(a);this.lists=[];this.elements=[];this.idle=true},attach:function(){this.lists.each(function(a){this.addItems(a.getChildren())},this)},detach:function(){this.lists.each(function(a){this.removeItems(a.getChildren())},this)},addList:function(a){this.lists.push($(a));
this.addItems(a.getChildren());return this},addItems:function(a){a.each(function(b){this.elements.push(b);if(!b._startsort)b._startsort=this.start.bindWithEvent(this,b);(this.options.handle?b.getElement(this.options.handle)||b:b).addEvent("mousedown",b._startsort);this.fireEvent("onAddItem",b)},this);return this},removeList:function(a){this.lists.remove($(a));this.removeItems(a.getChildren());return this},removeItems:function(a){a.each(function(b){this.elements.remove(b);(this.options.handle?b.getElement(this.options.handle)||
b:b).removeEvent("mousedown",b._startsort)},this);return this},getClone:function(a,b){if(!this.options.clone)return(new Element("div")).inject(document.body);var c=b.getPosition();this.offset=a.page.y-c.y;var d=b.clone();this.fireEvent("onClone",[d]);return d.setStyles({margin:"0px",position:"absolute",visibility:"hidden",left:c.x,top:a.page.y-this.offset,width:b.getStyle("width")}).inject(this.list)},getDroppables:function(){var a=this.list.getChildren();this.options.constrain||(a=this.lists.copy().merge(a).remove(this.list));
return a.remove(this.clone).remove(this.element)},start:function(a,b){this.fireEvent("onBeforeStart",[b]);if(this.idle){this.idle=false;this.element=b;this.opacity=b.getStyle("opacity");this.list=b.getParent();this.clone=this.getClone(a,b);this.drag=new Drag.Element(this.clone,{snap:this.options.snap,container:this.options.constrain&&this.list,droppables:this.getDroppables(),onSnap:function(){a.stop();this.clone.setStyle("visibility","visible");this.element.setStyle("opacity",this.options.opacity||
0);this.fireEvent("onStart",[this.element,this.clone])}.bind(this),onEnter:this.insert.bind(this),onComplete:this.end.bind(this)});this.clone.injectBefore(this.element);this.fireEvent("onDragStart",[this.element,this.clone]);this.drag.start(a)}},insert:function(a,b){if(this.lists.contains(b)){this.list=b;this.drag.droppables=this.getDroppables();this.element.injectInside(b)}else this.element.getAllPrevious().contains(b)?this.element.injectBefore(b):this.element.injectAfter(b);this.fireEvent("onSort",
[this.element,this.clone])},end:function(){this.idle=true;this.clone.remove();this.drag.detach();this.element.setStyle("opacity",this.opacity);this.fireEvent("onComplete",this.element)},serialize:function(a){return this.list.getChildren().map(a||function(b){return this.elements.indexOf(b)},this)}});SortableList.implement(new Events,new Options);
Element.extend({getAllPrevious:function(){for(var a=[],b=this.getPrevious();$chk(b);){a.push(b);b=b.getPrevious()}return a},clone:function(a,b){var c={input:"checked",option:"selected",textarea:"value"};a=a!==false;var d=this.cloneNode(a),j=function(e,g){b||e.removeAttribute("id");if(window.ie){e.clearAttributes();e.mergeAttributes(g);e.removeAttribute("uid");if(e.options)for(var f=e.options,l=g.options,h=f.length;h--;)f[h].selected=l[h].selected}if((f=c[g.tagName.toLowerCase()])&&g[f])e[f]=g[f]};
if(a)for(var k=d.getElementsByTagName("*"),m=this.getElementsByTagName("*"),i=k.length;i--;)j(k[i],m[i]);j(d,this);return $(d)}});
Drag.Element=Drag.Base.extend({options:{droppables:[],container:false,overflown:[]},initialize:function(a,b){this.setOptions(b);this.element=$(a);this.droppables=$$(this.options.droppables);this.container=$(this.options.container);this.position={element:this.element.getStyle("position"),container:false};if(this.container)this.position.container=this.container.getStyle("position");if(!["relative","absolute","fixed"].contains(this.position.element))this.position.element="absolute";var c=this.element.getStyle("top").toInt(),
d=this.element.getStyle("left").toInt();if(this.position.element=="absolute"&&!["relative","absolute","fixed"].contains(this.position.container)){c=$chk(c)?c:this.element.getTop(this.options.overflown);d=$chk(d)?d:this.element.getLeft(this.options.overflown)}else{c=$chk(c)?c:0;d=$chk(d)?d:0}this.element.setStyles({top:c,left:d,position:this.position.element});this.parent(this.element)},start:function(a){this.overed=null;if(this.container){var b=this.container.getCoordinates(),c=this.element.getCoordinates();
this.options.limit=this.position.element=="absolute"&&!["relative","absolute","fixed"].contains(this.position.container)?{x:[b.left,b.right-c.width],y:[b.top,b.bottom-c.height]}:{y:[0,b.height-c.height],x:[0,b.width-c.width]}}this.parent(a)},drag:function(a){this.parent(a);a=this.out?false:this.droppables.filter(this.checkAgainst,this).getLast();if(this.overed!=a){this.overed&&this.overed.fireEvent("leave",[this.element,this]);a&&this.fireEvent("onEnter",[this.element,a]);this.overed=a?a.fireEvent("over",
[this.element,this]):null}return this},checkAgainst:function(a){a=a.getCoordinates(this.options.overflown);var b=this.mouse.now;return b.x>a.left&&b.x<a.right&&b.y<a.bottom&&b.y>a.top},stop:function(){this.overed&&!this.out?this.overed.fireEvent("drop",[this.element,this]):this.element.fireEvent("emptydrop",this);this.parent();return this}}); 