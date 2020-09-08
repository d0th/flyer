/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./public/js/_slider.js":
/*!******************************!*\
  !*** ./public/js/_slider.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$(document).ready(function () {
  $('.corporate__list').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    prevArrow: '<button class="slide-arrow prev-arrow"><img src="/images/icon/prev.svg" alt=""></button>',
    nextArrow: '<button class="slide-arrow next-arrow"><img src="/images/icon/next.svg" alt=""></button>',
    responsive: [{
      breakpoint: 1400,
      settings: {
        slidesToShow: 3
      }
    }, {
      breakpoint: 1050,
      settings: {
        slidesToShow: 2
      }
    }, {
      breakpoint: 750,
      settings: {
        slidesToShow: 1
      }
    }]
  });
  $('.corporate__anchor[href^="#"]').click(function () {
    var anchor = $(this).attr('href');
    $('html, body').animate({
      scrollTop: $(anchor).offset().top
    }, 600);
  }); // добавляем имена вместо точек перелистывания на слайдере

  if ($(".instructor__name") !== undefined) {
    for (var childrenKey in $(".instructor__name")) {
      if ($(".instructor__name").hasOwnProperty(childrenKey)) {
        $(".slick-dots li button")[childrenKey].innerHTML = $(".instructor__name")[childrenKey].innerHTML;
      }
    }
  }

  console.log($('.o-1'));
  console.log(1);
  $(".slick-list").on("init", function (event, slick) {
    console.log(slick.slideCount); //$(".seti__counter_facebook").text(1 + " / " + slick.slideCount);
  });
});

/***/ }),

/***/ 1:
/*!************************************!*\
  !*** multi ./public/js/_slider.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/cryptokitty/code/works/ifly/public/js/_slider.js */"./public/js/_slider.js");


/***/ })

/******/ });