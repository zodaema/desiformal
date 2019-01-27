/*! ========================================================================
 * Non standard functionality
 *
 * options.attack (bool)
 * If options.attack is set to true the scrollspy will differintiate the attack direction
 * ie. if the user is scrolling down or up
 * ======================================================================== */

/*! ========================================================================
 * Bootstrap: scrollspy.js v3.1.0
 * http://getbootstrap.com/javascript/#scrollspy
 * ========================================================================
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */

(function ($) {
  'use strict';

  // SCROLLSPY CLASS DEFINITION
  // ==========================

  function ScrollSpy(element, options) {
    var 
      href,
      process  = $.proxy(this.process, this);

    this.$element       = $(element).is('body') ? $(window) : $(element);
    this.$body          = $('body');
    this.$scrollElement = this.$element.on('scroll.bs.scroll-spy.data-api', process);
    this.options        = $.extend({}, ScrollSpy.DEFAULTS, options);
    this.selector       = (this.options.target || 
      ((href = $(element).attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '')) /* strip for ie7 */ ||
       '') + ' a[href*="#"]';
    this.offsets        = $([]);
    this.targets        = $([]);
    this.activeTarget   = null;
    this.cacheScrollTop = 0;

    this.refresh();
    this.process();
  }

  ScrollSpy.DEFAULTS = {
    offset: 10,
    // Differentiate between scrolling down and up
    attack: false
  };

  ScrollSpy.prototype.refresh = function () {
    var
      self = this,
      offsetMethod = this.$element[0] == window ? 'offset' : 'position',
      $targets;

    this.offsets = $([]);
    this.targets = $([]);

    $targets = this.$body
      .find(this.selector)
      .map(function () {
        var 
          $el   = $(this),
          href  = $el.data('target') || $el.attr('href'),
          $href = /^#./.test(href) && $(href);

        return ($href && 
          $href.length && 
          $href.is(':visible') && 
          [[ $href[offsetMethod]().top + (!$.isWindow(self.$scrollElement.get(0)) && self.$scrollElement.scrollTop()), href ]]) || null;
      })
      .sort(function (a, b) { 
        return a[0] - b[0]; 
      })
      .each(function () {
        self.offsets.push(this[0]);
        self.targets.push(this[1]);
      });
  };

  ScrollSpy.prototype.process = function () {
    var 
      scrollTop    = this.$scrollElement.scrollTop(),
      scrollHeight = this.$scrollElement[0].scrollHeight || this.$body[0].scrollHeight,
      height       = this.$scrollElement.height(),
      maxScroll    = scrollHeight - height,
      offsets      = this.offsets,
      targets      = this.targets,
      activeTarget = this.activeTarget,
      len          = offsets.length,
      attack       = -1, // 1 = scroll down, 0 = scroll up
      offsetScrollTop,
      i;

    if(this.options.attack && this.cacheScrollTop > scrollTop) {
      // Scroll up
      offsetScrollTop = scrollTop + height - this.options.offset;
      attack = 0;
    } else {
      // Scroll down
      offsetScrollTop = scrollTop + this.options.offset;
      attack = 1;
    }

    this.cacheScrollTop = scrollTop;


    if (offsetScrollTop >= maxScroll) {
      return activeTarget != (i = targets.last()[0]) && this.activate(i);
    }

    if (activeTarget && offsetScrollTop <= offsets[0]) {
      return activeTarget != (i = targets[0]) && this.activate(i);
    }

    for (i = len; i--;) {
      activeTarget != targets[i] && 
        offsetScrollTop >= offsets[i] && 
        (!offsets[i+1] || offsetScrollTop <= offsets[i+1]) && 
        this.activate( targets[i] , attack );
    }
  };

  ScrollSpy.prototype.activate = function (target, attack) {
    var
      selector = this.selector +
        '[data-target="' + target + '"],' +
        this.selector + '[href="' + target + '"]',
      active;

    this.activeTarget = target;

    $(this.selector)
      .parentsUntil(this.options.target, '.active')
      .removeClass('active');

    active = $(selector)
      .parents('li')
      .addClass('active');

    if (active.parent('.dropdown-menu').length) {
      active = active
        .closest('li.dropdown')
        .addClass('active');
    }

    active.trigger('activate.bs.scrollspy');

    if(typeof attack !== 'undefined') {
      switch (attack) {
        case 0:
          active.trigger('scrollup.ep.scrollspy');
        break;
        case 1:
          active.trigger('scrolldown.ep.scrollspy');
        break;
      }
    }
  };


  // SCROLLSPY PLUGIN DEFINITION
  // ===========================

  var old = $.fn.scrollspy;

  $.fn.scrollspy = function (option) {
    return this.each(function () {
      var 
        $this   = $(this),
        data    = $this.data('bs.scrollspy'),
        options = typeof option == 'object' && option;

      if (!data) $this.data('bs.scrollspy', (data = new ScrollSpy(this, options)));
      if (typeof option == 'string') data[option]();
    });
  };

  $.fn.scrollspy.Constructor = ScrollSpy;


  // SCROLLSPY NO CONFLICT
  // =====================

  $.fn.scrollspy.noConflict = function () {
    $.fn.scrollspy = old;
    return this;
  };


  // SCROLLSPY DATA-API
  // ==================

  $(window).on('load', function () {
    $('[data-spy="scroll"]').each(function () {
      var $spy = $(this);
      $spy.scrollspy($spy.data());
    });
  });

})(jQuery);