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
          <table id="responseData" class="table table-bordered mb-0">
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
        <h4 class="modal-title fs-5" id="exampleModalLabel">Schedule Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="appendDetails">
      </div>
    </div>
  </div>
</div>
<script>
    function getTotalRecordsData(qparam) {
        $.ajax({
            url: '<?= base_url(ADMINPATH . 'all-schedule-data'); ?>?' + qparam,
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
        $('#responseData').html('');
        var newQueryParam = '?'+qparam + '&recordstotal=' + $('#totalRecords').val();
        $('#responseData').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '<?= base_url(ADMINPATH . 'all-schedule-data'); ?>' + newQueryParam,
                "type": 'POST',
                dataSrc: (res) => {
                    return res.data
                }
            },
            "columns": [{ data: "sr_no", "name": "Sr.No", "title": "Sr.No" },
            { data: "schedule_name", "title": "Schedule Name" },
            { data: "id",  "title": "Dates","render":dates },
            { data: "id",  "title": "Lead Detail", "render": lead_detail },
            { data: "id",  "title": "Action", "render": action_render },
           
          ],

            "rowReorder": { selector: 'td:nth-child(2)' },
            "responsive": false,
            "autoWidth": false,
            "destroy": true,
            "searchDelay": 2000,
            "searching": true,
            "pagingType": 'simple_numbers',
            "rowId": (a) => { return 'id_' + a.id; },
            "iDisplayLength": 10,
            "order": [3, "asc"],
        });
    }


var dates = ( data, type, row, meta )=>{
  var data = '';
  let schedule_date_time= row.schedule_date_time!=null?row.schedule_date_time:"";
  let add_date= row.add_date!=null?row.add_date:"";
  if(type === 'display'){
        data += '<span class="fotr_10"><b>Scheduled On : </b>'+schedule_date_time+'</span><br>' ;
        data += '<span class="fotr_10"><b>Added On : </b>'+add_date+'</span>' ;
      
  }
return data;
}

var lead_detail = ( data, type, row, meta )=>{
  var data = '';
  let lead_id= row.lead_id!=null?row.lead_id:"";
  let student_name= row.student_name!=null?row.student_name:"";
  let student_mobile_no= row.student_mobile_no!=null?row.student_mobile_no:"";
  let student_email= row.student_email!=null?row.student_email:"";
  
  if(type === 'display'){
        data += '<span class="fotr_10"><b>Lead ID : </b>'+lead_id+'</span><br>' ;
        data += '<span class="fotr_10"><b>Student Name : </b>'+student_name+'</span><br>' ;
        data += '<span class="fotr_10"><b>Student Mobile : </b>'+student_mobile_no+'</span><br>' ;
        data += '<span class="fotr_10"><b>Student Email : </b>'+student_email+'</span>' ;
  }
return data;
}

function action_render(data, type, row, meta) {
    let output = '';
    var getDetails = "appendDetails('"+row.schedule_name+"','"+row.description+"',"+row.lead_id+",'"+row.student_name+"','"+row.student_mobile_no+"','"+row.student_email+"','"+row.schedule_date_time+"')"
    if (type === 'display') {
        output += '<button class="btn btn-sm btn-info text-white"  onclick="' + getDetails + '" title="Assign Tutor" id="assign' + row.id + '" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-eye"></i></button> ';
    }
    return output;
}

function appendDetails(schedule_name,description,lead_id,student_name,student_mobile_no,student_email,schedule_date_time){
    $('#appendDetails').html('');
    $.ajax({
            url: '<?= base_url(ADMINPATH . 'appendDetails'); ?>',
            type: "POST",
            data: { schedule_name:schedule_name,description:description,lead_id:lead_id,student_name:student_name,student_mobile_no:student_mobile_no,student_email:student_email,schedule_date_time },
            cache: false,
            dataType:"html",
            success: function (response) {
                $('#appendDetails').html(response);
                
            }
        });
}

</script>