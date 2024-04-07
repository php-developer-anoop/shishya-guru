<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?=script_tag(base_url('assets/plugins/toastr/toastr.min.js'))."\n"?>
<?=script_tag(base_url('assets/plugins/select2/js/select2.full.min.js'))."\n"?>
<?=script_tag(base_url('assets/common.js'))?>
<script src="<?=base_url()?>assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>assets/frontend/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?=base_url()?>assets/frontend/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="<?=base_url()?>assets/frontend/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?=base_url()?>assets/frontend/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?=base_url()?>assets/frontend/vendor/aos/aos.js"></script>
<script src="<?=base_url()?>assets/frontend/vendor/php-email-form/validate.js"></script>
<script src="<?=base_url()?>assets/frontend/js/main.js"></script>
<script src="<?=base_url()?>assets/frontend/js/script.js"></script>
<?=script_tag('https://unpkg.com/sweetalert/dist/sweetalert.min.js')."\n"?>
<script>
        <?php if (session()->getFlashdata('success')) { ?>
			setTimeout(function () {
				toastr.success('<?php echo session()->getFlashdata('success'); ?>')
			}, 1000);
		<?php } ?>
		<?php if (session()->getFlashdata('failed')) { ?>
			setTimeout(function () {
				toastr.error('<?php echo session()->getFlashdata('failed'); ?>.')
			}, 1000);
		<?php } ?>
		
		$(document).ready(function() {
		   $('#stars li').on('click', function() {
		      var onStar = parseInt($(this).data('value'), 10); // The star currently selected
		      var stars = $(this).parent().children('li.star');
		      for (i = 0; i < stars.length; i++) {
		         $(stars[i]).removeClass('selected');
		      }
		      for (i = 0; i < onStar; i++) {
		         $(stars[i]).addClass('selected');
		      }
		   });
		});
		var swiper = new Swiper(".blog-contentslider", {
		   slidesPerView: 3,
		   spaceBetween: 25,
		   loop: true,
		   centerSlide: 'true',
		   fade: 'true',
		   grabCursor: 'true',
		   pagination: {
		      el: ".swiper-pagination",
		      clickable: true,
		      dynamicBullets: true,
		   },
		   navigation: {
		      nextEl: ".swiper-button-next",
		      prevEl: ".swiper-button-prev",
		   },
		   breakpoints: {
		      0: {
		         slidesPerView: 1,
		      },
		      520: {
		         slidesPerView: 2,
		      },
		      950: {
		         slidesPerView: 3,
		      },
		   },
		});
		var swiper = new Swiper(".slide-content", {
		   slidesPerView: 4,
		   spaceBetween: 25,
		   loop: true,
		   centerSlide: 'true',
		   fade: 'true',
		   grabCursor: 'true',
		   pagination: {
		      el: ".swiper-pagination",
		      clickable: true,
		      dynamicBullets: true,
		   },
		   navigation: {
		      nextEl: ".swiper-button-next",
		      prevEl: ".swiper-button-prev",
		   },
		   breakpoints: {
		      0: {
		         slidesPerView: 1,
		      },
		      520: {
		         slidesPerView: 2,
		      },
		      950: {
		         slidesPerView: 4,
		      },
		   },
		});
		var swiper = new Swiper(".slider-contentslider", {
		   slidesPerView: 4,
		   spaceBetween: 25,
		   loop: true,
		   centerSlide: 'true',
		   fade: 'true',
		   grabCursor: 'true',
		   pagination: {
		      el: ".swiper-pagination",
		      clickable: true,
		      dynamicBullets: true,
		   },
		   navigation: {
		      nextEl: ".swiper-button-next",
		      prevEl: ".swiper-button-prev",
		   },
		   breakpoints: {
		      0: {
		         slidesPerView: 1,
		      },
		      520: {
		         slidesPerView: 2,
		      },
		      950: {
		         slidesPerView: 4,
		      },
		   },
		});
		var swiper = new Swiper(".blog-listingPageslider", {
		   slidesPerView: 1,
		   spaceBetween: 165,
		   loop: true,
		   centerSlide: true,
		   parallax: true,
		   autoplay: 1000, // Change autoplay value to your desired delay
		   autoplayDisableOnInteraction: false,
		   speed: 800,
		   fade: true,
		   grabCursor: true,
		   pagination: {
		      el: ".swiper-pagination",
		      clickable: true,
		      dynamicBullets: true,
		   },
		   navigation: {
		      nextEl: ".swiper-button-next",
		      prevEl: ".swiper-button-prev",
		   },
		   breakpoints: {
		      0: {
		         slidesPerView: 1,
		      },
		      520: {
		         slidesPerView: 1,
		      },
		      950: {
		         slidesPerView: 1,
		      },
		   },
		});
		// Read more section start
		document.addEventListener("DOMContentLoaded", function() {
		   var moreLessButton = document.querySelector('.moreless-button');
		   var moreText = document.querySelector('.moretext');
		   moreLessButton.addEventListener('click', function() {
		      console.log(moreLessButton);
		      console.log(moreText);
		      moreText.classList.toggle('visible');
		      if (moreLessButton.textContent === "Read More") {
		         moreLessButton.textContent = "Read Less";
		      } else {
		         moreLessButton.textContent = "Read More";
		      }
		   });
		});
		// Read more section end
		var swiper = new Swiper(".slider-contentslider", {
		   slidesPerView: 4,
		   spaceBetween: 25,
		   loop: true,
		   centerSlide: 'true',
		   fade: 'true',
		   grabCursor: 'true',
		   pagination: {
		      el: ".swiper-pagination",
		      clickable: true,
		      dynamicBullets: true,
		   },
		   navigation: {
		      nextEl: ".swiper-button-next",
		      prevEl: ".swiper-button-prev",
		   },
		   breakpoints: {
		      0: {
		         slidesPerView: 1,
		      },
		      520: {
		         slidesPerView: 2,
		      },
		      950: {
		         slidesPerView: 5,
		      },
		   },
		});
		jQuery(document).ready(function($) {
		   $('.rating .star').hover(function() {
		      $(this).addClass('to_rate');
		      $(this).parent().find('.star:lt(' + $(this).index() + ')').addClass('to_rate');
		      $(this).parent().find('.star:gt(' + $(this).index() + ')').addClass('no_to_rate');
		   }).mouseout(function() {
		      $(this).parent().find('.star').removeClass('to_rate');
		      $(this).parent().find('.star:gt(' + $(this).index() + ')').removeClass('no_to_rate');
		   }).click(function() {
		      $(this).removeClass('to_rate').addClass('rated');
		      $(this).parent().find('.star:lt(' + $(this).index() + ')').removeClass('to_rate').addClass('rated');
		      $(this).parent().find('.star:gt(' + $(this).index() + ')').removeClass('no_to_rate').removeClass('rated');
		      /*Save your rate*/
		      /*TODO*/
		   });
		});


function getRandomCaptcha(){
    $.ajax({
       url: "<?=base_url('getRandomCaptcha')?>",
       cache: false,
       method: 'POST',
       success: function(html) {
           $('.csrf').val(html);
           $('.bgreprat').html(html);
           
       }
   });
  }

  
// $(document).ready(function() {
//   $(".activer").click(function(event) {
//     event.stopPropagation();
//     $(this).addClass("show");
//   });

//   $('.inputerer').on('input', function() {
//     $('#appendCitySearch').html('');
//     var inputVal = $(this).val().trim();
//     $.ajax({
//       url: "<?php //base_url('getCity')?>",
//       cache: false,
//       data: {keyword: inputVal},
//       method: 'POST',
//       success: function(response) {
//         $('#appendCitySearch').html(response);
//       }
//     });
//     if (inputVal === '') {
//       $('.headerer').removeClass('active');
//     } else {
//       $('.headerer').addClass('active');
//     }
//   });
// });
//   function gotoCity(url,value) {
//     if (url && typeof url === 'string') {
//       $('.inputerer').val(value);
//       $('#appendCard').html('');
//       $('#appendCitySearch').html('');
//     }
//   }

let digitValidate = function(ele) {
   ele.value = ele.value.replace(/[^0-9]/g, '');
  }
  
  let tabChange = function(val) {
   let ele = document.querySelectorAll('input.otp');
   if (ele[val - 1].value != '') {
     ele[val].focus()
   } else if (ele[val - 1].value == '') {
     ele[val - 2].focus()
   }
  }

</script>