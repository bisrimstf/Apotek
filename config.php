<?php


session_start();

$conn = new mysqli('localhost', 'root', '', 'obat');
class Koneksi {
    var $hostname = "localhost";
    var $username = "root";
    var $database = "obat";
    var $password = "";
    var $conn;

    function check_db(){
        $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->database);
        if($this->conn){
            return "Koneksi sukses";
        }
    }

    function getData($kd_obat = null){
        if($kd_obat == null){
            $data = mysqli_query($this->conn, "SELECT * FROM obat");
        } else {
            $data = mysqli_fetch_assoc(mysqli_query($this->conn, "SELECT * FROM obat WHERE kd_obat = '$kd_obat'"));
        }
        return $data;
    }

    function insert($data){
        $kd_obat = $data['kd_obat'];
        $nama_obat = $data['nama_obat'];
        $jenis_obat = $data['jenis_obat'];
        $jumlah_obat = $data['jumlah_obat'];
        $harga_obat = $data['harga_obat'];
        $tanggal_obat = $data['tanggal_obat'];
        $resep_obat = $data['resep_obat'];
        $submit = mysqli_query($this->conn, "INSERT INTO `obat`(`kd_obat`, `nama_obat`, `jenis_obat`, `jumlah_obat`, `harga_obat`, `tanggal_obat`, `resep_obat`) VALUES ('$kd_obat','$nama_obat','$jenis_obat', '$jumlah_obat', '$harga_obat','$tanggal_obat','$resep_obat')");
        if(!$submit){
            $_SESSION['message'] = '<div class="alert alert-danger" role="alert">
            Kode sudah ada!
            </div>';
        } else {
            $_SESSION['message'] = '<div class="alert alert-success" role="alert">
            Data berhasil ditambahkan!
            </div>';
        }
    }

    function update($data){
        $kd_obat = $data['kd_obat'];
        $nama_obat = $data['nama_obat'];
        $jenis_obat = $data['jenis_obat'];
        $jumlah_obat = $data['jumlah_obat'];
        $harga_obat = $data['harga_obat'];
        $tanggal_obat = $data['tanggal_obat'];
        $resep_obat = $data['resep_obat'];
        $submit = mysqli_query($this->conn, "UPDATE `obat` SET `nama_obat`='$nama_obat',`jenis_obat`='$jenis_obat',`jumlah_obat`='$jumlah_obat',`harga_obat`='$harga_obat',`tanggal_obat`='$tanggal_obat',`resep_obat`='$resep_obat' WHERE `kd_obat`='$kd_obat'");
        if(!$submit){
            $_SESSION['message'] = '<div class="alert alert-danger" role="alert">
            Gagal memperbarui data!
            </div>';
        } else {
            $_SESSION['message'] = '<div class="alert alert-success" role="alert">
            Data berhasil diperbarui!
            </div>';
        }
    }

    function hapusData($kd_obat){
        $submit = mysqli_query($this->conn, "DELETE FROM `obat` WHERE kd_obat = '$kd_obat'");
        if(!$submit){
            $_SESSION['message'] = '<div class="alert alert-danger" role="alert">
            Gagal menghapus data!
            </div>';
        } else {
            $_SESSION['message'] = '<div class="alert alert-success" role="alert">
            Data berhasil dihapus!
            </div>';
        }
    }
}