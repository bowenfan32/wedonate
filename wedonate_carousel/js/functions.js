var swiper = new Swiper('.swiper-container', {
    effect: 'coverflow',
    centeredSlides: true,
    slidesPerView: 'auto',
    paginationClickable: true,
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
    spaceBetween: 30,
    coverflow: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows : true
    }
});

$(document).ready(function() {

    $(".carousel-cause .image").click(function(){

        $(".carousel-cause .image").removeClass('selected');
        $("#"+this.id).addClass('selected');

    });


});