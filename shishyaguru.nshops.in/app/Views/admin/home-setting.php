<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="<?= base_url(ADMINPATH . 'dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active">
              <?= $title ?>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header">
          <?=form_open_multipart(ADMINPATH . 'save/homesetting'); ?>
          <?=form_hidden('id',!empty($home['id'])?$home['id']:"")?>
          <?=form_hidden('old_top_banner_jpg',!empty($home['top_banner_jpg'])?$home['top_banner_jpg']:"")?>
          <?=form_hidden('old_top_banner_webp',!empty($home['top_banner_webp'])?$home['top_banner_webp']:"")?>
          <?=form_hidden('old_mid_banner_jpg',!empty($home['mid_banner_jpg'])?$home['mid_banner_jpg']:"")?>
          <?=form_hidden('old_mid_banner_webp',!empty($home['mid_banner_webp'])?$home['mid_banner_webp']:"")?>
          <?=form_hidden('old_top_bg_image_jpg',!empty($home['top_bg_image_jpg'])?$home['top_bg_image_jpg']:"")?>
          <?=form_hidden('old_top_bg_image_webp',!empty($home['top_bg_image_webp'])?$home['top_bg_image_webp']:"")?>
          <?=form_hidden('old_free_demo_image_jpg',!empty($home['free_demo_image_jpg'])?$home['free_demo_image_jpg']:"")?>
          <?=form_hidden('old_free_demo_image_webp',!empty($home['free_demo_image_webp'])?$home['free_demo_image_webp']:"")?>
          <?=form_hidden('old_bottom_banner_jpg',!empty($home['bottom_banner_jpg_jpg'])?$home['bottom_banner_jpg_jpg']:"")?>
          <?=form_hidden('old_bottom_banner_webp',!empty($home['bottom_banner_jpg_webp'])?$home['bottom_banner_jpg_webp']:"")?>
          <div class="row">
          <div class="col-sm-12">
              <label for="meta_title" class="col-form-label">Meta Title</label>
              <?= form_input(['name' => 'meta_title', 'required' => 'required', 'maxlength'=>'70', 'placeholder' => 'Enter Meta Title','autocomplete'=>'off', 'id' => 'meta_title', 'class' => 'form-control','value'=>!empty($home['meta_title']) ? $home['meta_title']:'']); ?>
            </div>
            <div class="col-sm-12">
              <label for="meta_description" class="col-form-label">Meta Description</label>
              <?= form_input(['name' => 'meta_description', 'required' => 'required','maxlength'=>'160', 'placeholder' => 'Enter Meta Description','autocomplete'=>'off', 'id' => 'meta_description', 'class' => 'form-control','value'=>!empty($home['meta_description']) ? $home['meta_description']:'']); ?>
            </div>
            <div class="col-sm-12">
              <label for="meta_keyword" class="col-form-label">Meta Keyword</label>
              <?= form_input(['name' => 'meta_keyword', 'required' => 'required', 'placeholder' => 'Enter Meta Keyword', 'id' => 'meta_keyword','autocomplete'=>'off', 'class' => 'form-control','value'=>!empty($home['meta_keyword']) ? $home['meta_keyword']:'']); ?>
            </div>
            <div class="col-sm-6">
              <label for="top_heading" class="col-form-label">Top Heading</label>
              <?= form_input(['name' => 'top_heading', 'required' => 'required', 'placeholder' => 'Enter Top Heading', 'id' => 'top_heading', 'class' => 'form-control','autocomplete'=>'off','value'=>!empty($home['top_heading']) ? $home['top_heading']:'']); ?>
            </div>
            <div class="col-sm-6">
              <label for="class_group_heading" class="col-form-label">Class Group Heading</label>
              <?= form_input(['name' => 'class_group_heading', 'required' => 'required', 'placeholder' => 'Enter Class Group Heading', 'id' => 'class_group_heading', 'class' => 'form-control','autocomplete'=>'off','value'=>!empty($home['class_group_heading']) ? $home['class_group_heading']:'']); ?>
            </div>
            <div class="col-sm-6">
              <label for="subject_heading" class="col-form-label">Subject Heading</label>
              <?= form_input(['name' => 'subject_heading', 'required' => 'required', 'placeholder' => 'Enter Subject Heading', 'id' => 'subject_heading', 'class' => 'form-control','autocomplete'=>'off','value'=>!empty($home['subject_heading']) ? $home['subject_heading']:'']); ?>
            </div>
            <div class="col-sm-6">
              <label for="tutor_heading" class="col-form-label">Tutor Heading</label>
              <?= form_input(['name' => 'tutor_heading', 'required' => 'required', 'placeholder' => 'Enter Tutor Heading', 'id' => 'tutor_heading', 'class' => 'form-control','autocomplete'=>'off','value'=>!empty($home['tutor_heading']) ? $home['tutor_heading']:'']); ?>
            </div>
            <div class="col-sm-6">
              <label for="about_us_heading" class="col-form-label">About Us Heading</label>
              <?= form_input(['name' => 'about_us_heading', 'required' => 'required', 'placeholder' => 'Enter About Us Heading', 'id' => 'about_us_heading', 'class' => 'form-control','autocomplete'=>'off','value'=>!empty($home['about_us_heading']) ? $home['about_us_heading']:'']); ?>
            </div>
            <div class="col-sm-6">
              <label for="city_heading" class="col-form-label">City Heading</label>
              <?= form_input(['name' => 'city_heading', 'required' => 'required', 'placeholder' => 'Enter City Heading', 'id' => 'city_heading', 'class' => 'form-control','autocomplete'=>'off','value'=>!empty($home['city_heading']) ? $home['city_heading']:'']); ?>
            </div>
            <div class="col-sm-6">
              <label for="area_heading" class="col-form-label">Area Heading</label>
              <?= form_input(['name' => 'area_heading', 'required' => 'required', 'placeholder' => 'Enter Area Heading', 'id' => 'area_heading', 'class' => 'form-control','autocomplete'=>'off','value'=>!empty($home['area_heading']) ? $home['area_heading']:'']); ?>
            </div>
            <div class="col-sm-6">
              <label for="blogs_heading" class="col-form-label">Blogs Heading</label>
              <?= form_input(['name' => 'blogs_heading', 'required' => 'required', 'placeholder' => 'Enter Blogs Heading', 'id' => 'blogs_heading', 'class' => 'form-control','autocomplete'=>'off','value'=>!empty($home['blogs_heading']) ? $home['blogs_heading']:'']); ?>
            </div>
            <div class="col-sm-6">
              <label for="testimonial_heading" class="col-form-label">Testimonial Heading</label>
              <?= form_input(['name' => 'testimonial_heading', 'required' => 'required', 'placeholder' => 'Enter Testimonial Heading', 'id' => 'testimonial_heading', 'class' => 'form-control','autocomplete'=>'off','value'=>!empty($home['testimonial_heading']) ? $home['testimonial_heading']:'']); ?>
            </div>
            <div class="col-sm-12">
              <label for="about_us_description" class="col-form-label">About Us Description</label>
              <?= form_textarea(['name' => 'about_us_description', 'placeholder' => 'Enter About Us Description','rows'=>'3', 'id' => 'about_us_description','autocomplete'=>'off','class' => 'form-control','value'=>!empty($home['about_us_description']) ? $home['about_us_description']:'']); ?>
            </div>
            <div class="col-sm-12">
            <div class="about_wrapper">
            <?php if(!empty($about_list)){
              $i=0;
              foreach($about_list as $key=>$value){
                
            ?>
            <div id="about_<?=$key?>">
              <div class="row mt-2">
              <div class="col-sm-11">
                  <?= form_label('Abous Us Point <span class="text-danger">*</span>', 'about_us_point', ['class' => 'col-form-label']) ?>
                  <?= form_input(['name' => 'about_us_point[]', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter About Us Point', 'id' => 'about_us_point', 'class' => 'form-control','value'=> preg_replace("/[^a-zA-Z0-9\s]/", "", $value)]); ?>
                </div>
               
                <div class="col-sm-1">
                  <div class="d-flex justify-content-start align-items-end h-100 pb-1">
                    <?php if($i==0){ ?>
                      <a href="javascript:void(0);" class="add_about_button btn btn-success btn-sm" title="Add field"><i class="fa fa-plus"></i></a>
                    <?php } else { ?>
                      <a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Remove field" id="ab_<?=$key?>" onclick="del_about(<?=$key?>)"><i class="fa fa-minus"></i></a>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <?php $i++; } } else { ?>
              <div class="row mt-2">
                <div class="col-sm-11">
                  <?= form_label('Abous Us Point <span class="text-danger">*</span>', 'about_us_point', ['class' => 'col-form-label']) ?>
                  <?= form_input(['name' => 'about_us_point[]', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter About Us Point', 'id' => 'about_us_point', 'class' => 'form-control']); ?>
                </div>
                
                <div class="col-sm-1">
                  <div class="d-flex justify-content-start align-items-end h-100 pb-1">
                    <a href="javascript:void(0);" class="add_area_button btn-sm btn btn-success" title="Add field"><i class="fa fa-plus"></i></a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div></div>
            <div class="col-sm-3">
              <label for="top_banner" class="col-form-label">Top Banner</label>
              <?= form_upload([
                'name'        => 'top_banner',
                'class'       => 'form-control',
                'accept'      => 'image/png, image/jpg, image/jpeg' 
                ]); ?>
            </div>
            <div class="col-sm-3">
              <label for="top_banner_alt" class="col-form-label">Top Banner Image Alt</label>
              <?= form_input([
                'name'        => 'top_banner_alt',
                'required'    => 'required',
                'placeholder' => 'Top Banner Image Alt',
                'id'          => 'top_banner_alt',
                'class'       => 'form-control',
                'autocomplete'=>'off',
                'value'       =>!empty($home['top_banner_alt']) ? $home['top_banner_alt']:''
                ]); ?>
            </div>
            <div class="col-sm-3">
              <label for="mid_banner" class="col-form-label">Mid Banner</label>
              <?= form_upload([
                'name'        => 'mid_banner',
                'class'       => 'form-control',
                'accept'      => 'image/png, image/jpg, image/jpeg' 
                ]); ?>
            </div>
            <div class="col-sm-3">
              <label for="mid_banner_alt" class="col-form-label">Mid Banner Image Alt</label>
              <?= form_input([
                'name'        => 'mid_banner_alt',
                'required'    => 'required',
                'placeholder' => 'Mid Banner Image Alt',
                'id'          => 'mid_banner_alt',
                'class'       => 'form-control',
                'autocomplete'=> 'off',
                'value'       => !empty($home['mid_banner_alt']) ? $home['mid_banner_alt']:''
                ]); ?>
            </div>
            <?php if (!empty($home['top_banner_jpg'])) { ?>
            <div class="col-sm-3 mt-2">
              <img src="<?= base_url('uploads/') . $home['top_banner_jpg']; ?>" height="100px" width="100%" alt="Logo">
            </div>
            <?php } ?>
            <div class="col-sm-3">
            </div>
            <?php if (!empty($home['mid_banner_jpg'])) { ?>
            <div class="col-sm-3 mt-2">
              <img src="<?= base_url('uploads/') . $home['mid_banner_jpg'] ?>" height="100px" width="100%" alt="Image">
            </div>
            <?php } ?>
            <div class="col-sm-3">
            </div>
            <div class="col-sm-3">
              <label for="top_background" class="col-form-label">Top Background</label>
              <?= form_upload([
                'name'        => 'top_background',
                'class'       => 'form-control',
                'accept'      => 'image/png, image/jpg, image/jpeg' 
                ]); ?>
            </div>
            
            <div class="col-sm-3">
              <label for="top_bg_image_alt" class="col-form-label">Top Background Alt</label>
              <?= form_input([
                'name'        => 'top_bg_image_alt',
                'required'    => 'required',
                'placeholder' => 'Top Background Image Alt',
                'id'          => 'top_bg_image_alt',
                'class'       => 'form-control',
                'autocomplete'=>'off',
                'value'       =>!empty($home['top_bg_image_alt']) ? $home['top_bg_image_alt']:''
                ]); ?>
            </div>
            <div class="col-sm-3">
              <label for="free_demo_image" class="col-form-label">Free Demo Image</label>
              <?= form_upload([
                'name'        => 'free_demo_image',
                'class'       => 'form-control',
                'accept'      => 'image/png, image/jpg, image/jpeg' 
                ]); ?>
            </div>
           
            <div class="col-sm-3">
              <label for="free_demo_image_alt" class="col-form-label">Free Demo Image Alt</label>
              <?= form_input([
                'name'        => 'free_demo_image_alt',
                'required'    => 'required',
                'placeholder' => 'Free Demo Image Alt',
                'id'          => 'free_demo_image_alt',
                'class'       => 'form-control',
                'autocomplete'=>'off',
                'value'       =>!empty($home['free_demo_image_alt']) ? $home['free_demo_image_alt']:''
                ]); ?>
            </div>
            <?php if (!empty($home['top_bg_image_jpg'])) { ?>
            <div class="col-sm-3 mt-2">
              <img src="<?= base_url('uploads/') . $home['top_bg_image_jpg'] ?>" height="100px" width="100%" alt="Image">
            </div>
            <?php } ?>
            <div class="col-sm-3">
            </div>
            <?php if (!empty($home['free_demo_image_jpg'])) { ?>
            <div class="col-sm-3 mt-2">
              <img src="<?= base_url('uploads/') . $home['free_demo_image_jpg'] ?>" height="100px" width="100%" alt="Image">
            </div>
            <?php } ?>
            <div class="col-sm-3">
            </div>
            <div class="col-sm-3">
              <label for="bottom_banner" class="col-form-label">Bottom Banner</label>
              <?= form_upload([
                'name'        => 'bottom_banner',
                'class'       => 'form-control',
                'accept'      => 'image/png, image/jpg, image/jpeg' 
                ]); ?>
            </div>
            <?php if (!empty($home['bottom_banner_jpg'])) { ?>
            <div class="col-sm-3 mt-2">
              <img src="<?= base_url('uploads/') . $home['bottom_banner_jpg'] ?>" height="100px" width="100%" alt="Image">
            </div>
            <?php } ?>
            <div class="col-sm-3">
              <label for="bottom_banner_image_alt" class="col-form-label">Bottom Banner Alt</label>
              <?= form_input([
                'name'        => 'bottom_banner_image_alt',
                'required'    => 'required',
                'placeholder' => 'Bottom Banner Alt',
                'id'          => 'bottom_banner_image_alt',
                'class'       => 'form-control',
                'autocomplete'=>'off',
                'value'       =>!empty($home['bottom_banner_image_alt']) ? $home['bottom_banner_image_alt']:''
                ]); ?>
            </div>
            
          </div>
          <div class="form-group row mt-2">
            <div class="col-sm-12">
              <div class="custom-btn-group">
                <input type="submit" value="Submit" class="btn btn-success">
              </div>
            </div>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {
    const maxFieldLimit = 10;
    const addMoreButton = $('.add_about_button');
    const fieldWrapper = $('.about_wrapper');
    let fieldCounter = 1;

    // Event delegation for adding fields
    $(document).on('click', '.add_about_button', function () { 
        if (fieldCounter < maxFieldLimit) {
            fieldCounter++;
            const fieldHTML = `
                <div class="row mt-2">
                    <div class="col-sm-11">
                        <label for="about_us_point">About Us Point<span class="text-danger">*</span></label>
                        <input type="text" name="about_us_point[]" required="required" autocomplete="off" placeholder="Enter About Us Point" id="about_us_point" class="form-control">
                    </div>
                    <div class="col-sm-1">
                        <div class="d-flex justify-content-start align-items-end h-100 pb-1"> 
                            <a href="#" class="remove_about_button btn btn-danger btn-sm" title="Remove field"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                </div>`;
            
            $(fieldWrapper).append(fieldHTML);
        }
    });

    // Event delegation for removing fields
    $(fieldWrapper).on('click', '.remove_about_button', function (e) {
        e.preventDefault();
        $(this).closest('.row').remove(); // Use closest() instead of parent() to ensure proper removal
        fieldCounter--;
    });
});



function del_about(a) {
    $('#about_' + a).remove(); 
        $('#ab_' + a).remove(); 
}
</script>