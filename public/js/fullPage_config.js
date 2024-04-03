$(document).ready(function () {

    function changeColor(index, slider) {
        if (index == 3) {
            $("#navall").find(".icon_navbar").addClass("red");
            $(".main-logo").src = "../img/EB-logo-red.png";
        } else {
            $("#navall").find(".icon_navbar").removeClass("red");
            $(".main-logo").src = "../img/EB-logo-white.png";
        }


    }

    $("#fullpage").fullpage({
            verticalCentered: false,
            scrollHorizontally: true,
            slidesNavigation: false,
            slidesNavPosition: false,
            fitToSection: true,
            fitToSectionDelay: 1000,
            css3: true,
            anchors: ["page1", "page2", "page3", "page4", "page5", "page6", "page7"],
            sectionsColor: ["", "#bc0c26", "#fff", "#F0F2F4", "#F0F2F4", "#F0F2F4", "#F0F2F4"],
            navigation: false,
            responsiveWidth: 0,
            responsiveHeight: 0,
            responsiveSlides: true,
            resetSliders: true,
            controlArrows: false,
            scrollOverflow: false,
            interlockedSlides: [1, 3],
            scrollOverflowReset: true,
            navigationPosition: "right",
            normalScrollElements: '#slider2, .element',
            navigationTooltips: ["HOME", "SOBRE O EVENTO", "PROGRAMAÇÃO", "COMISSÃO ORGANIZADORA", "INVESTIMENTO", "ORGANIZAÇÃO", "CONTATO"],
            resize: true,
            afterSlideLoad: function (anchorLink, index, slideAnchor, slideIndex) {
                $('.nav__item.active').removeClass('active');
                $('.nav__item').eq(slideIndex).addClass('active');

                if (index == 2 && slideIndex == 1) {
                    $("#section2").find(".left_arrow").addClass("aparecer");

                } else {
                    $("#section2").find(".left_arrow").removeClass("aparecer");
                }

                if (index == 2 && slideIndex == 1) {
                    $("#section2").find(".right_arrow").addClass("sumir");
                } else {
                    $("#section2").find(".right_arrow").removeClass("sumir");

                }

                if (index == 5 && slideIndex == 1) {
                    $("#section5").find(".left_arrow").addClass("aparecer");

                } else {
                    $("#section5").find(".left_arrow").removeClass("aparecer");

                }

                if (index == 5 && slideIndex == 1) {
                    $("#section5").find(".right_arrow").addClass("sumir");
                    $("#navall").find(".icon_navbar").removeClass("red");

                } else {
                    $("#section5").find(".right_arrow").removeClass("sumir");

                }





            },

            onSlideLeave: function (anchorLink, index, slideAnchor, slideIndex) {

                if (anchorLink == 'page5' && slideIndex == 1) {
                    $("#navall").find(".icon_navbar").removeClass("red");
                } else {
                    $("#navall").find(".icon_navbar").addClass("red");
                }

            },
            afterLoad: function (anchorLink, index) {

                /*mudar de cor do logo e  do hamburger*/

                if (index == 3 || index == 5) {
                    $("#navall").find(".icon_navbar").addClass("red");
                    $("#navall").find(".main-logo").attr("src", "img/EB-logo-red.png");
                } else {
                    $("#navall").find(".icon_navbar").removeClass("red");
                    $("#navall").find(".main-logo").attr("src", "img/EB-logo-white.png");
                }


            },
            onLeave: function (index, nextIndex, direction) {

                if (nextIndex == 1 ) {
                    var vid = document.getElementById("myVideo");
                    vid.autoplay = true;
                    vid.load(); 
                }


                /*mudar de cor do logo e  do hamburger*/
                if (nextIndex == 3 || nextIndex == 5) {
                    $("#navall").find(".icon_navbar").addClass("red");
                    $("#navall").find(".main-logo").attr("src", "img/EB-logo-red.png");

                    if (direction == "right") {
                        $("#navall").find(".icon_navbar").removeClass("red");
                    }

                } else {
                    $("#navall").find(".icon_navbar").removeClass("red");
                    $("#navall").find(".main-logo").attr("src", "img/EB-logo-white.png");
                }

            },
            afterResize: function () {

            },
        }),
        $.fn.fullpage.setAutoScrolling = function (o) {
            options.autoScrolling = o;
            var a = $(".fp-section.active");
            options.autoScrolling ? ($("html, body").css({
                overflow: "hidden",
                height: "100%"
            }), container.css({
                "-ms-touch-action": "none",
                "touch-action": "none"
            }), a.length && silentScroll(a.position().top)) : ($("html, body").css({
                overflow: "visible",
                height: "initial"
            }), container.css({
                "-ms-touch-action": "",
                "touch-action": ""
            }), silentScroll(0), $("html, body").scrollTop(a.position().top))
        }

    $(".fechar-r").on("click", function () {
        UIkit.offcanvas('#offcanvas-nav-primary').hide();
    });



    const canvas = document.querySelector('#border-canvas');
    const ctx = canvas.getContext('2d')

    function render() {
        const w = window.innerWidth;
        const h = window.innerHeight;
        canvas.width = w;
        canvas.height = h;
        ctx.globalCompositeOperation = 'source-over';

        ctx.clearRect(0, 0, w, h);
        ctx.fillStyle = '#bc0c26';
        ctx.beginPath();
        ctx.rect(0, 0, w, h);
        ctx.fill();

        ctx.globalCompositeOperation = 'destination-out';
        ctx.fillStyle = '#000000';
        ctx.beginPath();

        ctx.arc((w - (w * 0.026)) - (h * 0.65), (h / 2), h * 0.65, 0, 2 * Math.PI);
        ctx.fill();
        ctx.clearRect(0, 0, (w - (w * 0.026)) - (h * 0.65), h);

        requestAnimationFrame(render);
    }


    render();
});