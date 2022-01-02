
// <3images slider script start>
$(document).ready(function() {
  var owl = $('.waqar-1');
  owl.owlCarousel({
    margin: 10,
    nav: false,
    loop: true,
    autoplay: false,
    responsive: {
      0: {
        items: 3
      },
      600: {
        items: 5
      },
      1000: {
        items: 6  
      }
    }
  });
  // slider-2
  var owl2 = $('.waqar-2');
  owl2.owlCarousel({
    margin: 10,
    nav: false,
    loop: true,
    autoplay: true,
    responsive: {
      0: {
        items: 3
      },
      600: {
        items: 5
      },
      1000: {
        items: 6
      }
    }
  })
  // slider
  var owl3 = $('.waqar-3');
  owl3.owlCarousel({
    margin: 10,
    nav: false,
    loop: true,
    autoplay: true,
    dots: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 1
      }
    }
  })
  // slider4
  var owl4 = $('.waqar-4');
  owl4.owlCarousel({
    margin: 10,
    nav: false,
    loop: true,
    autoplay: true,
    responsive: {
      0: {
        items: 3
      },
      600: {
        items: 3
      },
      1000: {
        items: 7
      }
    }
  })
  // slider5
    var owl4 = $('.waqar-5');
  owl4.owlCarousel({
    margin: 10,
    nav: false,
    loop: true,
    autoplay: true,
    responsive: {
      0: {
        items: 1.19
      },
      600: {
        items: 1.19
      },
      1000: {
        items: 3
      }
    }
  })
  // <>
  var owl2 = $('.waqar-6');
  owl2.owlCarousel({
    margin: 10,
    nav: false,
    loop: false,
    pauseOnHover: true,
    slidesToScroll: 0,
    autoplay: false,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 3
      }
    }
  })
  // slider7
   var owl2 = $('.waqar-7');
  owl2.owlCarousel({
    margin: 10,
    nav: false,
    loop: false,
    pauseOnHover: true,
    slidesToScroll: 0,
    autoplay: false,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 3
      }
    }
  })
  // slider8
  var owl2 = $('.waqar-8');
  owl2.owlCarousel({
    margin: 10,
    nav: false,
    loop: false,
    pauseOnHover: true,
    slidesToScroll: 0,
    autoplay: false,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 1
      }
    }
  })
  // slider9
  var owl2 = $('.waqar-9');
  owl2.owlCarousel({
    margin: 10,
    nav: false,
    loop: false,
    pauseOnHover: true,
    slidesToScroll: 0,
    autoplay: false,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 1
      }
    }
  })
  // slider11
  var owl2 = $('.waqar-11');
  owl2.owlCarousel({
    margin: 10,
    nav: false,
    loop: false,
    pauseOnHover: true,
    slidesToScroll: 0,
    autoplay: false,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 3
      }
    }
  })
  // slider10
  var owl2 = $('.waqar-10');
  owl2.owlCarousel({
    margin: 10,
    nav: false,
    loop: false,
    pauseOnHover: true,
    slidesToScroll: 0,
    autoplay: false,
    responsive: {
      0: {
        items: 3
      },
      600: {
        items: 3
      },
      1000: {
        items: 6
      }
    }
  })
  // <>
  var owl2 = $('.waqar-15');
  owl2.owlCarousel({
    margin: 10,
    nav: false,
    loop: true,
    autoplay: true,
    responsive: {
      0: {
        items: 2
      },
      600: {
        items: 2
      },
      1000: {
        items: 4
      }
    }
  })
  // <>
  var owl2 = $('.waqar-16');
  owl2.owlCarousel({
    margin: 10,
    nav: false,
    loop: true,
    autoplay: true,
    responsive: {
      0: {
        items: 2
      },
      600: {
        items: 2
      },
      1000: {
        items: 4
      }
    }
  })

  $('.customer-logos').slick({
      slidesToShow: 10,
      slidesToScroll: 6,
      autoplay: false,
      autoplaySpeed: 1500,
      arrows: false,
      dots: false,
      pauseOnHover: false,
      responsive: [{
          breakpoint: 768,
          settings: {
              slidesToShow: 4
          }
      },{
          breakpoint: 520,
          settings: {
              slidesToShow: 5
          }
      }]
  });
  var owl2 = $('.irfan-11');
  owl2.owlCarousel({
    margin: 10,
    nav: false,
    loop: true,
    autoplay: true,
    responsive: {
      0: {
        items: 2
      },
      600: {
        items: 4
      },
      1000: {
        items: 6
      }
    }
  });
  // <>
  var owl2 = $('.irfan-37');
  owl2.owlCarousel({
    margin: 10,
    nav: false,
    loop: true,
    autoplay: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 3
      }
    }
  });
  // <>
});
// menu sidebar js start
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  // document.getElementById("main").style.marginLeft = "250px";
  // document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  // document.getElementById("main").style.marginLeft= "0"; 
}
// /*end*/menu sidebar js end
// menu sidebar js start
function openNav1() {
  document.getElementById("myfilter").style.width = "302px";
  // document.getElementById("main1").style.marginLeft = "362px";
  // document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
  document.getElementById("back-overlay").style.display = "block"; 
}

function closeNav1() {
  document.getElementById("myfilter").style.width = "0";
  // document.getElementById("main1").style.marginLeft= "0";
  // document.body.style.backgroundColor = "white";
  document.getElementById("back-overlay").style.display = "none"; 
}
// /*end*/menu sidebar js end

// <cart script start>


// <script type="text/javascript">
$(document).ready(function(){
  $(".search_show").click(function(){
    // $(".search").addClass("d-block")
    // $(".search_show").css("display","none")
    $(".search").toggle(300);

  });
});
// </script>
// <>
$(document).ready(function() {
    // declare variable
    var scrollTop = $(".scrollTop");

    $(window).scroll(function() {
      // declare variable
      var topPos = $(this).scrollTop();
    }); // scroll END

    //Click event to scroll to top
    $(scrollTop).click(function() {
      $('html, body').animate({
        scrollTop: 0
      }, 800);
      return false;

    });
});
// ***********************************************
// <script type="text/javascript">

// </script>
// ****************************************

