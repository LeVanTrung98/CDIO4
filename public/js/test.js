$(document).ready(function () {
  // executes when HTML-Document is loaded and DOM is ready

  // breakpoint and up  
  $(window).resize(function () {
    if ($(window).width() >= 980) {

      // when you hover a toggle show its dropdown menu
      $(".navbar .dropdown-toggle").hover(function () {
        $(this).parent().toggleClass("show");
      });

      // hide the menu when the mouse leaves the dropdown
      $(".navbar").mouseleave(function () {
        $(this).removeClass("show");
      });

      // do something here
    }
  });



  // document ready  
});

var swiper = new Swiper('.swiper-container', {
  effect: 'cube',
  autoplay: {
    delay: 5000
  },
  loop: true
});

//swiper-slide

var galleryTop = new Swiper(".gallery-top", {
  centeredSlides: true,
  slidesPerView: 1,
  on: {

  },
  navigation: {
    nextEl: ".main-swiper-button-next",
    prevEl: ".main-swiper-button-prev"
  }
});

var galleryThumbs = new Swiper(".gallery-thumbs", {
  spaceBetween: 10,
  slidesPerView: "auto",
  centeredSlides: true,
  touchRatio: 0.2,
  slideToClickedSlide: true,
  on: {
  },
});

if (galleryTop.controller) {
  galleryTop.controller.control = galleryThumbs;
  galleryThumbs.controller.control = galleryTop;
}

function updateWidth(thumbnail) {
  const img = thumbnail.querySelector("img");
  const width = img.offsetWidth;
  thumbnail.style.width = width;
}

function updateWidth(thumbnail) {
  const img = thumbnail.querySelector("img");
  const width = img.offsetWidth;
  thumbnail.style.width = width;
}

window.addEventListener("load", function (event) {
  let thumbs = document.querySelectorAll(".gallery-thumbs .swiper-slide");

  thumbs.forEach(thumb => updateWidth(thumb));
});



(() => {
  const sliderEl = document.querySelector('.slider-seeroom');
  if (!sliderEl) {
    return;
  }
  const slider = new Swiper(sliderEl, {
    slidesPerView: 3,
    loop: true,
    spaceBetween: 14,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    breakpoints: {
      768: {
        slidesPerView: 2
      },
      640: {
        slidesPerView: 1
      }
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
})();