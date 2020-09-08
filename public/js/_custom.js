//BackForm input-file

function getFileName() {
  let file = document.getElementById("uploaded-file").value;

  file = file
    .replace(/\\/g, "/")
    .split("/")
    .pop();

  document.getElementById("file-name").innerHTML =
    '<div class="del__container">' +
    file +
    '<span id="del-file"><span class="name">Удалить файл</span></span>' +
    "</div>";
}

$(document).ready(function() {
  //sliders

  $(".programs__list").slick({
    infinite: false,
    arrows: true,
    dots: false,
    speed: 300,
    autoplay: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    focusOnSelect: true,
    responsive: [
      {
        breakpoint: 1400,
        settings: {
          infinite: true
        }
      },
      {
        breakpoint: 1350,
        settings: {
          slidesToShow: 2
        }
      }
    ]
  });

  $(".advantages__list").slick({
    infinite: true,
    dots: true,
    arrows: false,
    speed: 300,
    slidesToShow: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    customPaging: function(slider, i) {
      var thumb = $(slider.$slides[i]).data();
      return '<a class="advantages__dot">' + "0" + (i + 1) + "</a>";
    },
    responsive: [
      {
        breakpoint: 500,
        settings: {
          dots: false,
          arrows: false,
          infinite: false,
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }
    ]
  });

  $(".akcii__list").slick({
    infinite: true,
    arrows: false,
    speed: 300,
    autoplay: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1250,
        settings: {
          infinite: true,
          arrows: true,
          autoplay: true,
          speed: 300,
          autoplaySpeed: 3000,
          slidesToShow: 2,
          slidesToScroll: 1
        }
      }
    ]
  });

  // seti homepage
  // $(".seti__lenta").slick({
  //   infinite: true,
  //   arrows: true,
  //   slidesToShow: 3,
  //   slidesToScroll: 1,
  //   focusOnSelect: true,
  //   centerMode: true,
  //   autoplay: true,
  //   autoplaySpeed: 3000,
  //   responsive: [
  //     {
  //       breakpoint: 1350,
  //       settings: {
  //         slidesToShow: 2
  //       }
  //     }
  //   ]
  // });

  // function setSlideVisibility() {
    //Find the visible slides i.e. where aria-hidden="false"
    // let visibleSlides = $(
    //   '.seti__lenta > .slick-list > .slick-track > .slick-slide[aria-hidden="false"]'
    // );
    //Make sure all of the visible slides have an opacity of 1
    // $(visibleSlides).each(function() {
    //   $(this).css("opacity", 1);
      // console.log($(this).html());
    // });
    //Set the opacity of the first and last partial slides.
  //   $(visibleSlides)
  //     .first()
  //     .prev()
  //     .css("opacity", 0.4);
  //   $(visibleSlides)
  //     .last()
  //     .next()
  //     .css("opacity", 0.4);
  // }

  //Execute the function to apply the visibility on dom ready.
  // $(setSlideVisibility());

  //Re-apply the visibility in the beforeChange event.
  // $(".seti__lenta").on("beforeChange", function() {
  //   $(".slick-slide").each(function() {
  //     $(this).css("opacity", 1);
  //   });
  // });

  //After the slide change has completed, call the setSlideVisibility to hide the partial slides.
  // $(".seti__lenta").on("afterChange", function() {
  //   setSlideVisibility();
  // });

  // reviews
  $(".reviews-slider").slick({
    infinite: true,
    dots: false,
    arrows: true,
    speed: 300,
    autoplay: true,
    autoplaySpeed: 3000,
    slidesToShow: 1
  });

  $(".insructors__sliders").slick({
    arrows: false,
    speed: 300,
    slidesToShow: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    dots: true
  });

  $(".insructors__sliders #slick-slide-control00").text("Алексей Птушкин");
  $(".insructors__sliders #slick-slide-control01").text("Илья Алёхин");
  $(".insructors__sliders #slick-slide-control02").text("Вячеслав Красный");
  $(".insructors__sliders #slick-slide-control03").text("Сергей Панченков");
  $(".insructors__sliders #slick-slide-control04").text("Алексей Смирнов");

  $(".newpost-slider").slick({
    infinite: true,
    dots: false,
    arrows: true,
    speed: 300,
    slidesToShow: 2,
    slidesToScroll: 1,
    variableWidth: true,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
      {
        breakpoint: 1300,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          arrows: true,
          infinite: true
        }
      },
      {
        breakpoint: 640,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: true,
          infinite: true
        }
      }
    ]
  });

  $(".new__bottom").slick({
    dots: false,
    arrows: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
      {
        breakpoint: 1300,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          arrows: true,
          infinite: true
        }
      },
      {
        breakpoint: 640,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: true,
          infinite: true
        }
      }
    ]
  });

  $(".history-slide").slick({
    dots: true,
    arrows: false,
    speed: 300,
    autoplay: true,
    autoplaySpeed: 2000,
    slidesToShow: 1,
    slidesToScroll: 1
  });

  $(".history-slide #slick-slide-control00").text("1998 - 2001");
  $(".history-slide #slick-slide-control01").text("2002 - 2007");
  $(".history-slide #slick-slide-control02").text("2008 - 2013");
  $(".history-slide #slick-slide-control03").text("2014 - 2019");

  //pagination text
  // $("a[data-slide]").click(function(e) {
  //   e.preventDefault();
  //   let slideno = $(this).data("slide");
  //   $(".insructors__sliders").slick("slickGoTo", slideno - 1);
  // });

  // $("a[data-slide]").click(function(e) {
  //   e.preventDefault();
  //   let slideno = $(this).data("slide");
  //   $(".history-slide").slick("slickGoTo", slideno - 1);
  // });

  //news
  $(".news__btn").on("click", function(event) {
    event.preventDefault();
    $(this).toggleClass("is-active");
  });

  $(".news__selectValue").on("click", function(event) {
    event.preventDefault();
    $(".news__nav").toggleClass("is-active");
  });

  //form
  $(".register").on("click", function(event) {
    event.preventDefault();
    $(".main__form").addClass("is-active");
    $(".overlay").addClass("is-active");
    $(".overlay").on("click", function(event) {
      $(this).removeClass("is-active");
      $(".main__form").removeClass("is-active");
    });
    $(".form__btnClose").on("click", function(event) {
      $(".overlay").removeClass("is-active");
      $(".main__form").removeClass("is-active");
    });
  });

  //nav-menu
  $(".burger-menu").on("click", function(event) {
    event.preventDefault();
    $("#nav-menu").toggleClass("is-active");
    $(".burger-menu").toggleClass("is-active");
    $(".profile__subList").removeClass("is-active");
  });

  //profile
  $(".profile__container").on("click", function(event) {
    event.preventDefault();
    $(".profile__subList").toggleClass("is-active");
    $("#nav-menu").removeClass("is-active");
    $(".burger-menu").removeClass("is-active");
  });

  $(".header__link").hover(function(event) {
    event.preventDefault();
    $(this)
      .siblings(".header__subList")
      .toggleClass("is-active");
    $(".header__subList").on("mouseenter", function() {
      $(this).addClass("is-active");
    });
    $(".header__subList").on("mouseleave", function() {
      $(this).removeClass("is-active");
    });
  });

  // accordion FAQ page
  $(".faq__btn").on("click", function() {
    $(".panel").removeClass("is-active");
    $(this)
      .parents(".panel")
      .toggleClass("is-active");
  });

  //pagination counter

  //custom function showing current slide
  // var $status = $(".pagingInfo");
  // var $slickElement = $(".pagin-number");

  // $slickElement.on("init reInit afterChange", function(
  //   event,
  //   slick,
  //   currentSlide,
  //   nextSlide
  // ) {
  //   //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
  //   var i = (currentSlide ? currentSlide : 0) + 1;
  //   $status.text(i + "/" + slick.slideCount);
  // });

  // let $slider = $(".pagin-number");

  // if ($slider.length) {
  //   let currentSlide = 0;
  //   let slidesCount;
  //   let sliderCounter = document.createElement("div");
  //   sliderCounter.classList.add("slider__counter");

  //   let updateSliderCounter = function(slick, currentIndex) {
  //     currentSlide = slick.slickCurrentSlide() + 1;
  //     slidesCount = slick.slideCount;
  //     $(sliderCounter).text(currentSlide + "/" + slidesCount);
  //   };

  //   $slider.on("afterChange", function(event, slick, currentSlide) {
  //     updateSliderCounter(slick, currentSlide);
  //   });

  //   $slider.on("init", function(event, slick) {
  //     $slider.append(sliderCounter);
  //     updateSliderCounter(slick);
  //   });

  //   $slider.slick();
  // }

  // let $slider02 = $(".pagin-number02");

  // if ($slider02.length) {
  //   let currentSlide = 0;
  //   let slidesCount;
  //   let sliderCounter = document.createElement("div");
  //   sliderCounter.classList.add("slider__counter");

  //   $slider02.on("init", function(event, slick) {
  //     $slider02.append(sliderCounter);
  //     updateSliderCounter(slick);
  //   });

  //   $slider02.on("afterChange", function(event, slick, currentSlide) {
  //     updateSliderCounter(slick, currentSlide);
  //   });

  //   let updateSliderCounter = function(slick, currentIndex) {
  //     currentSlide = slick.slickCurrentSlide() + 1;
  //     slidesCount = slick.slideCount;
  //     $(sliderCounter).text(currentSlide + "/" + slidesCount);
  //   };

  //   $slider02.slick();
  // }

  // let $slider03 = $(".pagin-number03");

  // if ($slider03.length) {
  //   let currentSlide = 0;
  //   let slidesCount;
  //   let sliderCounter = document.createElement("div");
  //   sliderCounter.classList.add("slider__counter");

  //   $slider03.on("init", function(event, slick) {
  //     $slider03.append(sliderCounter);
  //     updateSliderCounter(slick);
  //   });

  //   $slider03.on("afterChange", function(event, slick, currentSlide) {
  //     updateSliderCounter(slick, currentSlide);
  //   });

  //   let updateSliderCounter = function(slick, currentIndex) {
  //     currentSlide = slick.slickCurrentSlide() + 1;
  //     slidesCount = slick.slideCount;
  //     $(sliderCounter).text(currentSlide + "/" + slidesCount);
  //   };

  //   $slider03.slick();
  // }
});
