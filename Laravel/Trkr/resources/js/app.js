import './bootstrap';

import '../sass/app.scss'

import swal from 'sweetalert';

// Settings for the delete warning popup
window.deleteConfirm = function (e) {
    e.preventDefault();
    var form = e.target.form;

    // Can change colours to match design
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        
      }).then((result) => {
        // if user confirms delete the form is submitted
        if (result.isConfirmed) {
          form.submit();
        }
      })
}

// Image upload preview
function showPreview(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-ip-1-preview");
    preview.src = src;
    preview.style.display = "block";
  }
}
