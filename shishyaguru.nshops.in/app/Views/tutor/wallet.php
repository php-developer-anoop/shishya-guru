<main id="main" class="main">
  <div class="form-topclass d-block">
    <div class="pagetitle m-0 col-md-12">
      <p><i class="bi bi-folder"></i><span class="current"><a href="<?=($tutor['kyc_status']!="Approved")?'javascript:void(0)':base_url(TUTORPATH.'dashboard')?>">Dashboard</a></span> /
        Wallet 
      </p>
      <span class="dashobord-title d-flex justify-content-between">
        <h1><i class="bi bi-arrow-left-short toggle-sidebar-btn"></i>Wallet<span class="profileName"></span>
        </h1>
        <span class="d-flex dashobord-title">
          <p></p>
        </span>
      </span>
    </div>
  </div>
  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-xxl-12 col-md-12 col-lg-12">
            <div class="card sales-card bodyCard-bg px-2">
              <div class="filter card3 walletPage">
                <img src="<?=base_url('assets/tutor')?>/img/card-icon.png" class="img-fluid">
              </div>
              <div class="card-body custum-walletCard">
                <div class="align-items-center">
                  <div class="d-flex justify-content-between col-md-12  col-sm-12 align-items-center">
                    <div class="align-items-center profit-lossIcon">
                      <span class="balance">Total balance </span>
                      <h5 class="text-white m-0 h3"><?=!empty($tutor['wallet_balance'])?'₹ '.$tutor['wallet_balance']:''?></h5>
                      <span class="balance d-none"><i class="bi bi-arrow-up-right"></i> 1000</span>
                    </div>
                    <div class="addfund d-flex flex-row gap-3">
                      <a href="javascript:void(0)" class="number" data-bs-toggle="modal"
                        data-bs-target="#exampleModal2" data-bs-whatever="@mdo">Add Fund</a>
                      <a href="<?=base_url(TUTORPATH.'recharge-request-list')?>">Recharge Request List</a>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xxl-12 col-md-12 col-lg-12">
            <h5 class="fw-bold">Transaction History</h5>
            <div class="card custum-overflow">
              <div class="tablemaincls mt-3" id="style-3">
                <!-- <table id="example" class="display nowrap" style="width:100%"> -->
                <input type="hidden" value="0" id="totalRecords" />
                <table id="responseData" class="display nowrap" style="width:100%">
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<span>
  <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content custum-InputBox position-relative pt-3">
        <span class="position-absolute end-0 top-0 mt-1 me-1">
        <button type="button" class="btnclosebtn" data-bs-dismiss="modal" aria-label="Close"><i
          class="bi bi-x"></i></button>
        </span>
        <h4 class="text-center mb-0"><b>Recharge Wallet</b></h4>
        <div class="modal-body addbalance pt-1">
          <div class="custom-radio d-flex justify-content-center d-none">
            <?php if(!empty($plan_list)){foreach($plan_list as $plkey=>$plvalue){?>
            <input id="one-r<?=$plkey?>" type="radio" name="myradio" value="<?=!empty($plvalue['amount'])?(int)$plvalue['amount']:''?>" onclick="return fillMoney(<?=!empty($plvalue['amount'])?(int)$plvalue['amount']:''?>)"/>
            <label for="one-r<?=$plkey?>"><?=!empty($plvalue['amount'])?(int)$plvalue['amount']:''?></label>
            <?php }} ?>
          </div>
          <div class="d-flex justify-content-start align-items-center flex-column">
            <label><b>Pay Using QR</b></label>
            <img src="<?=base_url('uploads/'.$company['qr_code'])?>" height="50%" width="50%"  />
          </div>
          <div class="addmoney-modal">
            <div class="form-group d-flex justify-content-start align-items-center flex-row mb-3 gap-3">
              <label for="exampleInputEmail1"><b>Or Pay Using UPI ID : </b></label><br>
              <span><?=!empty($company['upi_id'])?$company['upi_id']:''?></span>
            </div>
            <div class="form-group d-flex justify-content-start align-items-center flex-row gap-2">
              <label for="exampleInputEmail1" class="text-start w-100 " style="flex: 0 0 30%"><b>Paid Amount</b></label>
              <input type="text" class="form-control mt-2 numbersWithZeroOnlyInput" autocomplete="off" style="flex: 0 0 70%" placeholder="Enter Paid Amount" id="amount">
            </div>
            <div class="form-group mt-3 d-flex justify-content-start align-items-center flex-row gap-2">
              <label for="exampleInputEmail1" class="text-center w-100" style="flex: 0 0 30%"><b>Transaction Id</b></label>
              <input type="text" class="form-control mt-2" autocomplete="off" style="flex: 0 0 70%" placeholder="Enter Transaction Id" id="txn_id">
            </div>
            <div class="col-12 addmoney">
              <button class="btn btn-Purple w-100" type="submit" onclick="return validateAddMoney()" id="renderBtn">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</span>

<script>
  function getTotalRecordsData(qparam) {
        $.ajax({
            url: '<?= base_url(TUTORPATH . 'my-wallet-data'); ?>?' + qparam,
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
                "url": '<?= base_url(TUTORPATH . 'my-wallet-data'); ?>' + newQueryParam,
                "type": 'POST',
                dataSrc: (res) => {
                    return res.data
                }
            },
            "columns": [
             // { data: "sr_no", "name": "Sr.No", "title": "Sr.No" },
            { data: "transaction_id", "title": "Transaction Id"},
            { data: "add_date", "title": "Transaction Date & Time" },
            { data: "txn_amount", "title": "Amount" },
            { data: "id", "title": "Credit/Debit","render":credit_debit_render},
            { data: "remark", "title": "Remark"},
            
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
    
    
       var credit_debit_render = ( data, type, row, meta )=>{
  var data = '';
  let credit_debit= row.credit_debit!=null?capitalizeFirstLetters(row.credit_debit):"";
  if(type === 'display'){
        data= '<span>'+credit_debit+'</span><br>' ;
  }
return data;
}

function validateAddMoney() {
    var amount = $('#amount').val().trim();
    var txn_id = $('#txn_id').val().trim();
    var tutor_id = '<?=!empty($tutor['id'])?$tutor['id']:''?>';
    var unique_id = '<?=!empty($tutor['unique_id'])?$tutor['unique_id']:''?>';
    var tutor_name = '<?=!empty($tutor['tutor_name'])?$tutor['tutor_name']:''?>';
    if (amount == "") {
        toastr.error("Enter Paid Amount");
        return false;
    } else if (txn_id == "") {
        toastr.error("Enter Transaction Id");
        return false;
    } else {
        $.ajax({
            url: "<?=base_url(TUTORPATH.'add-request')?>",
            method: 'POST',
            data: { amount: amount,txn_id:txn_id,tutor_id:tutor_id,unique_id:unique_id,tutor_name:tutor_name },
            dataType: 'json',
            beforeSend: function() {
                $('#renderBtn').prop('disabled', true).text('Please Wait...');
            },
            success: function(response) {
                if (response.status) {
                    toastr.success(response.message);
                    $('#renderBtn').prop('disabled', false).text('Submit');
                    $('#amount').val('');
                    $('#txn_id').val('');
                    $('#exampleModal2').modal('hide');
                } else {
                    toastr.error(response.message);
                    $('#renderBtn').prop('disabled', false).text('Submit');
                }
            }
        });
    }
}



function fillMoney(amount){
  
    $('#amount').val('');
    $('#amount').val(amount);
}
</script>