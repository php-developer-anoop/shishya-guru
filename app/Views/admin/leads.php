<style>
  .pad-last td:last-child{
  padding-left:5px;
  }
</style>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="<?= base_url(ADMINPATH . 'dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item">
              <?= $menu; ?>
            </li>
            <li class="breadcrumb-item active">
              <?= $title; ?>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <input type="hidden" value="0" id="totalRecords" />
          <table id="responseData" class="table table-bordered mb-0 pad-last">
          </table>
        </div>
      </div>
      <br>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="exampleModalLabel">Assign Tutor</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        <div class="row" id="appendStructure">
        </div>
        <input type="hidden" id="lead_id" value="">
        <div class="col-lg-3 btn btn-success mt-2" onclick="return validateAssignTutor()" id="submit">Submit</div>
      </div>
    </div>
  </div>
</div>
<script>
    function getTotalRecordsData(qparam) {
      $.ajax({
          url: '<?= base_url(ADMINPATH . 'leads-list-data'); ?>?' + qparam,
          type: "POST",
          data: {
              'is_count': 'yes',
              'start': 0,
              'length': 10
          },
          cache: false,
          success: function(response) {
              $('#totalRecords').val(response);
              loadAllRecordsData(qparam);
          }
      });
  }

  $(document).ready(function() {
      let qparam = (new URL(location)).searchParams;
      getTotalRecordsData(qparam);
  });

  function loadAllRecordsData(qparam) {
      $('#responseData').html('');
      var newQueryParam = '?' + qparam + '&recordstotal=' + $('#totalRecords').val();
      $('#responseData').DataTable({
          "processing": true,
          "serverSide": true,
          "ajax": {
              "url": '<?= base_url(ADMINPATH . 'leads-list-data'); ?>' + newQueryParam,
              "type": 'POST',
              dataSrc: (res) => {
                  return res.data
              }
          },
          "columns": [{
                  data: "sr_no",
                  "name": "Sr.No",
                  "title": "Sr.No"
              },
              {
                  data: "id",
                  "title": "Student Details",
                  "render": tutor_detail
              },
              {
                  data: "id",
                  "title": "Tuition Detail",
                  "render": tuition_detail
              },
              {
                  data: "tuition_mode",
                  "title": "Tuition Mode",
                  "render": location_detail
              },
              {
                  data: "id",
                  "title": "Assigned Tutor",
                  "render": assigned_detail
              },
              {
                  data: "id",
                  "title": "Dates",
                  "render": dates_times
              },
              {
                  data: "id",
                  "title": "Action",
                  "render": action_render
              },

          ],

          "rowReorder": {
              selector: 'td:nth-child(2)'
          },
          "responsive": false,
          "autoWidth": false,
          "destroy": true,
          "searchDelay": 1000,
          "searching": true,
          "pagingType": 'simple_numbers',
          "rowId": (a) => {
              return 'id_' + a.id;
          },
          "iDisplayLength": 10,
          "order": [3, "asc"],
      });
  }


  var tutor_detail = (data, type, row, meta) => {
      var data = '';
      let name = row.name != null ? row.name : "N/A";
      let email = row.email != null ? row.email : "N/A";
      let mobile_no = row.mobile_no != null ? row.mobile_no : "N/A";
      let gender = row.gender != null ? row.gender : "N/A";
      if (type === 'display') {
          data += '<span class="fotr_10"><b>Name : </b>' + name + '</span><br>';
          data += '<span class="fotr_10"><b>Email : </b>' + email + '</span><br>';
          data += '<span class="fotr_10"><b>Mobile : </b>' + mobile_no + '</span><br>';
          data += '<span class="fotr_10"><b>Gender : </b>' + gender + '</span>';
      }
      return data;
  }

  var dates_times = (data, type, row, meta) => {
      var data = '';
      let add_date = row.add_date != null ? row.add_date : "N/A";
      let assigned_date_time = row.assigned_date_time != null ? row.assigned_date_time : "N/A";
      let mobile_no = row.mobile_no != null ? row.mobile_no : "N/A";
      let gender = row.gender != null ? row.gender : "N/A";
      if (type === 'display') {
          data += '<span class="fotr_10"><b>Added On : </b>' + add_date + '</span><br>';
          data += '<span class="fotr_10"><b>Assigned On : </b>' + assigned_date_time + '</span>';
      }
      return data;
  }

  var tuition_detail = (data, type, row, meta) => {
      var data = '';
      let class_name = row.class_name != null ? row.class_name : "N/A";
      let subject_name = row.subject_name != null ? row.subject_name : "N/A";
      let board_name = row.board_name != null ? row.board_name : "N/A";

      if (type === 'display') {
          data += '<span class="fotr_10"><b>Class : </b>' + class_name + '</span><br>';
          data += '<span class="fotr_10"><b>Subject : </b>' + subject_name + '</span><br>';
          data += '<span class="fotr_10"><b>Board : </b>' + board_name + '</span>';

      }
      return data;
  }

  var location_detail = (data, type, row, meta) => {
      let details = '';
      let city_name = row.city_name != null ? row.city_name : "N/A";
      let area = row.area != null ? row.area : "N/A";
      let tuition_mode = row.tuition_mode != null ? row.tuition_mode : "N/A";
      let lead_status = row.lead_status != null ? row.lead_status : "N/A";

      if (type === 'display') {
          details += '<span class="fotr_10"><b>City : </b>' + city_name + '</span><br>';
          details += '<span class="fotr_10"><b>Area : </b>' + area + '</span><br>';
          details += '<span class="fotr_10"><b>Tuition Mode : </b>' + tuition_mode + '</span><br>';
          details += '<span class="fotr_10"><b>Lead Status : </b><span id="lead' + row.id + '">' + lead_status + '</span></span>';
      }
      return details;
  }

  var assigned_detail = (data, type, row, meta) => {
      let details = '';
      let assigned_tutor_name = row.assigned_tutor_name != null ? row.assigned_tutor_name : "N/A";
      let assigned_tutor_mobile_no = row.assigned_tutor_mobile_no != null ? row.assigned_tutor_mobile_no : "N/A";


      if (type === 'display') {
          details += '<span class="fotr_10"><b>Tutor Name : </b>' + assigned_tutor_name + '</span><br>';
          details += '<span class="fotr_10"><b>Tuition Mobile : </b>' + assigned_tutor_mobile_no + '</span><br>';

      }
      return details;
  }


  function action_render(data, type, row, meta) {
      let output = '';
      if (type === 'display') {
          var assignTutor = "assignTutor('" + row.id + "')";

          var cancelLead = "cancelLead('" + row.id + "')";
          let lead_status =  (row.lead_status == 'Assigned') || (row.lead_status == 'Cancelled') ? "disabled" : "";

          output = '<button class="btn btn-sm btn-danger text-white m-1" ' + lead_status + ' onclick="' + cancelLead + '" title="Cancel Lead" id="cancel' + row.id + '"><i class="fa fa-cancel"></i></button>';

           if (row.lead_status != "New") {
              output += '<button class="btn btn-sm btn-success text-white"  onclick="' + assignTutor + '" title="Assign Tutor" id="assign' + row.id + '" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-tasks"></i></button> ';
           }
      }
      return output;
  }

  function cancelLead(lead_id) {
      $.ajax({
          url: "<?= base_url(ADMINPATH.'cancelLead') ?>",
          type: 'POST',
          data: {
              lead_id: lead_id
          },
          dataType: 'json',
          success: function(response) {
              if (response.status) {
                  toastr.success(response.message);
                  $('#lead' + lead_id).text(response.lead_status);
                  $('#cancel' + lead_id).prop('disabled', true);
              } else {
                  toastr.error(response.message);
              }
          },
          error: function(xhr, status, error) {
              console.error('Error:', error);
          }
      });
  }

  function assignTutor(lead_id) {
      $('#appendStructure').html('');
      $.ajax({
          url: "<?= base_url(ADMINPATH.'getAcceptedTutors') ?>",
          type: 'POST',
          data: {
              lead_id: lead_id
          },
          dataType: 'html',
          success: function(response) {
              $('#appendStructure').html(response);
              $('#lead_id').val(lead_id);
          },
          error: function(xhr, status, error) {
              console.error('Error:', error);
          }
      });
  }

  function validateAssignTutor() {
      var tutor_id = $('input[name="tutor"]:checked').val();
      var mobile_no = $('input[name="tutor"]:checked').data('mobile');
      var name = $('input[name="tutor"]:checked').data('tutor_name');
      var lead_id = $('#lead_id').val();
      if (tutor_id == "") {
          toastr.error("Please Select An Option");
          return false;
      } else {
          $.ajax({
              url: "<?= base_url(ADMINPATH.'assignTutor') ?>",
              type: 'POST',
              data: {
                  tutor_id: tutor_id,
                  mobile_no: mobile_no,
                  name: name,
                  lead_id: lead_id
              },
              dataType: 'json',
              success: function(response) {
                  if (response.status) {
                      toastr.success(response.message);
                      $('#lead' + lead_id).text(response.lead_status);
                      $('#cancel' + lead_id).prop('disabled', true);
                     // $('#assign' + lead_id).hide();
                      $('#exampleModal').modal('hide');
                  } else {
                      toastr.error(response.message);
                  }
              },
              error: function(xhr, status, error) {
                  console.error('Error:', error);
              }
          });
      }
  }
</script>