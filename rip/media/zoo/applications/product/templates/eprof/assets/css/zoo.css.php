/* Copyright (C) 2007 - 2010 YOOtheme GmbH, YOOtheme License (http://www.yootheme.com/license) */

/*
 * layout
 */

#yoo-zoo .row,
#yoo-zoo .floatbox { overflow: hidden; }

#yoo-zoo .width25 {
	float: left;
	width: 24.999%;
}

#yoo-zoo .width33 {
	float: left;
	width: 33.333%;
}

#yoo-zoo .width50 {
	float: left;
	width: 49.999%;
}
 
/*
 * alpha-index
 */

#yoo-zoo .alpha-index {
	margin: 0px 0px 20px 0px;
	background: url(../images/alpha_index.png) 0 0 no-repeat;
}

#yoo-zoo .alpha-index-2 {
	padding: 0px 10px 0px 10px;
	background: url(../images/alpha_index.png) 100% -40px no-repeat;
}

#yoo-zoo .alpha-index-3 {
	height: 35px;
	padding: 0px 0px 0px 5px;
	background: url(../images/alpha_index.png) 0 -80px repeat-x;
	overflow: hidden;
}

#yoo-zoo .alpha-index a,
#yoo-zoo .alpha-index span {
	display: block;
	width: 21px;
	height: 35px;
	float: left;
	line-height: 35px;
	text-align: center;	
	text-transform: uppercase;
}

#yoo-zoo .alpha-index a:link,
#yoo-zoo .alpha-index a:visited {
	color: #646464;
	text-decoration: none;
}

#yoo-zoo .alpha-index a:hover {
	background: url(../images/alpha_index.png) 0 -121px no-repeat;
	color: #000000;
	text-decoration: none;
}

#yoo-zoo .alpha-index span {
	color: #C8C8C8;
	cursor: default;
}

/*
 * box
 */

#yoo-zoo div.box-t1 { background: url(../images/box.png) 0 0 no-repeat; }

#yoo-zoo div.box-t2 {
	padding: 0px 10px 0px 10px;
	background: url(../images/box.png) 100% -15px no-repeat;
}

#yoo-zoo div.box-t3 {
	height: 9px;
	border-top: 1px solid #C8CBCD;
	background: #ffffff;
}

#yoo-zoo div.box-1 {
	border-left: 1px solid #C8CBCD;
	border-right: 1px solid #C8CBCD;
	background: #ffffff;
	overflow: hidden;
}

#yoo-zoo div.box-b1 { background: url(../images/box.png) 0 -30px no-repeat; }

#yoo-zoo div.box-b2 {
	padding: 0px 10px 0px 10px;
	background: url(../images/box.png) 100% -45px no-repeat;
}

#yoo-zoo div.box-b3 {
	height: 9px;
	border-bottom: 1px solid #C8CBCD;
	background: #ffffff;
}

#yoo-zoo h1.box-title {
	position: absolute;
	left: 0px;
	right: 0px;
	margin: 0px;
	background: url(../images/box.png) 0 -60px no-repeat;
	font-size: 18px;
	font-weight: bold;
	color: #505050;
	line-height: 50px;
}

#yoo-zoo h1.box-title > span {
	display: block;
	padding: 0px 10px 0px 10px;
	background: url(../images/box.png) 100% -115px no-repeat;
}

#yoo-zoo h1.box-title > span > span {
	display: block;
	padding: 0px 5px 0px 5px;
	height: 50px;
	background: url(../images/box.png) 0 -170px repeat-x;
}

#yoo-zoo div.has-box-title div.box-1 { padding-top: 50px; }

#yoo-zoo div.box-1 div.row {
	padding: 15px 5px 15px 5px;
	border-top: 1px solid #E6E7E8;
}

#yoo-zoo div.box-1 div.first-row {
	padding-top: 5px;
	border-top: none;
}

/*
 * details
 */
 
#yoo-zoo .details { margin: 0px 0px 20px 0px; }

#yoo-zoo .details div.box-1 { padding: 0px 14px 4px 14px; }

#yoo-zoo .details h1.title {
	margin: 0px 0px 5px 0px;
	font-size: 35px;
	color: #505050;
	line-height: 50px;
	font-weight: normal;
	letter-spacing: -1px;
}

#yoo-zoo .details div.description { overflow: hidden; }

#yoo-zoo .details.align-center { text-align: center; }

#yoo-zoo .details.align-left .image {
	margin-right: 15px;
	float: left;
}

#yoo-zoo .details.align-right .image {
	margin-left: 15px;
	float: right;
}

#yoo-zoo .details.align-center .image {
	display: block;
	margin: auto;
	margin-bottom: 10px;
}

/*
 * categories
 */

#yoo-zoo .categories {
	position: relative;
	margin: 0px 0px 20px 0px;
}

#yoo-zoo .categories .category { padding: 0px 10px 0px 10px; }

#yoo-zoo .categories h2.title {
	/*margin: 0px;*/
	margin-top: 10px;
	font-size: 16px;
	line-height: 18px;
	font-weight: bold;
}

#yoo-zoo .categories h2.title a { text-decoration: none; }

#yoo-zoo .categories h2.title span {
	font-size: 12px;
	font-weight: normal;
	color: #969696;
}

#yoo-zoo .categories a.teaser-image {
	display: block;
	margin: 10px 0px 0px 0px;
	text-align: center;
}

#yoo-zoo .categories p.sub-categories { margin: 10px 0px 0px 0px; }

#yoo-zoo .categories p.sub-categories span {
	color: #969696;
	font-size: 11px;
}

/*
 * items
 */

#yoo-zoo .items { position: relative; }

#yoo-zoo .items div.teaser-item {
	padding: 0px 10px 0px 10px;
	overflow: hidden;
}

/* position: media */
#yoo-zoo .items div.media-left {
	margin-right: 15px;
	float: left;
}

#yoo-zoo .items div.media-right {
	margin-left: 15px;
	float: right;
}

#yoo-zoo .items div.media-center { text-align: center; }

/* position: title */
#yoo-zoo .items h2.pos-title {
	margin: 5px 0px 0px 0px;
	font-size: 16px;
	font-weight: bold;
	line-height: 16px;
}

#yoo-zoo .items h2.pos-title a { text-decoration: none; }

/* position: description */
#yoo-zoo .items div.pos-description {}
#yoo-zoo .items div.pos-description .element { margin-top: 7px; }

/* element type: textarea */
#yoo-zoo .items div.pos-description .element-textarea > * { margin: 0px 0px 7px 0px; }
#yoo-zoo .items div.pos-description .element-textarea > *:last-child { margin: 0px; }

/* position: specification */
#yoo-zoo .items ul.pos-specification {
	list-style: none;
	margin: 7px 0px 0px 0px;
	padding: 0px;
}

#yoo-zoo .items ul.pos-specification strong {
	display: inline-block;
	width: 120px;
}

/* position: links */
#yoo-zoo .items p.pos-links { margin: 7px 0px 0px 0px; }

#yoo-zoo .items p.pos-links span a:after {
	content: " »";
	font-size: 14px;
}

/*
 * pagination
 */
 
#yoo-zoo .pagination {
	padding: 15px 5px 5px 5px;
	border-top: 1px solid #E6E7E8;
	text-align: center;
}

#yoo-zoo .pagination div.pagination-bg {
	display: inline-block;
	cursor: pointer;
}

#yoo-zoo .pagination a { text-decoration: none; }

#yoo-zoo .items h2.pos-title {
    margin: 10px 0px 0px 0px !important;
    font-size: 16px;
    font-weight: bold;
    line-height: 16px;
}

#yoo-zoo .items div.media-left {
    width: 151px;
    height: 168px;
    overflow: hidden;
}/* Copyright (C) 2007 - 2010 YOOtheme GmbH, YOOtheme License (http://www.yootheme.com/license) */

/*
 * item
 */

/* box */
#yoo-zoo .item div.box-1 { padding: 4px 14px 4px 14px; }

/* position headings */
#yoo-zoo .item h3 {
	margin-top: 0px;
	font-size: 21px;
	font-weight: normal;
}

/* element type: textarea */
#yoo-zoo .item .element-textarea > * { margin: 0px 0px 10px 0px; }
#yoo-zoo .item .element-textarea > *:last-child { margin: 0px; }

/* position: top */
#yoo-zoo .item div.pos-top {
	margin-bottom: 20px;
	overflow: hidden;
}
#yoo-zoo .item div.pos-top .element { margin-bottom: 20px; }
#yoo-zoo .item div.pos-top .element.last { margin-bottom: 0px; }

/* product box */
#yoo-zoo .item > div.floatbox { margin-bottom: 20px; }

/* position: media */
#yoo-zoo .item div.media-left {
	margin-right: 15px;
	float: left;
}

#yoo-zoo .item div.media-right {
	margin-left: 15px;
	float: right;
}

#yoo-zoo .item div.media-center { text-align: center; }

#yoo-zoo .item div.pos-media .element { margin-bottom: 15px; }

/* title */
#yoo-zoo .item h1.pos-title {
	margin: 0px;
	font-weight: bold;
	color: #505050;
	font-size: 21px;
	line-height: 32px;
}

/* position: description */
#yoo-zoo .item div.pos-description {}
#yoo-zoo .item div.pos-description .element { margin-top: 20px; }

/* element type: rating */
#yoo-zoo .item div.pos-description .element-rating { margin-top: 0px; }

#yoo-zoo .item div.pos-description div.rating { overflow: hidden; }
#yoo-zoo .item div.pos-description div.rating div.rating-container {
	margin-right: 10px;
	float: left;
}
#yoo-zoo .item div.pos-description div.rating div.vote-message { line-height: 20px; }

/* position: specification */
#yoo-zoo .item div.pos-specification {
	margin-top: 20px;
	overflow: hidden;
}

#yoo-zoo .item div.pos-specification ul {
	list-style: none;
	margin: 0px;
	padding: 0px;
}

#yoo-zoo .item div.pos-specification ul strong {
	display: inline-block;
	width: 120px;
}

/* position: bottom */
#yoo-zoo .item div.pos-bottom { overflow: hidden; }
#yoo-zoo .item div.pos-bottom .element { margin-top: 20px; }

/* position: related */
#yoo-zoo .item div.pos-related {
	margin-top: 40px;
	overflow: hidden;
}

#yoo-zoo .item div.pos-related h3 {
	margin-bottom: 10px;
	padding-bottom: 10px;
	border-bottom: 1px solid #E6E7E8;
	color: #323232;
}

#yoo-zoo .item div.pos-related .element-relateditems > div {
	width: 50%;
	margin-bottom: 20px;
	float: left;
}

/* related item */

/* position: media */
#yoo-zoo .pos-related div.media-left {
	margin-right: 15px;
	float: left;
}

#yoo-zoo .pos-related div.media-right {
	margin-left: 15px;
	float: right;
}

#yoo-zoo .pos-related div.media-center { text-align: center; }

/* position: title */
#yoo-zoo .pos-related h4.sub-pos-title {
	margin: 5px 0px 0px 0px;
	font-size: 16px;
	font-weight: bold;
	line-height: 16px;
}

#yoo-zoo .pos-related h4.sub-pos-title a { text-decoration: none; }

/* position: description */
#yoo-zoo .pos-related div.sub-pos-description {}
#yoo-zoo .pos-related div.sub-pos-description .element { margin-top: 7px; }

/* element type: textarea */
#yoo-zoo .pos-related div.sub-pos-description .element-textarea > * { margin: 0px 0px 7px 0px; }
#yoo-zoo .pos-related div.sub-pos-description .element-textarea > *:last-child { margin: 0px; }

/* position: specification */
#yoo-zoo .pos-related ul.sub-pos-specification {
	list-style: none;
	margin: 7px 0px 0px 0px;
	padding: 0px;
}

#yoo-zoo .pos-related ul.sub-pos-specification strong {}

/* position: links */
#yoo-zoo .pos-related p.sub-pos-links { margin: 7px 0px 0px 0px; }

#yoo-zoo .pos-related p.sub-pos-links span a:after {
	content: " »";
	font-size: 14px;
}

/*
 * comments
 */
 
#yoo-zoo div#comments { margin-top: 0px; }

#yoo-zoo div#comments .comments-meta {
	margin: 0px 0px 15px 0px;
	font-weight: bold;
	color: #505050;
	font-size: 21px;
	line-height: 32px;
}