/* Copyright (C) 2007 - 2010 YOOtheme GmbH, YOOtheme License (http://www.yootheme.com/license) */

var ElementVideo=new Class({initialize:function(a,b){this.setOptions({file:".file",url:".url",type:".type",notice:"span.notice",formats:["avi","divx","flv","mov","mpg","mp4","wmv","swf"],sites:["video.google.com","youtube.com","liveleak.com","vids.myspace.com","vimeo.com"],msgNoMatch:" Can't match format, select manually."},b);this.element=$(a)},attachEvents:function(){var a=this,b=this.element.getElement(this.options.file),c=this.element.getElement(this.options.url),g=this.element.getElement(this.options.type),
h=g.getParent().getElement(this.options.notice);b.addEvent("change",function(){var d=b.getProperty("value"),e=a.getVideoFormat(d),f="";if(d&&!e)f=a.options.msgNoMatch;g.setProperty("value",e);h.setHTML(f)});c.addEvent("blur",function(){var d=c.getProperty("value"),e=a.getVideoFormat(d)||a.getVideoSite(d),f="";if(!b.getProperty("value")){if(d&&!e)f=a.options.msgNoMatch;g.setProperty("value",e);h.setHTML(f)}})},getVideoFormat:function(a){var b="";this.options.formats.each(function(c){if(a.test("^.*."+
c+"$","i"))b=c});return b},getVideoSite:function(a){var b="";this.options.sites.each(function(c){if(a.test(c))b=c});return b}});ElementVideo.implement(new Options); 
