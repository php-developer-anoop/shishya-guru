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
          <div class="table-responsive">
          <table id="responseData" class="table table-bordered mb-0">
          </table>
          </div>
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
        <h4 class="modal-title fs-5" id="exampleModalLabel">KYC Documents</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mt-2">
          <div class="col-md-4"><label for="profile_image">Profile Image </label></div>
          <div class="col-md-8" id="profile_image"></div>
        </div>
        <div class="row mt-2">
          <div class="col-md-4"><label for="aadhaar_front">Aadhaar Front</label></div>
          <div class="col-md-8" id="aadhaar_front"></div>
        </div>
        <div class="row mt-2">
          <div class="col-md-4"><label for="aadhaar_back">Aadhaar Back</label></div>
          <div class="col-md-8" id="aadhaar_back"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="exampleModalLabel">Manage Wallet</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-4">
            <select name="credit_debit" id="credit_debit" class="form-control select2">
                <option value="">Select Credit/Debit</option>
                <option value="Credit">Credit</option>
                <option value="Debit">Debit</option>
            </select>
          </div>
          <div class="col-lg-4">
            <input type="text" placeholder="Enter Amount" class="form-control numbersWithZeroOnlyInput" autocomplete="off" maxlength="5" id="amount" value="">
            <input type="hidden" id="tutor_id" value="">
          </div>
          <div class="col-lg-4">
            <input type="text" placeholder="Enter Remark" class="form-control" autocomplete="off"  id="remark" value="">
          
          </div>
          <div class="col-lg-3 btn btn-success mt-2 ml-2" onclick="return validateWalletRefill()" id="submit">Submit</div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    function getTotalRecordsData(qparam) {
        $.ajax({
            url: '<?= base_url(ADMINPATH . 'tutor-data'); ?>?' + qparam,
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
                "url": '<?= base_url(ADMINPATH . 'tutor-data'); ?>' + newQueryParam,
                "type": 'POST',
                dataSrc: (res) => {
                    return res.data
                }
            },
            "columns": [{ data: "sr_no", "name": "Sr.No", "title": "Sr.No" },
            { data: "id", "title": "Tutor Detail","render":tutor_detail },
           // { data: "id", "title": "Tuition Detail","render":tuition_detail },
            { data: "id", "title": "Experience","render":experience_detail },
          //  { data: "id", "title": "Location","render":location_detail },
            { data: "add_date",  "title": "Added On","render":pay_mode_detail },
            { data: "add_date",  "title": "Profile Status","render":status_render },
            { data: "id",  "title": "Action","render":action_render }

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


    var tutor_detail = (data, type, row, meta) => {
  var data = '';
  let tutor_name = row.tutor_name != null ? row.tutor_name : "N/A";
  let mobile_no = row.mobile_no != null ? row.mobile_no : "N/A";
  let gender = row.gender != null ? row.gender : "N/A";
  let email = row.email != null ? row.email : "N/A";
  let dob = row.dob != null ? row.dob : "N/A";
  let wallet_balance = row.wallet_balance != null ? row.wallet_balance : "N/A";

  if (type === 'display') {
    data += '<span><b>Name : </b>' + tutor_name + '</span><br>';
    data += '<span><b>Mobile : </b>' + mobile_no + '</span><br>';
    data += '<span style="word-break:break-all"><b>Email : </b>' + email + '</span><br>';
    data += '<span><b>Gender : </b>' + gender + '</span><br>';
    data += '<span><b>DOB : </b>' + dob + '</span><br>';
    data += '<span><b>Wallet Balance : </b>' + wallet_balance + '</span>';
  }
  return data;
}

var tuition_detail = (data, type, row, meta) => {
  var data = '';
  let tuition_mode = row.tuition_mode != null ? row.tuition_mode : "N/A";
  let subject = row.subject_name != null ? row.subject_name : "N/A";
  let board = row.matching_board_names != null ? row.matching_board_names : "N/A";
  let class_name = row.class_name != null ? row.class_name : "N/A";
  let monthly_fees = row.monthly_fees != null ? parseInt(row.monthly_fees) : "N/A";
  let days = row.days != null ? row.days : "N/A";

  if (type === 'display') {
    data += '<span><b>Mode : </b>' + tuition_mode + '</span><br>';
    data += '<span style="word-break:break-all"><b>Board : </b>' + board + '</span><br>';
    data += '<span style="word-break:break-all"><b>Class : </b>' + class_name + '</span><br>';
    data += '<span style="word-break:break-all"><b>Subject : </b>' + subject + '</span><br>';
    data += '<span><b>Days : </b>' + days + '</span><br>';
    data += '<span><b>Fees : </b>' + monthly_fees + '</span>';
  }
  return data;
}

var experience_detail = (data, type, row, meta) => {
  var data = '';
  let is_experienced = row.is_experienced != null ? row.is_experienced : "N/A";
  let experience_years = row.experience_years != null ? row.experience_years : "N/A";
  let skill = row.skill_name != null ? row.skill_name : "N/A";

  if (type === 'display') {
    data += '<span><b>Experienced : </b>' + is_experienced + '</span><br>';
    data += '<span><b>Exp. (Yrs) : </b>' + experience_years + '</span><br>';
   // data += '<span style="word-break:break-all"><b>Skills : </b>' + skill + '</span>';
  }
  return data;
}

var location_detail = (data, type, row, meta) => {
  var data = '';
  let city_name = row.city_name != null ? row.city_name : "N/A";
  let address = row.address != null ? row.address : "N/A";
  let pincode = row.pincode != null ? row.pincode : "N/A";

  if (type === 'display') {
    data += '<span><b>City : </b>' + city_name + '</span><br>';
    data += '<span><b>Address : </b>' + address + '</span><br>';
    data += '<span><b>Pincode : </b>' + pincode + '</span>';
  }
  return data;
}

var pay_mode_detail = (data, type, row, meta) => {
  var data = '';
  let add_date = row.add_date != null ? row.add_date : "N/A";
  let payment_mode = row.payment_mode != null ? row.payment_mode : "N/A";
  let kyc_status = row.kyc_status != null ? row.kyc_status : "N/A";

  if (type === 'display') {
    data += '<span><b>Payment Mode : </b>' + payment_mode + '</span><br>';
    data += '<span><b>Added On : </b>' + add_date + '</span><br>';
    data += '<span><b>KYC Status: </b><span id="kyc_status'+row.id+'">' + kyc_status + '<span></span>';

  }
  return data;
}

function action_render(data, type, row, meta) {
    let output = '';
    if (type === 'display') {
        var onclick = "remove('" + row.id + "','dt_tutor_list')";
        var appendImage = "appendImage('" + row.profile_image + "','" + row.aadhaar_front + "','" + row.aadhaar_back + "')";
        var appendTutorId = "appendTutorId('" + row.id + "')";
        var kyc_class_pending = (row.kyc_status === "Pending") ? "bg-danger text-white" : "bg-white text-black";
        var kyc_class_approved = (row.kyc_status === "Approved") ? "bg-danger text-white" : "bg-white text-black";
        output  = '<div class="d-flex align-items-center" style="gap:3px;">';
        output += '<a class="btn btn-sm btn-info text-white" onclick="' + appendImage + '" data-toggle="modal" data-target="#exampleModal" title="View Documents"><i class="fa fa-eye"></i></a> ';
        output += '<a class="btn btn-sm btn-warning text-white" href="<?= base_url(ADMINPATH . "edit-tutor?id=") ?>' + row.id + '" title="Edit Tutor"><i class="fa fa-edit"></i></a> ';
        output += '<div class="btn-group dropstart">';
        output += '<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
        output += '<i class="fa fa-cog"></i></button>';
        output += '<ul class="dropdown-menu">';
        output += '<li class="'+kyc_class_pending+'"><a class="dropdown-item " href="javascript:void(0)"  onclick="return changeKycStatus(\'Pending\', \'' + row.id + '\')">Pending</a></li>';
        output += '<li class="'+kyc_class_approved+'"><a class="dropdown-item " href="javascript:void(0)" onclick="return changeKycStatus(\'Approved\', \'' + row.id + '\')">Approved</a></li>';
        output += '</ul>';
        output += '</div>';
        output += '</div>';
        output += '<div class="d-flex align-items-center mt-1" style="gap:3px;">';
        output += '<a class="btn btn-sm btn-success text-white" onclick="' + appendTutorId + '" data-toggle="modal" data-target="#exampleModal2" title="Refill Wallet"><i class="far fa-money-bill-alt"></i></a> ';
        output += '<a class="btn btn-sm btn-success text-white" href="<?= base_url(ADMINPATH . "wallet-history?user_id=") ?>' + row.id + '"  title="Wallet History"><i class="fa fa-list"></i></a> ';
        output += '<a class="btn btn-sm btn-secondary text-white" href="<?= base_url(ADMINPATH . "leads-list?user_id=") ?>' + row.id + '"  title="Assigned Leads"><i class="fa fa-list"></i></a> ';
         output += '<a class="btn btn-sm btn-danger text-white" href="<?= base_url(ADMINPATH . "recharge-request-list?user_id=") ?>' + row.id + '"  title="Recharge Request History"><i class="fa fa-list"></i></a> ';
        output += '</div>';
        
    }
    return output;
}


function appendImage(profile_image, aadhaar_front, aadhaar_back) {
    $('#profile_image').html(profile_image ? '<a href="'+profile_image+'" target="_anoop"><img src="' + profile_image + '" height=100 width=200></a>' : 'No image uploaded');
    $('#aadhaar_front').html(aadhaar_front ? '<a href="'+aadhaar_front+'" target="_anoop"><img src="' + aadhaar_front + '" height=100 width=200></a>' : 'No image uploaded');
    $('#aadhaar_back').html(aadhaar_back ? '<a href="'+aadhaar_back+'" target="_anoop"><img src="' + aadhaar_back + '" height=100 width=200></a>' : 'No image uploaded');
}


function changeKycStatus(kyc_status, tutor_id) {
   // alert(tutor_id);
    $.ajax({
        url: '<?= base_url(ADMINPATH.'changeKycStatus') ?>', 
        type: 'POST',
        data: { kyc_status: kyc_status, tutor_id: tutor_id },
        dataType: 'json',
        
        success: function(response) {
            if (response.status) {
                toastr.success(response.message);
                $('#kyc_status'+tutor_id).text(response.kyc_status);
            } else {
                toastr.error(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Something Went Wrong: ' + error);
            
        }
    });
}

function status_render(data, type, row, meta) {
    if (type === 'display') {
        const isChecked = row.status === 'Active';
        const label = isChecked ? 'Active' : 'Inactive';
        const id = `tableswitch5${row.id}`;
        const onchange = `change_status(${row.id}, 'dt_tutor_list')`;

        return `<div class="custom-control custom-switch">
                <input type="checkbox" onchange="${onchange}" ${isChecked ? 'checked' : ''} class="custom-control-input" id="${id}">
                <label class="custom-control-label" for="${id}" id="label_id${row.id}">${label}</label>
            </div> `;
    }
    return '';
}

function appendTutorId(tutor_id){
   $('#tutor_id').val(tutor_id);
}

function validateWalletRefill() {
    var tutor_id = $('#tutor_id').val();
    var credit_debit = $('#credit_debit').val();
    var amount = $('#amount').val().trim();
    var remark = $('#remark').val().trim();

    if (credit_debit == "") {
        toastr.error("Please Select Credit/Debit");
        return false;
    } else if (amount == "") {
        toastr.error("Please Enter Amount");
        return false;
    } else if (remark == "") {
        toastr.error("Please Enter Remark");
        return false;
    } else {
        $.ajax({
            url: '<?= base_url(ADMINPATH.'refillWallet') ?>',
            type: 'POST',
            data: { amount: amount, tutor_id: tutor_id,credit_debit:credit_debit,remark:remark },
            dataType: 'json',
            beforeSend: () => {
            $('#submit').text('Please Wait...');
            $('#submit').prop("disabled", true);
         },
            success: function(response) {
                if (response.status == true) {
                    toastr.success(response.message);
                    $('#exampleModal2').modal('hide');
                    $('#amount').val(''); // Resetting the form
                    $('#tutor_id').val('');
                    $('#submit').text('Submit');
                    $('#submit').prop("disabled", false);
                } else {
                    toastr.error(response.message);
                    //$('#exampleModal2').modal('hide');
                    $('#amount').val(''); // Resetting the form
                    $('#tutor_id').val('');
                    $('#credit_debit').val('');
                    $('#remark').val('');
                    $('#submit').text('Submit');
                    $('#submit').prop("disabled", false);
                }
            },
            error: function(xhr, status, error) {
                console.error('Something Went Wrong: ' + error);
            }
        });
    }
}

</script>