</div>
</div>
</div>

<nav class="navbar navbar-expand navbar-light navbar-bottom">
  <div class="container-fluid">
    <ul class="navbar-nav mx-auto">
      <!-- home -->
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-home text-center d-block"></i>
          <span>Home</span>
        </a>
      </li>
      <!-- pendaftar -->
      <li class="nav-item">
        <a class="nav-link" href="pendaftar.php">
          <i class="fas fa-users text-center d-block"></i>
          <span>Pendaftar</span>
        </a>
      </li>
      <!-- setting -->
      <li class="nav-item">
        <a class="nav-link" href="pengaturan.php">
          <i class="fas fa-cogs text-center d-block"></i>
          <span>Setting</span>
        </a>
      </li>
      <!-- logout -->
      <li class="nav-item">
        <a class="nav-link" href="../config/logout.php">
          <i class="fas fa-sign-out-alt text-center d-block"></i>
          <span>Logout</span>
        </a>
      </li>
    </ul>
  </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.0/js/dataTables.bootstrap5.js"></script>
<!-- Font Awesome JS -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
  $(document).ready(function() {
    $('#pendaftar').DataTable();
  });
</script>

</body>

</html>