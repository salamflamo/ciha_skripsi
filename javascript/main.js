var form = $('form[name=form_nilai]');
var form_target = $('form#target_form');
var penilaian_form = $('form#penilaian_form');
var form_update_info = $('form#form_update_info');
var nilai_asli = null;
var base_url = $('link#base_url').attr('href');
var blockui = function () {
  $.blockUI({
            message: '<img src="http://rs717.pbsrc.com/albums/ww173/prestonjjrtr/Smileys/Volleyball.gif~c200" style="width:40%;height:auto"/><br><h3>Counting...</h3>',
            overlayCSS: {
                backgroundColor: '#eaedf2',
                opacity: 0.5,
                cursor: 'wait',
            },
            css: {
                border: 0,
                padding: 0,
                margin:0,
                backgroundColor: 'transparent',
                top:'20%',
            }
        });
}
var unblockui = function () {
  $.unblockUI();
}

$('input.nilai').on('input',function () {
  var nilai = $(this).val();
  if (parseInt(nilai) > 5 || parseInt(nilai) < 0) {
    alert("Tidak boleh kurang atau lebih dari 5")
    $(this).val("");
  }
});
$('input.target').on('click',function () {
  var asli = $(this).val();
  nilai_asli = asli;
});
$('input.target').on('input',function () {
  var nilai = $(this).val();
  if (parseInt(nilai) > 5 || parseInt(nilai) < 0) {
    alert("Tidak boleh kurang atau lebih dari 5")
    $(this).val(nilai_asli);
  }
});

$('div#isi_table_p').on('click','table tbody tr td input.penilaian',function () {
  var nilai = $(this).val();
  nilai_asli = nilai;
});
$('div#isi_table_p').on('input','table tbody tr td input.penilaian',function () {
  var nilai = $(this).val();
  if (parseInt(nilai) > 5 || parseInt(nilai) < 0) {
    alert("Tidak boleh kurang atau lebih dari 5")
    $(this).val(nilai_asli);
  }
});

form.submit(function (e) {
  e.preventDefault();
  var data = $(this).serialize();
  var url = $(this).attr('action');
  $.ajax({
    url: url,
    method:'post',
    data:data,
    success:function (r) {
      if (r==1) {
        alert("Berhasil simpan");
        $('button[name=reset]').trigger('click');
        var flag = $('select[name=flag_untuk]').val();
        refresh_table(flag);
      } else {
        alert("Gagal simpan");
      }
    }
  });
});

form_target.submit(function (e) {
  e.preventDefault();
  var data = $(this).serialize();
  var url = $(this).attr('action');
  $.ajax({
    url:url,
    method:'post',
    data:data,
    success:function (r) {
      alert("Berhasil update");
      var flag = $('select[name=flag_untuk]').val();
      refresh_table(flag);
    },
    error:function (e) {
      alert("Terjadi kesalahan gagal update");
    }
  });
});

penilaian_form.submit(function (e) {
  e.preventDefault();
  var data = $(this).serialize();
  var url = $(this).attr('action');
  $.ajax({
    url:url,
    method:'post',
    data:data,
    success:function (r) {
      alert("Berhasil update");
      var flag = $('select[name=flag_untuk]').val();
      refresh_table(flag);
    },
    error:function (e) {
      alert("Terjadi kesalahan gagal update");
    }
  });
});

form_update_info.submit(function (e) {
  e.preventDefault();
  var url = $(this).attr('action')+$(this).attr('data-id');
  var data = $(this).serialize();
  $.ajax({
    url:url,
    data:data,
    method:'post',
    success:function (r) {
      if (r) {
        alert("Berhasil update");
        $('button[name=reset_form_update]').trigger('click');
      }
    },
    error:function (e) {
      alert("Error "+e);
    }
  });
});

function refresh_table(flag_untuk) {
  blockui();
  $.ajax({
    url : base_url+'hitung/main/'+flag_untuk,
    dataType:'json',
    success:function (r) {
      // $.each(r,function (i,v) {
      //   $('#isi_table').append(v);
      // });
      setTimeout(function () {
        unblockui();
        $('#isi_table').html(r.prefrensi);
        $('#isi_table_p').html(r.penilaian);
        $('#klik').trigger('click');
      }, 1000);
    },
    error:function (e) {
      alert("Terjadi kesalahan, reload halaman");
      unblockui();
      $('#isi_table').html("");
    }
  });
}

function hapus(id) {
  var konfir = confirm("Konfirmasi hapus");
  if (konfir) {
    $.ajax({
      url:base_url+'main/penilaian_delete/'+id,
      success:function (r) {
        alert("Berhasil hapus");
        var flag = $('select[name=flag_untuk]').val();
        refresh_table(flag);
      },
      error:function (e) {
        alert("Terjadi kesalahan gagal hapus");
      }
    });
  }
}

function detail(id,dari) {
  $.ajax({
    url:base_url+'main/detail_pemain/'+id,
    dataType:'json',
    success:function (r) {
      var text = 'Pemain <strong>'+r.nama+'</strong>, umur <strong>'+r.umur+'</strong>, tinggi badan <strong>'+r.tinggi_bdn+'</strong> dan berat badan <strong>'+r.berat_bdn+'</strong>.';
      $('#text_detail_pemain').html(text);
      $('#form_update_info').attr('data-id',id);
      $('#update_nama').val(r.nama);
      $('#update_umur').val(r.umur);
      $('#update_lahir').val(r.lahir);
      $('#update_tinggi_bdn').val(r.tinggi_bdn);
      $('#update_berat_bdn').val(r.berat_bdn);
      if (dari=='update') {
        $('#modal_detail_pemain').modal('show');
      } else if (dari=='detail') {
        $('#modal_detail_pemain_2').modal('show');
      }
    },
    error:function (e) {

    }
  });
}

$(function () {
  var flag = $('select[name=flag_untuk]').val();
  refresh_table(flag);
  $('select[name=flag_untuk]').on('change',function () {
    refresh_table($(this).val());
  });
  $('#modal_welcome').modal({keyboard:false,backdrop:'static'});
  $('#modal_welcome').modal('show');
});
