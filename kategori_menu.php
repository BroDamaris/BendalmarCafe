<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_kategori_menu");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Daftar Kategori Menu
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end mb-1">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahUser">Tambah Kategori Menu</button>
                </div>
            </div>
            <!-- Modal Tambah Kategori Menu start -->
            <div class="modal fade" id="modalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" action="proses/proses_input_kategori_menu.php" method="post" novalidate>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="jenis_menu" id="">
                                                <option value="1">Makanan</option>
                                                <option value="2">Minuman</option>
                                            </select>
                                            <label for="floatingInput">Jenis Menu</label>
                                            <div class="invalid-feedback">
                                                Masukkan Jenis Menu yang valid.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="kategori_menu" placeholder="kategori_menu" required>
                                            <label for="floatingInput">Kategori Menu</label>
                                            <div class="invalid-feedback">
                                                Masukkan Kategori Menu yang valid.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="input_kategori_validate" value="12345" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Tambah Kategori Menu end -->

            <?php
            foreach ($result as $row) {
            ?>

                <!-- Modal Edit start -->
                <div class="modal fade" id="modalEdit<?php echo $row['id_kategori_menu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kategori Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" action="proses/proses_edit_kategori_menu.php" method="post" novalidate>
                                    <input type="hidden" value="<?php echo $row['id_kategori_menu'] ?>" name="id">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example" required name="jenis_menu" id="">
                                                    <?php
                                                    $data = array("Makanan", "Minuman");
                                                    foreach ($data as $key => $value) {
                                                        if ($row['jenis_menu'] == $key + 1) {
                                                            echo "<option selected value=" . ($key + 1) . ">$value</option>";
                                                        } else {
                                                            echo "<option value=" . ($key + 1) . ">$value</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingInput">Jenis Menu</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Jenis Menu yang valid.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" name="kategori_menu" placeholder="kategori_menu" required value="<?php echo $row['kategori_menu'] ?>">
                                                <label for="floatingInput">Kategori Menu</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Kategori Menu yang valid.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="input_kategori_validate" value="12345" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Edit end -->

                <!-- Modal Delete start -->
                <div class="modal fade" id="modalDelete<?php echo $row['id_kategori_menu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Kategori Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" action="proses/proses_delete_kategori_menu.php" method="post" novalidate>
                                    <input type="hidden" value="<?php echo $row['id_kategori_menu'] ?>" name="id">
                                    <div class="col-lg-12">
                                        Apakah anda ingin menghapus kategori <b><?php echo $row['kategori_menu'] ?></b>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="delete_kategori_validate" value="12345" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Delete end -->
            <?php } ?>

            <?php
            if (empty($result)) {
                echo "Data User tidak ada";
            } else {
            ?>
                <!-- Tabel Daftar Kategori Menu Start -->
                <div class=" table-responsive">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Jenis Menu</th>
                                <th scope="col">Kategori Menu</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td><?php echo ($row['jenis_menu'] == 1) ? "Makanan" : "Minuman" ?></td>
                                    <td><?php echo $row['kategori_menu'] ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $row['id_kategori_menu'] ?>"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalDelete<?php echo $row['id_kategori_menu'] ?>"><i class=" bi bi-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- Tabel Daftar Kategori Menu end -->
            <?php } ?>
        </div>
    </div>
</div>

<script src="asset/js/validate.js"></script>