var b = {};

b.init = function() {

  // Load fullpage scroll.
  var timeout;
  var body = b.body = $('body');
  setTimeout(function(){ body.addClass('loaded'); }, 100);
  //window.FastClick.attach(document.body);

  // Navigation toggle.
  $('.ham1')[0].onclick = b.navToggle;

  // Home page.
  if (body.hasClass('home')) {

    // Fullpage scrolling.
    $('#fullpage').fullpage({
      verticalCentered: false,
      fitToSection: false,
      responsiveHeight: 665,
      onLeave: function(i, nexti, dir) {
        if (timeout) clearTimeout(timeout);
        body.addClass('sliding slow');
        rotator.stop();
      },
      afterLoad: function(i, nexti, dir) {
        body.removeClass('sliding');
        rotator.start();
        timeout = setTimeout(function() {body.removeClass('slow');}, 500);
      } 
    });

    $('.mouse').on('click', function() {
      $('#fullpage').fullpage.moveSectionDown();
    });

    // Smoke paralax.
    var smoke = $('#smoke')[0];
    var paralax = new Parallax(smoke, {
      relativeInput: false,
      scalarX: 4,
      scalarY: 4
    });

    // Rotating featured images.
    rotator.init();

  } else {

    // Caption toggle.
    b.captions($('.caption'));

    // Sidebar.
    $(window).scroll(function() {
      var y = $(document).scrollTop();
      if (y > 235) $('.sidebar').addClass('fixed');
      else $('.sidebar').removeClass('fixed');
    });
    //$('.sidebar').stickySidebar({
      //topSpacing: 60,
      //bottomSpacing: 60
    //});

    // Scrolling hides bottom nav.
    var to = false;
    $(window).on('scroll', function() {
      if (to) clearTimeout(to);
      else body.addClass('scrolled');
      to = setTimeout(function() {
        body.removeClass('scrolled');
        to = false;
      }, 400);
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

var rotator = {
  init: function() {
    var that = this;
    this.links = $('#featured li');
    this.images = $('#featured .images > div');
    this.imageContainer = $('#featured .images');
    this.imagelist = [];
    this.currentIndex = 0;
    this.autoplay = false;
    this.delay = 6000;

    // Listners.
    if (this.autoplay) this.start();
    this.links.on('mouseenter', 'a', this.mouseEnter.bind(this));
    this.links.on('mouseout', 'a', this.mouseLeave.bind(this));
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
        for: $(image).find('img').data("for")
      });
    });
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
    var images = $('#featured .images > div'); // needs to be fresh everytime.
    var h3 = $('#featured .right h3');
    var h4 = $('#featured .right h4');

    // Update active link.
    this.links.removeClass('active');
    image.link.addClass('active');

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