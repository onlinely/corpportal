
function addValidateForms() {
    const forms = document.querySelectorAll('.form-submit');

    forms.forEach((form) => {
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.addEventListener('click', function (event) {
            const validationResult = validation(form);

            if (!validationResult) {
                event.preventDefault();
                event.stopPropagation();
            }
        });
    });

    const allInputs = document.querySelectorAll('input, textarea');
    allInputs.forEach((input) => {
        input.addEventListener('focusout', () => {
            if (input.required) {
                inputRequired(input);
            }
            if (input.type === 'email') {
                mailValid(input);
            }
            if (input.type === 'tel') {
                telValid(input);
            }
        });
    });
}
function telValid(telField) {
    let telVal = true;

    if (telField.value.trim().length < 10) {
        telField.parentNode.parentNode.classList.add("required_active");
        telVal = false;
    } else {
        telField.parentNode.parentNode.classList.remove("required_active");
        telVal = true;
    }

    return telVal;
}

function mailValid(field) {
    let fieldValue = field.value.trim(),
        mailVal = true,
        wrapper = field.parentNode.parentNode,
        reg = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;

    // Проверка, если поле не является обязательным и пустое, ничего не делать
    if (!field.required && fieldValue.length === 0) {
        return true;
    }

    if (fieldValue.length === 0 || !reg.test(fieldValue)) {
        field.parentNode.parentNode.classList.add("required_active");
        mailVal = false;
    } else {
        field.parentNode.parentNode.classList.remove("required_active");
        mailVal = true;
    }

    return mailVal;
}


function inputRequired(fieldRequired) {
    let requiredVal = true;

    if (fieldRequired.value.trim().length < 2) {
        fieldRequired.parentNode.parentNode.classList.add("required_active");
        requiredVal = false;
    } else {
        fieldRequired.parentNode.parentNode.classList.remove("required_active");
        requiredVal = true;
    }

    return requiredVal;
}

function validation(form) {
    let result = true;
    const allInputs = form.querySelectorAll('input, textarea');

    allInputs.forEach((input) => {
        if (input.required && !inputRequired(input)) {
            result = false;
        }
        if (input.type === 'email' && !mailValid(input)) {
            result = false;
        }
        if (input.type === 'tel' && !telValid(input)) {
            result = false;
        }
    });

    return result;
}

function chekMenu() {
    if ($(window).width() > 991) {
        $('.header__bottom ul.header__list').flexMenu({
            showOnHover: false,
            linkText: "Еще...",
            linkTitle: "Показать еще",
            linkTextAll: "Меню",
            linkTitleAll: "Развернуть меню",
            popupClass: 'more_dropdown'
        });
    }
}
function updatePaginationVisibility(swiperInstance) {
    const totalSlides = swiperInstance.slides.length;
    const slidesPerView = swiperInstance.params.slidesPerView;
    const paginationEl = swiperInstance.pagination.el;

    if (paginationEl) {
        const bullets = paginationEl.querySelectorAll('.swiper-pagination-bullet');
        if (totalSlides <= slidesPerView || bullets.length <= 1) {
            paginationEl.classList.add('hidden'); // Добавляем класс
        } else {
            paginationEl.classList.remove('hidden'); // Убираем класс
        }
    }
}
function addMaskInput() {
    $(function () {
        $.mask.definitions['9'] = '';
        $.mask.definitions['d'] = '[0-9]';
        $('input[type="tel"]').mask("+7 (ddd) ddd-dd-dd");
    });
    $.fn.setCursorPosition = function(pos) {
        if ($(this).get(0).setSelectionRange) {
          $(this).get(0).setSelectionRange(pos, pos);
        } else if ($(this).get(0).createTextRange) {
          var range = $(this).get(0).createTextRange();
          range.collapse(true);
          range.moveEnd('character', pos);
          range.moveStart('character', pos);
          range.select();
        }
    };
    $('input[type="tel"]').click(function(){
        $(this).setCursorPosition(4);  // set position number
    });
}
document.addEventListener('DOMContentLoaded', function () {
   addValidateForms();
});

$(document).ready(function () {
    $('.openFeedback').on('click', function() {

        let nameprod = $(this).attr('data-nameprod'),
            titleform = $(this).attr('data-titleform'),
            pageform = $(this).attr('data-pageform');
        $.ajax({
            url: BX.message('SITE_DIR') + 'ajax/feedback.php',
            method: 'GET',
            data: {
                nameprod: nameprod,
                titleform: titleform,
                pageform: pageform,
            },
            success: function(response) {
                $('#dialog-content').html(response);
                addMaskInput();
                addValidateForms();

                Fancybox.show([{
                    src: '#dialog-content',
                    type: 'inline'
                }], {
                    animated: true,
                    mainClass: "fancy-modal-form",
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX error:', textStatus, errorThrown);
            }
        });
    });

    $('.cards-news__name a').each(function () {
        const container = $(this);
        const fullText = container.text().trim();
        container.data('fulltext', fullText);
    
        // При клике показываем полный текст
        container.on('click', function () {
            container.text(fullText); // Показываем полный текст
        });
    });

    addMaskInput();

    if($('.banners-block .swiper-container').length){
        const swiperMainBanner = new Swiper('.banners-block .swiper-container', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            on: {
                init: function () { 
                    updatePaginationVisibility(this); 
                }, 
                paginationRender: function () {
                    const swiperContainer = document.querySelector('.swiper-container');
                    const paginationElement = document.querySelector('.swiper-pagination');

                    if (paginationElement && paginationElement.children.length > 0) {
                        swiperContainer.classList.add('has-pagination');
                    }
                },
                slideChange: function () {
                    const currentSlide = this.slides[this.activeIndex];
                    const header = document.querySelector('.header.header__inner');
        
                    if (currentSlide.classList.contains('slide-white')) {
                        header.classList.remove('header-dark');
                    } else {
                        header.classList.add('header-dark');
                    }
                },
                resize: function () { 
                    updatePaginationVisibility(this); 
                },
            },
            autoplay: {
                delay: 5000,
            },
        });
        
        updatePaginationVisibility(swiperMainBanner);
    }
    
    if($('.partners .swiper-container').length){
        const swiperPartners = new Swiper('.partners .swiper-container', {
            slidesPerView: 6,
            spaceBetween: 10,
            pagination: {
                el: '.partners .swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            breakpoints: {
                // when window width is >= 500px
                500: {
                    slidesPerView: 4,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 5,
                    spaceBetween: 10,
                },
                1200: {
                    slidesPerView: 6,
                    spaceBetween: 10,
                },

                0: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                }
            },
            on: {
                init: function () { 
                    updatePaginationVisibility(this); 
                }, 
                resize: function () { 
                    updatePaginationVisibility(this); 
                },
                slideChange: function () { 
                    updatePaginationVisibility(this); 
                } 
            }
        });
        updatePaginationVisibility(swiperPartners);
    }
    $('.header__search-mobile-btn').on('click', function (event) {
        $(this).hide();
        $('.header__logo').hide();
        $('.header__burger').hide();
		$('#header__search').appendTo('.header__search-head');
    });
    $('.search__close').on('click', function (event) {
        $('.header__burger').show();
        $('.header__search-mobile-btn').show();
        $('.header__logo').show();
		$('#header__search').appendTo('.header__mobile-search');
    });
    $('.header__burger').on('click', function (event) {
        $('.main-wrapper, .header, .header__burger, .header__mobile, .header__search-mobile-btn').toggleClass('active');
    });
    $('.header__mobile .parent-link-opened').on('click', function (){
        $(this).parent().next().toggleClass('active');
    });
    function adjustHeaderPadding() {
        const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
        $('.header__inner').css('padding-right', scrollbarWidth + 'px');
    }

    function resetHeaderPadding() {
        $('.header__inner').css('padding-right', '');
    }

    let objFancyboxDefaults = {
        AnimationEffect: "fade",
        mainClass: "fancy-modal-form",
        backFocus: false,
        on: {
            init: function () {
                adjustHeaderPadding();
            },
            destroy: function () {
                resetHeaderPadding();
            }
        }
    };

    // Fancybox.bind('.btn-default', objFancyboxDefaults);
    
    let productSettings = {
        ...objFancyboxDefaults,
        Thumbs: {
            type: "classic"
        }
    };
    
    Fancybox.bind('[data-fancybox="product"]', productSettings);



	chekMenu();
    $('.smart-filter__spoiler-btn').on('click', function () {
        $('.smart-filter__wrapper').toggleClass('active');
    });

    function updateNavigationVisibility(swiper) {
        const nextButton = document.querySelector(swiper.params.navigation.nextEl);
        const prevButton = document.querySelector(swiper.params.navigation.prevEl);
        const arrowsContainer = document.querySelector('.catalog-detail__arrows');
    
        if (nextButton && prevButton && arrowsContainer) {
            if (nextButton.classList.contains('swiper-button-disabled') && prevButton.classList.contains('swiper-button-disabled')) {
                arrowsContainer.style.display = 'none';
            } else {
                arrowsContainer.style.display = 'block';
            }
        }
    }

    const galleryThumbs = new Swiper('.catalog-detail__thumbnail-slider', {
        spaceBetween: 10,
        slidesPerView: 'auto',
        autoWidth: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        on: {
            init: function () {
                updateNavigationVisibility(this);
            },
            resize: function () {
                updateNavigationVisibility(this);
            },
            slideChange: function () {
                updateNavigationVisibility(this);
            },
            update: function () {
                updateNavigationVisibility(this);
            }
        }
    });
    
    const galleryTop = new Swiper('.catalog-detail__main-slider', {
        spaceBetween: 10,
        loop: false,
        effect: 'fade',
        fadeEffect: { 
            crossFade: false 
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: false,
            dynamicBullets: true,
            dynamicMainBullets: 2,
        },
        on: {
            init: function () { 
                galleryThumbs.update(); // Обновляем галерею миниатюр при инициализации
            },
        },
        thumbs: {
            swiper: galleryThumbs,
        },
    });

    $('.tabs__caption li').on('click', function() {
        var value = $(this).data('value');

        // Удаляем класс 'active' у всех вкладок и контента
        $('.tabs__caption li').removeClass('active');
        $('.tabs__content').hide().removeClass('active');

        // Добавляем класс 'active' для выбранной вкладки и соответствующего контента
        $(this).addClass('active');
        $('.tabs__content[data-value="' + value + '"]').show().addClass('active');
    });
    
    $('.table').wrap('<div class="big-table"></div>');
});

$(window).on('resize', function() {
	chekMenu();
});
