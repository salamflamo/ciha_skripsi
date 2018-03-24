$.ajax({
  url: '/hitung/createTableMatriks',
  success: function (r) {
    $('#isi_table').html(r);
    $('table.datatable').DataTable();
  }
});
