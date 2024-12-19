<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman User
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end mb-1">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahUser">Tambah User</button>
                </div>
            </div>
            <!-- Modal Tambah User start -->
            <div class="modal fade" id="modalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" action="proses/proses_input_user.php" method="post" novalidate>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Masukan Nama Anda" name="nama" required>
                                            <label for="floatingInput">Nama</label>
                                            <div class="invalid-feedback">
                                                Masukkan nama yang valid.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required>
                                            <label for="floatingInput">Email</label>
                                            <div class="invalid-feedback">
                                                Masukkan Email yang valid.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="level" required>
                                                <option selected hidden value="">Pilih level User</option>
                                                <option value="1">Admin</option>
                                                <option value="2">Kasir</option>
                                                <option value="3">Pelayan</option>
                                                <option value="4">Dapur</option>
                                            </select>
                                            <label for="floatingInput">Level User</label>
                                            <div class="invalid-feedback">
                                                Masukkan level yang valid.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="08xxx" name="nohp">
                                            <label for="floatingInput">No HP</label>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingInput" placeholder="password" name="password" required>
                                    <label for="floatingPassword">Password</label>
                                    <div class="invalid-feedback">
                                        Masukkan password yang valid.
                                    </div>
                                </div>


                                <div class="form-floating">
                                    <textarea class="form-control" name="alamat" id="" style="height:100px;"></textarea>
                                    <label for="floatingInput">Alamat</label>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="input_user_validate" value="12345" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Tambah User end -->

            <?php
            foreach ($result as $row) {
                $level_text = '';
                switch ($row['level']) {
                    case 1:
                        $level_text = 'Admin';
                        break;
                    case 2:
                        $level_text = 'Kasir';
                        break;
                    case 3:
                        $level_text = 'Pelayan';
                        break;
                    case 4:
                        $level_text = 'Dapur';
                        break;
                    default:
                        $level_text = 'Unknown';
                        break;
                }
            ?>
                <!-- Modal view start -->
                <div class="modal fade" id="modalView<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" action="proses/proses_input_user.php" method="post" novalidate>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="Masukan Nama Anda" name="nama" value="<?php echo $row['nama'] ?>" disabled>
                                                <label for="floatingInput">Nama</label>
                                                <div class="invalid-feedback">
                                                    Masukkan nama yang valid.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" value="<?php echo $row['username'] ?>" disabled>
                                                <label for=" floatingInput">Email</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Email yang valid.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example" disabled name="level" id="">
                                                    <?php
                                                    $data = array("Admin", "Kasir", "Pelayan", "Dapur");
                                                    foreach ($data as $key => $value) {
                                                        if ($row['level'] == $key + 1) {
                                                            echo "<option selected value='$key'>$value</option>";
                                                        } else {
                                                            echo "<option value='$key'>$value</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingInput">Level User</label>
                                                <div class="invalid-feedback">
                                                    Masukkan level yang valid.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="08xxx" name="nohp" value="<?php echo $row['nohp'] ?>" disabled>
                                                <label for="floatingInput">No HP</label>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-floating">
                                        <textarea class="form-control" name="alamat" id="" style="height:100px;" disabled><?php echo $row['alamat'] ?></textarea>
                                        <label for="floatingInput">Alamat</label>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <!-- <button type="submit" name="input_user_validate" value="12345" class="btn btn-primary">Save changes</button> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal view end -->

                <!-- Modal Edit start -->
                <div class="modal fade" id="modalEdit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" action="proses/proses_edit_user.php" method="post" novalidate>
                                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" required class="form-control" id="floatingInput" placeholder="Masukan Nama Anda" name="nama" value="<?php echo $row['nama'] ?>">
                                                <label for="floatingInput">Nama</label>
                                                <div class="invalid-feedback">
                                                    Masukkan nama yang valid.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input <?php echo ($row['username'] == $_SESSION['username_bendalmar']) ? 'disabled' : ''; ?> type="email" class="form-control" id="floatingInput" required placeholder="name@example.com" name="username" value="<?php echo $row['username'] ?> ">
                                                <label for=" floatingInput">Email</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Email yang valid.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example" required name="level" id="">

                                                    <?php
                                                    $data = array("Admin", "Kasir", "Pelayan", "Dapur");
                                                    foreach ($data as $key => $value) {
                                                        if ($row['level'] == $key + 1) {
                                                            echo "<option selected value=" . ($key + 1) . ">$value</option>";
                                                        } else {
                                                            echo "<option value=" . ($key + 1) . ">$value</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingInput">Level User</label>
                                                <div class="invalid-feedback">
                                                    Masukkan level yang valid.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" placeholder="08xxx" name="nohp" value="<?php echo $row['nohp'] ?>">
                                                <label for="floatingInput">No HP</label>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-floating">
                                        <textarea class="form-control" name="alamat" id="" style="height:100px;"><?php echo $row['alamat'] ?></textarea>
                                        <label for="floatingInput">Alamat</label>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="input_user_validate" value="12345" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Edit end -->

                <!-- Modal Delete start -->
                <div class="modal fade" id="modalDelete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" action="proses/proses_delete_user.php" method="post" novalidate>
                                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                    <div class="col-lg-12">
                                        <?php
                                        if ($row['username'] == $_SESSION['username_bendalmar']) {
                                            echo "<div class='alert alert-danger'>Anda tidak dapat menghapus akun sendiri</div>";
                                        } else {
                                            echo "Apakah anda yakin ingin menghapus user <b>$row[username]</b>";
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="input_user_validate" value="12345" class="btn btn-danger" <?php echo ($row['username'] == $_SESSION['username_bendalmar']) ? 'disabled' : ''; ?>>Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Delete end -->

                <!-- Modal Reset Password start -->
                <div class="modal fade" id="modalResetPassword<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Reset Password</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" action="proses/proses_reset_password.php" method="post" novalidate>
                                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                    <div class="col-lg-12">
                                        <?php
                                        if ($row['username'] == $_SESSION['username_bendalmar']) {
                                            echo "<div class='alert alert-danger'>Anda tidak dapat mereset password sendiri</div>";
                                        } else {
                                            echo "Apakah anda yakin ingin mereset password <b>$row[username]</b> menjadi password bawaan sistem yaitu <b>password</b>";
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="input_user_validate" value="12345" class="btn btn-success" <?php echo ($row['username'] == $_SESSION['username_bendalmar']) ? 'disabled' : ''; ?>>Reset Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Reset Password end -->
            <?php } ?>

            <?php
            if (empty($result)) {
                echo "Data User tidak ada";
            } else {
            ?>
                <div class=" table-responsive mt-2">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Level</th>
                                <th scope="col">No HP</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                                $level_text = '';
                                switch ($row['level']) {
                                    case 1:
                                        $level_text = 'Admin';
                                        break;
                                    case 2:
                                        $level_text = 'Kasir';
                                        break;
                                    case 3:
                                        $level_text = 'Pelayan';
                                        break;
                                    case 4:
                                        $level_text = 'Dapur';
                                        break;
                                    default:
                                        $level_text = 'Unknown';
                                        break;
                                }
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td><?php echo $row['nama'] ?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php echo $level_text ?></td>
                                    <td><?php echo $row['nohp'] ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $row['id'] ?>"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $row['id'] ?>"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalDelete<?php echo $row['id'] ?>"><i class=" bi bi-trash"></i></button>
                                            <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalResetPassword<?php echo $row['id'] ?>"><i class=" bi bi-key"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script src="asset/js/validate.js"></script>