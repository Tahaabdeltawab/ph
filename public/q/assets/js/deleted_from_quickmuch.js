  // instagram slider
  var swiper = new Swiper('.instagram-slider', {
      slidesPerView: 2,
      loop: true,
      autoplay: {
          delay: 2500,
          disableOnInteraction: false,
      },
      navigation: false,
      breakpoints: {
          480: {
              slidesPerView: 3,
          },
          768: {
              slidesPerView: 4,
          },
          992: {
              slidesPerView: 6,
          },
          1500: {
              slidesPerView: 8,
          },
      }
  });

  // category-slider
  var swiper = new Swiper('.category-slider', {
      slidesPerView: 2,
      spaceBetween: 15,
      loop: false,
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      },
      breakpoints: {
          576: {
              slidesPerView: 3,
              spaceBetween: 15,
          },
          768: {
              slidesPerView: 4,
              spaceBetween: 40,
          },
          992: {
              slidesPerView: 6,
              spaceBetween: 40,
          },
          1200: {
              slidesPerView: 8,
              spaceBetween: 15,
          },
      }
  });
  // popular-item-slider
  var swiper = new Swiper('.popular-item-slider', {
      slidesPerView: 2,
      spaceBetween: 15,
      loop: false,
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      },
      breakpoints: {
          576: {
              slidesPerView: 4,
              spaceBetween: 15,
          },
          768: {
              slidesPerView: 5,
              spaceBetween: 40,
          },
          1200: {
              slidesPerView: 6,
              spaceBetween: 15,
          },
          1400: {
              slidesPerView: 8,
              spaceBetween: 15,
          },
          1800: {
              slidesPerView: 10,
              spaceBetween: 15,
          },
      }
  });
  // popular-item-slider
  var swiper = new Swiper('.near-offer-slider', {
      slidesPerView: 1,
      spaceBetween: 15,
      loop: false,
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      },
      breakpoints: {
          576: {
              slidesPerView: 2,
              spaceBetween: 15,
          },
          768: {
              slidesPerView: 3,
              spaceBetween: 40,
          },
          1200: {
              slidesPerView: 3,
              spaceBetween: 15,
          },
          1400: {
              slidesPerView: 4,
              spaceBetween: 15,
          }
      }
  });
  // featured-partners-slider
  var swiper = new Swiper('.featured-partners-slider', {
      slidesPerView: 1,
      spaceBetween: 15,
      loop: false,
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      },
      breakpoints: {
          576: {
              slidesPerView: 2,
              spaceBetween: 15,
          },
          991: {
              slidesPerView: 3,
              spaceBetween: 40,
          },
          1200: {
              slidesPerView: 3,
              spaceBetween: 15,
          },
          1400: {
              slidesPerView: 3,
              spaceBetween: 15,
          }
      }
  });
  // trending-slider
  var swiper = new Swiper('.trending-slider', {
      slidesPerView: 1,
      spaceBetween: 15,
      loop: false,
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      },
      breakpoints: {
          576: {
              slidesPerView: 2,
              spaceBetween: 15,
          },
          991: {
              slidesPerView: 3,
              spaceBetween: 40,
          },
          1200: {
              slidesPerView: 3,
              spaceBetween: 15,
          },
          1400: {
              slidesPerView: 4,
              spaceBetween: 15,
          }
      }
  });
  // fresh deals
  var swiper = new Swiper('.fresh-deals-slider', {
      slidesPerView: 1,
      spaceBetween: 15,
      loop: false,
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      },
      breakpoints: {
          576: {
              slidesPerView: 2,
              spaceBetween: 15,
          },
          991: {
              slidesPerView: 3,
              spaceBetween: 40,
          },
          1200: {
              slidesPerView: 3,
              spaceBetween: 15,
          },
          1400: {
              slidesPerView: 4,
              spaceBetween: 15,
          }
      }
  });
  // kosher-delivery-slider
  var swiper = new Swiper('.kosher-delivery-slider', {
      slidesPerView: 1,
      spaceBetween: 15,
      loop: false,
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      },
      breakpoints: {
          576: {
              slidesPerView: 1,
              spaceBetween: 15,
          },
          768: {
              slidesPerView: 2,
              spaceBetween: 40,
          },
          1200: {
              slidesPerView: 3,
              spaceBetween: 15,
          },
          1400: {
              slidesPerView: 3,
              spaceBetween: 15,
          }
      }
  });
  // food near me
  var swiper = new Swiper('.food-near-me', {
      slidesPerView: 2,
      spaceBetween: 15,
      loop: false,
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      },
      breakpoints: {
          576: {
              slidesPerView: 2,
              spaceBetween: 15,
          },
          768: {
              slidesPerView: 4,
              spaceBetween: 40,
          },
          1200: {
              slidesPerView: 4,
              spaceBetween: 15,
          },
          1400: {
              slidesPerView: 8,
              spaceBetween: 15,
          }
      }
  });
  // advertisement slider
  var swiper = new Swiper('.advertisement-slider', {
      slidesPerView: 1,
      spaceBetween: 0,
      loop: false,
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      }
  });
  // about-us-slider slider
  var swiper = new Swiper('.about-us-slider', {
      autoplay: {
          delay: 2500,
          disableOnInteraction: false,
      },
      speed: 1000,
      grabCursor: true,
      watchSlidesProgress: true,
      mousewheelControl: true,
      keyboardControl: true,
      slidesPerView: 1,
      spaceBetween: 0,
      loop: true,
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      }
  });
  // about-us-slider slider
  var swiper = new Swiper('.feedback-slider', {
      autoplay: {
          delay: 2500,
          disableOnInteraction: false,
      },
      speed: 1000,
      grabCursor: true,
      watchSlidesProgress: true,
      mousewheelControl: true,
      keyboardControl: true,
      slidesPerView: 1,
      spaceBetween: 0,
      loop: true,
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      }
  });
  // Delivery time range
  $(".delivery-range-slider").ionRangeSlider({
      min: 0,
      from: new Date().getMonth(),
      values: ["45 min", "60 min", "Any"],
      grid: true
  });
  // Distance range
  $(".distance-range-slider").ionRangeSlider({
      min: 0,
      from: new Date().getMonth(),
      values: ["1/4 mi", "1/2 mi", "1 mi", "2 mi", "3 mi", "4 mi", "5 mi", "10 mi"],
      grid: true
  });