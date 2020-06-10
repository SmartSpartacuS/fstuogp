function successTambah(){
    Lobibox.notify('info', {
      pauseDelayOnHover: true,
      icon: 'fa fa-info-circle',
      continueDelayOnInactiveTab: false,
      position: 'center top',
      showClass: 'bounceIn',
          hideClass: 'bounceOut',
          width: 600,
      msg: 'Data Berhasil Ditambahkan'
    });
};

function successUbah(){
    Lobibox.notify('info', {
      pauseDelayOnHover: true,
      icon: 'fa fa-info-circle',
      continueDelayOnInactiveTab: false,
      position: 'center top',
      showClass: 'bounceIn',
          hideClass: 'bounceOut',
          width: 600,
      msg: 'Berhasil Merubah Data'
    });
};

function notifError(idError){
  Lobibox.notify('error', {
    pauseDelayOnHover: true,
    icon: 'fa fa-info-circle',
        continueDelayOnInactiveTab: false,
    position: 'center top',
    showClass: 'zoomIn',
        hideClass: 'zoomOut',
        width: 600,
    msg: idError
  });
};

$(document).ready(function() {
  $('.single-select').select2();
});

function loadMoreData() {
  $.ajax({
      url: '',
      type: "get",
      datatype: "html",
      success:function(data){
          $('#tampil').html(data);
      }
  })
  .fail(function(jqXHR, ajaxOptions, thrownError)
  {
      alert('Server tidak merespon...');
  });
};


