    <?php
    include 'connect.php';
    $id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
    $gambar = (isset($_POST['gambar'])) ? htmlentities($_POST['gambar']) : "";

    if (!empty($_POST['delete_user_validate'])) {
        $query = mysqli_query($conn, "DELETE FROM tb_daftar_menu WHERE id = '$id'");
        if ($query) {
            unlink("../asset/images/$gambar");
            $message = '<script>alert("Menu berhasil dihapus");
            window.location = "../menu"; </script>';
        } else {
            $message = '<script>alert("Menu gagal dihapus");
            window.location = "../menu"; </script>';
        }
    }
    echo $message;

    ?>