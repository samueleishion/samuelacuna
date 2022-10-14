(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
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
  var movePage = function(e, link) {
    var href;
    var pos;

    e.preventDefault();

    href = link.attr('href');
    pos = $(href).offset().top - $('nav').outerHeight();

    $('html').animate({
      scrollTop: pos
    }, 1000, 'swing', function() {
      $(link).blur();
      $(href).focus();
    });
  };

  $('nav a[href^="#"]:not(.sa-skip)')
    .on('click', function(e) {
      movePage(e, $(this));
    })
    .on('keyup', function(e) {
      if (e.which === 13 || e.which === 32) {
        movePage(e, $(this));
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

var setProjects = function() {
  var projectsContainer = $('#projects');
  // console.log("setProjects", projectsContainer);

  var projectTemplate = '\
<div class="container">\
  <div class="row">\
    <div class="col">\
      <img class="sa-project-logo" />\
      <h3 class="sa-project-title">Project Title</h3>\
      <span class="sa-project-role" />\
    </div>\
  </div>\
  <div class="row">\
    <div class="col-xl-6 offset-xl-3 col-md-8 offset-md-2 col-sm-10 offset-sm-1">\
      <div class="sa-project-description">\
      </div>\
      <div class="sa-project-links">\
      </div>\
      <div class="sa-code">\
      </div>\
      <ul class="sa-pills">\
      </ul>\
    </div>\
  </div>\
  <div class="row">\
    <div class="col-lg-8 offset-lg-2">\
      <div class="sa-project-pics">\
      </div>\
    </div>\
  </div>\
</div>\
';

  var projects = $.getJSON("./data/projects.json",
    function(data) {
      $.each(data.projects, function(index, project) {
        var projectElement = $(document.createElement('div'));
        projectElement.append($.parseHTML(projectTemplate));

        var projectLogo = projectElement.find('.sa-project-logo');
        var projectTitle = projectElement.find('.sa-project-title');
        var projectRole = projectElement.find('.sa-project-role');
        var projectDescription = projectElement.find('.sa-project-description');
        var projectLinks = projectElement.find('.sa-project-links');
        var projectCode = projectElement.find('.sa-code');
        var projectTags = projectElement.find('.sa-pills');
        var projectPics = projectElement.find('.sa-project-pics');

        projectElement.addClass('container-fluid sa-project');
        projectElement.attr('id', 'sa-project-' + project.id);
        projectElement.attr('style', 'background-color: ' + project.color.background);

        switch(project.color.foreground) {
          case 'light':
            projectElement.addClass('sa-project--light');
            projectTags.addClass('sa-pills--light');
            break;
          case 'dark':
            projectElement.addClass('sa-project--dark');
            projectTags.addClass('sa-pills--dark');
            break;
          default:
            break;
        };

        projectLogo.attr('src', project.image.src);
        projectLogo.attr('alt', project.image.alt);

        projectTitle.html(project.title);

        projectRole.attr('style', 'color: ' + project.color.role);
        projectRole.html(project.role);

        $.each(project.description, function(jndex, paragraph) {
          var p = $(document.createElement('p'));
          p.html($.parseHTML(paragraph));
          projectDescription.append(p);
        });

        $.each(project.links, function(jndex, link) {
          var a = $(document.createElement('a'));
          a.attr('href', link.href);
          a.attr('target', '_blank');
          a.html(link.label + ' &raquo;');
          projectLinks.append(a);

          if (jndex < project.links.length - 1) {
            projectLinks.append("|");
          }
        });

        if (project.code !== undefined && project.code.length > 0) {
          $.each(project.code, function(jndex, snippet) {
            var code = $(document.createElement('code'));
            code.html(snippet);
            projectCode.append(code);
          });
        }

        $.each(project.tags, function(jndex, tag) {
          var li = $(document.createElement('li'));
          li.addClass('sa-pill')
            .html($.parseHTML('#' + tag));
          projectTags.append(li);
        });

        $.each(project.screenshots, function(jndex, screenshot) {
          var pic = $(document.createElement('img'));
          pic.addClass('sa-project-pic')
            .attr('src', screenshot.src)
            .attr('alt', screenshot.alt);
          projectPics.append(pic);
        });

        $.each(project.videos, function(jndex, video) {
          var iframe = $(document.createElement('iframe'));
          var frame = $(document.createElement('div'));

          function resizeVideo(iframe) {
            var width = 560; 
            var ratio = 0.5625; 
            var windowWidth = $(window).width(); 
            // console.log("resizeVideo", $(window).width(), $(document).width(), $('main').width()); 

            if (windowWidth < 476) {
              console.log(windowWidth, "a"); 
              width = 250; 
            } else if (windowWidth < 568) {
              console.log(windowWidth, "b"); 
              width = 400; 
            } else if (windowWidth < 993) {
              console.log(windowWidth, "c"); 
              width = 480; 
            }

            iframe.attr('width', `${width}px`); 
            iframe.attr('height', `${width * ratio}px`); 
          }

          frame.addClass('sa-project-video');
          iframe.attr('frameborder', '0');
          iframe.attr('allow', 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture');
          iframe.attr('allowfullscreen', 'true');
          iframe.attr('src', "https://www.youtube.com/embed/" + video);
          resizeVideo(iframe); 

          frame.append(iframe);
          projectPics.append(frame);

          $(window).on('resize', (e) => {
            resizeVideo(iframe); 
          }); 
        });

        projectsContainer.append(projectElement);
      });
    })
    .fail(function(e) {
      console.error("fail", e);
    });
};

$(document).ready(function() {
  setBackgroundImage();
  setNavMenu();
  setFooter();
  setProjects();
});

},{}]},{},[1]);
