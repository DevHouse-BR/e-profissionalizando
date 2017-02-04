/* Copyright (C) 2007 - 2010 YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

var WarpTemplate = {
		
	start: function() {

		/* Match height of div tags */
		matchHeights();

		/* Accordion menu */
		new Warp.AccordionMenu('div#middle ul.menu li.toggler', 'ul.accordion', { accordion: 'slide' });

		/* Dropdown menu */
		var dropdown = new Warp.Menu('menu', { mode: 'slide', dropdownSelector: 'div.dropdown', transition: Fx.Transitions.Expo.easeOut });
		//dropdown.matchHeight();

		/* set hover color */
		switch (Warp.Settings.color) {
			case 'plainflowers':
				var menuEnter = '#F7F6F5';
				var menuLeave = '#FFFFFF';
				var submenuEnter = '#F4F4F3';
				var submenuLeave = '#F9F9F8';
				break;
			case 'retropaper':
			case 'retrolandscape':
			case 'retrobeige':
				var menuEnter = '#F0EFEF';
				var menuLeave = '#FAFAF6';
				var submenuEnter = '#F1F0EF';
				var submenuLeave = '#FAFAF6';
				break;
			case 'gradientblue':
			case 'gradientbusiness':
			case 'gradientspace':
			case 'gradientribbon':
			case 'gradientred':
				var menuEnter = '#E3E4E5';
				var menuLeave = '#EEEFF0';
				var submenuEnter = '#E3E4E5';
				var submenuLeave = '#EEEFF0';
				break;
			default:
				var menuEnter = '#F5F6F7';
				var menuLeave = '#FFFFFF';
				var submenuEnter = '#F3F4F5';
				var submenuLeave = '#F8F9FA';
		}

		/* Morph: main menu - level2 (bg) */
		var menuEnter = { 'background-color': menuEnter };
		var menuLeave = { 'background-color': menuLeave };

		new Warp.Morph('#menu a.level2', menuEnter, menuLeave,
			{ transition: Fx.Transitions.linear, duration: 0 },
			{ transition: Fx.Transitions.sineIn, duration: 100 });
			
		/* Morph: sub menu - level1 (bg) */
		var submenuEnter = { 'background-color': submenuEnter };
		var submenuLeave = { 'background-color': submenuLeave };

		new Warp.Morph('div.mod-line ul.menu span.level1, div.mod-line ul.menu a.level1', submenuEnter, submenuLeave,
			{ transition: Fx.Transitions.linear, duration: 0 },
			{ transition: Fx.Transitions.sineIn, duration: 100 });

		/* Smoothscroll */
		new SmoothScroll({ duration: 500, transition: Fx.Transitions.Expo.easeOut });

		/* Match height of div tags */
		function matchHeights() {
			Warp.Base.matchHeight('div.headerbox div.deepest', 20);
			Warp.Base.matchHeight('div.topbox div.deepest', 20);
			Warp.Base.matchHeight('#bottom div.bottombox div.deepest', 20);
			Warp.Base.matchHeight('#bottom2 div.bottombox div.deepest', 20);
			Warp.Base.matchHeight('div.maintopbox div.deepest', 20);
			Warp.Base.matchHeight('div.mainbottombox div.deepest', 20);
			Warp.Base.matchHeight('div.contenttopbox div.deepest', 20);
			Warp.Base.matchHeight('div.contentbottombox div.deepest', 20);
			Warp.Base.matchHeight('#left, #right, #contentleft, #contentright', 20);
		}

	}

};

/* Add functions on window load */
window.addEvent('domready', WarpTemplate.start);