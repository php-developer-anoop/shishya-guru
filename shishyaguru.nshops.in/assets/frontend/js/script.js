
  document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.instutte-cardsec');

    cards.forEach(card => {
      card.addEventListener('click', function() {
        // Remove 'active' class from all cards
        cards.forEach(c => c.classList.remove('active'));
        // Add 'active' class to the clicked card
        this.classList.add('active');
        // You can add further functionality here, like fetching data
        // or performing other actions when a card is clicked
      });
    });
  });


// Kyc Upload img start
document.getElementById('tutor_profile_image').addEventListener('change', function (event) {
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




  document.getElementById('tutor_aadhaar_front').addEventListener('change', function (event) {
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




  document.getElementById('tutor_aadhaar_back').addEventListener('change', function (event) {
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

  // Kyc Upload img end











// Scroll Modal open start

$(document).ready(function() {
    $(window).scroll(function() {
      if ($(window).scrollTop() >= 430) {
        var modal = $('#exampleModal');
        modal.modal('show');
  
        // Bind close functionality to close button
        var closeButton = modal.find('.modal-header .close');
        closeButton.on('click', function() {
          modal.modal('hide');
        });
  
        // Remove the event listener once the modal is opened
        $(window).off("scroll");
      }
    });
  });
  
  
  // Scroll Modal open end


// slides Start


  
   


// slides End










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

//   kyc file FileChooser end



// tabing form section start

  // document.addEventListener("DOMContentLoaded", function () {
  //   var tabs = document.querySelectorAll('.tabcontent');
  //   var tabLinks = document.querySelectorAll('.tablinks');
  //   var currentTab = 0;
  //   var btnPrevious = document.querySelector('.btnPrevious');
  //   var btnNext = document.querySelector('.btnNext');
  //   var submitButton = document.querySelector('.submitButton');

  //   // Function to switch between tabs
  //   function openTab(tabIndex) {
      
  //     tabs.forEach(function (tab) {
  //       tab.classList.remove('active');
  //     });
  //     tabLinks.forEach(function (link) {
  //       link.classList.remove('active');
  //     });
  //     tabs[tabIndex].classList.add('active');
  //     tabLinks[tabIndex].classList.add('active');

  //     // Toggle display of Previous button
  //     btnPrevious.style.display = (tabIndex === 0) ? "none" : "block";
  //     // Toggle display of Next button
  //     btnNext.style.display = (tabIndex === tabs.length - 1) ? "none" : "block";
  //     // Toggle display of Submit button
  //     submitButton.style.display = (tabIndex === tabs.length - 1) ? "block" : "none";
  //   }

  //   // Next button functionality
  //   btnNext.addEventListener('click', function () {
  //     currentTab = (currentTab + 1) % tabs.length;
  //     openTab(currentTab);
  //   });

  //   // Previous button functionality
  //   btnPrevious.addEventListener('click', function () {
  //     currentTab = (currentTab - 1 + tabs.length) % tabs.length;
  //     openTab(currentTab);
  //   });

  //   // Open the first tab by default
  //   openTab(currentTab);
  // });

// tabing form section end


// Star rating Section start

  jQuery(document).ready(function($) {
  $('.rating .star').hover(function() {
    $(this).addClass('to_rate');
    $(this).parent().find('.star:lt(' + $(this).index() + ')').addClass('to_rate');
    $(this).parent().find('.star:gt(' + $(this).index() + ')').addClass('no_to_rate');
  }).mouseout(function() {
    $(this).parent().find('.star').removeClass('to_rate');
    $(this).parent().find('.star:gt(' + $(this).index() + ')').removeClass('no_to_rate');
  }).click(function() {
    $(this).removeClass('to_rate').addClass('rated');
    $(this).parent().find('.star:lt(' + $(this).index() + ')').removeClass('to_rate').addClass('rated');
    $(this).parent().find('.star:gt(' + $(this).index() + ')').removeClass('no_to_rate').removeClass('rated');
    /*Save your rate*/
    /*TODO*/
  });
});

// Star rating Section end




// Teacher details page tabing start

  function openTab(evt, tabName) {
  // Get all elements with class="tabcontent" and hide them
  var tabcontent = document.getElementsByClassName("tabcontent");
  for (var i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  
  // Get all elements with class="tablinks" and remove the class "active"
  var tablinks = document.getElementsByClassName("tablinks");
  for (var i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  
  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}





















