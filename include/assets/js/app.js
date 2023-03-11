$(document).ready(function () {
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $("#scroll").fadeIn();
    } else {
      $("#scroll").fadeOut();
    }
  });
  $("#scroll").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
  });
});

$(window).scroll(function () {
  if ($(this).scrollTop() > 100) {
    $(".header_section").addClass("sticky");
  } else {
    $(".header_section").removeClass("sticky");
  }
});

// Filter

$(document).ready(function () {
  $(".filter-button").click(function () {
    var value = $(this).attr("data-filter");

    if (value == "all") {
      $(".filter").show("1000");
      $(".filter-button").removeClass("filter-button-active");
      $(this).addClass("filter-button-active");
    } else {
      $(".filter")
        .not("." + value)
        .hide("3000");
      $(".filter-button").removeClass("filter-button-active");
      $(this).removeClass("filter-button-active");

      $(".filter")
        .filter("." + value)
        .show("3000");
      $(this).addClass("filter-button-active");
    }
  });
});

$(document).ready(function () {
  $("#increaseFont,#decreaseFont,#restoreSize").click(function () {
    var type = $(this).val();
    var curFontSize = $(".method-data").css("font-size");
    if (type == "increase") {
      $(".method-data").css("font-size", parseInt(curFontSize) + 1);
    } else if (type == "decrease") {
      $(".method-data").css("font-size", parseInt(curFontSize) - 1);
    } else {
      $(".method-data").css("font-size", 16);
    }
    // alert($('.data').css('font-size'));
  });
});

$(function () {
  $("#side-menu").metisMenu();
}),
  $(function () {
    $(window).bind("load resize", function () {
      var i = 50,
        n =
          this.window.innerWidth > 0
            ? this.window.innerWidth
            : this.screen.width;
      n < 768
        ? ($("div.navbar-collapse").addClass("collapse"), (i = 100))
        : $("div.navbar-collapse").removeClass("collapse");
      var e =
        (this.window.innerHeight > 0
          ? this.window.innerHeight
          : this.screen.height) - 1;
      (e -= i),
        e < 1 && (e = 1),
        e > i && $("#page-wrapper").css("min-height", e + "px");
    });
    for (
      var i = window.location,
        n = $("ul.nav a")
          .filter(function () {
            return this.href == i;
          })
          .addClass("active")
          .parent();
      ;

    ) {
      if (!n.is("li")) break;
      n = n.parent().addClass("in").parent();
    }
  });

  var $star_rating = $('.star-rating .fa');

  var SetRatingStar = function() {
    return $star_rating.each(function() {
      if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
        $('.star-rating .fa').addClass('no-click');
        return $(this).removeClass('fa-star-o').addClass('fa-star');
      } else {
        return $(this).removeClass('fa-star').addClass('fa-star-o');
      }
    });
  };
  
  $star_rating.on('click', function() {
    $star_rating.siblings('input.rating-value').val($(this).data('rating'));
    return SetRatingStar();
  });
  
  SetRatingStar();
  $(document).ready(function() {
  
  });


