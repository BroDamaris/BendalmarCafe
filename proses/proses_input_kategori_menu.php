    <?php
    include 'connect.php';
    $jenis_menu = (isset($_POST['jenis_menu'])) ? htmlentities($_POST['jenis_menu']) : "";
    $kategori_menu = (isset($_POST['kategori_menu'])) ? htmlentities($_POST['kategori_menu']) : "";

    if (!empty($_POST['input_kategori_validate'])) {
        $select = mysqli_query($conn, "SELECT kategori_menu FROM tb_kategori_menu WHERE kategori_menu = '$kategori_menu'");
        if (mysqli_num_rows($select) > 0) {
            $message = '<script>alert("kategori yang anda inputkan sudah ada");
            window.location = "../kategori_menu"; </script>';
        } else {
            $query = mysqli_query($conn, "INSERT INTO tb_kategori_menu (jenis_menu, kategori_menu) values ('$jenis_menu', '$kategori_menu')");
            if ($query) {
                $message = '<script>alert("Data berhasil dimasukan");
                window.location = "../kategori_menu"; </script>';
            } else {
                $message = '<script>alert("Data gagal dimasukan")
                window.location = "../kategori_menu"; </script>';
            }
        }
    }
    echo $message;

    ?>