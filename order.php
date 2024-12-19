<?php
include "proses/connect.php";
date_default_timezone_set('Asia/Jakarta');

$query = mysqli_query($conn, "SELECT tb_order.*,tb_bayar.*,nama, SUM(harga*jumlah) AS harganya FROM tb_order 
LEFT JOIN tb_user ON tb_user.id = tb_order.pelayan
LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
GROUP BY id_order ORDER BY waktu_order DESC");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

// $select_kategori_menu = mysqli_query($conn, "SELECT id_kategori_menu, kategori_menu FROM tb_kategori_menu");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Order
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end mb-1">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahUser">Tambah Order</button>
                </div>
            </div>
            <!-- Modal Tambah Order start -->
            <div class="modal fade" id="modalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Order</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" action="proses/proses_input_order.php" method="post" novalidate>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="kode_order" name="kode_order" placeholder="kode order" readonly value="<?php echo date('ymdHi') . rand(100, 999) ?>">
                                            <label for="kode_order">Kode Order</label>
                                            <div class="invalid-feedback">
                                                Masukkan Kode Order yang valid.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="meja" name="meja" placeholder="Nomor Meja" required>
                                            <label for="meja">Meja</label>
                                            <div class="invalid-feedback">
                                                Masukkan Nomor Meja.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="pelanggan" name="pelanggan" placeholder="nama pelanggan" required>
                                            <label for="pelanggan">Nama Pelanggan</label>
                                            <div class="invalid-feedback">
                                                Masukkan Nama Pelanggan yang valid.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="input_order_validate" value="12345" class="btn btn-success">Buat Order</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Tambah Order end -->

            <?php
            if (empty($result)) {
                echo "Daftar menu tidak ada";
            } else {
                foreach ($result as $row) {
            ?>
                    <!-- Modal Edit start -->
                    <div class="modal fade" id="modalEdit<?php echo $row['id_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Order</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="proses/proses_edit_order.php" method="post" novalidate>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="kode_order" name="kode_order" placeholder="kode order" value="<?php echo $row['id_order'] ?>" readonly>
                                                    <label for="kode_order">Kode Order</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Kode Order yang valid.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="meja" name="meja" placeholder="Nomor Meja" value="<?php echo $row['meja'] ?>" required>
                                                    <label for="meja">Meja</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Meja yang valid.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="pelanggan" name="pelanggan" placeholder="nama pelanggan" required value="<?php echo $row['pelanggan'] ?>">
                                                    <label for="pelanggan">Nama Pelanggan</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Nama Pelanggan yang valid.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="edit_order_validate" value="1234" class="btn btn-warning">Edit Order</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Edit end -->

                    <!-- Modal Delete start -->
                    <div class="modal fade" id="modalDelete<?php echo $row['id_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Order</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="proses/proses_delete_order.php" method="post" novalidate>
                                        <input type="hidden" value="<?php echo $row['id_order'] ?>" name="kode_order">
                                        <div class="col-lg-12">
                                            apakah anda ingin menghapus order atas nama <b><?php echo $row['pelanggan'] ?></b> dengan kode order <b><?php echo $row['id_order'] ?></b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="delete_order_validate" value="12345" class="btn btn-danger">Hapus</button>
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
                                <th scope="col">Kode Order</th>
                                <th scope="col">Pelanggan</th>
                                <th scope="col">Meja</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Pelayan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Waktu Order</th>
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


                                    <td><?php echo $row['id_order'] ?></td>
                                    <td><?php echo $row['pelanggan'] ?></td>
                                    <td><?php echo $row['meja'] ?></td>
                                    <td><?php echo number_format((int)$row['harganya'], 0, ',', '.') ?></td>
                                    <td><?php echo $row['nama'] ?></td>
                                    <td>
                                        <?php echo (!empty($row['id_bayar'])) ? "<span class='badge text-bg-success'>dibayar</span>" : ""; ?>
                                    </td>
                                    <td><?php echo $row['waktu_order'] ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-info btn-sm me-1" href="./?x=order_item&order=<?php echo $row['id_order'] . "&meja=" . $row['meja'] . "&pelanggan=" . $row['pelanggan'] ?>"><i class="bi bi-eye"></i></a>
                                            <button class="<?php echo (!empty($row['id_bayar'])) ? 'btn btn-secondary btn-sm me-1 disabled' : 'btn btn-warning btn-sm me-1'; ?>" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $row['id_order'] ?>"><i class="bi bi-pencil-square"></i></button>
                                            <button class="<?php echo (!empty($row['id_bayar'])) ? 'btn btn-secondary btn-sm me-1 disabled' : 'btn btn-danger btn-sm me-1'; ?>" data-bs-toggle="modal" data-bs-target="#modalDelete<?php echo $row['id_order'] ?>"><i class=" bi bi-trash"></i></button>
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