    <?php
    include 'connect.php';
    $id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

    if (!empty($_POST['delete_kategori_validate'])) {
        $select = mysqli_query($conn, "SELECT kategori FROM tb_daftar_menu WHERE kategori = '$id'");
        if (mysqli_num_rows($select) > 0) {
            $message = '<script>alert("kategori tidak dapat dihapus karena sudah digunakan pada daftar menu");
            window.location = "../kategori_menu"; </script>';
        } else {
            $query = mysqli_query($conn, "DELETE FROM tb_kategori_menu WHERE id_kategori_menu = '$id'");
            if ($query) {
                unlink("../asset/images/$gambar");
                $message = '<script>alert("Menu berhasil dihapus");
            window.location = "../kategori_menu"; </script>';
            } else {
                $message = '<script>alert("Menu gagal dihapus");
            window.location = "../kategori_menu"; </script>';
            }
        }
    }
    echo $message;

    ?>