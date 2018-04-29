var form = $('form[name=form_nilai]');

$('input.nilai').on('input',function () {
  var nilai = $(this).val();
  if (parseInt(nilai) > 5 || parseInt(nilai) <= 0) {
    alert("Tidak boleh kurang atau lebih dari 5")
    $(this).val("");
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

function refresh_table(flag_untuk) {
  $.ajax({
    url : '/hitung/main/'+flag_untuk,
    dataType:'json',
    success:function (r) {
      // $.each(r,function (i,v) {
      //   $('#isi_table').append(v);
      // });
      $('#isi_table').html(r);
    }
  });
}

$(function () {
  var flag = $('select[name=flag_untuk]').val();
  refresh_table(flag);
});
