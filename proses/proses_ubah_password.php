    <?php
    session_start();
    include 'connect.php';
    $id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
    $passwordLama = (isset($_POST['passwordLama'])) ? md5(htmlentities($_POST['passwordLama'])) : "";
    $passwordBaru = (isset($_POST['passwordBaru'])) ? md5(htmlentities($_POST['passwordBaru'])) : "";
    $repasswordBaru = (isset($_POST['repasswordBaru'])) ? md5(htmlentities($_POST['repasswordBaru'])) : "";

    if (!empty($_POST['ubah_password_validate'])) {
        $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_bendalmar]' && password = '$passwordLama'");
        $hasil = mysqli_fetch_array($query);
        if ($hasil) {
            if ($passwordBaru == $repasswordBaru) {
                $query = mysqli_query($conn, "UPDATE tb_user SET password='$passwordBaru' WHERE username = '$_SESSION[username_bendalmar]'");
                if ($query) {
                    $message = '<script>alert("Password berhasil diubah");
                    window.history.back();</script>';
                } else {
                    $message = '<script>alert("Password gagal diubah");
                    window.history.back();</script>';
                }
            } else {
                $message = '<script>alert("Password baru tidak sama");
                window.history.back();</script>';
            }
        } else {
            $message = '<script>alert("Password lama tidak sesuai");
            window.history.back();</script>';
        }
    } else {
        header('location:../home');
    }
    echo $message;
    ?>