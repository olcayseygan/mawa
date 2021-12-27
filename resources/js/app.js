import * as $ from "jquery";
import "owl.carousel";

$(".film-category").owlCarousel({
    dots: false,
    nav: false,
    stagePadding: 72,
    responsive: {
        0: {
            items: 1
        },
        1280: {
            items: 5
        },
        1536: {
            items: 8
        }
    }
});