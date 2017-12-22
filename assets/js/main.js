var b = {
  init: function() {

    // Load fullpage scroll.
    $('#fullpage').fullpage({
      verticalCentered: false,
      fitToSection: false,
      onLeave: function(i, nexti, dir) {
        $('body').addClass('sliding');
      },
      afterLoad: function(i, nexti, dir) {
        $('body').removeClass('sliding');
      } 
    });

    // Loaded
    $('body').addClass('loaded');

    // Fast click.
    //window.FastClick.attach(document.body);

    // Navigation toggle.
    $('.ham1')[0].onclick = b.navToggle;

    // Featured links.
    rotator.init();
  },

  navToggle: function(e) {
    /**
     * Toggle navigation when ham is clicked.
     */
    e.preventDefault();
    $('body').toggleClass('mm');
    $('.ham1').toggleClass('x1');
  }
};

var rotator = {
  init: function() {
    var that = this;
    this.links = $('#featured li');
    this.images = $('#featured .images > div');
    this.imageContainer = $('#featured .images');
    this.imagelist = [];
    this.currentIndex = 0;
    this.autoplay = true;
    this.delay = 6000;

    // Listners.
    this.autoplay && this.start();
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
        image: $(image).data("index", i) // update index and return image.
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

    // Update active link.
    this.links.removeClass('active');
    image.link.addClass('active');

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