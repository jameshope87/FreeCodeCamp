$(document).ready(function carouselNormalization() {
  var items = $("#tributecarousel .image"), //grab all slides
    heights = [], //create empty array to store height values
    shortest; //create variable to make note of the tallest slide
  console.log(heights);
  
  if (items.length) {
    function normalizeHeights() {
      items.each(function() {
        console.log($(this).height())
        //add heights to array
        heights.push($(this).height());
      });
      shortest = Math.min.apply(null, heights); //cache largest value
      items.each(function() {
        $(this).css("max-height", shortest + "px");
      });
    }
    console.log(heights);
    console.log(shortest);
    $(window).on("resize orientationchange", function() {
      (shortest = 0), (heights.length = 0); //reset vars
      console.log(heights);
      items.each(function() {
        $(this).css("max-height", "auto"); //reset max-height
      });
      normalizeHeights(); //run it again
      console.log(heights);
    });
  }
});