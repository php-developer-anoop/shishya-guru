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
          <a href="<?= base_url(ADMINPATH . 'lead-list') ?>" class="btn btn-success m-auto" style="float:right;position:relative;">
          Lead List
          </a>
        </div>
        <div class="card-body">
          <?= form_open(); ?>
          <input type="hidden" id='lead_id' value="<?= $id ?>">
          <div class="row mt-2">
            <div class="col-sm-3">
              <?= form_label('Select State<span class="text-danger">*</span>', 'state_id', ['class' => 'col-form-label']) ?>
              <select name="state_id" id="state_id" class="form-control select2" required onchange="getCities(this.value, '<?= $city_id ?>')">
                <option value="">Select State</option>
                <?php if (!empty($state_list)) {
                  foreach ($state_list as $skey => $svalue) { ?>
                <option value="<?= $svalue['id'] ?>" <?= !empty($state_id) && ($state_id == $svalue['id']) ? 'selected' : '' ?>><?= $svalue['state_name'] ?></option>
                <?php }
                  } ?>
              </select>
            </div>
            <div class="col-sm-3">
              <?= form_label('Select City <span class="text-danger">*</span>', 'city_id', ['class' => 'col-form-label']) ?>
              <select name="city_id" id="city_id" required class="form-control select2">
                <option value="">Select City</option>
              </select>
            </div>
            <div class="col-sm-3">
              <?= form_label('Select Class Group <span class="text-danger">*</span>', 'class_group_id', ['class' => 'col-form-label']) ?>
              <select name="class_group_id" id="class_group_id" class="form-control select2" required>
                <option value="">Select Class Group</option>
                <?php if (!empty($class_group_list)) {
                  foreach ($class_group_list as $cglkey => $cglvalue) { ?>
                <option value="<?= $cglvalue['id'] ?>" <?= !empty($class_group_id) && ($class_group_id == $cglvalue['id']) ? 'selected' : '' ?>><?= $cglvalue['class_group_name'] ?></option>
                <?php }
                  } ?>
              </select>
            </div>
            <div class="col-sm-3">
              <?= form_label('Cost Per Lead <span class="text-danger">*</span>', 'cost_per_lead', ['class' => 'col-form-label']) ?>
              <?= form_input(['name' => 'cost_per_lead', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Cost Per Lead', 'id' => 'cost_per_lead','maxlength'=>'4' ,'class' => 'form-control numbersWithZeroOnlyInput', 'value' => $cost_per_lead]); ?>
            </div>
            <div class="col-sm-3">
              <?= form_label('Status', 'status', ['class' => 'col-form-label']) ?>
              <div class="row mt-2">
                <div class="col-4">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input status" name="status" <?= ($status == 'Active') ? 'checked' : '' ?> type="radio" id="checkStatus1" value="Active" checked>
                    <?= form_label('Active', 'checkStatus1', ['class' => 'custom-control-label']) ?>
                  </div>
                </div>
                <div class="col-4">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input status" name="status" <?= ($status == 'Inactive') ? 'checked' : '' ?> type="radio" id="checkStatus2" value="Inactive">
                    <?= form_label('Inactive', 'checkStatus2', ['class' => 'custom-control-label']) ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row mt-2">
            <div class="col-sm-12">
              <div class="custom-btn-group">
                <button type="button" id="submit" onclick="return validateLead()" class="btn btn-success">Submit</button>
              </div>
            </div>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script>
    function validateLead() {
    var cost_per_lead = $('#cost_per_lead').val().trim();
    var state_id = $('#state_id').val().trim();
    var city_id = $('#city_id').val().trim();
    var class_group_id = $('#class_group_id').val().trim();
    var lead_id = $('#lead_id').val().trim();
    var status = $('.status:checked').val().trim();

    if (state_id === "") {
        toastr.error("Please Select State");
        return false;
    } else if (city_id === "") {
        toastr.error("Please Select City");
        return false;
    } else if (class_group_id === "") {
        toastr.error("Please Select Class Group");
        return false;
    } else if (cost_per_lead === "") {
        toastr.error("Please Enter Cost Per Lead");
        return false;
    } else {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You Want to Submit',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url(ADMINPATH . 'save-lead') ?>', // Replace this with the actual backend endpoint URL
                    type: 'POST',
                    data: {
                        'id': lead_id,
                        'cost_per_lead': cost_per_lead,
                        'state_id': state_id,
                        'city_id': city_id,
                        'class_group_id': class_group_id,
                        'status': status
                    },
                    cache: false,
                    dataType: "json",
                    beforeSend: function () {
                        $('#submit').text('Please Wait...');
                        $('#submit').prop("disabled", true);
                    },
                    success: function (response) {
                        if (response.status === false) {
                            toastr.error(response.message);
                            $('#submit').text('Submit');
                            $('#submit').prop("disabled", false);
                        } else if (response.status === true) {
                            toastr.success(response.message);
                            setTimeout(function () {
                                window.location.href = response.url;
                            }, 500);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle error if necessary
                        console.error(xhr, status, error);
                        Swal.fire("Error occurred. Please try again."); // Show a generic error message
                    }
                });
            }
        });
    }
}

 <?php 
    if(!empty($city_id)){
    ?>
    getCities(<?= !empty($state_id) ? $state_id : "" ?>,'<?=$city_id?>');
    <?php 
    }
    ?>

    function getCities(id,city_id){
        
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
</script>