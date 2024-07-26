<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login/login.php");
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>

    </style>

</head>
<title>Admin SIDUPA</title>

<body>

    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/img/logo.png" alt="" width="50" height="60" class="d-inline-block align-text-top">
                <div class="brand-text">
                    <div class="brand-title">SISTEM INFORMASI DATA UMKM KELURAHAN PAJANG</div>
                    <div class="address">Jl. Sidomukti Utara I, Pajang, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57146</div>
                </div>
            </a>
            <a href="#" class="btn btn-danger logout-btn" onclick="confirmLogout()">Logout</a>
        </div>
    </nav>
    <div class="container">
        <div class="mt-3">
            <!-- <h2 class="text-center">Input Data</h2> -->
        </div>
        <div class="card text-center mt-3 fade-in">
            <div class="card-header bg-primary text-white h2">
                Data UMKM Kelurahan Pajang
            </div>
            <?php

            include "koneksi.php";

            //Cek apakah ada kiriman form dari method post
            if (isset($_GET['id_umkm'])) {
                $id_umkm = htmlspecialchars($_GET["id_umkm"]);

                $sql = "delete from umkm where id_umkm='$id_umkm' ";
                $hasil = mysqli_query($kon, $sql);

                //Kondisi apakah berhasil atau tidak
                if ($hasil) {
                    header("Location:index.php");
                } else {
                    echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
                }
            }
            ?>


            <thead>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="resetForm()">
                    Tambah Data
                </button>
                <table class="table table-bordered table-striped table-hover">
                    <tr class="table-dark">
                        <th>No</th>
                        <th>Foto Produk</th>
                        <th>Nama UMKM</th>
                        <th>Alamat UMKM</th>
                        <th>No Hp</th>
                        <th>No Izin</th>
                        <th>Nama Pemilik</th>
                        <th colspan='2'>Opsi</th>

                    </tr>
            </thead>

            <?php
            include "koneksi.php";
            $sql = "select * from umkm order by id_umkm desc";

            $hasil = mysqli_query($kon, $sql);

            $no = 0;
            while ($data = mysqli_fetch_array($hasil)) {
                $no++;

            ?>
                <tbody>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><img src="<?php echo $data["foto_produk"]; ?>" alt="" style="width: 200px; height: 200px"></td>
                        <td><?php echo $data["nama_umkm"];   ?></td>
                        <td><?php echo $data["alamat_umkm"];   ?></td>
                        <td><?php echo $data["no_hp"];   ?></td>
                        <td><?php echo $data["no_izin"];   ?></td>
                        <td><?php echo $data["nama_pemilik"]; ?></td>
                        <td>

                            <button class="btn btn-warning" role="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="editData(<?php echo htmlspecialchars(json_encode($data)); ?>)">Ubah</button>
                            <a href="javascript:void(0);" class="btn btn-danger" role="button" onclick="confirmDelete('<?php echo $data['id_umkm']; ?>')">Hapus</a>

                        </td>
                    </tr>
                </tbody>
            <?php
            }
            ?>
            </table>
            <!-- <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Tambah Data
                </button> -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">INPUT DATA</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="proses_simpan.php" method="post" enctype="multipart/form-data" id="formData" onsubmit="return validatePhoneNumber()">
                                <input type="hidden" name="id_umkm" id="id_umkm">
                                <div class="form-group">
                                    <label>Nama Pemilik:</label>
                                    <input type="text" autocomplete="off" name="nama_pemilik" id="nama_pemilik" class="form-control" placeholder="Masukan Nama Pemilik (Optional)" />
                                </div>
                                <div class="form-group">
                                    <label>Nama UMKM:</label>
                                    <input type="text" autocomplete="off" name="nama_umkm" id="nama_umkm" class="form-control" placeholder="Masukan Nama UMKM" required />
                                </div>
                                <div class="form-group">
                                    <label>Alamat UMKM:</label>
                                    <input type="text" autocomplete="off" name="alamat_umkm" id="alamat_umkm" class="form-control" placeholder="Masukan Alamat UMKM" required />
                                </div>
                                </p>
                                <div class="form-group">
                                    <label>No HP:</label>
                                    <input type="text" autocomplete="off" minlength="10" maxlength="13" pattern="\d+" name="no_hp" id="no_hp" class="form-control" placeholder="Masukan No HP" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />
                                </div>
                                <div class="form-group">
                                    <label>No Izin:</label>
                                    <input type="text" autocomplete="off" name="no_izin" id="no_izin" class="form-control" placeholder="Masukan No Izin" required />
                                </div>
                                <div class="form-group">
                                    <label>Foto Produk:</label>
                                    <input type="file" name="foto_produk" class="form-control" placeholder="" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<script>
    function resetForm() {
        document.getElementById('formData').reset();
        document.getElementById('id_umkm').value = '';
        document.getElementById('formModalLabel').innerText = 'Tambah Data';
        document.getElementById('foto_produk').required = true;
    }

    function editData(data) {
        document.getElementById('id_umkm').value = data.id_umkm;
        document.getElementById('nama_pemilik').value = data.nama_pemilik;
        document.getElementById('nama_umkm').value = data.nama_umkm;
        document.getElementById('alamat_umkm').value = data.alamat_umkm;
        document.getElementById('no_hp').value = data.no_hp;
        document.getElementById('no_izin').value = data.no_izin;
        document.getElementById('formModalLabel').innerText = 'Ubah Data';
        document.getElementById('foto_produk').required = false;
    }

    function confirmDelete(id_umkm) {
        Swal.fire({
            title: 'Anda yakin ingin menghapus data ini?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "hapus.php?id_umkm=" + id_umkm;
            }
        })
    }

    function confirmLogout() {
        Swal.fire({
            title: 'Anda yakin ingin keluar?',
            text: "Anda akan diarahkan ke halaman login.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, keluar!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'logout.php';
            }
        })
    }

    function validatePhoneNumber() {
        const phoneNumber = document.getElementById('no_hp').value;
        if (phoneNumber.length < 10) {
            Swal.fire({
                title: "Nomor HP tidak valid",
                text: "Nomor HP harus terdiri dari minimal 10 angka.",
                icon: "error"
            });
            return false;
        }
        return true;
    }

    <?php if (isset($_SESSION['success'])) : ?>
        Swal.fire({
            title: "Berhasil",
            text: "<?= $_SESSION['success'] ?>",
            icon: "success"
        });
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])) : ?>
        Swal.fire({
            title: "Gagal",
            text: "<?= $_SESSION['error'] ?>",
            icon: "error"
        });
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
</script>


</html>