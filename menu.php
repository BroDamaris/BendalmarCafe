<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_daftar_menu LEFT JOIN tb_kategori_menu ON tb_kategori_menu.id_kategori_menu = tb_daftar_menu.kategori");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$select_kategori_menu = mysqli_query($conn, "SELECT id_kategori_menu, kategori_menu FROM tb_kategori_menu");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Menu
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end mb-1">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahUser">Tambah Menu</button>
                </div>
            </div>
            <!-- Modal Tambah Menu Baru start -->
            <div class="modal fade" id="modalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" action="proses/proses_input_menu.php" method="post" novalidate enctype="multipart/form-data">

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="masukan nama menu" name="nama_menu" required>
                                    <label for="floatingInput">Nama Menu</label>
                                    <div class="invalid-feedback">
                                        Masukkan Nama Menu yang valid.
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control py-3" id="uploadGambar" placeholder="Masukan gambar" name="gambar" required>
                                    <label class="input-group-text" for="uploadGambar">Upload Gambar</label>
                                    <div class="invalid-feedback">
                                        Masukkan file gambar yang valid.
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="masukan nama menu" name="keterangan">
                                    <label for="floatingInput">Keterangan</label>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="kategori_menu" required>
                                                <option value="" hidden>Pilih Kategori Menu</option>
                                                <?php
                                                foreach ($select_kategori_menu as $value) {
                                                    echo "<option value='{$value['id_kategori_menu']}'>{$value['kategori_menu']}</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingInput">Kategori Menu</label>
                                            <div class="invalid-feedback">
                                                Masukkan kategori yang valid.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="harga" name="harga" required>
                                            <label for="floatingInput">Harga</label>
                                            <div class="invalid-feedback">
                                                Masukkan Harga yang valid.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" placeholder="stok" name="stok" required>
                                            <label for="floatingInput">Stok</label>
                                            <div class="invalid-feedback">
                                                Masukkan Stok yang valid.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="input_menu_validate" value="12345" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Tambah Menu Baru end -->

            <?php
            if (empty($result)) {
                echo "Daftar menu tidak ada";
            } else {
                foreach ($result as $row) {
            ?>
                    <!-- Modal view start -->
                    <div class="modal fade" id="modalView<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Lihat Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="proses/proses_input_menu.php" method="post" novalidate enctype="multipart/form-data">

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="<?php echo $row['nama_menu'] ?>" disabled>
                                            <label for="floatingInput">Nama Menu</label>
                                            <div class="invalid-feedback">
                                                Masukkan Nama Menu yang valid.
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" value="<?php echo $row['keterangan'] ?>" disabled>
                                            <label for="floatingInput">Keterangan</label>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" aria-label="Default select example" disabled>
                                                        <option value="" hidden>Pilih Kategori Menu</option>
                                                        <?php
                                                        foreach ($select_kategori_menu as $value) {
                                                            if ($row['kategori'] == $value['id_kategori_menu']) {
                                                                echo "<option selected value='{$value['id_kategori_menu']}'>{$value['kategori_menu']}</option>";
                                                            } else {
                                                                echo "<option value='{$value['id_kategori_menu']}'>{$value['kategori_menu']}</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="floatingInput">Kategori Menu</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan kategori yang valid.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" value="<?php echo $row['harga'] ?>" disabled>
                                                    <label for="floatingInput">Harga</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Harga yang valid.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" value="<?php echo $row['stok'] ?>" disabled>
                                                    <label for="floatingInput">Stok</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Stok yang valid.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <!-- <button type="submit" name="input_menu_validate" value="12345" class="btn btn-primary">Save changes</button> -->
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="proses/proses_edit_menu.php" method="post" novalidate enctype="multipart/form-data">
                                        <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="masukan nama menu" name="nama_menu" required value="<?php echo $row['nama_menu'] ?>">
                                            <label for="floatingInput">Nama Menu</label>
                                            <div class="invalid-feedback">
                                                Masukkan Nama Menu yang valid.
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control py-3" id="uploadGambar" placeholder="Masukan gambar" name="gambar" required>
                                            <label class="input-group-text" for="uploadGambar">Upload Gambar</label>
                                            <div class="invalid-feedback">
                                                Masukkan file gambar yang valid.
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="masukan nama menu" name="keterangan" value="<?php echo $row['keterangan'] ?>">
                                            <label for="floatingInput">Keterangan</label>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" aria-label="Default select example" name="kategori_menu">
                                                        <option value="" hidden>Pilih Kategori Menu</option>
                                                        <?php
                                                        foreach ($select_kategori_menu as $value) {
                                                            if ($row['kategori'] == $value['id_kategori_menu']) {
                                                                echo "<option selected value='{$value['id_kategori_menu']}'>{$value['kategori_menu']}</option>";
                                                            } else {
                                                                echo "<option value='{$value['id_kategori_menu']}'>{$value['kategori_menu']}</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="floatingInput">Kategori Menu</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan kategori yang valid.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="harga" name="harga" required value="<?php echo $row['harga'] ?>">
                                                    <label for="floatingInput">Harga</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Harga yang valid.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="stok" name="stok" required value="<?php echo $row['stok'] ?>">
                                                    <label for="floatingInput">Stok</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Stok yang valid.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="edit_menu_validate" value="12345" class="btn btn-primary">Save changes</button>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="proses/proses_delete_menu.php" method="post" novalidate>
                                        <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                        <input type="hidden" value="<?php echo $row['gambar'] ?>" name="gambar">
                                        <div class="col-lg-12">
                                            apakah anda ingin menghapus menu <b><?php echo $row['nama_menu'] ?></b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="delete_user_validate" value="12345" class="btn btn-danger">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Delete end -->

                <?php } ?>



                <div class=" table-responsive mt-2">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr class="text-no-warp">
                                <th scope="col">No</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Nama Menu</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Jenis</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stok</th>
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

                                    <td>
                                        <div style="width: 90px;">
                                            <img src="asset/images/<?php echo $row['gambar'] ?>" class="img-thumbnail" alt="...">
                                        </div>
                                    </td>
                                    <td><?php echo $row['nama_menu'] ?></td>
                                    <td>
                                        <?php echo $row['keterangan'] ?>
                                    </td>
                                    <td><?php echo ($row['jenis_menu'] == 1) ? "Makanan" : "Minuman" ?></td>
                                    <td><?php echo $row['kategori_menu'] ?></td>
                                    <td><?php echo $row['harga'] ?></td>
                                    <td><?php echo $row['stok'] ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalView<?php echo $row['id'] ?>"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $row['id'] ?>"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalDelete<?php echo $row['id'] ?>"><i class=" bi bi-trash"></i></button>
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