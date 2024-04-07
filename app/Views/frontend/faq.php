<section class="breadcrumbs-sec">
  <div class="page-title">
    <nav class="breadcrumbs">
      <div class="extratitle-bredcrum">
        <ol>
          <li><a href="<?=base_url()?>">Home</a></li>
          <i class="fa-solid fa-chevron-right"></i>
          <li class="current"><?=!empty($page['page_name'])?$page['page_name']:''?></li>
        </ol>
      </div>
    </nav>
    <?php $bgimage = !empty($page['banner_image_jpg'] || $page['banner_image_webp']) ? base_url('uploads/') . imgExtension($page['banner_image_jpg'], $page['banner_image_webp']) : "";
      ?>
    <section class="registration content-section p-0 text-center">
      <img src="<?=$bgimage?>" alt="<?=!empty($page['banner_image_alt'])?$page['banner_image_alt']:''?>" class="img-fluid">
    </section>
  </div>
</section>
<main class="about-Sec">
  <?php if(!empty($faq_list)){?>
  <section id="faq" class="faq section-bg">
    <div class="">
      <div class="faq-list p-0 ">
        <h3 class="heading"><?=!empty($page['h1'])?$page['h1']:''?></h3>
        <ul class="faq-list">
          <?php foreach($faq_list as $key=>$value){ ?>
          <li>
            <i class="bx bx-help-circle icon-help"></i>
            <a data-bs-toggle="collapse" class="<?=$key!=0?"collapsed":""?>" data-bs-target="#faq-list-<?php echo $key; ?>">
            <span class="accodiant_itmeheding"><?php echo $value['question']; ?></span>
            <i class="fa-solid fa-circle-minus icon-close"></i>
            <i class="fa-solid fa-circle-plus icon-show"></i>
            </a>
            <div id="faq-list-<?php echo $key; ?>" class="collapse <?php echo $key == 0 ? 'show' : ''; ?>" data-bs-parent=".faq-list">
              <p><?php echo $value['answer']; ?></p>
            </div>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </section>
  <?php } ?>
  <!-- End Frequently Asked Questions Section -->
</main>