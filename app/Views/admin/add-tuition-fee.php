<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="<?= base_url(ADMINPATH . 'dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active"><?= $menu ?></li>
            <li class="breadcrumb-item active"><?= $title ?></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header">
          <a href="<?= base_url(ADMINPATH . 'tuition-fee-list') ?>" class="btn btn-success m-auto" style="float:right;position:relative;">Tuition Fee List</a>
        </div>
        <div class="card-body">
          <?= form_open(base_url(ADMINPATH.'save-tuition-fee')); ?>
          <input type="hidden" name="state_id" id="state_id" value="<?= $state_id ?>">
          <input type="hidden" name="class_id" id="class_id" value="<?= $class_id ?>">
          <div class="row mt-2">
            <div class="col-sm-2"></div>
            <div class="col-sm-4">
              <label for="state_id" class="col-form-label">Select State</label>
              <select name="state_id" id="state_id" required class="form-control select2">
                <option value="">Select State</option>
                <?php if(!empty($state_list)){foreach($state_list as $skey=>$svalue){?>
                <option value="<?=$svalue['id']?>" <?=!empty($state_id) && ($state_id==$svalue['id'])?'selected':''?>><?=$svalue['state_name']?></option>
                <?php }} ?>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="class_id" class="col-form-label">Select Class</label>
              <select name="class_id" id="class_id" required class="form-control select2">
                <option value="">Select Class</option>
                <?php if(!empty($class_list)){foreach($class_list as $ckey=>$cvalue){?>
                <option value="<?=$cvalue['id']?>" <?=!empty($class_id) && ($class_id==$cvalue['id'])?'selected':''?>><?=$cvalue['class_name']?></option>
                <?php }} ?>
              </select>
            </div>
            <div class="col-sm-2"></div>
          </div>
          <div class="fee_field_wrapper">
            <?php if(!empty($fee_list)){
              $i=0;
              
              foreach($fee_list as $key=>$value){
                
              ?>
            <div id="fee_<?=$value['id']?>">
              <div class="row mt-2">
                <div class="col-sm-2"></div>
                <div class="col-sm-3">
                  <?= form_label('Fee Head <span class="text-danger">*</span>', 'fee_head', ['class' => 'col-form-label']) ?>
                  <?= form_input(['name' => 'fee_head[]', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Fee Head', 'id' => 'fee_head', 'class' => 'form-control ucwords restrictedInput','value'=>$value['fee_head']]); ?>
                </div>
                <div class="col-sm-2">
                  <?= form_label('Fee <span class="text-danger">*</span>', 'fee', ['class' => 'col-form-label']) ?>
                  <?= form_input(['name' => 'fee[]', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Fee Head', 'id' => 'fee', 'class' => 'form-control numbersWithZeroOnlyInput','value'=>$value['fee']]); ?>
                </div>
                <div class="col-sm-3">
                  <?= form_label('Duration <span class="text-danger">*</span>', 'duration', ['class' => 'col-form-label']) ?>
                  <?= form_input(['name' => 'duration[]', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Duration', 'id' => 'duration', 'class' => 'form-control','value'=>$value['duration']]); ?>
                </div>
                <div class="col-sm-1">
                  <div class="d-flex justify-content-start align-items-end h-100 pb-1">
                    <?php if($i==0){ ?>
                    <a href="javascript:void(0);" class="fee_add_button btn btn-success btn-sm" title="Add field"><i class="fa fa-plus"></i></a>
                    <?php } else { ?>
                    <a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Remove field" id="fe_<?=$value['id']?>" onclick="del_fee(<?=$value['id']?>)"><i class="fa fa-minus"></i></a>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <?php $i++; } } else { ?>
            <div class="row mt-2">
              <div class="col-sm-2"></div>
              <div class="col-sm-3">
                <?= form_label('Fee Head <span class="text-danger">*</span>', 'fee_head', ['class' => 'col-form-label']) ?>
                <?= form_input(['name' => 'fee_head[]', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Fee Head', 'id' => 'fee_head', 'class' => 'form-control ucwords restrictedInput']); ?>
              </div>
              <div class="col-sm-2">
                <?= form_label('Fee <span class="text-danger">*</span>', 'fee', ['class' => 'col-form-label']) ?>
                <?= form_input(['name' => 'fee[]', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Fee', 'id' => 'fee', 'class' => 'form-control numbersWithZeroOnlyInput']); ?>
              </div>
              <div class="col-sm-3">
                <?= form_label('Duration <span class="text-danger">*</span>', 'duration', ['class' => 'col-form-label']) ?>
                <?= form_input(['name' => 'duration[]', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Duration', 'id' => 'duration', 'class' => 'form-control']); ?>
              </div>
              <div class="col-sm-1">
                <div class="d-flex justify-content-start align-items-end h-100 pb-1">
                  <a href="javascript:void(0);" class="fee_add_button btn-sm btn btn-success" title="Add field"><i class="fa fa-plus"></i></a>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
          <div class="form-group row mt-2 ">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
              <div class="custom-btn-group">
                <button type="submit" id="submit" class="btn btn-success">Submit</button>
              </div>
            </div>
          </div>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  
  $(document).ready(function () {
    const maxFieldLimit = 10;
    const fieldWrapper = $('.fee_field_wrapper');
    let fieldCounter = 1; // Adjust fieldCounter based on existing fields

    $(document).on('click', '.fee_add_button', function () { // Corrected the class name for event delegation
        if (fieldCounter < maxFieldLimit) {
            fieldCounter++;
            const fieldHTML = `
                <div class="fee_div">
                    <div class="row mt-2">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-3">
                            <?= form_label('Fee Head <span class="text-danger">*</span>', 'fee_head', ['class' => 'col-form-label']) ?>
                            <?= form_input(['name' => 'fee_head[]', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Fee Head', 'id' => 'fee_head', 'class' => 'form-control ucwords restrictedInput']); ?>
                        </div>
                        <div class="col-sm-2">
                            <?= form_label('Fee <span class="text-danger">*</span>', 'fee', ['class' => 'col-form-label']) ?>
                            <?= form_input(['name' => 'fee[]', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Fee', 'id' => 'fee', 'class' => 'form-control numbersWithZeroOnlyInput']); ?>
                        </div>
                        <div class="col-sm-3">
                            <?= form_label('Duration <span class="text-danger">*</span>', 'duration', ['class' => 'col-form-label']) ?>
                            <?= form_input(['name' => 'duration[]', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Duration', 'id' => 'duration', 'class' => 'form-control']); ?>
                        </div>
                        <div class="col-sm-1">
                            <div class="d-flex justify-content-start align-items-end h-100 pb-1">
                            <a href="javascript:void(0);" class="remove_fee_button btn btn-danger btn-sm" title="Remove field"><i class="fa fa-minus"></i></a>
                            </div>
                        </div>
                    </div>
                    
                </div>`;
            
            fieldWrapper.append(fieldHTML);
        }
    });

    fieldWrapper.on('click', '.remove_fee_button', function (e) { // Corrected event delegation to fieldWrapper
        e.preventDefault();
        $(this).closest('.fee_div').remove(); // Changed parent() to closest() for more flexibility
        fieldCounter--;
    });
});



function del_fee(a) {
    $.ajax({
      url: '<?= base_url(ADMINPATH.'delFees') ?>',
      type: "POST",
      data: { 'id': a },
      cache: false,
      success: function (response) {
        $('#fee_' + a).remove(); 
        $('#fe_' + a).remove(); 
        toastr.success('Fee Deleted Successfully');
        setTimeout(function() {
             window.location.reload();
            },500);
      }
    });
}

</script>