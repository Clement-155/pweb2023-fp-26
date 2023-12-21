$(function() {
    $(document).ready(function() {
      $('#example').DataTable();
      
    });
    $.extend( $.fn.dataTable.defaults, {
        responsive: true
      } );
  });
  