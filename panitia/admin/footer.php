</div>
</div>
</div>

<nav class="navbar navbar-expand navbar-light navbar-bottom mt-5">
  <div class="container-fluid">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pendaftar.php">
          Pendaftar
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pengaturan.php">
          Pengaturan
        </a>
      </li>
    </ul>
  </div>
</nav>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- <script src="https://cdn.datatables.net/2.1.0/js/dataTables.bootstrap5.js"></script> -->
<!-- gpt -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdn.datatables.net/fixedcolumns/4.3.1/js/dataTables.fixedColumns.min.js"></script> -->
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function() {
    $('#pendaftar').DataTable({
      scrollX: true,
      fixedColumns: {
        leftColumns: 2
      },
      lengthMenu: [10, 25, 50, 100],
      language: {
        lengthMenu: "Show _MENU_ entries"
      }
    });
  });
</script>

</body>

</html>