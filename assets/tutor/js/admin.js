
  $('.dashobord-title .bi-arrow-left-short').on('click', function () {
  // alert("vh");
  window.history.back();
});


$('#profile-btn').click(function(){
  $('fieldset').css('border','1px solid var(--grey_light, #999)');
})
$('#profile-btn').click(function(){
   $(".border_class").removeAttr("style");
})

// Paasworld hide and Show
$(document).ready(function() {
    $(".toggle-password").click(function () {
      $(this).toggleClass("bi-eye-slash bi-eye");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
});

// $(document).ready(function() {
//   $('.bi-list').click(function(){
//     alert("jfg");
//     // $(".sidebartoggle").toggleClass(".side-logo");
//   });
// });






// Kyc Upload img start
document.getElementById('fileInput').addEventListener('change', function (event) {
  const files = event.target.files;
  const imagePreview = document.getElementById('imagePreview');
  imagePreview.innerHTML = '';

  if (files) {
    for (let i = 0; i < Math.min(files.length, 3); i++) {
      const file = files[i];
      if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function () {
          const imgElement = document.createElement('img');
          imgElement.src = reader.result;
          imagePreview.appendChild(imgElement);
        }
        reader.readAsDataURL(file);
      } else {
        alert('Please select only image files.');
      }
    }
  }
});


document.getElementById('fileInput2').addEventListener('change', function (event) {
  const files = event.target.files;
  const imagePreview = document.getElementById('imagePreview2');
  imagePreview.innerHTML = '';

  if (files) {
    for (let i = 0; i < Math.min(files.length, 3); i++) {
      const file = files[i];
      if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function () {
          const imgElement = document.createElement('img');
          imgElement.src = reader.result;
          imagePreview.appendChild(imgElement);
        }
        reader.readAsDataURL(file);
      } else {
        alert('Please select only image files.');
      }
    }
  }
});




document.getElementById('fileInput3').addEventListener('change', function (event) {
  const files = event.target.files;
  const imagePreview = document.getElementById('imagePreview3');
  imagePreview.innerHTML = '';

  if (files) {
    for (let i = 0; i < Math.min(files.length, 3); i++) {
      const file = files[i];
      if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function () {
          const imgElement = document.createElement('img');
          imgElement.src = reader.result;
          imagePreview.appendChild(imgElement);
        }
        reader.readAsDataURL(file);
      } else {
        alert('Please select only image files.');
      }
    }
  }
});









//   kyc file FileChooser start
class FileChooser {
  constructor(element, settings) {
    if (typeof element === 'string') {
      element = document.querySelector(element);
    }

    this.settings = FileChooser.getSettings(settings);
    this.originalInput = element;
    this.wrapper = FileChooser.createWrapper();
    this.input = FileChooser.createInput(this.settings.placeholder);
    this.clearButton = FileChooser.createClearButton();

    this.appendElements();
    this.attachListeners();
  }
  setText(text) {
    this.input.value = text.split('\\').pop(); // Only show the filename, not the full path
  }
  reset() {
    this.originalInput.value = ''; // Reset the original input
    this.input.value = ''; // Reset the custom input
  }
  open() {
    this.originalInput.click();
  }
  attachListeners() {
    this.wrapper.addEventListener('click', (ev) => {
      ev.preventDefault();
      this.open();
    });
    this.wrapper.addEventListener('submit', (ev) => ev.preventDefault());

    this.clearButton.addEventListener('click', (ev) => {
      ev.stopPropagation();
      this.reset();
    });

    this.originalInput.addEventListener('click', (ev) => ev.stopPropagation());

    this.originalInput.addEventListener('change', (ev) => {
      this.setText(ev.target.value);
    });
  }
  appendElements() {
    let parent = this.originalInput.parentNode;

    this.originalInput.classList.add('file-chooser-hidden');
    this.wrapper.appendChild(this.input);
    this.wrapper.appendChild(this.clearButton);
    parent.insertBefore(this.wrapper, this.originalInput);
    this.wrapper.appendChild(this.originalInput);
  }
  static getDefaults() {
    return {
      buttonText: 'Browse',
      placeholder: 'Please choose a file'
    }
  }
  static getSettings(settings) {
    return {
      ...FileChooser.getDefaults(),
      ...settings
    };
  }
  static createWrapper() {
    let wrapper = document.createElement('div'); // Changed form to div
    wrapper.classList.add('file-chooser');
    return wrapper;
  }
  static createInput(placeholder) {
    let input = document.createElement('input');
    input.setAttribute('readonly', true);
    input.setAttribute('placeholder', placeholder);
    input.classList.add('file-chooser-input');
    return input;
  }
  static createClearButton() {
    let clearButton = document.createElement('button');
   // clearButton.textContent = 'Clear'; // Added text content
    clearButton.classList.add('file-chooser-clear');
    return clearButton;
  }
}

let fileBrowser = new FileChooser('.file-browser', {});
let fileBrowser2 = new FileChooser('.file-browser-2', {});
let fileBrowser3 = new FileChooser('.file-browser-3', {});





// Tabing profile section

document.addEventListener("DOMContentLoaded", function () {
  var tabs = document.querySelectorAll('.tabcontent');
  var tabLinks = document.querySelectorAll('.tablinks');
  var submitButton = document.querySelector('.submitButton');

  // Function to switch between tabs
  function openTab(tabIndex) {
      tabs.forEach(function (tab, index) {
          if (index === tabIndex) {
              tab.classList.add('active');
              tab.style.display = 'block'; // Show the active tab
          } else {
              tab.classList.remove('active');
              tab.style.display = 'none'; // Hide other tabs
          }
      });
      tabLinks.forEach(function (link, index) {
          if (index === tabIndex) {
              link.classList.add('active');
          } else {
              link.classList.remove('active');
          }
      });
      submitButton.style.display = "block"; // Always show submit button
  }

  // Tab click functionality
  tabLinks.forEach(function (link, index) {
      link.addEventListener('click', function () {
          openTab(index);
      });
  });

  var form_step = $('#form_step_id').val();
   
    // Open the first tab by default
    if(form_step==""){
        form_step=0;
        openTab(form_step);
    }else{
         openTab(form_step-1);
    }
   
});





// text-editoer write blog page

ClassicEditor.create(document.querySelector("#textEditor")).catch((error) => {
  console.error(error);
});


