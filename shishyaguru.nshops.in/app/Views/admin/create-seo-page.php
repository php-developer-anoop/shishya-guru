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
        <?=form_open(ADMINPATH.'save-city-seo-page'); ?>
        <div class="card-header">
          <div class="row mt-2">
            <div class="col-sm-3">
              <?= form_label('Choose State <span class="text-danger">*</span>', 'state_id', ['class' => 'col-form-label']) ?>
              <select id="state_id" class="form-control select2" onchange="return getCities(this.value)">
                <option value="">Select State</option>
                <?php if(!empty($state_list)){foreach($state_list as $slkey=>$slvalue){?>
                <option value="<?=$slvalue['id']?>"><?=$slvalue['state_name']?></option>
                <?php }} ?>
              </select>
            </div>
            <div class="col-sm-3">
              <?= form_label('Choose City <span class="text-danger">*</span>', 'city_id', ['class' => 'col-form-label']) ?>
              <select name="city_id" id="city_id" class="form-control select2">
                <option value="" disabled>Choose City</option>
              </select>
            </div>
            <div class="col-sm-3">
              <?= form_label('Choose Type <span class="text-danger">*</span>', 'type', ['class' => 'col-form-label']) ?>
              <select name="type" id="type" class="form-control select2" onchange="getTypeList(this.value)">
                <option value="">Choose Type</option>
                <option value="dt_boards_list">Board</option>
                <option value="dt_class_list">Class</option>
                <option value="dt_subject_list">Subject</option>
              </select>
            </div>
            <div class="col-sm-3">
              <?= form_label('Choose Option <span class="text-danger">*</span>', 'type_id', ['class' => 'col-form-label']) ?>
              <select name="type_id" id="type_id" class="form-control select2">
                <option value="" disabled>Choose Option</option>
              </select>
            </div>
          </div>
        </div>
        <div class="card-body" id="append_list"></div>
        <div class="row ml-2 mb-2">
          <div class="col-sm-12">
            <div class="custom-btn-group">
              <button type="submit" id="submit" onclick="return validateSeoPage()" class="btn btn-success">Submit</button>
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
    function validateSeoPage() {
    var state_id = $('#state_id').val();
    var type = $('#type').val();
    var type_id = $('#type_id').val();

    if (state_id === "") {
        toastr.error("Please Select State");
        return false;
    } else if (type === "") {
        toastr.error("Please Select Type");
        return false;
    } else if (type_id === "") {
        toastr.error("Please Select Type Value");
        return false;
    } 
    return true;
}


function getCities(id,city_id=null){
        
        $('#city_id').html('');
        $.ajax({
            url: '<?= base_url(ADMINPATH.'getCities') ?>',
            method: 'POST',
            data: { state_id: id ,city_id:city_id},
            success: function (response) {
                $('#city_id').html(response);
                
            }
        });
        }

function getTypeList(type){
    $('#type_id').html('');
        $.ajax({
            url: '<?= base_url(ADMINPATH.'getTypeList') ?>',
            method: 'POST',
            data: { type: type },
            success: function (response) {
                $('#type_id').html(response);
                
            }
        });
}


$('#state_id').on('change',function(){
    $('#append_list').html('');
    var state_id = $('#state_id').val();
    
        $.ajax({
            url: '<?= base_url(ADMINPATH.'getList') ?>',
            method: 'POST',
            data: { type: 'State',id:state_id },
            success: function (response) {
                $('#append_list').html(response);
                
            }
        });
});
$('#city_id').on('change', function() {
    $('#append_list').html('');
    var city_id = $('#city_id').val();
    if (city_id == "") {
        var state_id = $('#state_id').val();
        $.ajax({
            url: '<?= base_url(ADMINPATH.'getList') ?>',
            method: 'POST',
            data: { type: 'State', id: state_id },
            success: function(response) {
                $('#append_list').html(response);
            }
        });
    } else {
        $.ajax({
            url: '<?= base_url(ADMINPATH.'getList') ?>',
            method: 'POST',
            data: { type: 'City', id: city_id },
            success: function(response) {
                $('#append_list').html(response);
            }
        });
    }
});


</script>