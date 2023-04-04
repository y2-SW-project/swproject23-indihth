import './bootstrap';


import swal from 'sweetalert';

// Settings for the delete warning popup
window.deleteConfirm = function (e) {
    e.preventDefault();
    var form = e.target.form;

    //   Swal.fire(
    //     'Good job!',
    //     'You clicked the button!',
    //     'success'
    //   )

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
        if (result.isConfirmed) {
          Swal.clickConfirm()
          // Swal.fire(
          //   'Deleted!',
          //   'Your file has been deleted.',
          //   'success'
          // )
        }
      })
}

