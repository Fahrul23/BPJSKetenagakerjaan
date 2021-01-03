$(".elemet-carousel").owlCarousel({
    items: 5,
    loops: true,
    margin: 20,
    responsive: {
        0: {
            items: 2
        },
        768: {
            items: 3
        },
        1200: {
            items: 5
        }
    }
});