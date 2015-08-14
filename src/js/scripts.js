// DOM Ready
$(function() {

	// SVG fallback
	// toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script#update
	if (!Modernizr.svg) {
		var imgs = document.getElementsByTagName('img');
		var dotSVG = /.*\.svg$/;
		for (var i = 0; i != imgs.length; ++i) {
			if(imgs[i].src.match(dotSVG)) {
				imgs[i].src = imgs[i].src.slice(0, -3) + "png";
			}
		}
	}

	// Target your .container, .wrapper, .post, etc.
    $(".fitvid").fitVids();

});

// High Contrast Mode
var highContrast = false;
$("#highcontrast a").click(function () {
	if (!(highContrast)) {
		$('body').append('<link rel="stylesheet" href="/odwg/specialevents/wp-content/themes/se_felix/assets/css/highcontrast.min.css" type="text/css" id="hc_stylesheet"/>');
		$('#highcontrast a').text($("#highcontrast a").attr('offtext'));
		highContrast = true;
	}
	else {
		// remove the high-contrast style
		$("#hc_stylesheet").remove();
		$('#highcontrast a').text($("#highcontrast a").attr('ontext'));
		highContrast = false;
	}
});

// Masonry

// $('#eventsFilter').change(function() {
//     var val = $("#eventsFilter option:selected").text();
//     alert(val);
// });

// Call to iSotope Masonry




var $container = $('#specialevents').imagesLoaded(function() {

$items = $('.post');

  $container.isotope({
    itemSelector: '.post',
    // filter: '.show-all',
    masonry: {
      columnWidth: 220,
      gutter: 20
    },
    getSortData : {
      selected : function( $item ){
        // sort by selected first, then by original order
        return ($item.hasClass('selected') ? -1000 : 0 ) + $item.index();
      }
    },
    sortBy : 'selected'
  });

  $('#filter').find('a').click(function() {
        // get the href attribute
        var filterName = '.' + $(this).attr('href').slice(1);
        filterName = filterName === '.show-all' ? '*' : filterName;
        $container.isotope({
            filter : filterName
        });
        return false;
    });

});

// Video Player Functionality

var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


// This function creates an <iframe> (and YouTube player)
// after the API code downloads.
// $('#watch-event').click(function() {

var ytid = ($('#watch-event').data('ytid'));
console.log($('#watch-event').data('ytid'));

// Function creates an <iframe> (and YouTube player)
// on click and after the API code downloads.
var player;

function onPlayerReady(event) {
    event.target.playVideo();
}

$('#watch-event').click(function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
      height: '350',
      width: '623',
      videoId: ytid,
      events: {
        'onReady': onPlayerReady,
        'onStateChange': function (event) {
              switch (event.data) {
                  case -1:
                      console.log ('unstarted');
                      break;
                  case 0:
                      $('#yt-theatre').animate({'padding-bottom': '34.5%'},{duration:700});
                      console.log ('ended');
                      break;
                  case 1:
                      $('#yt-theatre').animate({'padding-bottom': '42.5%'},{duration:700});
                      console.log ('playing');
                      break;
                  case 2:
                      $('#yt-theatre').animate({'padding-bottom': '34.5%'},{duration:700});
                      console.log ('paused');
                      break;
                  case 3:
                      $('#yt-theatre').animate({'padding-bottom': '34.5%'}, {duration:700});
                      console.log ('buffering');
                      break;
                  case 5:
                      console.log ('video cued');
                      break;
              }
          }
        }
    });
});

// Frontpage Slider

jQuery(document).ready(function(){
  jQuery('#upcoming-slide').slippry({
    // options
    adaptiveHeight: false, // height of the sliders adapts to current
    captions: false,
    pager: false,

    // transitions
    transition: 'fade', // fade, horizontal, kenburns, false
    speed: 1200,
    pause: 5000,
  })
});