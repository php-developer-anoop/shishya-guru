<footer id="footer" class="footer">
  <div class="container footer-top">
    <div class="row gy-3">
      <div class="Popular-school col-lg-12">
        <div class="d-flex flex-column gap-3 ">
          <?php $boardPages=getFooterPageList('dt_boards_list');
            $classPages=getFooterPageList('dt_class_list');
            $subjectPages=getFooterPageList('dt_subject_list');
            ?>
          <div class="row">
            <h3>Find Home Tutor By Board</h3>
            <?php if(!empty($boardPages)){foreach($boardPages as $bpkey=>$bpvalue){?>
            <div class="col-sm-4 col-md-4 col-lg-4 pb-2 d-flex flex-row"><i class="bi bi-dot"></i><a class="w-100 d-flex" href="<?=!empty($bpvalue['slug'])?base_url($bpvalue['slug']):'javascript:void(0)'?>"><?=!empty($bpvalue['display_name'])?$bpvalue['display_name']:''?></a></div>
            <?php }} ?>
          </div>
          <div class="row ">
            <h3>Explore Home Tuition By Class</h3>
            <?php if(!empty($classPages)){foreach($classPages as $cpkey=>$cpvalue){?>
            <div class="col-sm-4 col-md-4 col-lg-4 pb-2 d-flex flex-row"><i class="bi bi-dot"></i><a class="w-100 d-flex" href="<?=!empty($cpvalue['slug'])?base_url($cpvalue['slug']):'javascript:void(0)'?>"><?=!empty($cpvalue['display_name'])?$cpvalue['display_name']:''?></a></div>
            <?php }} ?>
          </div>
          <div class="row">
            <h3>Discover Your Tuition Teacher By Subject</h3>
            <?php if(!empty($subjectPages)){foreach($subjectPages as $spkey=>$spvalue){?>
            <div class="col-sm-4 col-md-4 col-lg-4 pb-2 d-flex flex-row"><i class="bi bi-dot"></i><a class="w-100 d-flex" href="<?=!empty($spvalue['slug'])?base_url($spvalue['slug']):'javascript:void(0)'?>"><?=!empty($spvalue['display_name'])?$spvalue['display_name']:''?></a></div>
            <?php }} ?>
          </div>
          </ul>
        </div>
      </div>
      <div class="col-lg-3  footer-about  order-2">
        <div class="social-links d-flex mt-2 mb-3 mb-lg-0">
          <a href="<?=!empty($company['twitter_x_link'])?$company['twitter_x_link']:'javascript:void(0)'?>"><i class="bi bi-twitter"></i></a>
          <a href="<?=!empty($company['facebook_link'])?$company['facebook_link']:'javascript:void(0)'?>"><i class="bi bi-facebook"></i></a>
          <a href="<?=!empty($company['instagram_link'])?$company['instagram_link']:'javascript:void(0)'?>"><i class="bi bi-instagram"></i></a>
          <a href="<?=!empty($company['linkedin_link'])?$company['linkedin_link']:'javascript:void(0)'?>"><i class="bi bi-linkedin"></i></a>
          <a href="<?=!empty($company['youtube_link'])?$company['youtube_link']:'javascript:void(0)'?>"><i class="bi bi-youtube"></i></a>
        </div>
      </div>
      <div class="col-lg-9 col-12 footer-links order-1 mb-0">
        <ul class="d-flex flex-row gap-lg-2 gap-1  justify-content-start flex-wrap flex-lg-unwrap linner">
          <li><a href="<?=base_url('about-us')?>">About Us</a></li>
          <li><a href="<?=base_url('tutor-register')?>">Register as tutor</a></li>
          <li><a href="<?=base_url('terms-and-conditions')?>">Terms & Conditions</a></li>
          <li><a href="<?=base_url('privacy-policy')?>">Privacy policy</a></li>
          <li><a href="<?=base_url('faqs')?>">FAQ</a></li>
          <li><a href="<?=base_url('contact-us')?>">Contact Us</a></li>
          <li><a href="<?=base_url('sitemap.xml')?>">Sitemap</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="copyright text-center">
    <p><span>© <?=date('Y')?> Copyright Shishy Guru. All Rights Reserved & Developed By <a href="https://duplextech.com/" class="text-black">Duplex Technologies</a>.</span> </p>
  </div>
</footer>