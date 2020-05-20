var b = {};

b.init = function() {

  // Load fullpage scroll.
  var timeout;
  var body = b.body = $('body');
  setTimeout(function(){ body.addClass('loaded'); }, 100);
  //window.FastClick.attach(document.body);

  // Navigation toggle.
  $('.ham1')[0].onclick = b.navToggle;

  // Contact toggle
  $('.cbtn').on('click', function() {
    body.toggleClass('con');
  });

  // scrolling logo on normal pages.
  $(window).scroll(function() {
    var y = $(document).scrollTop();
    if (y > 5) body.addClass('scrolled');
    else body.removeClass('scrolled')
  });

  // Home page.
  if (body.hasClass('home')) {

    // Fullpage scrolling.
    $('#fullpage').fullpage({
      verticalCentered: false,
      fitToSection: false,
      responsiveHeight: 700,
      onLeave: function(i, nexti, dir) {
        if (timeout) clearTimeout(timeout);
        body.addClass('sliding slow' + (nexti > 1? ' scrolled' : ''));
        if (nexti == 1) body.removeClass('scrolled');
        rotator.stop();
      },
      afterLoad: function(i, nexti, dir) {
        body.removeClass('sliding' );
        rotator.start();
        timeout = setTimeout(function() {body.removeClass('slow');}, 500);
      } 
    });

    $('.mouse').on('click', function() {
      $('#fullpage').fullpage.moveSectionDown();
    });

    // Smoke paralax.
    // var smoke = $('#smoke')[0];
    // var paralax = new Parallax(smoke, {
    //   relativeInput: false,
    //   scalarX: 4,
    //   scalarY: 4
    // });

    // Rotating featured images.
    rotator.init();

  } else {

    b.faq();

    // Caption toggle.
    b.captions($('.caption'));

    // Sidebar.
    $(window).scroll(function() {
      var y = $(document).scrollTop();
      if (y > 235) $('.sidebar').addClass('fixed');
      else $('.sidebar').removeClass('fixed');
    });

    // Scrolling hides bottom nav.
    var to = false;
    $(window).on('scroll', function() {
      if (to) clearTimeout(to);
      else body.addClass('scrolling');
      to = setTimeout(function() {
        body.removeClass('scrolling');
        to = false;
      }, 300);
    });
  }
};

b.captions = function(elems) {

  // Find natual width/height.
  $(window).on('resize', getsizes);
  getsizes();
  
  function getsizes() {
    var html = '';
    elems.each(function(i) {
      $(this).addClass('init');
      var text = $(this).children('span');
      var id = $(this).attr('id');
      var w = text.width();
      var h = text.height();

      // No id.
      if (!id) {
        id = 'c'+i;
        $(this).attr('id', id);
      }

      html += '#'+id+'.on > span{max-width:'+w+'px; max-height:'+h+'px;}';
      $(this).removeClass('init');
      //console.log(w,h);
    });

    // Update css.
    $('#captioncss').remove();
    $('<style id="captioncss" type="text/css">'+html+'</style>').appendTo('head');
  }
  
  // Listen to clicks.
  elems.on('click', function(e) {
    $(this).toggleClass('on');
  });
};

b.navToggle = function(e) {
  /**
   * Toggle navigation when ham is clicked.
   */
  e.preventDefault();
  $('body').toggleClass('mm');
  $('.ham1').toggleClass('x1');
};

b.faq = function() {
  var style = false;
  var blocks = $('.qa .text');

  if (blocks.length) {
    // Need a lag for div > ul height to set in.
    setTimeout(calc, 20);
    setTimeout(function() { blocks.addClass('initiated'); }, 300);
    $(window).on('resize', calc);
    $('.qa').on('click', expand);
  }

  function calc() {
    var css = '';
    var heights = [];
    blocks.each(function(i) {
      var text = $(this);
      var span = text.children('span');
      var qa = text.parent();
      var id = qa.attr('id');

      // Add ID if not already made.
      if (!id) {
        id = "qa"+i;
        qa.attr('id', id);
      }

      // Add css.
      css += '#qa'+ i +'.on .text{max-height:'+ span.height() +'px}';
    });

    if (!style) {
      style = $('<style>' + css + '</style>');
      $('body').append(style);
      
    } else {
      style.html(css);
    }
  }

  function expand(e) {
    e.preventDefault();
    var qa = $(this);
    var on = qa.hasClass('on');

    // Close opened qa in column.
    qa.parent().find('.qa.on').removeClass('on');
    if (!on) qa.addClass('on');
  }
};

var rotator = {
  init: function() {
    var that = this;
    this.links = $('#featured li');
    this.images = $('#featured .images .image');
    this.imageContainer = $('#featured .images > div');
    this.imagelist = [];
    this.currentIndex = 0;
    this.autoplay = true;
    this.delay = 5000;
    this.imageready = true;
    this.imagemouseover = false;

    // Listners.
    if (this.autoplay) this.start();
    this.links.on('mouseenter', 'a', this.mouseEnter.bind(this));
    this.links.on('mouseout', 'a', this.mouseLeave.bind(this));
    //this.images.on('mouseenter', this.imageover.bind(this));
    //this.images.on('mouseout', this.imageLeave.bind(this));
    $(document).keydown(function(e) {
      if (e.keyCode == 37 || e.keyCode == 39) that.start();
      if (e.keyCode == 37) that.prev();
      if (e.keyCode == 39) that.next();
    });

    // Setup topics.
    this.links.each(function(i, elem) {
      var image = that.images.get(i);
      if (image) that.imagelist.push({
        link: $(elem),
        image: $(image).data("index", i), // update index and return image.
        title: $(image).find('img').data("title"),
        for: $(image).find('img').data("for"),
        href: $(image).attr("href")
      });
    });
  },

  imageover: function(e) {
    var i = 1;
    var that = this;
    if (e) {
      e.stopPropagation();
      i = $(e.currentTarget).index();
    }

    // Next slide, and turn refresh autoplay.
    this.imagemouseover = true;
    if (!this.imageready) return;
    this.imageready = false;
    this.next();
    if (this.autoplay) {
      this.stop();
      this.start();
    }

    // Limit how many times per second we can trigger next.
    // And start again if we are still hovered. (fixes element switching)
    setTimeout(function() { 
      that.imageready = true;
      if (that.imagemouseover == true) that.imageover();
    }, 500);
  },

  imageLeave: function(e) {
    this.imagemouseover = false;
  },

  mouseEnter: function(e) {
    e.stopPropagation();
    var i = $(e.currentTarget).parent().index();
    if (this.autoplay) this.stop();
    this.goto(i);
  },

  mouseLeave: function(e) {
    var i = $(e.currentTarget).parent().index();
    if (this.autoplay) this.start(i);
  },

  rotate: function(i, e) {
    i = i >= 0 && i <= this.imagelist.length? i : 0;
    e = e || 1;
    var image = this.imagelist[i];
    var images = $('#featured .images .image'); // needs to be fresh everytime.
    var h3 = $('#featured .right h3');
    var h4 = $('#featured .right h4');

    // Update active link.
    this.links.removeClass('active');
    image.link.addClass('active');

    // Update hittext with link.
    $('.images .hittest').attr('href', image.href)

    // Update h3 h4.
    h3.html(image.title);
    h4.html(image.for);

    // Rotate images.
    1 === e?
      images.first().nextUntil(image.image).addBack().detach().appendTo(this.imageContainer) : 
      image.image.nextAll().addBack().detach().prependTo(this.imageContainer);

    // For mobile.
    images.removeClass("active");
    image.image.addClass("active");

    // Save.
    this.currentIndex = i;
  },

  next: function() {
    var i = this.mod(this.currentIndex + 1, this.imagelist.length);
    this.rotate(i);
  },

  prev: function() {
    var i = this.mod(this.currentIndex - 1, this.imagelist.length);
    this.rotate(i, -1);
  },

  goto: function(i) {
    var e = (i < this.currentIndex)? -1 : 1;
    this.rotate(i, e);
  },

  start: function(i) {
    if (!this.autoplay) return;
    if (this.interval) clearInterval(this.interval);
    this.interval = setInterval(this.next.bind(this), this.delay);
  },

  stop: function() {
    if (this.interval) clearInterval(this.interval);
    this.interval = false;
  },

  mod: function(i, len) {
    return (i % len + len) % len;
  }
};

document.addEventListener("DOMContentLoaded", b.init);
