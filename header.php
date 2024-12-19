<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_bendalmar]'");
$records = mysqli_fetch_array($query);
?>

<nav class="navbar navbar-expand navbar-dark bg-danger sticky-top">
    <div class="container-lg">
        <a class="navbar-brand" href="."><i class="bi bi-cup-hot"></i> BendalmarCafe</a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $hasil['username']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalProfile"><i class="bi bi-person-square"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalUbahPassword"><i class="bi bi-key"></i> Ubah Password
                            </a></li>
                        <li><a class="dropdown-item" href="logout"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal Ubah Password start -->
<div class="modal fade" id="modalUbahPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="proses/proses_ubah_password.php" method="post" novalidate>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input disabled type="email" class="form-control" id="floatingInput" required placeholder="name@example.com" name="username" value="<?php echo $_SESSION['username_bendalmar'] ?> ">
                                <label for=" floatingInput">Username</label>
                                <div class="invalid-feedback">
                                    Masukkan username yang valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" required name="passwordLama" value="">
                                <label for=" floatingPassword">Password Lama</label>
                                <div class=" invalid-feedback">
                                    Masukkan Password Lama yang valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" required name="passwordBaru" value="">
                                <label for=" floatingPassword">Password Baru</label>
                                <div class=" invalid-feedback">
                                    Masukkan Password Baru yang valid.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" required name="repasswordBaru" value="">
                                <label for=" floatingPassword">Ulangi Password Baru</label>
                                <div class=" invalid-feedback">
                                    Ulangi Password Baru yang valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="ubah_password_validate" value="12345" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ubah Password end -->

<!-- Modal Profile start -->
<div class="modal fade" id="modalProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="proses/proses_profile.php" method="post" novalidate>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-floating mb-3">
                                <input disabled type="email" class="form-control" id="floatingInput" required placeholder="name@example.com" name="username" value="<?php echo $_SESSION['username_bendalmar'] ?> ">
                                <label for=" floatingInput">Username</label>
                                <div class="invalid-feedback">
                                    Masukkan username yang valid.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingPassword" required name="nama" value="<?php echo $records['nama'] ?>">
                                <label for=" floatingPassword">Nama</label>
                                <div class=" invalid-feedback">
                                    Masukkan Nama yang valid.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingPassword" required name="nohp" value="<?php echo $records['nohp'] ?>">
                                <label for=" floatingPassword">Nomor HP</label>
                                <div class=" invalid-feedback">
                                    Masukkan Nomor HP yang valid.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" name="alamat" id="" style="height:100px;"><?php echo $records['alamat'] ?></textarea>
                        <label for="floatingInput">Alamat</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="profile_validate" value="12345" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Profile end -->

<script src="asset/js/validate.js"></script>