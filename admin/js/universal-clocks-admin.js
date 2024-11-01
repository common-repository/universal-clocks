(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

$(document).ready(function(){
	/** Digital clock font family  **/
	$( "#post").submit(function( event ) {

		if( $('#timezone_offset').val() == '' ){
			$("#msg-timezone_offset").show();
			return false;
		}

	});
	$('#timezone_offset').on('change',function(){
		if( $('#timezone_offset').val() != '' )
			{
				$("#msg-timezone_offset").hide();
			}
		  }
		);
		/** Color picker **/
	$('.color-field').wpColorPicker();
		/** check clock type  **/
	$("input[name='clock_type']").on('change',function(){
		var clock_type = $("input[name='clock_type']:checked").val();
		if(clock_type == 'analog'){
			$('.analog-group').show();
			$('.digtal-group').hide();
		}
		else if(clock_type == 'digital'){
			$('.digtal-group').show();
			$('.analog-group').hide();
		}
	});
	$("input[name='clock_type']").trigger('change');


});


})( jQuery );
///**  Sidemeta Image Model  **///
	function openModal() {
        document.getElementById("ucamodel").style.display = "block";
  			  }
    function closeModal() {
        document.getElementById("ucamodel").style.display = "none";
    }
    var slideIndex = 1;
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }
    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("uca-model-slide");
        if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                slides[slideIndex-1].style.display = "block";
            }

    function openModal1() {
        document.getElementById("ucamodel1").style.display = "block";
  			  }
    function closeModal1() {
        document.getElementById("ucamodel1").style.display = "none";
    }
    var slideIndex = 2;
    function currentSlide1(n) {
        showSlides(slideIndex = n);
    }
    function showSlides1(n) {
        var i;
        var slides = document.getElementsByClassName("uca-model-slide1");
        if (n > slides.length) {slideIndex = 2}
            if (n < 1) {slideIndex = slides.length}
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                slides[slideIndex-2].style.display = "block";
            }
