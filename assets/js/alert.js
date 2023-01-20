const flashData = $('.flash-data').data('flashdata');

if (flashData){
    Swal.fire(
        'Oke',
        'Kegiatatan Berhasil '+ flashData,
        'success'
      )
}