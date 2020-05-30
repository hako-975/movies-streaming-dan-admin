$(document).ready(function(){
  $(".owl-carousel").owlCarousel({
  	items: 6,
  	margin: 20,
  	responsive : {
    0 : {
  		items: 3,
  		margin: 10,
    },
    // breakpoint from 768 up
    992 : {
		items: 6,
  		margin: 20,
    }
}
  });
});