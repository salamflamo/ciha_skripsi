var data = '';
var base_url = $('link#base_url').attr('href');

$.ajax({
    url:base_url+'hitung/ambil_formasi',
    dataType:'json',
    success:function (r) {
      var w = 1;
      var el = '';
      r.forEach(function (e) {
        el += '<div class="isi">' +
          '<h3>Nama : '+ e.nama +'</h3>' +
          '<p>Tinggi Badan : '+ e.tinggi_bdn +' cm</p>' +
          '<p>Berat Badan : '+ e.berat_bdn +' Kg</p>' +
        '</div>';
        if (e.id == 1) {
          $('#s').text(e.nama);
        } else if (e.id == 2) {
          if (w==1) {
            $('#w1').text(e.nama);
            w++;
          } else {
            $('#w2').text(e.nama);
          }
        } else if (e.id == 3) {
          $('#m').text(e.nama);
        } else if (e.id == 4) {
          $('#l').text(e.nama);
        } else if (e.id == 5) {
          $('#u').text(e.nama);
        }
      });
      $('div#pemains').html(el);
    },
    error:function (e) {
      alert(e);
    }
});
