/**
 * File js-enabled.js
 *
 * If Javascript is enabled, replace the <body> class "no-js".
 */
document.body.className = document.body.className.replace( 'no-js', 'js' );
/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var container, button, menu, links, subMenus, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );
	subMenus = menu.getElementsByTagName( 'ul' );

	// Set menu items with submenus to aria-haspopup="true".
	for ( i = 0, len = subMenus.length; i < len; i++ ) {
		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
	}

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
} )();
/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var isWebkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
	    isOpera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
	    isIe     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

	if ( ( isWebkit || isOpera || isIe ) && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
})();
/*
	scripts.js

	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html

	Copyright: (c) 2013 Alexander "Alx" Agnarson, http://alxmedia.se
*/

"use strict";

jQuery(document).ready(function($) {

/*  Toggle header search
/* ------------------------------------ */
	$('.toggle-search').click(function(){
		$('.toggle-search').toggleClass('active');
		$('.search-expand').fadeToggle(250);
            setTimeout(function(){
                $('.search-expand input').focus();
            }, 300);
	});

/*  Scroll to top
/* ------------------------------------ */
	$('a#back-to-top').click(function() {
		$('html, body').animate({scrollTop:0},'slow');
		return false;
	});

/*  Tabs widget
/* ------------------------------------ */
	(function() {
		var $tabsNav       = $('.alx-tabs-nav'),
			$tabsNavLis    = $tabsNav.children('li'),
			$tabsContainer = $('.alx-tabs-container');

		$tabsNav.each(function() {
			var $this = $(this);
			$this.next().children('.alx-tab').stop(true,true).hide()
			.siblings( $this.find('a').attr('href') ).show();
			$this.children('li').first().addClass('active').stop(true,true).show();
		});

		$tabsNavLis.on('click', function(e) {
			var $this = $(this);

			$this.siblings().removeClass('active').end()
			.addClass('active');

			$this.parent().next().children('.alx-tab').stop(true,true).hide()
			.siblings( $this.find('a').attr('href') ).fadeIn();
			e.preventDefault();
		}).children( window.location.hash ? 'a[href=' + window.location.hash + ']' : 'a:first' ).trigger('click');

	})();

/*  Comments / pingbacks tabs
/* ------------------------------------ */
    $(".comment-tabs li").click(function() {
        $(".comment-tabs li").removeClass('active');
        $(this).addClass("active");
        $(".comment-tab").hide();
        var selected_tab = $(this).find("a").attr("href");
        $(selected_tab).fadeIn();
        return false;
    });

/*  Table odd row class
/* ------------------------------------ */
	$('table tr:odd').addClass('alt');

/*  Sidebar collapse
/* ------------------------------------ */
	$('body').addClass('s1-collapse');
	$('body').addClass('s2-collapse');

	$('.s1 .sidebar-toggle').click(function(){
		$('body').toggleClass('s1-collapse').toggleClass('s1-expand');
		if ($('body').is('.s2-expand')) {
			$('body').toggleClass('s2-expand').toggleClass('s2-collapse');
		}
	});
	$('.s2 .sidebar-toggle').click(function(){
		$('body').toggleClass('s2-collapse').toggleClass('s2-expand');
		if ($('body').is('.s1-expand')) {
			$('body').toggleClass('s1-expand').toggleClass('s1-collapse');
		}
	});

/*  Dropdown menu animation
/* ------------------------------------ */
	$('.nav ul.sub-menu').hide();
	$('.nav li').hover(
		function() {
			$(this).children('ul.sub-menu').slideDown('fast');
		},
		function() {
			$(this).children('ul.sub-menu').hide();
		}
	);

/*  Fitvids
/* ------------------------------------ */
	function responsiveVideo() {
			if ( $().fitVids ) {
				$('#wrapper').fitVids();
			}
		}

	responsiveVideo();

/*  Mobile menu smooth toggle height
/* ------------------------------------ */
	$('.nav-toggle').on('click', function() {
		slide($('.nav-wrap .nav', $(this).parent()));
	});

	function slide(content) {
		var wrapper = content.parent();
		var contentHeight = content.outerHeight(true);
		var wrapperHeight = wrapper.height();

		wrapper.toggleClass('expand');
		if (wrapper.hasClass('expand')) {
		setTimeout(function() {
			wrapper.addClass('transition').css('height', contentHeight);
		}, 10);
	}
	else {
		setTimeout(function() {
			wrapper.css('height', wrapperHeight);
			setTimeout(function() {
			wrapper.addClass('transition').css('height', 0);
			}, 10);
		}, 10);
	}

	wrapper.one('transitionEnd webkitTransitionEnd transitionend oTransitionEnd msTransitionEnd', function() {
		if(wrapper.hasClass('open')) {
			wrapper.removeClass('transition').css('height', 'auto');
		}
	});
	}

});
/**
 * File window-ready.js
 *
 * Add a "ready" class to <body> when window is ready.
 */
window.Window_Ready = {};
( function( window, $, that ) {

	// Constructor.
	that.init = function() {
		that.cache();
		that.bindEvents();
	};

	// Cache document elements.
	that.cache = function() {
		that.$c = {
			window: $(window),
			body: $(document.body),
		};
	};

	// Combine all events.
	that.bindEvents = function() {
		that.$c.window.load( that.addBodyClass );
	};

	// Add a class to <body>.
	that.addBodyClass = function() {
		that.$c.body.addClass( 'ready' );
	};

	// Engage!
	$( that.init );

})( window, jQuery, window.Window_Ready );
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImpzLWVuYWJsZWQuanMiLCJuYXZpZ2F0aW9uLmpzIiwic2tpcC1saW5rLWZvY3VzLWZpeC5qcyIsInRoZW1lLmpzIiwid2luZG93LXJlYWR5LmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQ0xBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQ2hGQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUNoQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQ2pKQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJmaWxlIjoicHJvamVjdC5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8qKlxuICogRmlsZSBqcy1lbmFibGVkLmpzXG4gKlxuICogSWYgSmF2YXNjcmlwdCBpcyBlbmFibGVkLCByZXBsYWNlIHRoZSA8Ym9keT4gY2xhc3MgXCJuby1qc1wiLlxuICovXG5kb2N1bWVudC5ib2R5LmNsYXNzTmFtZSA9IGRvY3VtZW50LmJvZHkuY2xhc3NOYW1lLnJlcGxhY2UoICduby1qcycsICdqcycgKTsiLCIvKipcbiAqIEZpbGUgbmF2aWdhdGlvbi5qcy5cbiAqXG4gKiBIYW5kbGVzIHRvZ2dsaW5nIHRoZSBuYXZpZ2F0aW9uIG1lbnUgZm9yIHNtYWxsIHNjcmVlbnMgYW5kIGVuYWJsZXMgVEFCIGtleVxuICogbmF2aWdhdGlvbiBzdXBwb3J0IGZvciBkcm9wZG93biBtZW51cy5cbiAqL1xuKCBmdW5jdGlvbigpIHtcblx0dmFyIGNvbnRhaW5lciwgYnV0dG9uLCBtZW51LCBsaW5rcywgc3ViTWVudXMsIGksIGxlbjtcblxuXHRjb250YWluZXIgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCggJ3NpdGUtbmF2aWdhdGlvbicgKTtcblx0aWYgKCAhIGNvbnRhaW5lciApIHtcblx0XHRyZXR1cm47XG5cdH1cblxuXHRidXR0b24gPSBjb250YWluZXIuZ2V0RWxlbWVudHNCeVRhZ05hbWUoICdidXR0b24nIClbMF07XG5cdGlmICggJ3VuZGVmaW5lZCcgPT09IHR5cGVvZiBidXR0b24gKSB7XG5cdFx0cmV0dXJuO1xuXHR9XG5cblx0bWVudSA9IGNvbnRhaW5lci5nZXRFbGVtZW50c0J5VGFnTmFtZSggJ3VsJyApWzBdO1xuXG5cdC8vIEhpZGUgbWVudSB0b2dnbGUgYnV0dG9uIGlmIG1lbnUgaXMgZW1wdHkgYW5kIHJldHVybiBlYXJseS5cblx0aWYgKCAndW5kZWZpbmVkJyA9PT0gdHlwZW9mIG1lbnUgKSB7XG5cdFx0YnV0dG9uLnN0eWxlLmRpc3BsYXkgPSAnbm9uZSc7XG5cdFx0cmV0dXJuO1xuXHR9XG5cblx0bWVudS5zZXRBdHRyaWJ1dGUoICdhcmlhLWV4cGFuZGVkJywgJ2ZhbHNlJyApO1xuXHRpZiAoIC0xID09PSBtZW51LmNsYXNzTmFtZS5pbmRleE9mKCAnbmF2LW1lbnUnICkgKSB7XG5cdFx0bWVudS5jbGFzc05hbWUgKz0gJyBuYXYtbWVudSc7XG5cdH1cblxuXHRidXR0b24ub25jbGljayA9IGZ1bmN0aW9uKCkge1xuXHRcdGlmICggLTEgIT09IGNvbnRhaW5lci5jbGFzc05hbWUuaW5kZXhPZiggJ3RvZ2dsZWQnICkgKSB7XG5cdFx0XHRjb250YWluZXIuY2xhc3NOYW1lID0gY29udGFpbmVyLmNsYXNzTmFtZS5yZXBsYWNlKCAnIHRvZ2dsZWQnLCAnJyApO1xuXHRcdFx0YnV0dG9uLnNldEF0dHJpYnV0ZSggJ2FyaWEtZXhwYW5kZWQnLCAnZmFsc2UnICk7XG5cdFx0XHRtZW51LnNldEF0dHJpYnV0ZSggJ2FyaWEtZXhwYW5kZWQnLCAnZmFsc2UnICk7XG5cdFx0fSBlbHNlIHtcblx0XHRcdGNvbnRhaW5lci5jbGFzc05hbWUgKz0gJyB0b2dnbGVkJztcblx0XHRcdGJ1dHRvbi5zZXRBdHRyaWJ1dGUoICdhcmlhLWV4cGFuZGVkJywgJ3RydWUnICk7XG5cdFx0XHRtZW51LnNldEF0dHJpYnV0ZSggJ2FyaWEtZXhwYW5kZWQnLCAndHJ1ZScgKTtcblx0XHR9XG5cdH07XG5cblx0Ly8gR2V0IGFsbCB0aGUgbGluayBlbGVtZW50cyB3aXRoaW4gdGhlIG1lbnUuXG5cdGxpbmtzICAgID0gbWVudS5nZXRFbGVtZW50c0J5VGFnTmFtZSggJ2EnICk7XG5cdHN1Yk1lbnVzID0gbWVudS5nZXRFbGVtZW50c0J5VGFnTmFtZSggJ3VsJyApO1xuXG5cdC8vIFNldCBtZW51IGl0ZW1zIHdpdGggc3VibWVudXMgdG8gYXJpYS1oYXNwb3B1cD1cInRydWVcIi5cblx0Zm9yICggaSA9IDAsIGxlbiA9IHN1Yk1lbnVzLmxlbmd0aDsgaSA8IGxlbjsgaSsrICkge1xuXHRcdHN1Yk1lbnVzW2ldLnBhcmVudE5vZGUuc2V0QXR0cmlidXRlKCAnYXJpYS1oYXNwb3B1cCcsICd0cnVlJyApO1xuXHR9XG5cblx0Ly8gRWFjaCB0aW1lIGEgbWVudSBsaW5rIGlzIGZvY3VzZWQgb3IgYmx1cnJlZCwgdG9nZ2xlIGZvY3VzLlxuXHRmb3IgKCBpID0gMCwgbGVuID0gbGlua3MubGVuZ3RoOyBpIDwgbGVuOyBpKysgKSB7XG5cdFx0bGlua3NbaV0uYWRkRXZlbnRMaXN0ZW5lciggJ2ZvY3VzJywgdG9nZ2xlRm9jdXMsIHRydWUgKTtcblx0XHRsaW5rc1tpXS5hZGRFdmVudExpc3RlbmVyKCAnYmx1cicsIHRvZ2dsZUZvY3VzLCB0cnVlICk7XG5cdH1cblxuXHQvKipcblx0ICogU2V0cyBvciByZW1vdmVzIC5mb2N1cyBjbGFzcyBvbiBhbiBlbGVtZW50LlxuXHQgKi9cblx0ZnVuY3Rpb24gdG9nZ2xlRm9jdXMoKSB7XG5cdFx0dmFyIHNlbGYgPSB0aGlzO1xuXG5cdFx0Ly8gTW92ZSB1cCB0aHJvdWdoIHRoZSBhbmNlc3RvcnMgb2YgdGhlIGN1cnJlbnQgbGluayB1bnRpbCB3ZSBoaXQgLm5hdi1tZW51LlxuXHRcdHdoaWxlICggLTEgPT09IHNlbGYuY2xhc3NOYW1lLmluZGV4T2YoICduYXYtbWVudScgKSApIHtcblxuXHRcdFx0Ly8gT24gbGkgZWxlbWVudHMgdG9nZ2xlIHRoZSBjbGFzcyAuZm9jdXMuXG5cdFx0XHRpZiAoICdsaScgPT09IHNlbGYudGFnTmFtZS50b0xvd2VyQ2FzZSgpICkge1xuXHRcdFx0XHRpZiAoIC0xICE9PSBzZWxmLmNsYXNzTmFtZS5pbmRleE9mKCAnZm9jdXMnICkgKSB7XG5cdFx0XHRcdFx0c2VsZi5jbGFzc05hbWUgPSBzZWxmLmNsYXNzTmFtZS5yZXBsYWNlKCAnIGZvY3VzJywgJycgKTtcblx0XHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0XHRzZWxmLmNsYXNzTmFtZSArPSAnIGZvY3VzJztcblx0XHRcdFx0fVxuXHRcdFx0fVxuXG5cdFx0XHRzZWxmID0gc2VsZi5wYXJlbnRFbGVtZW50O1xuXHRcdH1cblx0fVxufSApKCk7IiwiLyoqXG4gKiBGaWxlIHNraXAtbGluay1mb2N1cy1maXguanMuXG4gKlxuICogSGVscHMgd2l0aCBhY2Nlc3NpYmlsaXR5IGZvciBrZXlib2FyZCBvbmx5IHVzZXJzLlxuICpcbiAqIExlYXJuIG1vcmU6IGh0dHBzOi8vZ2l0LmlvL3ZXZHIyXG4gKi9cbiggZnVuY3Rpb24oKSB7XG5cdHZhciBpc1dlYmtpdCA9IG5hdmlnYXRvci51c2VyQWdlbnQudG9Mb3dlckNhc2UoKS5pbmRleE9mKCAnd2Via2l0JyApID4gLTEsXG5cdCAgICBpc09wZXJhICA9IG5hdmlnYXRvci51c2VyQWdlbnQudG9Mb3dlckNhc2UoKS5pbmRleE9mKCAnb3BlcmEnICkgID4gLTEsXG5cdCAgICBpc0llICAgICA9IG5hdmlnYXRvci51c2VyQWdlbnQudG9Mb3dlckNhc2UoKS5pbmRleE9mKCAnbXNpZScgKSAgID4gLTE7XG5cblx0aWYgKCAoIGlzV2Via2l0IHx8IGlzT3BlcmEgfHwgaXNJZSApICYmIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkICYmIHdpbmRvdy5hZGRFdmVudExpc3RlbmVyICkge1xuXHRcdHdpbmRvdy5hZGRFdmVudExpc3RlbmVyKCAnaGFzaGNoYW5nZScsIGZ1bmN0aW9uKCkge1xuXHRcdFx0dmFyIGlkID0gbG9jYXRpb24uaGFzaC5zdWJzdHJpbmcoIDEgKSxcblx0XHRcdFx0ZWxlbWVudDtcblxuXHRcdFx0aWYgKCAhICggL15bQS16MC05Xy1dKyQvLnRlc3QoIGlkICkgKSApIHtcblx0XHRcdFx0cmV0dXJuO1xuXHRcdFx0fVxuXG5cdFx0XHRlbGVtZW50ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoIGlkICk7XG5cblx0XHRcdGlmICggZWxlbWVudCApIHtcblx0XHRcdFx0aWYgKCAhICggL14oPzphfHNlbGVjdHxpbnB1dHxidXR0b258dGV4dGFyZWEpJC9pLnRlc3QoIGVsZW1lbnQudGFnTmFtZSApICkgKSB7XG5cdFx0XHRcdFx0ZWxlbWVudC50YWJJbmRleCA9IC0xO1xuXHRcdFx0XHR9XG5cblx0XHRcdFx0ZWxlbWVudC5mb2N1cygpO1xuXHRcdFx0fVxuXHRcdH0sIGZhbHNlICk7XG5cdH1cbn0pKCk7IiwiLypcblx0c2NyaXB0cy5qc1xuXG5cdExpY2Vuc2U6IEdOVSBHZW5lcmFsIFB1YmxpYyBMaWNlbnNlIHYzLjBcblx0TGljZW5zZSBVUkk6IGh0dHA6Ly93d3cuZ251Lm9yZy9saWNlbnNlcy9ncGwtMy4wLmh0bWxcblxuXHRDb3B5cmlnaHQ6IChjKSAyMDEzIEFsZXhhbmRlciBcIkFseFwiIEFnbmFyc29uLCBodHRwOi8vYWx4bWVkaWEuc2VcbiovXG5cblwidXNlIHN0cmljdFwiO1xuXG5qUXVlcnkoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCQpIHtcblxuLyogIFRvZ2dsZSBoZWFkZXIgc2VhcmNoXG4vKiAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gKi9cblx0JCgnLnRvZ2dsZS1zZWFyY2gnKS5jbGljayhmdW5jdGlvbigpe1xuXHRcdCQoJy50b2dnbGUtc2VhcmNoJykudG9nZ2xlQ2xhc3MoJ2FjdGl2ZScpO1xuXHRcdCQoJy5zZWFyY2gtZXhwYW5kJykuZmFkZVRvZ2dsZSgyNTApO1xuICAgICAgICAgICAgc2V0VGltZW91dChmdW5jdGlvbigpe1xuICAgICAgICAgICAgICAgICQoJy5zZWFyY2gtZXhwYW5kIGlucHV0JykuZm9jdXMoKTtcbiAgICAgICAgICAgIH0sIDMwMCk7XG5cdH0pO1xuXG4vKiAgU2Nyb2xsIHRvIHRvcFxuLyogLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tICovXG5cdCQoJ2EjYmFjay10by10b3AnKS5jbGljayhmdW5jdGlvbigpIHtcblx0XHQkKCdodG1sLCBib2R5JykuYW5pbWF0ZSh7c2Nyb2xsVG9wOjB9LCdzbG93Jyk7XG5cdFx0cmV0dXJuIGZhbHNlO1xuXHR9KTtcblxuLyogIFRhYnMgd2lkZ2V0XG4vKiAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gKi9cblx0KGZ1bmN0aW9uKCkge1xuXHRcdHZhciAkdGFic05hdiAgICAgICA9ICQoJy5hbHgtdGFicy1uYXYnKSxcblx0XHRcdCR0YWJzTmF2TGlzICAgID0gJHRhYnNOYXYuY2hpbGRyZW4oJ2xpJyksXG5cdFx0XHQkdGFic0NvbnRhaW5lciA9ICQoJy5hbHgtdGFicy1jb250YWluZXInKTtcblxuXHRcdCR0YWJzTmF2LmVhY2goZnVuY3Rpb24oKSB7XG5cdFx0XHR2YXIgJHRoaXMgPSAkKHRoaXMpO1xuXHRcdFx0JHRoaXMubmV4dCgpLmNoaWxkcmVuKCcuYWx4LXRhYicpLnN0b3AodHJ1ZSx0cnVlKS5oaWRlKClcblx0XHRcdC5zaWJsaW5ncyggJHRoaXMuZmluZCgnYScpLmF0dHIoJ2hyZWYnKSApLnNob3coKTtcblx0XHRcdCR0aGlzLmNoaWxkcmVuKCdsaScpLmZpcnN0KCkuYWRkQ2xhc3MoJ2FjdGl2ZScpLnN0b3AodHJ1ZSx0cnVlKS5zaG93KCk7XG5cdFx0fSk7XG5cblx0XHQkdGFic05hdkxpcy5vbignY2xpY2snLCBmdW5jdGlvbihlKSB7XG5cdFx0XHR2YXIgJHRoaXMgPSAkKHRoaXMpO1xuXG5cdFx0XHQkdGhpcy5zaWJsaW5ncygpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKS5lbmQoKVxuXHRcdFx0LmFkZENsYXNzKCdhY3RpdmUnKTtcblxuXHRcdFx0JHRoaXMucGFyZW50KCkubmV4dCgpLmNoaWxkcmVuKCcuYWx4LXRhYicpLnN0b3AodHJ1ZSx0cnVlKS5oaWRlKClcblx0XHRcdC5zaWJsaW5ncyggJHRoaXMuZmluZCgnYScpLmF0dHIoJ2hyZWYnKSApLmZhZGVJbigpO1xuXHRcdFx0ZS5wcmV2ZW50RGVmYXVsdCgpO1xuXHRcdH0pLmNoaWxkcmVuKCB3aW5kb3cubG9jYXRpb24uaGFzaCA/ICdhW2hyZWY9JyArIHdpbmRvdy5sb2NhdGlvbi5oYXNoICsgJ10nIDogJ2E6Zmlyc3QnICkudHJpZ2dlcignY2xpY2snKTtcblxuXHR9KSgpO1xuXG4vKiAgQ29tbWVudHMgLyBwaW5nYmFja3MgdGFic1xuLyogLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tICovXG4gICAgJChcIi5jb21tZW50LXRhYnMgbGlcIikuY2xpY2soZnVuY3Rpb24oKSB7XG4gICAgICAgICQoXCIuY29tbWVudC10YWJzIGxpXCIpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcbiAgICAgICAgJCh0aGlzKS5hZGRDbGFzcyhcImFjdGl2ZVwiKTtcbiAgICAgICAgJChcIi5jb21tZW50LXRhYlwiKS5oaWRlKCk7XG4gICAgICAgIHZhciBzZWxlY3RlZF90YWIgPSAkKHRoaXMpLmZpbmQoXCJhXCIpLmF0dHIoXCJocmVmXCIpO1xuICAgICAgICAkKHNlbGVjdGVkX3RhYikuZmFkZUluKCk7XG4gICAgICAgIHJldHVybiBmYWxzZTtcbiAgICB9KTtcblxuLyogIFRhYmxlIG9kZCByb3cgY2xhc3Ncbi8qIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSAqL1xuXHQkKCd0YWJsZSB0cjpvZGQnKS5hZGRDbGFzcygnYWx0Jyk7XG5cbi8qICBTaWRlYmFyIGNvbGxhcHNlXG4vKiAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gKi9cblx0JCgnYm9keScpLmFkZENsYXNzKCdzMS1jb2xsYXBzZScpO1xuXHQkKCdib2R5JykuYWRkQ2xhc3MoJ3MyLWNvbGxhcHNlJyk7XG5cblx0JCgnLnMxIC5zaWRlYmFyLXRvZ2dsZScpLmNsaWNrKGZ1bmN0aW9uKCl7XG5cdFx0JCgnYm9keScpLnRvZ2dsZUNsYXNzKCdzMS1jb2xsYXBzZScpLnRvZ2dsZUNsYXNzKCdzMS1leHBhbmQnKTtcblx0XHRpZiAoJCgnYm9keScpLmlzKCcuczItZXhwYW5kJykpIHtcblx0XHRcdCQoJ2JvZHknKS50b2dnbGVDbGFzcygnczItZXhwYW5kJykudG9nZ2xlQ2xhc3MoJ3MyLWNvbGxhcHNlJyk7XG5cdFx0fVxuXHR9KTtcblx0JCgnLnMyIC5zaWRlYmFyLXRvZ2dsZScpLmNsaWNrKGZ1bmN0aW9uKCl7XG5cdFx0JCgnYm9keScpLnRvZ2dsZUNsYXNzKCdzMi1jb2xsYXBzZScpLnRvZ2dsZUNsYXNzKCdzMi1leHBhbmQnKTtcblx0XHRpZiAoJCgnYm9keScpLmlzKCcuczEtZXhwYW5kJykpIHtcblx0XHRcdCQoJ2JvZHknKS50b2dnbGVDbGFzcygnczEtZXhwYW5kJykudG9nZ2xlQ2xhc3MoJ3MxLWNvbGxhcHNlJyk7XG5cdFx0fVxuXHR9KTtcblxuLyogIERyb3Bkb3duIG1lbnUgYW5pbWF0aW9uXG4vKiAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gKi9cblx0JCgnLm5hdiB1bC5zdWItbWVudScpLmhpZGUoKTtcblx0JCgnLm5hdiBsaScpLmhvdmVyKFxuXHRcdGZ1bmN0aW9uKCkge1xuXHRcdFx0JCh0aGlzKS5jaGlsZHJlbigndWwuc3ViLW1lbnUnKS5zbGlkZURvd24oJ2Zhc3QnKTtcblx0XHR9LFxuXHRcdGZ1bmN0aW9uKCkge1xuXHRcdFx0JCh0aGlzKS5jaGlsZHJlbigndWwuc3ViLW1lbnUnKS5oaWRlKCk7XG5cdFx0fVxuXHQpO1xuXG4vKiAgRml0dmlkc1xuLyogLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tICovXG5cdGZ1bmN0aW9uIHJlc3BvbnNpdmVWaWRlbygpIHtcblx0XHRcdGlmICggJCgpLmZpdFZpZHMgKSB7XG5cdFx0XHRcdCQoJyN3cmFwcGVyJykuZml0VmlkcygpO1xuXHRcdFx0fVxuXHRcdH1cblxuXHRyZXNwb25zaXZlVmlkZW8oKTtcblxuLyogIE1vYmlsZSBtZW51IHNtb290aCB0b2dnbGUgaGVpZ2h0XG4vKiAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0gKi9cblx0JCgnLm5hdi10b2dnbGUnKS5vbignY2xpY2snLCBmdW5jdGlvbigpIHtcblx0XHRzbGlkZSgkKCcubmF2LXdyYXAgLm5hdicsICQodGhpcykucGFyZW50KCkpKTtcblx0fSk7XG5cblx0ZnVuY3Rpb24gc2xpZGUoY29udGVudCkge1xuXHRcdHZhciB3cmFwcGVyID0gY29udGVudC5wYXJlbnQoKTtcblx0XHR2YXIgY29udGVudEhlaWdodCA9IGNvbnRlbnQub3V0ZXJIZWlnaHQodHJ1ZSk7XG5cdFx0dmFyIHdyYXBwZXJIZWlnaHQgPSB3cmFwcGVyLmhlaWdodCgpO1xuXG5cdFx0d3JhcHBlci50b2dnbGVDbGFzcygnZXhwYW5kJyk7XG5cdFx0aWYgKHdyYXBwZXIuaGFzQ2xhc3MoJ2V4cGFuZCcpKSB7XG5cdFx0c2V0VGltZW91dChmdW5jdGlvbigpIHtcblx0XHRcdHdyYXBwZXIuYWRkQ2xhc3MoJ3RyYW5zaXRpb24nKS5jc3MoJ2hlaWdodCcsIGNvbnRlbnRIZWlnaHQpO1xuXHRcdH0sIDEwKTtcblx0fVxuXHRlbHNlIHtcblx0XHRzZXRUaW1lb3V0KGZ1bmN0aW9uKCkge1xuXHRcdFx0d3JhcHBlci5jc3MoJ2hlaWdodCcsIHdyYXBwZXJIZWlnaHQpO1xuXHRcdFx0c2V0VGltZW91dChmdW5jdGlvbigpIHtcblx0XHRcdHdyYXBwZXIuYWRkQ2xhc3MoJ3RyYW5zaXRpb24nKS5jc3MoJ2hlaWdodCcsIDApO1xuXHRcdFx0fSwgMTApO1xuXHRcdH0sIDEwKTtcblx0fVxuXG5cdHdyYXBwZXIub25lKCd0cmFuc2l0aW9uRW5kIHdlYmtpdFRyYW5zaXRpb25FbmQgdHJhbnNpdGlvbmVuZCBvVHJhbnNpdGlvbkVuZCBtc1RyYW5zaXRpb25FbmQnLCBmdW5jdGlvbigpIHtcblx0XHRpZih3cmFwcGVyLmhhc0NsYXNzKCdvcGVuJykpIHtcblx0XHRcdHdyYXBwZXIucmVtb3ZlQ2xhc3MoJ3RyYW5zaXRpb24nKS5jc3MoJ2hlaWdodCcsICdhdXRvJyk7XG5cdFx0fVxuXHR9KTtcblx0fVxuXG59KTsiLCIvKipcbiAqIEZpbGUgd2luZG93LXJlYWR5LmpzXG4gKlxuICogQWRkIGEgXCJyZWFkeVwiIGNsYXNzIHRvIDxib2R5PiB3aGVuIHdpbmRvdyBpcyByZWFkeS5cbiAqL1xud2luZG93LldpbmRvd19SZWFkeSA9IHt9O1xuKCBmdW5jdGlvbiggd2luZG93LCAkLCB0aGF0ICkge1xuXG5cdC8vIENvbnN0cnVjdG9yLlxuXHR0aGF0LmluaXQgPSBmdW5jdGlvbigpIHtcblx0XHR0aGF0LmNhY2hlKCk7XG5cdFx0dGhhdC5iaW5kRXZlbnRzKCk7XG5cdH07XG5cblx0Ly8gQ2FjaGUgZG9jdW1lbnQgZWxlbWVudHMuXG5cdHRoYXQuY2FjaGUgPSBmdW5jdGlvbigpIHtcblx0XHR0aGF0LiRjID0ge1xuXHRcdFx0d2luZG93OiAkKHdpbmRvdyksXG5cdFx0XHRib2R5OiAkKGRvY3VtZW50LmJvZHkpLFxuXHRcdH07XG5cdH07XG5cblx0Ly8gQ29tYmluZSBhbGwgZXZlbnRzLlxuXHR0aGF0LmJpbmRFdmVudHMgPSBmdW5jdGlvbigpIHtcblx0XHR0aGF0LiRjLndpbmRvdy5sb2FkKCB0aGF0LmFkZEJvZHlDbGFzcyApO1xuXHR9O1xuXG5cdC8vIEFkZCBhIGNsYXNzIHRvIDxib2R5Pi5cblx0dGhhdC5hZGRCb2R5Q2xhc3MgPSBmdW5jdGlvbigpIHtcblx0XHR0aGF0LiRjLmJvZHkuYWRkQ2xhc3MoICdyZWFkeScgKTtcblx0fTtcblxuXHQvLyBFbmdhZ2UhXG5cdCQoIHRoYXQuaW5pdCApO1xuXG59KSggd2luZG93LCBqUXVlcnksIHdpbmRvdy5XaW5kb3dfUmVhZHkgKTsiXSwic291cmNlUm9vdCI6Ii9zb3VyY2UvIn0=
