// Modified http://paulirish.com/2009/markup-based-unobtrusive-comprehensive-dom-ready-execution/
// Only fires on body class (working off strictly WordPress body_class)

var GenexusSite = {
  // All pages
  common: {
    init: function() {
        
        jQuery(function($) {

            $(document).ready(function() {

                // USER HDR NAV ICON
                var $userNav = $(document).find('.user-nav');

                $userNav.hover(function() {
                    var $button, $menu;
                    $button = $(this);
                    $menu = $button.children('.dropdown');
                    $menu.toggleClass('show-me hide-me');
                    $menu.children('li').click(function() {
                        $menu.removeClass('show-me hide-me');
                        $button.html($(this).html());
                    });
                });

                // SEARCH HDR NAV ICON
                var $searchNav = $(document).find('.search-nav');
                
                $searchNav.click(function() {
                    var $button;
                    $button = $(this);
                    var $sBar = $(document).find('.searchbar');
                    var $sForm = $sBar.children('.searchbar-form');
                    $sBar.removeClass('hide-me');
                    $sForm.removeClass('hide-me');
                    $sBar.toggleClass('search-hide search-show');

                });
            });
        });
        
    },
    finalize: function() { }
  },
  // Home page
  home: {
    init: function() {
        // JS here
    }
  },
  // About page
  about: {
    init: function() {
      // JS here
    }
  }

};

var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = GenexusSite;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {

    UTIL.fire('common');

    jQuery.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });

    UTIL.fire('common', 'finalize');
  }
};

jQuery(document).ready(UTIL.loadEvents);

//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm1haW4uanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJmaWxlIjoic2NyaXB0LmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gTW9kaWZpZWQgaHR0cDovL3BhdWxpcmlzaC5jb20vMjAwOS9tYXJrdXAtYmFzZWQtdW5vYnRydXNpdmUtY29tcHJlaGVuc2l2ZS1kb20tcmVhZHktZXhlY3V0aW9uL1xyXG4vLyBPbmx5IGZpcmVzIG9uIGJvZHkgY2xhc3MgKHdvcmtpbmcgb2ZmIHN0cmljdGx5IFdvcmRQcmVzcyBib2R5X2NsYXNzKVxyXG5cclxudmFyIEdlbmV4dXNTaXRlID0ge1xyXG4gIC8vIEFsbCBwYWdlc1xyXG4gIGNvbW1vbjoge1xyXG4gICAgaW5pdDogZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgXHJcbiAgICAgICAgalF1ZXJ5KGZ1bmN0aW9uKCQpIHtcclxuXHJcbiAgICAgICAgICAgICQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKCkge1xyXG5cclxuICAgICAgICAgICAgICAgIC8vIFVTRVIgSERSIE5BViBJQ09OXHJcbiAgICAgICAgICAgICAgICB2YXIgJHVzZXJOYXYgPSAkKGRvY3VtZW50KS5maW5kKCcudXNlci1uYXYnKTtcclxuXHJcbiAgICAgICAgICAgICAgICAkdXNlck5hdi5ob3ZlcihmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgJGJ1dHRvbiwgJG1lbnU7XHJcbiAgICAgICAgICAgICAgICAgICAgJGJ1dHRvbiA9ICQodGhpcyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJG1lbnUgPSAkYnV0dG9uLmNoaWxkcmVuKCcuZHJvcGRvd24nKTtcclxuICAgICAgICAgICAgICAgICAgICAkbWVudS50b2dnbGVDbGFzcygnc2hvdy1tZSBoaWRlLW1lJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJG1lbnUuY2hpbGRyZW4oJ2xpJykuY2xpY2soZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICRtZW51LnJlbW92ZUNsYXNzKCdzaG93LW1lIGhpZGUtbWUnKTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgJGJ1dHRvbi5odG1sKCQodGhpcykuaHRtbCgpKTtcclxuICAgICAgICAgICAgICAgICAgICB9KTtcclxuICAgICAgICAgICAgICAgIH0pO1xyXG5cclxuICAgICAgICAgICAgICAgIC8vIFNFQVJDSCBIRFIgTkFWIElDT05cclxuICAgICAgICAgICAgICAgIHZhciAkc2VhcmNoTmF2ID0gJChkb2N1bWVudCkuZmluZCgnLnNlYXJjaC1uYXYnKTtcclxuICAgICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgICAgJHNlYXJjaE5hdi5jbGljayhmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgJGJ1dHRvbjtcclxuICAgICAgICAgICAgICAgICAgICAkYnV0dG9uID0gJCh0aGlzKTtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgJHNCYXIgPSAkKGRvY3VtZW50KS5maW5kKCcuc2VhcmNoYmFyJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgdmFyICRzRm9ybSA9ICRzQmFyLmNoaWxkcmVuKCcuc2VhcmNoYmFyLWZvcm0nKTtcclxuICAgICAgICAgICAgICAgICAgICAkc0Jhci5yZW1vdmVDbGFzcygnaGlkZS1tZScpO1xyXG4gICAgICAgICAgICAgICAgICAgICRzRm9ybS5yZW1vdmVDbGFzcygnaGlkZS1tZScpO1xyXG4gICAgICAgICAgICAgICAgICAgICRzQmFyLnRvZ2dsZUNsYXNzKCdzZWFyY2gtaGlkZSBzZWFyY2gtc2hvdycpO1xyXG5cclxuICAgICAgICAgICAgICAgIH0pO1xyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICB9KTtcclxuICAgICAgICBcclxuICAgIH0sXHJcbiAgICBmaW5hbGl6ZTogZnVuY3Rpb24oKSB7IH1cclxuICB9LFxyXG4gIC8vIEhvbWUgcGFnZVxyXG4gIGhvbWU6IHtcclxuICAgIGluaXQ6IGZ1bmN0aW9uKCkge1xyXG4gICAgICAgIC8vIEpTIGhlcmVcclxuICAgIH1cclxuICB9LFxyXG4gIC8vIEFib3V0IHBhZ2VcclxuICBhYm91dDoge1xyXG4gICAgaW5pdDogZnVuY3Rpb24oKSB7XHJcbiAgICAgIC8vIEpTIGhlcmVcclxuICAgIH1cclxuICB9XHJcblxyXG59O1xyXG5cclxudmFyIFVUSUwgPSB7XHJcbiAgZmlyZTogZnVuY3Rpb24oZnVuYywgZnVuY25hbWUsIGFyZ3MpIHtcclxuICAgIHZhciBuYW1lc3BhY2UgPSBHZW5leHVzU2l0ZTtcclxuICAgIGZ1bmNuYW1lID0gKGZ1bmNuYW1lID09PSB1bmRlZmluZWQpID8gJ2luaXQnIDogZnVuY25hbWU7XHJcbiAgICBpZiAoZnVuYyAhPT0gJycgJiYgbmFtZXNwYWNlW2Z1bmNdICYmIHR5cGVvZiBuYW1lc3BhY2VbZnVuY11bZnVuY25hbWVdID09PSAnZnVuY3Rpb24nKSB7XHJcbiAgICAgIG5hbWVzcGFjZVtmdW5jXVtmdW5jbmFtZV0oYXJncyk7XHJcbiAgICB9XHJcbiAgfSxcclxuICBsb2FkRXZlbnRzOiBmdW5jdGlvbigpIHtcclxuXHJcbiAgICBVVElMLmZpcmUoJ2NvbW1vbicpO1xyXG5cclxuICAgIGpRdWVyeS5lYWNoKGRvY3VtZW50LmJvZHkuY2xhc3NOYW1lLnJlcGxhY2UoLy0vZywgJ18nKS5zcGxpdCgvXFxzKy8pLGZ1bmN0aW9uKGksY2xhc3NubSkge1xyXG4gICAgICBVVElMLmZpcmUoY2xhc3NubSk7XHJcbiAgICB9KTtcclxuXHJcbiAgICBVVElMLmZpcmUoJ2NvbW1vbicsICdmaW5hbGl6ZScpO1xyXG4gIH1cclxufTtcclxuXHJcbmpRdWVyeShkb2N1bWVudCkucmVhZHkoVVRJTC5sb2FkRXZlbnRzKTtcclxuIl0sInNvdXJjZVJvb3QiOiIvc291cmNlLyJ9
