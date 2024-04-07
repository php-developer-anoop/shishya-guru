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
          <a href="<?= base_url(ADMINPATH . 'schedule-list') ?>" class="btn btn-success m-auto"
            style="float:right;position:relative;">
          View Schedules
          </a>
        </div>
        <div class="card-header">
          <?=form_open(); ?>
          <input type="hidden" id='schedule_id' value="<?=$id?>">
          <div class="row mt-2">
            <div class="col-sm-4">
              <?= form_label('Schedule Name <span class="text-danger">*</span>', 'schedule_name', ['class' => 'col-form-label']) ?>
              <?= form_input(['name' => 'schedule_name', 'required' => 'required','autocomplete'=>'off', 'placeholder' => 'Enter Schedule Name', 'id' => 'schedule_name', 'class' => 'form-control ucwords restrictedInput','value'=>$name]); ?>
            </div>
            <div class="col-sm-6">
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
              <button type="button" id="submit" onclick="return validateSchedule()" class="btn btn-success">Submit</button>
              </div>
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
    function validateSchedule() {
    var schedule_name = $('#schedule_name').val().trim();
    var schedule_id = $('#schedule_id').val().trim();
    var status = $('.status:checked').val().trim();

    if (schedule_name === "") {
        toastr.error("Please Enter Schedule Name");
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
                    url: '<?= base_url(ADMINPATH . 'save-schedule') ?>', // Replace this with the actual backend endpoint URL
                    type: 'POST',
                    data: {
                        'id': schedule_id,
                        'name': schedule_name,
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

</script>