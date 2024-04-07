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
<script>
    function getTotalRecordsData(qparam) {
        $.ajax({
            url: '<?= base_url(ADMINPATH . 'recharge-request-data'); ?>?' + qparam,
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
                "url": '<?= base_url(ADMINPATH . 'recharge-request-data'); ?>' + newQueryParam,
                "type": 'POST',
                dataSrc: (res) => {
                    return res.data
                }
            },
            "columns": [{ data: "sr_no", "name": "Sr.No", "title": "Sr.No" },
            { data: "id", "title": "Tutor Details","render":tutor_details },
            { data: "id", "title": "Transaction Details","render":txn_details },
            { data: "id",  "title": "Dates","render":dates },
            { data: "id",  "title": "Status", "render": status_render },
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
var tutor_details = ( data, type, row, meta )=>{
  var data = '';
  let tutor_name= row.tutor_name!=null?row.tutor_name:"";
  let tutor_unique_id= row.tutor_unique_id!=null?row.tutor_unique_id:"";
  if(type === 'display'){
        data += '<span class="fotr_10"><b>Tutor Name : </b>'+tutor_name+'</span><br>' ;
        data += '<span class="fotr_10"><b>Unique ID : </b>'+tutor_unique_id+'</span>' ;
      
  }
return data;
}

var txn_details = ( data, type, row, meta )=>{
  var data = '';
  let amount= row.amount!=null?row.amount:"";
  let txn_id= row.txn_id!=null?row.txn_id:"";
  if(type === 'display'){
        data += '<span class="fotr_10"><b>Amount : </b>'+amount+'</span><br>' ;
        data += '<span class="fotr_10"><b>Txn. Id : </b>'+txn_id+'</span>' ;
  }
return data;
}

var dates = ( data, type, row, meta )=>{
  var data = '';
  let add_date= row.add_date!=null?row.add_date:"";
  let upd_date= row.update_date!=null?row.update_date:"";
  if(type === 'display'){
        data += '<span class="fotr_10"><b>Added On : </b>'+add_date+'</span><br>' ;
        data += '<span class="fotr_10"><b>Updated On : </b>'+upd_date+'</span>' ;
  }
return data;
}

function action_render(data, type, row, meta) {
    let output = '';
    var status_class_pending = (row.status === "Pending") ? "bg-danger text-white" : "bg-white text-black";
    var status_class_approved = (row.status === "Approved") ? "bg-danger text-white" : "bg-white text-black";
    var status_class_rejected = (row.status === "Rejected") ? "bg-danger text-white" : "bg-white text-black";
    var disabled_prop = (row.status === "Pending") ? "" : "d-none";
    var disabled_text = (row.status === "Pending") ? "" : "Status Changed";

    if (type === 'display') {
        if (disabled_text !== "") {
            output = '<span class="fotr_10"><b>' + disabled_text + '</b></span><br>';
        } else {
            output += '<div class="dropdown">';
            output += '<button type="button" id="btn' + row.id + '" class="' + disabled_prop + ' btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
            output += '<i class="fa fa-cog"></i></button>';
            output += '<ul class="dropdown-menu">';
            output += '<li class="' + status_class_pending + '"><a class="dropdown-item" href="javascript:void(0)" onclick="return changeRechargeStatus(\'Pending\', \'' + row.id + '\', \'' + row.tutor_id + '\', \'' + row.amount + '\', \'' + row.txn_id + '\')">Pending</a></li>';
            output += '<li class="' + status_class_approved + '"><a class="dropdown-item" href="javascript:void(0)" onclick="return changeRechargeStatus(\'Approved\', \'' + row.id + '\', \'' + row.tutor_id + '\', \'' + row.amount + '\', \'' + row.txn_id + '\')">Approved</a></li>';
            output += '<li class="' + status_class_rejected + '"><a class="dropdown-item" href="javascript:void(0)" onclick="return changeRechargeStatus(\'Rejected\', \'' + row.id + '\', \'' + row.tutor_id + '\', \'' + row.amount + '\', \'' + row.txn_id + '\')">Rejected</a></li>';
            output += '</ul>';
            output += '</div>';
        }
    }
    return output;
}


   function status_render(data, type, row, meta) {
       var data='';
    if (type === 'display') {
        data += '<span class="fotr_10" id="status_' + row.id + '">' + row.status + '</span>';
    }
    return data;
}

function changeRechargeStatus(status, id, tutor_id, amount, txn_id) {
    // Construct URL using JavaScript instead of PHP short tag
    var url = '<?= base_url(ADMINPATH.'changeRechargeStatus') ?>';
    
    // Make AJAX request
    $.ajax({
        url: url,
        type: 'POST',
        data: { 
            status: status, 
            id: id,
            tutor_id: tutor_id,
            amount: amount,
            txn_id: txn_id
        },
        dataType: 'json',
        success: function(response) {
            if (response.status) {
                toastr.success(response.message);
                $('#status_' + id).text(response.status);
                $('#btn' + id).prop('disabled',true); // Remove 'true' argument from addClass
            } else {
                toastr.error(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Something Went Wrong: ' + error);
        }
    });
}


</script>