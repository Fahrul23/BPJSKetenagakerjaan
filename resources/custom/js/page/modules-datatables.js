"use strict";

$("[data-checkboxes]").each(function() {
  var me = $(this),
    group = me.data('checkboxes'),
    role = me.data('checkbox-role');

  me.change(function() {
    var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
      checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
      dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
      total = all.length,
      checked_length = checked.length;

    if(role == 'dad') {
      if(me.is(':checked')) {
        all.prop('checked', true);
      }else{
        all.prop('checked', false);
      }
    }else{
      if(checked_length >= total) {
        dad.prop('checked', true);
      }else{
        dad.prop('checked', false);
      }
    }
  });
});

$(".table-1").dataTable({
  "language": {
    "lengthMenu": "Tampilkan _MENU_ data",
    "zeroRecords": "Data yang Dicari Tidak Ada.",
    "info": "Menampilkan _PAGE_ dari _PAGES_ Halaman",
    "infoEmpty": "Tidak Menampilkan Data Apapun.",
    "processing": "Sedang Memproses...",
    "infoFiltered": "(Difilter dari _MAX_ Total Record)",
    "search": "Cari ",
    "paginate": {
      "previous": "Prev",
      "next": "Next"
    }
  },
  "columnDefs": [
    { "sortable": false, "targets": [2,3] }
  ]
});

$("#table-2").dataTable({
  "language": {
    "lengthMenu": "Tampilkan _MENU_ data",
    "zeroRecords": "Data yang Dicari Tidak Ada.",
    "info": "Menampilkan _PAGE_ dari _PAGES_ Halaman",
    "infoEmpty": "Tidak Menampilkan Data Apapun.",
    "processing": "Sedang Memproses...",
    "infoFiltered": "(Difilter dari _MAX_ Total Record)",
    "search": "Cari ",
    "paginate": {
      "previous": "Prev",
      "next": "Next"
    }
  },
  "columnDefs": [
    { "sortable": false, "targets": [0,2,3] }
  ]
});
