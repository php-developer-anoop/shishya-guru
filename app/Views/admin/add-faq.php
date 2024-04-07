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
          <a href="<?= base_url(ADMINPATH . 'faq-list') ?>" class="btn btn-success m-auto"
            style="float:right;position:relative;">
          FAQ List
          </a>
        </div>
        <div class="card-header">
          <?=form_open(ADMINPATH . 'save-faq'); ?>
          <input type="hidden" name="table_id" value="<?= $table_id ?>">
          <input type="hidden" name="table_name" value="<?= $table_name ?>">
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
