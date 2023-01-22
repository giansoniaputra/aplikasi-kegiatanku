const flashDataError = $('.flash-data-error').data('flashdata');
if (flashDataError){
  Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: flashDataError,
    footer: '<a href="./generate">Klik disini untuk menambahkan</a> '
  })
}