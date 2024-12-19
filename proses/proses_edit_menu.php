    <?php
    include 'connect.php';
    $id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
    $nama_menu = (isset($_POST['nama_menu'])) ? htmlentities($_POST['nama_menu']) : "";
    $keterangan = (isset($_POST['keterangan'])) ? htmlentities($_POST['keterangan']) : "";
    $kategori_menu = (isset($_POST['kategori_menu'])) ? htmlentities($_POST['kategori_menu']) : "";
    $harga = (isset($_POST['harga'])) ? htmlentities($_POST['harga']) : "";
    $stok = (isset($_POST['stok'])) ? htmlentities($_POST['stok']) : "";

    $kode_random = rand(10000, 99999) . "-";
    $target_dir = "../asset/images/" . $kode_random;
    $target_file = $target_dir . basename($_FILES['gambar']['name']);
    $imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    if (!empty($_POST['edit_menu_validate'])) {
        // cek gambar atau bukan
        $cek = getimagesize($_FILES['gambar']['tmp_name']);
        if ($cek === false) {
            $message = "Gambar yang anda upload tidak valid";
            $statusUpload = 0;
        } else {
            $statusUpload = 1;
            if (file_exists($target_file)) {
                $message = "Nama File yang anda upload sudah ada";
                $statusUpload = 0;
            } else {
                if ($_FILES['gambar']['size'] > 500000) {
                    $message = "Gambar yang anda upload terlalu besar";
                    $statusUpload = 0;
                } else {
                    if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif") {
                        $message = "Gambar yang diperbolehkan hanyalah format JPG, JPEG, PNG dan GIF";
                        $statusUpload = 0;
                    }
                }
            }
        }

        if ($statusUpload == 0) {
            $message = '<script>alert("' . $message . ', Gambar tidak dapat diupload");
            window.location = "../menu";</script>';
        } else {
            $select = mysqli_query($conn, "SELECT * FROM tb_daftar_menu WHERE nama_menu = '$nama_menu'");
            if (mysqli_num_rows($select) > 0) {
                $message = '<script>alert("nama menu yang anda inputkan sudah ada");
                window.location = "../menu"; </script>';
            } else {
                if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
                    $query = mysqli_query($conn, "UPDATE tb_daftar_menu SET gambar='" . $kode_random . $_FILES['gambar']['name'] . "', nama_menu='$nama_menu', keterangan='$keterangan', kategori='$kategori_menu', harga='$harga', stok='$stok' WHERE id='$id'");
                    if ($query) {
                        $message = '<script>alert("Data berhasil dimasukan");
                        window.location = "../menu"; </script>';
                    } else {
                        $message = '<script>alert("Data gagal dimasukan");
                        window.location = "../menu"; </script>';
                    }
                } else {
                    $message = '<script>alert("terjai kesalahan");
                    window.location = "../menu"; </script>';
                }
            }
        }
    }
    echo $message;

    ?>