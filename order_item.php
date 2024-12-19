<?php
include "proses/connect.php";

$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS harganya, tb_order.waktu_order FROM tb_list_order 
LEFT JOIN tb_order ON  tb_order.id_order = tb_list_order.kode_order
LEFT JOIN tb_daftar_menu ON tb_daftar_menu.id = tb_list_order.menu
LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
GROUP BY id_list_order
HAVING tb_list_order.kode_order = $_GET[order]");

$kode = $_GET['order'];
$pelanggan = $_GET['pelanggan'];
$meja = $_GET['meja'];

while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$select_menu = mysqli_query($conn, "SELECT id, nama_menu FROM tb_daftar_menu");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Order Item
        </div>
        <div class="card-body">
            <a href="order" class="btn btn-danger mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="kode_order" value="<?php echo $kode ?>">
                        <label for="kode_order">Kode Order</label>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="pelanggan" value="<?php echo $pelanggan ?>">
                        <label for="pelanggan">Pelanggan</label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="meja" value="<?php echo $meja ?>">
                        <label for="meja">Meja</label>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Item start -->
            <div class="modal fade" id="tambahItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Order Item</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" action="proses/proses_input_order_item.php" method="post" novalidate>
                                <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="menu" id="" required>
                                                <option selected hidden value="">Pilih Menu</option>
                                                <?php
                                                foreach ($select_menu as $value) {
                                                    echo "<option value=$value[id]>$value[nama_menu]</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="menu">Menu</label>
                                            <div class="invalid-feedback">
                                                Pilih Menu yang valid.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="jumlah porsi" required>
                                            <label for="jumlah">Jumlah</label>
                                            <div class="invalid-feedback">
                                                Masukkan jumlah porsi yang valid.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="catatan" placeholder="masukan Catatan" name="catatan">
                                    <label for="catatan">Catatan</label>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="input_order_item_validate" value="12345" class="btn btn-success"><i class="bi bi-plus-circle-fill"></i> Tambah Item</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Tambah Item end -->

            <?php
            if (empty($result)) {
                echo "Daftar menu tidak ada";
            } else {
                foreach ($result as $row) {
            ?>
                    <!-- Modal Edit start -->
                    <div class="modal fade" id="modalEdit<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Order Item</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="proses/proses_edit_order_item.php" method="post" novalidate>
                                        <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                                        <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                        <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" name="menu" id="" required>
                                                        <option selected hidden value="">Pilih Menu</option>
                                                        <?php
                                                        foreach ($select_menu as $value) {
                                                            if ($row['menu'] == $value['id']) {
                                                                echo "<option selected value=$value[id]>$value[nama_menu]</option>";
                                                            } else {
                                                                echo "<option value=$value[id]>$value[nama_menu]</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="menu">Menu</label>
                                                    <div class="invalid-feedback">
                                                        Pilih Menu yang valid.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="jumlah porsi" required value="<?php echo $row['jumlah'] ?>">
                                                    <label for="jumlah">Jumlah</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan jumlah porsi yang valid.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="catatan" placeholder="masukan Catatan" name="catatan" value="<?php echo $row['catatan'] ?>">
                                            <label for="catatan">Catatan</label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="edit_order_item_validate" value="12345" class="btn btn-warning">Edit Item</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Edit end -->

                    <!-- Modal Delete start -->
                    <div class="modal fade" id="modalDelete<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Order Item</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="proses/proses_delete_order_item.php" method="post" novalidate>
                                        <input type="hidden" value="<?php echo $row['id_list_order'] ?>" name="id">
                                        <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                        <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                        <div class="col-lg-12">
                                            apakah anda ingin menghapus item <b><?php echo $row['nama_menu'] ?></b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="delete_order_item_validate" value="12345" class="btn btn-danger">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Delete end -->

                <?php } ?>

                <!-- Modal Bayar start -->
                <div class="modal fade" id="bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class=" table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr class="text-no-warp">

                                                <th scope="col">Menu</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Catatan</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total  = 0;
                                            foreach ($result as $row) {

                                            ?>
                                                <tr>
                                                    <td><?php echo $row['nama_menu'] ?></td>
                                                    <td> <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                                                    <td><?php echo $row['jumlah'] ?></td>
                                                    <td><?php echo $row['status'] ?></td>
                                                    <td><?php echo $row['catatan'] ?></td>
                                                    <td> <?php echo number_format($row['harganya'], 0, ',', '.'); ?></td>

                                                </tr>
                                            <?php
                                                $total += $row['harganya'];
                                            } ?>
                                            <tr>
                                                <td class="fw-bold" colspan="5">
                                                    Total harga
                                                </td>
                                                <td class="fw-bold">
                                                    <?php echo number_format($total, 0, ',', '.'); ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <form class="needs-validation" action="proses/proses_bayar.php" method="post" novalidate>
                                    <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                    <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                    <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                    <input type="hidden" name="total" value="<?php echo $total ?>">

                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="uang" name="uang" placeholder="uang" required>
                                        <label for="uang">Nominal Uang</label>
                                        <div class="invalid-feedback">
                                            Masukkan Nominal Uang yang valid.
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="bayar_validate" value="12345" class="btn btn-primary"><i class="bi bi-cash-coin"></i> Bayar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Bayar end -->

                <div class=" table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-no-warp">

                                <th scope="col">Menu</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Status</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Total</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total  = 0;
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <td><?php echo $row['nama_menu'] ?></td>
                                    <td> <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                                    <td><?php echo $row['jumlah'] ?></td>
                                    <td>
                                        <?php
                                        if ($row['status'] == 1) {
                                            echo "<span class='badge text-bg-warning'>Masuk Ke Dapur</span>";
                                        } elseif ($row['status'] == 2) {
                                            echo "<span class='badge text-bg-primary'>Siap Saji</span>";
                                        } else {
                                            echo "<span class='badge text-bg-danger'>Belum Diterima</span>";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['catatan'] ?></td>
                                    <td> <?php echo number_format($row['harganya'], 0, ',', '.'); ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="<?php echo (!empty($row['id_bayar'])) ? 'btn btn-secondary btn-sm me-1 disabled' : 'btn btn-warning btn-sm me-1'; ?>" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $row['id_list_order'] ?>"><i class="bi bi-pencil-square"></i></button>
                                            <button class="<?php echo (!empty($row['id_bayar'])) ? 'btn btn-secondary btn-sm me-1 disabled' : 'btn btn-danger btn-sm me-1'; ?>" data-bs-toggle="modal" data-bs-target="#modalDelete<?php echo $row['id_list_order'] ?>"><i class=" bi bi-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $total += $row['harganya'];
                            } ?>
                            <tr>
                                <td class="fw-bold" colspan="5">
                                    Total harga
                                </td>
                                <td class="fw-bold">
                                    <?php echo number_format($total, 0, ',', '.'); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
            <div>
                <button class="<?php echo (!empty($row['id_bayar'])) ? 'btn btn-secondary disabled' : 'btn btn-success'; ?>" data-bs-toggle="modal" data-bs-target="#tambahItem"><i class="bi bi-plus-circle-fill"></i> Tambah Item</button>
                <button class="<?php echo (!empty($row['id_bayar'])) ? 'btn btn-secondary disabled' : 'btn btn-primary'; ?>" data-bs-toggle="modal" data-bs-target="#bayar"><i class="bi bi-cash-coin"></i> Bayar</button>
                <button onclick="printStruk()" class="btn btn-warning"><i class="bi bi-printer"></i> Cetak Struk</button>
            </div>
        </div>
    </div>
</div>


<div id="strukContent" class="d-none">
    <style>
        #struk {
            font-family: "Arial", sans-serif;
            font-size: 12px;
            max-width: 300px;
            border: 1px solid #ccc;
            padding: 5px;
            width: 80mm;
        }

        #struk h2 {
            text-align: center;
            color: #333;
        }

        #struk p {
            margin: 5px 0;
        }

        #struk table {
            font-size: 12px;
            border-collapse: collapse;
            margin-top: 10px;
            width: 100%;
        }

        #struk th,
        #struk td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #struk table {
            font-size: 12px;
        }

        #struk .total {
            font-weight: bold;
        }
    </style>

    <div id="struk">
        <h2>Struk Pembayaran BendalmarCafe</h2>
        <p>Kode Order:<?php echo $kode ?></p>
        <p>Meja:<?php echo $meja ?></p>
        <p>Pelanggan:<?php echo $pelanggan ?></p>
        <p>Waktu Order:<?php echo date('d/m/Y H:i:s', strtotime($result[0]['waktu_order'])) ?></p>

        <table>
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($result as $row) { ?>
                    <tr>
                        <td><?php echo $row['nama_menu'] ?></td>
                        <td><?php echo number_format($row['harga'], 0, ',', '.') ?></td>
                        <td><?php echo $row['jumlah'] ?></td>
                        <td><?php echo number_format($row['harganya'], 0, ',', '.') ?></td>
                    </tr>
                <?php
                    $total += $row['harganya'];
                } ?>
                <tr class="total">
                    <td colspan="3">Total Harga</td>
                    <td><?php echo number_format($total, 0, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<script>
    function printStruk() {
        var strukContent = document.getElementById("strukContent").innerHTML;

        var printFrame = document.createElement('iframe');
        printFrame.style.display = 'none';
        document.body.appendChild(printFrame);
        printFrame.contentDocument.write(strukContent);
        var doc = printFrame.contentDocument || printFrame.contentWindow.document;
        doc.write(`
            <html>
                <head>
                    <style>
                        @page { 
                            size: Legal; 
                            margin: 0; 
                        }
                        body { 
                            margin: 0; 
                            -webkit-print-color-adjust: exact;
                        }
                    </style>
                </head>
                <body>${strukContent}</body>
            </html>
        `);

        doc.close();
        printFrame.contentWindow.print();
        document.body.removeChild(printFrame);
    }
</script>
<script src="asset/js/validate.js"></script>