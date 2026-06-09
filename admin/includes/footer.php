  <!-- Bootstrap 5 JS -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery (Required for DataTables) -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <!-- Admin Script -->
  <script src="../admin/js/admin.js"></script>
  
  <!-- Auto-initialize DataTables -->
  <script>
    $(document).ready(function() {
      if ($('.datatable').length) {
        $('.datatable').DataTable({
          "language": {
            "lengthMenu": "Show _MENU_ entries",
            "zeroRecords": "Data tidak ditemukan",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "Showing 0 to 0 of 0 entries",
            "infoFiltered": "(disaring dari _MAX_ entri)",
            "search": "Search:",
            "paginate": {
              "first": "Pertama",
              "last": "Terakhir",
              "next": "Next",
              "previous": "Previous"
            }
          }
        });
      }
    });
  </script>
</body>
</html>
