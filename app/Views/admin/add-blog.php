<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="<?= base_url(ADMINPATH . 'dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active">
              <?= $menu ?>
            </li>
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
          <a href="<?= base_url(ADMINPATH . 'blog-list') ?>" class="btn btn-success m-auto"
            style="float:right;position:relative;">
          Blog List
          </a>
        </div>
        <div class="card-header">
          <?=form_open_multipart(base_url(ADMINPATH.'save-blog')); ?>
          <input type="hidden" name='id' value="<?=$id?>">
          <input type="hidden" name='old_banner_jpg_image' value="<?=$banner_image_jpg?>">
          <input type="hidden" name='old_banner_webp_image' value="<?=$banner_image_webp?>">
          <input type="hidden" name='old_blog_jpg_image' value="<?=$blog_image_jpg?>">
          <input type="hidden" name='old_blog_webp_image' value="<?=$blog_image_webp?>">
          <div class="row mt-2">
            <div class="col-sm-4">
              <?= form_label('Select Blog Category <span class="text-danger">*</span>', 'blog_category_id', ['class' => 'col-form-label']) ?>
              <select name="blog_category_id" id="blog_category_id" required class="form-control select2">
                <option value="">Select Blog Category</option>
                <?php if(!empty($blog_category_list)){foreach($blog_category_list as $bclkey=>$bclvalue){?>
                <option value="<?=$bclvalue['id']?>" <?=!empty($blog_category_id) && ($blog_category_id==$bclvalue['id'])?'selected':''?>><?=$bclvalue['blog_category_name']?></option>
                <?php }} ?>
              </select>
            </div>
            <div class="col-sm-4">
              <?= form_label('Blog Title <span class="text-danger">*</span>', 'blog_title', ['class' => 'col-form-label']) ?>
              <?= form_input(['name' => 'blog_title', 'required' => 'required','autocomplete'=>'off','onkeyup'=>"return getSlug(this.value,'slug')",'placeholder' => 'Enter Blog Title', 'id' => 'blog_title', 'class' => 'form-control','value'=>$blog_title]); ?>
            </div>
            <div class="col-sm-4">
              <?= form_label('Seo Slug <span class="text-danger">*</span>', 'slug', ['class' => 'col-form-label']) ?>
              <?= form_input(['name' => 'slug', 'required' => 'required','autocomplete'=>'off', 'placeholder' => 'Enter Seo Slug', 'id' => 'slug', 'class' => 'form-control','value'=>$slug]); ?>
            </div>
            <div class="col-sm-12">
              <label for="h1" class="col-form-label">H1 Heading<span class="text-danger">*</span></label>
              <?= form_input(['name' => 'h1', 'required' => 'required', 'placeholder' => 'Enter H1 Heading', 'id' => 'h1','autocomplete'=>'off', 'class' => 'form-control','value'=>$h1]); ?>
            </div>
            <div class="col-sm-12">
              <label for="meta_title" class="col-form-label">Meta Title<span class="text-danger">*</span></label>
              <?= form_input(['name' => 'meta_title', 'required' => 'required', 'maxlength'=>'70', 'placeholder' => 'Enter Meta Title','autocomplete'=>'off', 'id' => 'meta_title', 'class' => 'form-control','value'=>$meta_title]); ?>
            </div>
            <div class="col-sm-12">
              <label for="meta_description" class="col-form-label">Meta Description<span class="text-danger">*</span></label>
              <?= form_input(['name' => 'meta_description', 'required' => 'required','maxlength'=>'160', 'placeholder' => 'Enter Meta Description','autocomplete'=>'off', 'id' => 'meta_description', 'class' => 'form-control','value'=>$meta_description]); ?>
            </div>
            <div class="col-sm-12">
              <label for="meta_keyword" class="col-form-label">Meta Keyword<span class="text-danger">*</span></label>
              <?= form_input(['name' => 'meta_keyword', 'required' => 'required', 'placeholder' => 'Enter Meta Keyword', 'id' => 'meta_keyword','autocomplete'=>'off', 'class' => 'form-control','value'=>$meta_keyword]); ?>
            </div>
            <div class="col-sm-12">
              <label for="meta_schema" class="col-form-label">Meta Schema</label>
              <?= form_textarea(['name' => 'meta_schema', 'placeholder' => 'Enter Meta Schema','rows'=>'3', 'id' => 'meta_schema','autocomplete'=>'off', 'class' => 'form-control','value'=>$meta_schema]); ?>
            </div>
            <div class="col-sm-12">
              <label for="short_description" class="col-form-label">Short Description<span class="text-danger">*</span></label>
              <?= form_input(['name' => 'short_description', 'required' => 'required', 'placeholder' => 'Enter Short Description', 'id' => 'short_description','autocomplete'=>'off', 'class' => 'form-control','value'=>$short_description]); ?>
            </div>
            <div class="col-sm-12">
              <label for="description" class="col-form-label">Description<span class="text-danger">*</span></label>
              <textarea name="description" class="form-control" id="description"><?=$description?></textarea>
            </div>
            <div class="col-sm-12">
              <label for="faq_schema" class="col-form-label">FAQ Schema</label>
              <?= form_textarea(['name' => 'faq_schema','rows'=>'3','placeholder' => 'Enter FAQ Schema', 'id' => 'faq_schema','autocomplete'=>'off','readonly'=>'readonly', 'class' => 'form-control','value'=>$faq_schema]); ?>
            </div>
            <div class="col-sm-12 mt-2">
              <div class="input_field_wrapper">
                <?php if(!empty($faqs)){
                  $i=1;
                  foreach($faqs as $key=>$value){
                  ?>
                <div id="faq_<?=$value['id']?>" class="position-relative pb-5">
                  <div class="form-group row mb-3">
                    <label for="faq_question" class="col-sm-2 col-form-label">Question</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="faq_question" placeholder="Question" value="<?=$value['question']?>" name="faq_question[]" >
                    </div>
                  </div>
                  <div class="form-group row mb-3">
                    <label for="faq_answer" class="col-sm-2 col-form-label">Answer</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="faq_answer" placeholder="Answer" value="<?=$value['answer']?>" name="faq_answer[]">
                    </div>
                  </div>
                  <?php if($i==1){?>
                  <a href="javascript:void(0);" class="add_button btn btn-success btn-sm" style="position:absolute;right:0" title="Add field"><i class="fa fa-plus"></i></a>
                  <?php }else{?>
                  <a href="javascript:void(0);" class="btn btn-danger btn-sm" style="position:absolute;right:0" title="Remove field" id="bt_<?=$value['id']?>" onclick="del_faq(<?=$value['id']?>)"><i class="fa fa-minus"></i></a>
                  <?php } ?>
                </div>
                <?php $i++;} }else{ ?>
                <div class="position-relative pb-5">
                  <div class="form-group row mb-3">
                    <label for="faq_question" class="col-sm-2 col-form-label">Question</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="faq_question" placeholder="Question" value="" name="faq_question[]" >
                    </div>
                  </div>
                  <div class="form-group row mb-3">
                    <label for="faq_answer" class="col-sm-2 col-form-label">Answer</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="faq_answer" placeholder="Answer" value="" name="faq_answer[]">
                    </div>
                  </div>
                  <a href="javascript:void(0);" class="add_button btn btn-success btn-sm" style="position:absolute;right:0" title="Add field"><i class="fa fa-plus"></i></a>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-3">
              <label for="image" class="col-form-label">Banner Image</label>
              <?= form_upload([
                'name' => 'banner_image',
                'class' => 'form-control',
                
                'accept' => 'image/png, image/jpg, image/jpeg'
                ]); ?>
            </div>
            <div class="col-sm-3">
              <label for="banner_image_alt" class="col-form-label">Banner Image Alt</label>
              <?= form_input(['name' => 'banner_image_alt', 'autocomplete'=>'off', 'placeholder' => 'Enter Image Alt', 'id' => 'banner_image_alt', 'class' => 'form-control','value'=>$banner_image_alt]); ?>
            </div>
            <div class="col-sm-3">
              <?= form_label('Created By <span class="text-danger">*</span>', 'created_by', ['class' => 'col-form-label']) ?>
              <?= form_input(['name' => 'created_by','autocomplete'=>'off','required' => 'required', 'placeholder' => 'Enter Created By', 'id' => 'created_by', 'class' => 'form-control ucwords restrictedInput','value'=>$created_by]); ?>
            </div>
            <div class="col-sm-3">
              <?= form_label('Created Date <span class="text-danger">*</span>', 'created_date', ['class' => 'col-form-label']) ?>
              <?= form_input(['type'=>'date','name' => 'created_date','autocomplete'=>'off', 'required' => 'required', 'id' => 'created_date', 'class' => 'form-control ucwords restrictedInput','value'=>$created_date]); ?>
            </div>
            <?php if (!empty($banner_image_jpg)) { ?>
            <div class="col-sm-12">
              <img src="<?= base_url('uploads/') . $banner_image_jpg; ?>" height=70px width=100px>
            </div>
            <?php } ?>
            
            <div class="col-sm-3">
              <label for="blog_image" class="col-form-label">Blog Image</label>
              <?= form_upload([
                'name' => 'blog_image',
                'class' => 'form-control',
                
                'accept' => 'image/png, image/jpg, image/jpeg'
                ]); ?>
            </div>
            <?php if (!empty($blog_image_jpg)) { ?>
            <div class="col-sm-3">
              <img src="<?= base_url('uploads/') . $blog_image_jpg; ?>" height=70px width=100px>
            </div>
            <?php } ?>
            <div class="col-sm-3">
              <label for="blog_image_alt" class="col-form-label">Blog Image Alt</label>
              <?= form_input(['name' => 'blog_image_alt', 'autocomplete'=>'off', 'placeholder' => 'Enter Blog Image Alt', 'id' => 'blog_image_alt', 'class' => 'form-control','value'=>$blog_image_alt]); ?>
            </div>
           
            <div class="col-sm-12">
              <?=form_label('Status','status',['class'=>'col-form-label'])?>
              <div class="row mt-2">
                <div class="col-2">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input status" name="status" <?= ($status == 'Active') ? 'checked' : '' ?> type="radio" id="checkStatus1" value="Active" checked>
                    <?=form_label('Active','checkStatus1',['class'=>'custom-control-label'])?>
                  </div>
                </div>
                <div class="col-2">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input status" name="status" <?= ($status == 'Inactive') ? 'checked' : '' ?> type="radio" id="checkStatus2" value="Inactive">
                    <?=form_label('Inactive','checkStatus2',['class'=>'custom-control-label'])?>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
          <div class="form-group row mt-2">
            <div class="col-sm-12">
              <div class="custom-btn-group">
                <button type="submit" id="submit" class="btn btn-success">Submit</button>
              </div>
            </div>
          </div>
        </div>
        <?=form_close(); ?>
      </div>
    </div>
  </div>
</div>
</div>
<script>
  CKEDITOR.replace('description');
</script>