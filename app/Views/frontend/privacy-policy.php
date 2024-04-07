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
  <div class="about-section">
    <h1><?=!empty($page['h1'])?$page['h1']:''?></h1>
    <div>
      <?=!empty($page['description'])?$page['description']:''?>
    </div>
  </div>
</main>