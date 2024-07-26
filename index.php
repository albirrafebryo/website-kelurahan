<?php

session_start();

?>
<!DOCTYPE html>
<html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="main.css">
  <script src="https://unpkg.com/feather-icons"></script>
  <style>

  </style>

</head>
<title>SIDUPA</title>

<body>
  <!-- Preloader -->
  <div id="preloader">
    <div class="line"></div>
  </div>
  <nav class="navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="assets/img/logo.png" alt="" width="50" height="60" class="d-inline-block align-text-top">
        <div class="brand-text">
          <div class="brand-title">SISTEM INFORMASI DATA UMKM KELURAHAN PAJANG</div>
          <div class="address">Jl. Sidomukti Utara I, Pajang, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57146</div>
        </div>
      </a>
      <div class="info-icons">
        <a href="#" id="info-icon" title="info">
          <i data-feather="info"></i>
        </a>
      </div>
    </div>
  </nav>
  <div class="container">
    <!-- <div class="mt-3"> -->
    <!-- <h2 class="text-center">Input Data</h2> -->
  </div>
  <div class="card text-center mt-3 fade-in">
    <div class="card-header text-white h2">
      Data UMKM Kelurahan Pajang
    </div>
    <thead>
      <table class="table table-bordered table-striped table-hover">
        <tr class="tr">
          <th>No</th>
          <th>Foto Produk</th>
          <th>Nama UMKM</th>
          <th>Alamat UMKM</th>
          <th>No Hp</th>
          <th>No Izin</th>
          <th>Nama Pemilik</th>
        </tr>
    </thead>
    <?php
    include "koneksi.php";
    $sql = "select * from umkm order by id_umkm desc";

    $hasil = mysqli_query($kon, $sql);

    $no = 0;
    while ($data = mysqli_fetch_array($hasil)) {
      $no++;
      $fotoProdukPath = "admin/foto/" . basename($data["foto_produk"]);
      $noHp = $data["no_hp"]; // Simpan nomor HP dalam variabel
    ?>
      <tbody>
        <tr>
          <td><?php echo $no; ?></td>
          <td><img src="<?php echo $fotoProdukPath; ?>" alt="Foto Produk" style="width: 200px; height: 200px"></td>
          <td><?php echo $data["nama_umkm"];   ?></td>
          <td><?php echo $data["alamat_umkm"];   ?></td>
          <td><a href="tel:<?php echo $noHp; ?>"><?php echo $noHp; ?></a></td> <!-- Membuat nomor HP bisa diklik -->
          <td><?php echo $data["no_izin"];   ?></td>
          <td><?php echo $data["nama_pemilik"]; ?></td>
        </tr>
      </tbody>
    <?php
    }
    ?>
  </div>
  </table>
  <footer>
    <p>&copy; 2024 Sistem Informasi Data UMKM Kelurahan Pajang.</p>
    <div class="social-icons">
      <a href=https://www.facebook.com/profile.php?id=61550343820996&mibextid=ZbWKwL" target="_blank" title="Facebook">
        <i data-feather="facebook"></i>
      </a>
      <a href="https://www.instagram.com/pajanginfo" target="_blank" title="Instagram">
        <i data-feather="instagram"></i>
      </a>
      <a href="tel: 021-0271721096" target="_blank" title="phone">
        <i data-feather="phone"></i>
      </a>
    </div>
  </footer>
  </div>

  <script src="preload.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    feather.replace(); // Replace all feather icons
    document.addEventListener('DOMContentLoaded', function() {
      var infoIcon = document.getElementById('info-icon');

      infoIcon.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        Swal.fire({
          title: 'Info',
          text: 'Silahkan hubungi admin untuk tambah data.',
          icon: 'info',
          confirmButtonText: 'OK'
        });
      });
    });
  </script>
  <script>
    let lastScrollTop = 0;
    const footer = document.querySelector('footer');

    window.addEventListener('scroll', function() {
      let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

      if (currentScroll > lastScrollTop) {
        // Scroll Down
        footer.classList.add('hidden');
      } else {
        // Scroll Up
        footer.classList.remove('hidden');
      }

      lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // For Mobile or negative scrolling
    });
  </script>
</body>

</html>