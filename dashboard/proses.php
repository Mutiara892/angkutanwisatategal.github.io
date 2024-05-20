<?php
session_start();
class Connect_db
{
    public $servername = "localhost";
    public $db_name = "pemesanan_tiket";
    public $username = "root";
    public $password = "";
    public $connect_db;

    // Koneksi Database
    public function __construct()
    {
        $this->connect_db = mysqli_connect($this->servername, $this->username, $this->password, $this->db_name);

        if (mysqli_connect_errno()) {
            echo "Gagal menyambungkan kedalam database -> " . mysqli_connect_error();
            exit();
        }
    }
    // End Of Koneksi Database

    // Get Database From Id
    public function db_From_Id($sql)
    {
        $query = mysqli_query($this->connect_db, $sql);

        $result = [];

        while ($data = mysqli_fetch_array($query)) {
            $result[] = $data;
        }

        return $result;
    }
    // End Of Get Database From ID

    // Signup
    public function signUp($username, $no_wa, $email, $password)
    {
        // hash password
        $secure_password = password_hash($password, PASSWORD_DEFAULT);
        // end hash password

        $sql = "INSERT INTO user (username, no_wa, email, password) VALUES ('$username', '$no_wa', '$email', '$secure_password')";

        // Cek Koneksi\
        if (mysqli_query($this->connect_db, $sql)) {
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'Akun Anda Berhasil Dibuat, Silahkan Login Untuk Melanjutkan';
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'Akun Anda Gagal Dibuat, Silahkan Hubungi Admin Jika Ada Kendala';
        }
        // End Of Cek Koneksi
    }
    // End Of Signup

    // Sign in
    public function signIn($username, $password)
    {

        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($this->connect_db, $sql);

        // cek username
        // if true
        if (mysqli_num_rows($result) > 0) {
            // cek password
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"])) {
                $_SESSION["login"] = $row["id"];
                header("Location: ../order/index.php");

            };
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'Berhasil Login';
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'Username Atau Password Yang Anda Masukkan Salah';
        }

    }
    // End Of Sign in

    // Order Tiket
    public function set_Pesanan($user_id, $kode_order, $order_type, $tanggal_order, $total_pembayaran, $bukti_pembayaran, $jadwal_id, $tujuan_id, $titik_berangkat, $kursi, $metode_pembayaran)
    {
        $sql = "INSERT INTO user_order(user_id, kode_order, order_type, tanggal_order, total_pembayaran, bukti_pembayaran, kursi, metode_pembayaran)
               VALUES
               ($user_id, '$kode_order', '$order_type', '$tanggal_order', '$total_pembayaran', '$bukti_pembayaran', '$kursi', '$metode_pembayaran')";

        try {
            mysqli_query($this->connect_db, $sql);
            $order_id = $this->db_From_Id("SELECT * FROM user_order WHERE kode_order = '$kode_order' LIMIT 1")[0]['id'];
            mysqli_query($this->connect_db, "INSERT INTO order_jadwal (user_order_id, jadwal_id) VALUES ($order_id, $jadwal_id)");
            mysqli_query($this->connect_db, "INSERT INTO order_lokasi (user_order_id, lokasi_id) VALUES ($order_id, $titik_berangkat), ($order_id, $tujuan_id)");

            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'Pesanan Berhasil Dibuat, Silahkan Tunggu Admin Untuk Konfirmasi, Jika Terdapat Kendala Bisa Hubungi 0856-7712-2272")';
        } catch (\Throwable $th) {
            //throw $th;
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'Mohon Maaf Terjadi Kesalahan Server, Pesanan Gagal Dibuat';
        }
    }

    public function set_Pesanan_sewa($user_id, $kode_order, $order_type, $tanggal_order, $tanggal_selesai_order, $total_pembayaran, $bukti_pembayaran, $titik_berangkat, $tujuan, $metode_pembayaran)
    {
        $sql = "INSERT INTO user_order (user_id, kode_order, order_type, tanggal_order, tanggal_selesai_order, total_pembayaran, bukti_pembayaran, metode_pembayaran)
               VALUES
               ($user_id, '$kode_order', '$order_type','$tanggal_order', '$tanggal_selesai_order', '$total_pembayaran', '$bukti_pembayaran', '$metode_pembayaran')";
        $add_order = mysqli_query($this->connect_db, $sql);
        $add_location = true;
        $order_id = $this->db_From_Id("SELECT * FROM user_order WHERE kode_order = '$kode_order' LIMIT 1")[0]['id'];
        $location_sql = "INSERT INTO order_lokasi (user_order_id, lokasi_id) VALUES ";
        $add_tujuan = mysqli_query($this->connect_db, $location_sql . "($order_id, $titik_berangkat)");
        foreach ($tujuan as $key => $tujuan) {
            $location_sql .= "($order_id, $tujuan),";
        }
        // var_dump(substr($location_sql, 0, -1));
        // exit;
        $add_location = mysqli_query($this->connect_db, substr($location_sql, 0, -1));
        if ($add_order && $add_location && $add_tujuan) {
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'Pesanan Berhasil Dibuat, Silahkan Tunggu Admin Untuk Konfirmasi, Jika Terdapat Kendala Bisa Hubungi 0856-7712-2272")';
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'Mohon Maaf Terjadi Kesalahan Server, Pesanan Gagal Dibuat';
        }
    }

    // End Of Order Tiket

    // Upload Gambar Ke File
    public function upload_Gambar($gambar)
    {

        $nama_file = $_FILES["gambar"]["name"];

        $error = $_FILES["gambar"]["error"];
        $tmpname = $_FILES["gambar"]["tmp_name"];

        if ($error === 4) {
            echo "<script>";
            echo "alert('Pilih gambar terlebih dahulu')";
            echo "</script>";
            return false;
        }

        // cek ekstensi gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $nama_file);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>";
            echo "alert('Yang anda upload bukan gambar')";
            echo "</script>";
            return false;
        }
        // generate nama baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

        // lolos check , dan upload
        move_uploaded_file($tmpname, '../db_images/' . $namaFileBaru);
        return $namaFileBaru;
    }

    // End Of Upload Gambar Ke File

    // Add Admin
    public function register_Admin($username, $password)
    {
        $secure_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO admin (id, username, password) VALUES ('', '$username', '$secure_password')";
        if (mysqli_query($this->connect_db, $sql)) {
            echo "<script>";
            echo "alert('Akun admin berhasil dibuat')";
            echo "</script>";
        } else {
            echo "<script>";
            echo "alert('Akun admin gagal dibuat')";
            echo "</script>";
        }
        header("Location: index.php");
    }
    // End Of Add Admin

    // Signin Admin
    public function sign_In_Admin($username, $password)
    {

        $sql = "SELECT * FROM admin WHERE username='$username'";
        $result = mysqli_query($this->connect_db, $sql);

        // cek username
        // if true
        if (mysqli_num_rows($result) > 0) {
            // cek password
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"])) {
                $_SESSION["login_admin"] = $row["id"];
                header("Location: index.php");
                exit;
            }
        } else {
            echo '<script>';
            echo 'alert("Username Atau Password Yang Anda Masukkan Salah")';
            echo '</script>';
        }

    }
    // End Of Signin Admin
}
