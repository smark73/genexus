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


                // MOBILE SLIDING NAV
                // code from sliding panel component from bourbon refills
                $('.mobile-nav-btn,.sliding-panel-fade-screen,.sliding-panel-close').on('click touchstart',function (e) {
                    $('.sliding-panel-content,.sliding-panel-fade-screen').toggleClass('is-visible');
                    e.preventDefault();
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

//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm1haW4uanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSIsImZpbGUiOiJzY3JpcHQuanMiLCJzb3VyY2VzQ29udGVudCI6WyIvLyBNb2RpZmllZCBodHRwOi8vcGF1bGlyaXNoLmNvbS8yMDA5L21hcmt1cC1iYXNlZC11bm9idHJ1c2l2ZS1jb21wcmVoZW5zaXZlLWRvbS1yZWFkeS1leGVjdXRpb24vXHJcbi8vIE9ubHkgZmlyZXMgb24gYm9keSBjbGFzcyAod29ya2luZyBvZmYgc3RyaWN0bHkgV29yZFByZXNzIGJvZHlfY2xhc3MpXHJcblxyXG52YXIgR2VuZXh1c1NpdGUgPSB7XHJcbiAgLy8gQWxsIHBhZ2VzXHJcbiAgY29tbW9uOiB7XHJcbiAgICBpbml0OiBmdW5jdGlvbigpIHtcclxuICAgICAgICBcclxuICAgICAgICBqUXVlcnkoZnVuY3Rpb24oJCkge1xyXG5cclxuICAgICAgICAgICAgJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XHJcblxyXG4gICAgICAgICAgICAgICAgLy8gVVNFUiBIRFIgTkFWIElDT05cclxuICAgICAgICAgICAgICAgIHZhciAkdXNlck5hdiA9ICQoZG9jdW1lbnQpLmZpbmQoJy51c2VyLW5hdicpO1xyXG5cclxuICAgICAgICAgICAgICAgICR1c2VyTmF2LmhvdmVyKGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICAgICAgICAgICAgIHZhciAkYnV0dG9uLCAkbWVudTtcclxuICAgICAgICAgICAgICAgICAgICAkYnV0dG9uID0gJCh0aGlzKTtcclxuICAgICAgICAgICAgICAgICAgICAkbWVudSA9ICRidXR0b24uY2hpbGRyZW4oJy5kcm9wZG93bicpO1xyXG4gICAgICAgICAgICAgICAgICAgICRtZW51LnRvZ2dsZUNsYXNzKCdzaG93LW1lIGhpZGUtbWUnKTtcclxuICAgICAgICAgICAgICAgICAgICAkbWVudS5jaGlsZHJlbignbGknKS5jbGljayhmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgJG1lbnUucmVtb3ZlQ2xhc3MoJ3Nob3ctbWUgaGlkZS1tZScpO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAkYnV0dG9uLmh0bWwoJCh0aGlzKS5odG1sKCkpO1xyXG4gICAgICAgICAgICAgICAgICAgIH0pO1xyXG4gICAgICAgICAgICAgICAgfSk7XHJcblxyXG4gICAgICAgICAgICAgICAgLy8gU0VBUkNIIEhEUiBOQVYgSUNPTlxyXG4gICAgICAgICAgICAgICAgdmFyICRzZWFyY2hOYXYgPSAkKGRvY3VtZW50KS5maW5kKCcuc2VhcmNoLW5hdicpO1xyXG4gICAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgICAkc2VhcmNoTmF2LmNsaWNrKGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICAgICAgICAgICAgIHZhciAkYnV0dG9uO1xyXG4gICAgICAgICAgICAgICAgICAgICRidXR0b24gPSAkKHRoaXMpO1xyXG4gICAgICAgICAgICAgICAgICAgIHZhciAkc0JhciA9ICQoZG9jdW1lbnQpLmZpbmQoJy5zZWFyY2hiYXInKTtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgJHNGb3JtID0gJHNCYXIuY2hpbGRyZW4oJy5zZWFyY2hiYXItZm9ybScpO1xyXG4gICAgICAgICAgICAgICAgICAgICRzQmFyLnJlbW92ZUNsYXNzKCdoaWRlLW1lJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJHNGb3JtLnJlbW92ZUNsYXNzKCdoaWRlLW1lJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJHNCYXIudG9nZ2xlQ2xhc3MoJ3NlYXJjaC1oaWRlIHNlYXJjaC1zaG93Jyk7XHJcblxyXG4gICAgICAgICAgICAgICAgfSk7XHJcblxyXG5cclxuICAgICAgICAgICAgICAgIC8vIE1PQklMRSBTTElESU5HIE5BVlxyXG4gICAgICAgICAgICAgICAgLy8gY29kZSBmcm9tIHNsaWRpbmcgcGFuZWwgY29tcG9uZW50IGZyb20gYm91cmJvbiByZWZpbGxzXHJcbiAgICAgICAgICAgICAgICAkKCcubW9iaWxlLW5hdi1idG4sLnNsaWRpbmctcGFuZWwtZmFkZS1zY3JlZW4sLnNsaWRpbmctcGFuZWwtY2xvc2UnKS5vbignY2xpY2sgdG91Y2hzdGFydCcsZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICAgICAgICAgICAgICAkKCcuc2xpZGluZy1wYW5lbC1jb250ZW50LC5zbGlkaW5nLXBhbmVsLWZhZGUtc2NyZWVuJykudG9nZ2xlQ2xhc3MoJ2lzLXZpc2libGUnKTtcclxuICAgICAgICAgICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgICAgICAgICB9KTtcclxuXHJcblxyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICB9KTtcclxuICAgICAgICBcclxuICAgIH0sXHJcbiAgICBmaW5hbGl6ZTogZnVuY3Rpb24oKSB7IH1cclxuICB9LFxyXG4gIC8vIEhvbWUgcGFnZVxyXG4gIGhvbWU6IHtcclxuICAgIGluaXQ6IGZ1bmN0aW9uKCkge1xyXG4gICAgICAgIC8vIEpTIGhlcmVcclxuICAgIH1cclxuICB9LFxyXG4gIC8vIEFib3V0IHBhZ2VcclxuICBhYm91dDoge1xyXG4gICAgaW5pdDogZnVuY3Rpb24oKSB7XHJcbiAgICAgIC8vIEpTIGhlcmVcclxuICAgIH1cclxuICB9XHJcblxyXG59O1xyXG5cclxudmFyIFVUSUwgPSB7XHJcbiAgZmlyZTogZnVuY3Rpb24oZnVuYywgZnVuY25hbWUsIGFyZ3MpIHtcclxuICAgIHZhciBuYW1lc3BhY2UgPSBHZW5leHVzU2l0ZTtcclxuICAgIGZ1bmNuYW1lID0gKGZ1bmNuYW1lID09PSB1bmRlZmluZWQpID8gJ2luaXQnIDogZnVuY25hbWU7XHJcbiAgICBpZiAoZnVuYyAhPT0gJycgJiYgbmFtZXNwYWNlW2Z1bmNdICYmIHR5cGVvZiBuYW1lc3BhY2VbZnVuY11bZnVuY25hbWVdID09PSAnZnVuY3Rpb24nKSB7XHJcbiAgICAgIG5hbWVzcGFjZVtmdW5jXVtmdW5jbmFtZV0oYXJncyk7XHJcbiAgICB9XHJcbiAgfSxcclxuICBsb2FkRXZlbnRzOiBmdW5jdGlvbigpIHtcclxuXHJcbiAgICBVVElMLmZpcmUoJ2NvbW1vbicpO1xyXG5cclxuICAgIGpRdWVyeS5lYWNoKGRvY3VtZW50LmJvZHkuY2xhc3NOYW1lLnJlcGxhY2UoLy0vZywgJ18nKS5zcGxpdCgvXFxzKy8pLGZ1bmN0aW9uKGksY2xhc3NubSkge1xyXG4gICAgICBVVElMLmZpcmUoY2xhc3NubSk7XHJcbiAgICB9KTtcclxuXHJcbiAgICBVVElMLmZpcmUoJ2NvbW1vbicsICdmaW5hbGl6ZScpO1xyXG4gIH1cclxufTtcclxuXHJcbmpRdWVyeShkb2N1bWVudCkucmVhZHkoVVRJTC5sb2FkRXZlbnRzKTtcclxuIl19
