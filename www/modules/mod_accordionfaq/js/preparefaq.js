/**
* Accordion FAQ - 1.0.7.2
* @author Ken Lowther
* @license Limited  http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
function prepareFaq()
{

var thisObject = this;
this.headers = null;
this.next = null;
this.newdiv = null;
this.hdr = null;
this.hdrcnt = 0;
this.ele = null;
this.eleChild = null;
this.prev = null;
this.sib = null;
this.autonumber = false;
this.hdrnumber = 1;
this.jumpto = null;
this.preloaded = false;
this.images = [];

this.exec = function( opts )
{
	if (typeof opts.id == 'undefined')
	{
		this.faqid = 'accordion';
	}
	else
	{
		this.faqid = opts.id;
	}
	if (typeof opts.header == 'undefined')
	{
		this.header = 'h3';
	}
	else
	{
		this.header = opts.header;
	}
	if (typeof opts.autonumber != 'undefined')
	{
		this.autonumber = opts.autonumber;
	}
	if (typeof opts.jumpto != 'undefined')
	{
		this.jumpto = opts.jumpto;
	}
	this.ele = document.getElementById( this.faqid );
	if (this.ele == null)
	{
		return;
	}
	this.eleChild = this.ele.firstChild;
	if (this.eleChild == null)
	{
		return;
	}
	this.prev = this.ele;
	this.hdrcnt = 0;
	while (this.hdrcnt == 0
          &&(this.prev = this.prev.parentNode) != null
		  )
	{
		this.headers = this.prev.getElementsByTagName( this.header );
		this.hdrcnt = this.headers.length;
	}

	if (this.prev == null)
	{
		return;
	}
	var tmphdrs = [];
	for (i =0; i < this.headers.length; i++)
	{
		if (this.headers[i].parentNode == this.prev)
		{
			tmphdrs[tmphdrs.length] = this.headers[i];
		}
	}
	this.headers = tmphdrs;
	this.hdrcnt = this.headers.length;
	this.ele.style.display = 'block';

	for (i = 0; i < this.headers.length; i++)
	{
		this.addClass( this.headers[i], 'accordionfaqheader' );
	}
	while(this.hdrcnt)
	{
		var i = 0;
		while (typeof this.headers[i] != "undefined" && this.headers[i].parentNode == this.ele)
		{
			i++;
		}

		this.hdrcnt--;
		this.next = this.headers[i].nextSibling;
		this.hdr = this.headers[i];
		this.prev.removeChild( this.hdr );
		if (this.hdrcnt > 0)
		{
			if (this.autonumber)
			{
				var hdrstr = this.hdr.innerHTML;
				this.hdr.innerHTML = this.hdrnumber + '. ' + hdrstr;
			}
			var hdrId = this.hdr.getAttribute('id');
			if (hdrId == null)
			{
				this.hdr.setAttribute( 'id', this.faqid + (this.hdrnumber-1) );
			}
			this.ele.insertBefore( this.hdr, this.eleChild );
			var icon = document.createElement( 'span' );
			if (this.hdr.childNodes.length > 0)
			{
				this.hdr.insertBefore( icon, this.hdr.firstChild );
			}
			else
			{
				this.hdr.appendChild( icon );
			}
			this.addClass( icon, 'accordionfaqicon' );
			this.newdiv = document.createElement( 'div' );
			this.ele.insertBefore( this.newdiv, this.eleChild );
			this.addClass( this.newdiv, 'accordionfaqitem' );
			this.hdrnumber++;
			if (! this.preloaded)
			{
				this.preloadIcons( this.hdr );
			}

			do
			{
				this.sib = this.next.nextSibling;
				this.prev.removeChild( this.next );
				this.newdiv.appendChild( this.next );
			}
			while ((this.next = this.sib) != null
			      &&this.next.nodeName != this.header.toUpperCase()
				  &&this.next != this.ele
				  );
		}
	}
	this.ele.removeChild( this.eleChild );
}

this.preloadIcons = function( ele )
{
	this.preloadImg( ele );
	this.addClass( ele, 'selected' );
	this.preloadImg( ele );
	this.removeClass( ele, 'selected' );
	this.preloaded = true;
}

this.preloadImg = function( ele )
{
	var bkgr = this.getStyle( ele, 'background-image' );

	if (bkgr != null)
	{
		var imgmatch = bkgr.match(/url[(](["']*)\s*([^'"]*)(["']*)[)]/i);
		if (imgmatch != null && typeof imgmatch[2] != 'undefined')
		{
			var img = new Image();
			img.src = imgmatch[2];
			this.images[this.images.length] = img;
		}
	}
}

this.toCamel = function( str )
{
	return str.replace(/(\-[a-z])/g, function($1){return $1.toUpperCase().replace('-','');});
}

this.getStyle = function(el,styleProp)
{
	var y = null;
	if (typeof window.getComputedStyle != 'undefined')
	{
		y = document.defaultView.getComputedStyle(el,null).getPropertyValue(styleProp);
	}
	else
	if (typeof el.currentStyle != 'undefined')
	{
		y = el.currentStyle[this.toCamel(styleProp)];
	}
	return y;
}

this.hasClass = function(ele,cls)
{
	return ele.className.match(new RegExp('(\\s|^)'+cls+'(\\s|$)'));
}

this.addClass = function(ele,cls)
{
	if (!this.hasClass(ele,cls)) ele.className += " "+cls;
	ele.className = this.trim( ele.className );
}

this.removeClass = function(ele,cls)
{
	if (this.hasClass(ele,cls))
	{
		var reg = new RegExp('(\\s|^)'+cls+'(\\s|$)');
		ele.className=ele.className.replace(reg,' ');
	}
}
this.trim = function trim(str)
{
	return str.replace(/^\s+|\s+$/g,"");
}

}