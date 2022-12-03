"use strict";
import Swiper, { Navigation } from 'swiper';

Swiper.use([Navigation]);
document.addEventListener('DOMContentLoaded', function () {
  $('.burger').on('click', function () {
    $('.burger,.mob-menu ').toggleClass('active');
    $('body').toggleClass('scroll-hide');
  });

  if ($(window).width() <= 1023) {
    $('.lang-act').on('click', function () {
      $(this).toggleClass('active');
      $('.lang__list').slideToggle(200);
    });
  }
  $('.sort-radio').on('click', function () {
    $(this).addClass('active').siblings().removeClass('active');
  });
  $('.creation-form-date-item').on('click', function () {
    $(this).addClass('active');
    $(this).parent().siblings().find('.creation-form-date-item').removeClass('active');
  });
  $('.tab').on('click', function (event) {
    event.preventDefault();
    $($(this).siblings()).removeClass('tab-active');
    $($(this).closest('.tabs-wrapper').siblings().find('div')).removeClass('tabs-content-active');
    $(this).addClass('tab-active');
    $($(this).attr('href')).addClass('tabs-content-active');
  });
  document.querySelectorAll('.num-input').forEach(function (item) {
    item.addEventListener('input', function () {
      if (this.value.length > this.maxLength) {
        this.value = this.value.slice(0, this.maxLength);
      }
    });
  });
    $('.cities-list .custom-select-item').on('click', function () {
        var text = $(this).text();
        $(this).parents('.custom-select').find('.custom-select-value').text(text);
        $(this).parents('.custom-select').find('.custom-select-input').val(text);
        $('.custom-select__list').slideUp(200);
        $('.custom-select__top').removeClass('active');
    });

    $('.sort-radio-input').on('click', function () {
        getExecutors()
    });


    $('.profession-list .custom-select-item').on('click', function () {
        var text = $(this).text();
        var gender = $(this).attr('id');
        $(this).parents('.custom-select').find('.custom-select-value').text(text);
        $(this).parents('.custom-select').find('.custom-select-input').val(gender);
        $('.custom-select__list').slideUp(200);
        $('.custom-select__top').removeClass('active');
    });
    $('.sections-list .custom-select-item').on('click', function () {
        var text = $(this).text();
        $(this).parents('.custom-select').find('.custom-select-value').text(text);
        $(this).parents('.custom-select').find('.custom-select-input').val($(this).attr('id'));
        $('.category-input').val(null)
        $('.category-value').text('')
        getCategories($(this).attr('id'));
        $('.custom-select__list').slideUp(200);
        $('.custom-select__top').removeClass('active');
    });
    $('.statuses-list .custom-select-item').on('click', function () {
        var text = $(this).text();
        $(this).parents('.custom-select').find('.custom-select-value').text(text);
        var status = $(this).attr('id');
        $(this).parents('.custom-select').find('.custom-select-input').val(status);

        $('.custom-select__list').slideUp(200);
        $('.custom-select__top').removeClass('active');
    });

    // $('.specialist-contact__btn').on('click', function () {
    //     var order_id = $(this).parents('.order-info').find('#order-id').val();
    //     $.ajax({
    //         url: "/order-respond/create",
    //         type: "POST",
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         data: {
    //             order_id: order_id,
    //             type: 'show'
    //         },
    //         dataType: 'json',
    //         success: function success() {
    //             $(".specialist-contact-payment").hide();
    //             $(".specialist-contact-show").removeAttr('hidden');
    //         }
    //     });
    // });

    $('.order-respond-close__btn').on('click', function () {
        var order_id = $(this).parents('.order-info').find('#order-id').val();
        $.ajax({
            url: "/order-respond/create",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                order_id: order_id,
                type: 'close'
            },
            dataType: 'json',
            success: function success() {
                $(".order-respond-close__btn").hide();
                $(".order-respond-close").removeAttr('hidden');
            }
        });
    });

    if (Object.keys($( "#city-search" )).length != 0) {
        $("#city-search").autocomplete({
            delay: 500,
            source: function (request, response) {
                $.ajax({
                    url: "get-city-search-ajax",
                    type: 'POST',
                    dataType: "json",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        $(".search__input").removeClass('search__input_border')
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                $('#city-search').val(ui.item.label);
                $('#city-id').val(ui.item.id);
                if($(".executors-city-search-id").val()) {
                    getExecutors();
                }
                return false;
            }
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            return $("<li>")
                .data("ui-autocomplete-item", item)
                .append("<div id='" + item.id + "' class='ui-menu-item-wrapper'>" + item.label + " </div>")
                .appendTo(ul);
        };
    }


    $('.trigger-next2').on('click', function () {
        let coins = $('#count-coins').val();
        console.log(coins)
        $('#cost-coins').html(coins)
        $('#payment-coins').val(coins)
    });
    if (Object.keys($( "#count-coins" )).length != 0) {
        let coins = $('#count-coins').val();
        console.log(coins)
        $('#cost-coins').html(coins)
        $('#payment-coins').val(coins)

    }

    if (Object.keys($( "#profile-city-search" )).length != 0) {
        $("#profile-city-search").autocomplete({
            appendTo: ".edit-profile-modal",
            delay: 500,
            source: function (request, response) {
                $.ajax({
                    url: "get-city-search-ajax",
                    type: 'POST',
                    dataType: "json",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        $(".search__input").removeClass('search__input_border')
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                $('#profile-city-search').val(ui.item.label);
                $('#city-id').val(ui.item.id);
                return false;
            }
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            return $("<li>")
                .data("ui-autocomplete-item", item)
                .append("<div id='" + item.id + "' class='ui-menu-item-wrapper'>" + item.label + " </div>")
                .appendTo(ul);
        };
    }
    $(".executors-city-search-id").on("input", function() {
        getExecutors();
    });
    $(".executors--id").change(function(){
        getExecutors();
    });
    $(".city-name-input").on('input', function () {
        if(this.value == '') {
            $('#city-id').val('');
            getExecutors();
        }
    })
    if (Object.keys($( "#search" )).length != 0) {
        $( "#search" ).autocomplete({
            delay: 500,
            source: function( request, response ) {
                $.ajax({
                    url: "get-search-ajax",
                    type: 'POST',
                    dataType: "json",
                    headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: {
                        term: request.term
                    },
                    success: function( data ) {
                        $(".search__input").removeClass('search__input_border')
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                window.location.href = ui.item.link;
                return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li>" )
                .data( "ui-autocomplete-item", item )
                .append("<div class='ui-menu-item-wrapper'>" + item.label + " <small>(" + item.type + ")</small> </div>")
                .appendTo( ul );
        };
    }
    $(document).on('click', '.executors-links .pagination a', function(event){
        event.preventDefault();
        console.log('here')
        var page = $(this).attr('href').split('page=')[1];
        getExecutors(page);
    });

    $(".star-rate").on({
        mouseenter: function () {
            $(this).parents('.stars-rating').addClass($(this).attr('id'));
        },
        mouseleave: function () {
            $(this).parents('.stars-rating').removeClass($(this).attr('id'));
        }
    });
    $('.section-filter-item').on('click', function () {
        getExecutors();
        $('#category-placeholder').html(category_placeholder)
    });
    $('.category-filter-item').on('click', function () {
        getExecutors();
    });
    $('.reset-filters-btn').on('click', function () {
        $("#city-id").val('');
        $(".category-input").val('');
        $(".city-name-input").val('');
        $('.section-input').val('');
        $("input[name='sort']").checked = false;
        $('#section-placeholder').html(section_placeholder)
        $('#category-placeholder').html(category_placeholder)

        getExecutors()
    });
    $('.section-header').on('click', function () {
        if(!$(this).find('.section-collapse').hasClass("section-collapse-down")){
            $(this).find('.section-collapse').addClass("section-collapse-down");
        } else {
            $(this).find('.section-collapse').removeClass("section-collapse-down");
        }
    });
    $('.order-respond__btn').on('click', function () {
        var order_id = $(this).parents('.order-info').find('#order-id').val();
        $.ajax({
            url: "/order-respond/create",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                order_id: order_id,
                type: 'request'
            },
            dataType: 'json',
            success: function success() {
                $(".order-respond__btn").hide();
                $(".order-responded").removeAttr('hidden');
            }
        });
    });
    $('.edit-img').on('click', function () {
        $.ajax({
            url: "/get-portfolio-media",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: $(this).attr('media-id')
            },
            dataType: 'json',
            success: function success(data) {
                $('.modal-edit-image').attr('src', data.media.path);
                $('#image-id').val(data.media.id);
                $('#image-type').val(data.media.type);
                $('#image-category-name').html(data.media.category_name);
                $('#image-section-name').html(data.media.section_name);
                $('#category-name').val(data.media.category_name);
                $('#section-name').val(data.media.section_name);
                $('#image-description').val(data.media.description);
                $('#image-category-id').val(data.media.category_id);
                $('#image-section-id').val(data.media.section_id);
            }
        });
    })

    $('.edit-video').on('click', function () {
        $.ajax({
            url: "/get-portfolio-media",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: $(this).attr('media-id')
            },
            dataType: 'json',
            success: function success(data) {
                $('#video-id').val(data.media.id);
                $('#video-type').val(data.media.type);
                $('#video-category-name').html(data.media.category_name);
                $('#video-section-name').html(data.media.section_name);
                $('#video-show-category-name').val(data.media.category_name);
                $('#video-show-section-name').val(data.media.section_name);
                $('#video-description').val(data.media.description);
                $('#video-category-id').val(data.media.category_id);
                $('#video-section-id').val(data.media.section_id);
                $('#video-path').attr('src', data.media.url);
                $('#video-link').val(data.media.path);
            }
        });
    })

    $('.result__link').on('click', function () {
        console.log('here')
        console.log($(this).attr('link'))
    });
    $('.test').on('click', function () {
        console.log('here')
        console.log($(this).attr('link'))
    });
    $('.time-select .custom-select-item').on('click', function () {
        var text = $(this).text();
        $(this).parents('.custom-select').find('.custom-select-value').text(text);
        $(this).parents('.custom-select').find('.custom-select-input').val(text);
        $('.custom-select__list').slideUp(200);
        $('.custom-select__top').removeClass('active');
    });

    $(".porftolio-file").change(function(){
        $(".portfolio-block__text").html($(this).val().replace(/^.*[\\\/]/, ''));
    });

    $(".copy-text").on('click', function() {
        copyText($(this).attr('text'))
    })

    $(".search__input").blur(function() {
        if(!$(this).hasClass("search__input_border")){
            $(this).addClass("search__input_border");
        }
    });

    $('.categories-list').delegate('.custom-select-item', 'click', function() {
        var text = $(this).text();
        $(this).parents('.custom-select').find('.custom-select-value').text(text);
        $(this).parents('.custom-select').find('.custom-select-input').val($(this).attr('id'));
        $('.custom-select__list').slideUp(200);
        $('.custom-select__top').removeClass('active');
    });
    $('.categories-filters-list').delegate('.custom-select-item', 'click', function() {
        getExecutors();
    });
  $(document).mouseup(function (e) {
    if (!$('.custom-select').is(e.target) && $('.custom-select').has(e.target).length === 0) {
      $('.custom-select__top').removeClass('active');
      $('.custom-select__list').slideUp(200);
    }
  });
  $('.custom-select__top').on('click', function () {
    $(this).toggleClass('active');
    $(this).next().slideToggle(200);
  });
});
"use strict";

var header = document.querySelector('.header'),
    modaWrap = document.querySelectorAll('.modal-wrap'),
    scrollHide = calcScroll();

function bindModal(triggerSelector, modalSelector) {
  var trigger = document.querySelectorAll(triggerSelector),
      modal = document.querySelector(modalSelector);
  trigger.forEach(function (item) {
    item.addEventListener('click', function (e) {
      e.preventDefault();
      closeModal();
      modal.classList.add('active');
      hideScroll();
    });
  });
}

function searchByFilters () {
    var form = $('.filters-form');
    console.log(form)
}

function getExecutors(page = null) {
    var city_id = $("#city-id").val();
    var category_id = $(".category-input").val();
    var section_id = $('.section-input').val();
    var sort = $("input[name='sort']:checked").attr('id');

    $.ajax({
        url: "/executors/search",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            sort: sort,
            section_id: section_id,
            category_id: category_id,
            city_id: city_id,
            page: page
        },
        dataType: 'json',
        success: function success(data) {
            $(".executors-list").html(data.html);
        }
    });
}
function copyText(copyText) {
    if (window.isSecureContext && navigator.clipboard) {
        navigator.clipboard.writeText(copyText);
    } else {
        const textArea = document.createElement("textarea");
        textArea.value = copyText;
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            document.execCommand('copy');
        } catch (err) {
            console.error('Unable to copy to clipboard', err);
        }
        document.body.removeChild(textArea);
    }
    console.log(copyText)
    navigator.clipboard.writeText(copyText);
}

function getCategories(sectionId) {
    $(".categories-list").html('')
    $.ajax({
        url: "get-categories-ajax",
        type: "POST",
        headers: {  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: {
            section_id: sectionId
        },
        dataType: 'json',
        success: function (res) {
            $.each(res, function (key, value) {
                $(".categories-list").append('<div class="custom-select-item" id="'+ value.id +'"> ' + value.name + ' </div>');
            });
        }
    });
}

function calcScroll() {
  var div = document.createElement('div');
  div.style.width = '50px';
  div.style.height = '50px';
  div.style.overflowY = 'scroll';
  div.style.visibility = 'hidden';
  document.body.appendChild(div);
  var scrollWidth = div.offsetWidth - div.clientWidth;
  div.remove();
  return scrollWidth;
}

function hideScroll() {
  document.body.style.overflow = "hidden";
  document.body.style.marginRight = "".concat(scrollHide, "px");
}

function showScroll() {
  document.body.style.overflow = "";
  document.body.style.marginRight = '';
}

function showModal(modalItem) {
  var modal = document.querySelector(modalItem);
  modal.classList.add('active');
  hideScroll();
}

bindModal('.edit-img', '.modal-edit-img');
bindModal('.edit-video', '.modal-edit-video');
bindModal('.trigger-pasword-done', '.modal-password');
bindModal('.coins.hed-circle', '.modal-balance--one');
bindModal('.trigger-next1', '.modal-balance--two');
bindModal('.trigger-next2', '.modal-balance--three');
bindModal('.edit-profile', '.edit-profile-modal');
bindModal('.trigger-next3', '.modal-balance--four'); //showModal('.modal');
//////////////////////////////////////////////////////////////////////////////

function closeModal() {
  var modalAll = document.querySelectorAll('.modal-wrap');
  modalAll.forEach(function (item) {
    item.classList.remove('active');
    showScroll();
  });
}

document.addEventListener('keydown', function (e) {
  if (e.key === 'Escape') {
    closeModal();
  }
});

function closeAllModal() {
  var modalAll = document.querySelectorAll('.modal-wrap');
  var modalClose = document.querySelectorAll('.modal__close, .close-modal');
  modalClose.forEach(function (item) {
    item.addEventListener('click', function () {
      closeModal();
    });
  });
  modalAll.forEach(function (item) {
    item.addEventListener('click', function (e) {
      if (e.target === item) {
        item.classList.remove('active');
        showScroll();
      }
    });
  });
}

closeAllModal(); /////////////////////////////////////////////////////////////////////////
"use strict";

function DynamicAdapt(type) {
  this.type = type;
}

DynamicAdapt.prototype.init = function () {
  var _this2 = this;

  var _this = this; // массив объектов


  this.оbjects = [];
  this.daClassname = "_dynamic_adapt_"; // массив DOM-элементов

  this.nodes = document.querySelectorAll("[data-da]"); // наполнение оbjects объктами

  for (var i = 0; i < this.nodes.length; i++) {
    var node = this.nodes[i];
    var data = node.dataset.da.trim();
    var dataArray = data.split(",");
    var оbject = {};
    оbject.element = node;
    оbject.parent = node.parentNode;
    оbject.destination = document.querySelector(dataArray[0].trim());
    оbject.breakpoint = dataArray[1] ? dataArray[1].trim() : "767";
    оbject.place = dataArray[2] ? dataArray[2].trim() : "last";
    оbject.index = this.indexInParent(оbject.parent, оbject.element);
    this.оbjects.push(оbject);
  }

  this.arraySort(this.оbjects); // массив уникальных медиа-запросов

  this.mediaQueries = Array.prototype.map.call(this.оbjects, function (item) {
    return '(' + this.type + "-width: " + item.breakpoint + "px)," + item.breakpoint;
  }, this);
  this.mediaQueries = Array.prototype.filter.call(this.mediaQueries, function (item, index, self) {
    return Array.prototype.indexOf.call(self, item) === index;
  }); // навешивание слушателя на медиа-запрос
  // и вызов обработчика при первом запуске

  var _loop = function _loop(_i) {
    var media = _this2.mediaQueries[_i];
    var mediaSplit = String.prototype.split.call(media, ',');
    var matchMedia = window.matchMedia(mediaSplit[0]);
    var mediaBreakpoint = mediaSplit[1]; // массив объектов с подходящим брейкпоинтом

    var оbjectsFilter = Array.prototype.filter.call(_this2.оbjects, function (item) {
      return item.breakpoint === mediaBreakpoint;
    });
    matchMedia.addListener(function () {
      _this.mediaHandler(matchMedia, оbjectsFilter);
    });

    _this2.mediaHandler(matchMedia, оbjectsFilter);
  };

  for (var _i = 0; _i < this.mediaQueries.length; _i++) {
    _loop(_i);
  }
};

DynamicAdapt.prototype.mediaHandler = function (matchMedia, оbjects) {
  if (matchMedia.matches) {
    for (var i = 0; i < оbjects.length; i++) {
      var оbject = оbjects[i];
      оbject.index = this.indexInParent(оbject.parent, оbject.element);
      this.moveTo(оbject.place, оbject.element, оbject.destination);
    }
  } else {
    for (var _i2 = 0; _i2 < оbjects.length; _i2++) {
      var _оbject = оbjects[_i2];

      if (_оbject.element.classList.contains(this.daClassname)) {
        this.moveBack(_оbject.parent, _оbject.element, _оbject.index);
      }
    }
  }
}; // Функция перемещения


DynamicAdapt.prototype.moveTo = function (place, element, destination) {
  element.classList.add(this.daClassname);

  if (place === 'last' || place >= destination.children.length) {
    destination.insertAdjacentElement('beforeend', element);
    return;
  }

  if (place === 'first') {
    destination.insertAdjacentElement('afterbegin', element);
    return;
  }

  destination.children[place].insertAdjacentElement('beforebegin', element);
}; // Функция возврата


DynamicAdapt.prototype.moveBack = function (parent, element, index) {
  element.classList.remove(this.daClassname);

  if (parent.children[index] !== undefined) {
    parent.children[index].insertAdjacentElement('beforebegin', element);
  } else {
    parent.insertAdjacentElement('beforeend', element);
  }
}; // Функция получения индекса внутри родителя


DynamicAdapt.prototype.indexInParent = function (parent, element) {
  var array = Array.prototype.slice.call(parent.children);
  return Array.prototype.indexOf.call(array, element);
}; // Функция сортировки массива по breakpoint и place 
// по возрастанию для this.type = min
// по убыванию для this.type = max


DynamicAdapt.prototype.arraySort = function (arr) {
  if (this.type === "min") {
    Array.prototype.sort.call(arr, function (a, b) {
      if (a.breakpoint === b.breakpoint) {
        if (a.place === b.place) {
          return 0;
        }

        if (a.place === "first" || b.place === "last") {
          return -1;
        }

        if (a.place === "last" || b.place === "first") {
          return 1;
        }

        return a.place - b.place;
      }

      return a.breakpoint - b.breakpoint;
    });
  } else {
    Array.prototype.sort.call(arr, function (a, b) {
      if (a.breakpoint === b.breakpoint) {
        if (a.place === b.place) {
          return 0;
        }

        if (a.place === "first" || b.place === "last") {
          return 1;
        }

        if (a.place === "last" || b.place === "first") {
          return -1;
        }

        return b.place - a.place;
      }

      return b.breakpoint - a.breakpoint;
    });
    return;
  }
};

var da = new DynamicAdapt("max");
da.init();
"use strict";

var reviewsSwiper = new Swiper(".reviews-swiper", {
  slidesPerView: 1,
  spaceBetween: 30,
  loop: true,
  speed: 800,
  pagination: {
    el: ".reviews .swiper-pagination",
    clickable: true
  },
  navigation: {
    nextEl: ".reviews .swiper-button-next",
    prevEl: ".reviews .swiper-button-prev"
  }
});
var creationFormSwiper = new Swiper(".creation-form-swiper", {
  slidesPerView: 'auto',
  spaceBetween: 26,
  loop: true,
    observer: true,
    observeParents: true,
  /* loop: true, */
  speed: 500,
  navigation: {
    nextEl: ".creation-form .swiper-button-next",
    prevEl: ".creation-form .swiper-button-prev"
  },
  breakpoints: {
    780: {
      spaceBetween: 26
    },
    300: {
      spaceBetween: 12
    }
  }
});
Swiper.update()
"use strict";
//# sourceMappingURL=main.js.map
