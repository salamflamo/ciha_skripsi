var form = $('form[name=form_nilai]');
var form_target = $('form#target_form');
var penilaian_form = $('form#penilaian_form');
var nilai_asli = null;

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
      alert("Gagal update");
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
      alert("Gagal update");
    }
  });
});

function refresh_table(flag_untuk) {
  $.ajax({
    url : '/hitung/main/'+flag_untuk,
    dataType:'json',
    success:function (r) {
      // $.each(r,function (i,v) {
      //   $('#isi_table').append(v);
      // });
      $('#isi_table').html(r.prefrensi);
      $('#isi_table_p').html(r.penilaian);
    },
    error:function (e) {
      $('#isi_table').html("");
    }
  });
}

function hapus(id) {
  var konfir = confirm("Konfirmasi hapus");
  if (konfir) {
    $.ajax({
      url:'/main/penilaian_delete/'+id,
      success:function (r) {
        alert("Berhasil hapus");
        var flag = $('select[name=flag_untuk]').val();
        refresh_table(flag);
      },
      error:function (e) {

      }
    });
  }
}

$(function () {
  var flag = $('select[name=flag_untuk]').val();
  refresh_table(flag);
  $('select[name=flag_untuk]').on('change',function () {
    refresh_table($(this).val());
  });
});
