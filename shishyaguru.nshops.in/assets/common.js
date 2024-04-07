$(document).ready(function() {
  $(".numbersOnlyInput").on("keydown", function(event) {
    if (
      event.key === "Backspace" ||
      event.key === "Delete" ||
      event.key === "Tab" ||
      event.key === "Escape" ||
      event.key === "Enter" ||
      (event.key > "0" && event.key <= "9")
    ) {
    } else {
      event.preventDefault();
    }
  });
});

toastr.options.timeOut = 1000;


$(document).ready(function() {
  $(".numbersWithZeroOnlyInput").on("keydown", function(event) {
    if (
      event.key === "Backspace" ||
      event.key === "Delete" ||
      event.key === "Tab" ||
      event.key === "Escape" ||
      event.key === "Enter" ||
      (event.key >= "0" && event.key <= "9")
    ) {
    } else {
      event.preventDefault();
    }
  });
});

$(document).ready(function() {
  $(".restrictedInput").on("keypress", function(event) {
    var keyCode = event.which;
    var inputChar = String.fromCharCode(keyCode);

    if (!/[a-zA-Z\s]/.test(inputChar)) {
      event.preventDefault();
    }
  });
});

$(document).ready(function() {
  $('.emailInput').on('blur', function() {
    var inputValue = $(this).val();
    var emailPattern = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;

    if (!emailPattern.test(inputValue)) {
      $(this).css('border-color', 'red');
      toastr.error('Enter A Valid Email');
      $(this).val('');
      return false;
    } else {
      $(this).css('border-color', ''); 
    }
  });
});

$('.notzero').keyup(function(e) {
  if ($(this).val().match(/^0/)) {
    $(this).val('');
    return false;
  }
});

jQuery(document).ready(function($) {
  'use strict';
  $('.numbersOnly').keyup(function() {
    this.value = this.value.replace(/[^0-9]+$/g, '');
  });
  $('.lettersOnly').keyup(function() {
    this.value = this.value.replace(/[^a-zA-Z\s]+$/g, '');
  });
  $('.ucwords').keyup(function() {
    var vall = this.value.replace(/[^A-Za-z0-9 ]+$/g, '');
    this.value = capitalizeFirstLetters(vall);
  });
  $('.alphanum').keyup(function() {
    this.value = this.value.replace(/[^0-9a-zA-Z\s]+$/g, '');
  });
  $('.uppercase').keyup(function() {
    this.value = this.value.replace(/[^A-Za-z0-9 ]+$/g, '').toUpperCase();
  });
  $('.lowercase').keyup(function() {
    this.value = this.value.replace(/[^A-Za-z0-9 ]+$/g, '').toLowerCase();
  });
  $('.emailOnly').keyup(function() {
    this.value = this.value.replace(/[^@_a-zA-Z0-9\.]/g, '');
  });

  $('.address').keyup(function() {
    this.value = this.value.replace(/[^0-9a-zA-Z.\s]+$/g, '');
  });

});

function capitalizeFirstLetters(str) {
  return str.toLowerCase().replace(/^\w|\s\w/g, function(letter) {
    return letter.toUpperCase();
  })
}

$(function() {
  $('.select2').select2();
  $('.select2bs4').select2({
    theme: 'bootstrap4',
    closeOnSelect: true
  });
});


function remove(id, table) {
  Swal.fire({
    title: "Are you sure?",
    text: "It Will Delete the Row!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, Delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      deleteRecord(id, table)
    }
  });
}

function selectTeacherName() {
  var selectedItem = $(event.target);
  var itemValue = selectedItem.text();
  var itemId = selectedItem.val();

  if (itemValue !== "" && itemId !== "") {
    $('#teach_name').val(itemValue);
    $('#teach_id').val(itemId);
    $('.autocomplete-list').hide();
  }
}

$("#suggestion-list").on("click", "li", selectTeacherName);

// $(document).ready(function () {
  // Attach a submit event handler to the form
  $('#myForm').submit(function (event) {
     var teach_id=$('#teach_id').val();
     if(teach_id==""){
        swal('Select Teacher From Suggestions');
         return false;
     }
});

$('.file').on('change', function() {
  var file = $(this)[0].files[0];
  if (file) {
      var fileName = file.name;
      var fileExtension = fileName.split('.').pop().toLowerCase();
      var allowedExtensions = ['jpg', 'jpeg', 'png'];
      var maxSize = 1 * 1024 * 1024; // 1MB in bytes

      if ($.inArray(fileExtension, allowedExtensions) === -1) {
          swal('Invalid file type! Please select a JPG, JPEG, PNG file.');
          // Clear the file input
          $(this).val('');
          $('#submit').addClass('disabled', true);
      } else if (file.size > maxSize) {
          swal('Please Select A File Less Than 1 Mb');
          // Clear the file input
          $(this).val('');
          $('#submit').addClass('disabled', true);
      } else {
          $('#submit').removeClass('disabled', true);
          // Valid file type and size selected
          // Proceed with your logic here
      }
  }
});

    const currentYear = new Date().getFullYear();
    const nextYear = currentYear + 1;
  $('#start_year').on('input', function() {
    const enteredYear = $(this).val();
    if(enteredYear.length >=4 ){
    if (enteredYear < currentYear) {
      $(this).val(currentYear);
    }
    }
  });


function validate_from() {
    var max = $("#to_date").val();
    $("#from_date").attr("max", max);
}

function validate_to() {
    var min = $("#from_date").val();
    $("#to_date").attr("min", min);
    $("#to_date").val(min);
}


// document.addEventListener('contextmenu', (e) => e.preventDefault());

// function ctrlShiftKey(e, keyCode) {
//   return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
// }

// document.onkeydown = (e) => {
//   // Disable F12, Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U
//   if (
//     event.keyCode === 123 ||
//     ctrlShiftKey(e, 'I') ||
//     ctrlShiftKey(e, 'J') ||
//     ctrlShiftKey(e, 'C') ||
//     ctrlShiftKey(e, 'S') ||
//     (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
//   )
//     // alert(message);
//     return false;
// };