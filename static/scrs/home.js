var setBackgroundImage = function() {
  var bgimgs = [
    '../imgs/bg/california1_bw_sm.jpg',
    '../imgs/bg/california2_bw_sm.jpg',
    '../imgs/bg/california3_bw_sm.jpg',
    '../imgs/bg/california4_bw_sm.jpg',
    '../imgs/bg/california5_bw_sm.jpg',
    '../imgs/bg/california6_bw_sm.jpg',
    '../imgs/bg/monterrey1_bw_sm.jpg',
    '../imgs/bg/monterrey1_bw_sm.jpg',
    '../imgs/bg/newmexico3_bw_sm.jpg',
    '../imgs/bg/oaxaca1_bw_sm.jpg',
    '../imgs/bg/oaxaca2_bw_sm.jpg',
    '../imgs/bg/oaxaca3_bw_sm.jpg',
    '../imgs/bg/oaxaca4_bw_sm.jpg',
    '../imgs/bg/oaxaca5_bw_sm.jpg',
    '../imgs/bg/oaxaca6_bw_sm.jpg',
    '../imgs/bg/oaxaca7_bw_sm.jpg',
    '../imgs/bg/oaxaca8_bw_sm.jpg',
    '../imgs/bg/oaxaca9_bw_sm.jpg',
    '../imgs/bg/oaxaca10_bw_sm.jpg',
    '../imgs/bg/oaxaca11_bw_sm.jpg',
    '../imgs/bg/oaxaca12_bw_sm.jpg',
    '../imgs/bg/oaxaca13_bw_sm.jpg',
    '../imgs/bg/oaxaca14_bw_sm.jpg',
    '../imgs/bg/texas_bw_sm.jpg',
    '../imgs/bg/utah_bw_sm.jpg'
  ];

  var getBgimg = function() {
    var index = Math.round(Math.random() * (bgimgs.length - 1));
    var img = bgimgs[index];
    return 'url("' + img + '")';
  };

  var img = getBgimg();

  $('body').attr('style', 'background-image:' + img);
};

var setNavMenu = function() {
  var movePage = function(e) {
    var link;
    var href;
    var pos;

    e.preventDefault();

    link = $(this);
    href = link.attr('href');
    pos = $(href).offset().top - $('nav').outerHeight();
    console.log(href, $(href).offset().top, $('nav').outerHeight(), pos);

    $('html').animate({
      scrollTop: pos
    }, 1000, 'swing', function() {
      $(link).blur();
      $(href).focus();
    });
  };

  $('nav a[href^="#"]:not(.sa-skip)')
    .on('click', movePage(e))
    .on('keyup', function(e) {
      if (e.which === 13 || e.which === 32) {
        movePage(e);
      }
    });
};

var setFooter = function() {
  $('#footer-year').html(new Date().getYear() + 1900);
  var footerLoaded = false;

  var getName = function(name) {
    var newname = '';

    for (var i=0; i < name.length; i++) {
      if (Math.round(Math.random()) > 0) {
        newname += name[i].toUpperCase();
      } else {
        newname += name[i].toLowerCase();
      }
    }

    return newname;
  };

  $('#footer-name').html(getName('samuel.acuna'));
  var i = setInterval(function() {
    $('#footer-name').html(getName('samuel.acuna'));

    if (!footerLoaded) {
      footerLoaded = true;
      $(window).on('beforeunload', function() {
        alert('are you sure?');
        clearInterval(i);
      });
    }
  }, 100);
};

$(document).ready(function() {
  setBackgroundImage();
  setNavMenu();
  setFooter();
});
