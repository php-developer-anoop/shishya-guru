<main id="main" class="main">
  <div class="form-topclass d-block">
    <div class="pagetitle m-0 col-md-12">
      <p><i class="bi bi-folder"></i><span class="current"><a href="<?=($tutor['kyc_status']!="Approved")?'javascript:void(0)':base_url(TUTORPATH.'dashboard')?>">Dashboard</a></span> /
        <?=$page_name?>
      </p>
      <span class="dashobord-title d-flex justify-content-between">
        <h1><i class="bi bi-arrow-left-short toggle-sidebar-btn"></i><?=$page_name?><span
          class="profileName"></span></h1>
      </span>
    </div>
  </div>
  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-xxl-12 col-md-12 col-lg-12">
            <div class="card custum-overflow">
              <div class="tablemaincls mt-3" id="style-3">
                  <input type="hidden" value="0" id="totalRecords" />
                <table id="responseData" class="display nowrap PickedEnqury" style="width:100%">
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <span>
    <div class="modal fade mt-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="text-center">
            <h1 class="modal-title mt-3 fs-5" id="exampleModalLabel"><b>Action</b></h1>
            <button type="button" class="btncrossbtn" data-bs-dismiss="modal" aria-label="Close"><i
              class="bi bi-x"></i></button>
          </div>
          <div class="modal-body modal-fieldset">
            <form>
                <input type="hidden" id="lead_id" value="">
                <input type="hidden" id="student_name" value="">
                <input type="hidden" id="student_mobile_no" value="">
                <input type="hidden" id="student_email" value="">
              <div class="mb-3 row">
                <div class="col-md-12 custom_class">
                  <fieldset>
                    <legend>Schedule</legend>
                    <select class="form-select" aria-label="Default select example" id="schedule_name">
                      <option selected="">Choose option</option>
                      <?php if(!empty($schedule_list)){foreach($schedule_list as $slkey=>$slvalue){?>
                      <option value="<?=$slvalue['name']?>"><?=$slvalue['name']?></option>
                      <?php }} ?>
                    </select>
                  </fieldset>
                </div>
                <div class="col-md-12 custom_class">
                  <fieldset>
                    <legend>Description</legend>
                    <textarea class="form-control" id="sdescription" rows="6" placeholder="Enter Description" style="resize: none;"></textarea>
                  </fieldset>
                </div>
                <div class="row mx-auto">
                  <div class="col-md-6 custom_class">
                    <fieldset>
                      <legend>Date</legend>
                      <input type="date" class="form-control" min="<?=date('Y-m-d')?>" id="date" name="date" placeholder="DD/MM/YYYY"
                        required value="">
                    </fieldset>
                  </div>
                  <div class="col-md-6 custom_class">
                    <fieldset>
                      <legend>Time</legend>
                      <input type="time" value="" class="form-control" id="time" name="time" placeholder="HH:MM" required>
                    </fieldset>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 d-grid">
                <button type="button" class="btn modalsubmitbtn" onclick="return validateSchedule()" id="msubmit">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </span>
</main>
<script>

function validateSchedule() {
    var schedule_name = $('#schedule_name').val();
    var description = $('#sdescription').val();
    var lead_id = $('#lead_id').val();
    var student_name = $('#student_name').val();
    var student_mobile_no = $('#student_mobile_no').val();
    var student_email = $('#student_email').val();
    var date = $('#date').val();
    var time = $('#time').val();
    
    if (schedule_name === "") {
        toastr.error("Select Schedule");
        return false;
    } else if (description === "") {
        toastr.error("Enter Description");
        return false;
    } else if (date === "") {
        toastr.error("Select Date");
        return false;
    } else if (time === "") {
        toastr.error("Select Time");
        return false;
    } else {
        $.ajax({
            url: '<?= base_url(TUTORPATH . 'save-schedule'); ?>',
            type: "POST",
            data: {
                schedule_name: schedule_name,
                description: description,
                lead_id: lead_id,
                student_name: student_name,
                student_mobile_no: student_mobile_no,
                student_email: student_email,
                date: date,
                time: time
            },
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('#msubmit').text('Please Wait...');
                $('#msubmit').attr("disabled", true);
            },
            success: function(response) {
                if (response.status === true) {
                    toastr.success("Schedule saved successfully");
                    $('#exampleModal').modal('hide');
                } else {
                    toastr.error("Failed to save schedule");
                }
            },
            error: function(xhr, status, error) {
                toastr.error("Failed to save schedule: " + error);
            },
            complete: function() {
                $('#msubmit').text('Submit');
                $('#msubmit').attr("disabled", false);
            }
        });
    }
}


  function getTotalRecordsData(qparam) {
        $.ajax({
            url: '<?= base_url(TUTORPATH . 'active-tuitions-data'); ?>?' + qparam,
            type: "POST",
            data: { 'is_count': 'yes', 'start': 0, 'length': 10 },
            cache: false,
            success: function (response) {
                $('#totalRecords').val(response);
                //if (response) {
                    loadAllRecordsData(qparam);
                //}
            }
        });
    }

    $(document).ready(function () {
        let qparam = (new URL(location)).searchParams;
        getTotalRecordsData(qparam);
    });

    function loadAllRecordsData(qparam) {
       // alert(qparam);
        $('#responseData').html('');
        var newQueryParam = '?'+qparam + '&recordstotal=' + $('#totalRecords').val();
        $('#responseData').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '<?= base_url(TUTORPATH . 'active-tuitions-data'); ?>' + newQueryParam,
                "type": 'POST',
                dataSrc: (res) => {
                    return res.data
                }
            },
            "columns": [
            { data: "id", "title": "Action","render":schedule_timing },
            { data: "name", "title": "Student Name"},
            { data: "mobile_no", "title": "Mobile No."},
            { data: "email", "title": "Email"},
            { data: "city_name", "title": "City"},
            { data: "board_name", "title": "Board"},
            { data: "class_name", "title": "Class"},
            { data: "subject_name", "title": "Subject"},
            { data: "id", "title": "Tuition Mode","render":tuition_mode },
            
            
            
          ],
             
            "rowReorder": { selector: 'td:nth-child(2)' },
            "responsive": false,
            "autoWidth": false,
            "destroy": true,
            "searchDelay": 500,
            "searching": true,
            "pagingType": 'simple_numbers',
            "rowId": (a) => { return 'id_' + a.id; },
            "iDisplayLength": 10,
            "order": [2, "asc"],
        });
    }
    
  var schedule_timing = (data, type, row, meta) => {
  var displayData = '';
  if (type === 'display') {
    var onclick = "appendDetails(" + row.id + ",'" + row.name + "','" + row.mobile_no + "','" + row.email + "')";
    displayData += '<span class="shownumber"><a data-bs-toggle="modal" onclick="' + onclick + '"  data-bs-target="#exampleModal" id="tutor' + row.id + '" style="cursor:pointer"><img src="<?=base_url('assets/frontend/img/timing.png')?>" /></a></span>';
  }
  return displayData;
}
  
function appendDetails(lead_id,student_name,student_mobile_no,student_email){
    $('#lead_id').val(lead_id);
    $('#student_name').val(student_name);
    $('#student_mobile_no').val(student_mobile_no);
    $('#student_email').val(student_email);
}  

    var tuition_mode = ( data, type, row, meta )=>{
  var data = '';
  let tuition_mode= row.tuition_mode!=null?row.tuition_mode:"";
  if(type === 'display'){
        data += '<span class="home-tution">'+tuition_mode+'</span><br>' ;
      
  }
return data;
}
  var subject_name = ( data, type, row, meta )=>{
  var data = '';
  let subject_name= row.subject_name!=null?row.subject_name:"";
  if(type === 'display'){
        data += '<span class="subject">'+subject_name+'</span><br>' ;
      
  }
return data;
}

function showNumber(lead_id, city_id, class_id) {
    $.ajax({
        type: 'POST',
        url: '<?= base_url(TUTORPATH.'showNumber')?>',
        data: {
            'city_id': city_id,
            'class_id': class_id,
            'lead_id': lead_id
        },
        dataType: 'json',
        beforeSend: function() {
            $('#number' + lead_id).text('Please Wait...');
            $('#number' + lead_id).attr("disabled");
        },
        success: function(res) {
            if (res.status === true) {
                $('#number' + lead_id).css({'background': '#ffffff', 'color': 'black'}).text(res.mobile_no);
            } else {
                $('#exampleModal2').modal('show');
                $('#number' + lead_id).text('Show Number');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

</script>