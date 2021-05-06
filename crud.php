<?php
// session_start();
require_once("config.php");
$db = new Koneksi();
$db->check_db();
if(isset($_POST['submit'])){
    $data['kd_obat'] = $_POST['kd_obat'];
    $data['nama_obat'] = $_POST['nama_obat'];
    $data['jenis_obat'] = $_POST['jenis_obat'];
    $data['jumlah_obat'] = $_POST['jumlah_obat'];
    $data['harga_obat'] = $_POST['harga_obat'];
    $data['tanggal_obat'] = $_POST['tanggal_obat'];
    $data['resep_obat'] = $_POST['resep_obat'];
    $submit = $db->insert($data);
    header("Location: index.php");
} else if(isset($_POST['edit'])){
    $data['kd_obat'] = $_POST['kd_obat'];
    $data['nama_obat'] = $_POST['nama_obat'];
    $data['jenis_obat'] = $_POST['jenis_obat'];
    $data['jumlah_obat'] = $_POST['jumlah_obat'];
    $data['harga_obat'] = $_POST['harga_obat'];
    $data['tanggal_obat'] = $_POST['tanggal_obat'];
    $data['resep_obat'] = $_POST['resep_obat'];
    $submit = $db->update($data);
    header("Location: index.php");
} else if(isset($_GET['edit'])){
    $kd_obat = $_GET['edit'];
    $data = $db->getData($kd_obat);
?>
<div class="form-group">
    <label for="kd_obat">Kode Obat</label>
    <input class="form-control" type="number" name="kd_obat" value="<?= $data['kd_obat']; ?>" readonly/>
</div>
<div class="form-group">
    <label for="nama_obat">Nama Obat</label>
    <input class="form-control" type="text" name="nama_obat" value="<?= $data['nama_obat']; ?>"/>
</div>
<div>
    <label for="jenis_obat">Jenis</label>
            <select class="form-control" name="jenis_obat">
                <?php
                //Perintah sql untuk menampilkan semua data pada tabel jurusan
                $sql="select * from jenis";

                $hasil=mysqli_query($conn,$sql);
                $no=0;
                $jenis=$data['jenis'];
                while ($ambil = mysqli_fetch_array($hasil)) {
                    $no++;

                    $ket="";
                    if (isset($_GET['kd_obat'])) {

                        if ($jenis==$ambil['nama_jenis'])
                        {
                            $ket="selected";
                        }
                    }
                    ?>
                    <option <?php echo $ket; ?> value="<?php echo $ambil['nama_jenis'];?>"><?php echo $ambil['nama_jenis'];?></option>
                    <?php
                }
                ?>
            </select>
</div>
<div class="form-group">
    <label for="jumlah_obat">Jumlah</label>
    <input class="form-control" type="number" name="jumlah_obat" value="<?= $data['jumlah_obat']; ?>"/>
</div>
<div class="form-group">
    <label for="harga_obat">Harga</label>
    <input class="form-control" type="number" name="harga_obat" value="<?= $data['harga_obat']; ?>"/>
</div>
<div class="form-group">
    <label for="tanggal_obat">Tanggal Terbit</label>
    <input class="form-control" type="date" name="tanggal_obat" value="<?= $data['tanggal_obat']; ?>"/>
</div>
<div>
    <label for="resep_obat">Resep Dokter</label>
            <select class="form-control" name="resep_obat">
                <?php
                //Perintah sql untuk menampilkan semua data pada tabel jurusan
                $sql="select * from resep";

                $hasil=mysqli_query($conn,$sql);
                $no=0;
                $resep=$data['resep'];
                while ($ambil = mysqli_fetch_array($hasil)) {
                    $no++;

                    $ket="";
                    if (isset($_GET['kd_obat'])) {

                        if ($jenis==$ambil['nama_resep'])
                        {
                            $ket="selected";
                        }
                    }
                    ?>
                    <option <?php echo $ket; ?> value="<?php echo $ambil['nama_resep'];?>"><?php echo $ambil['nama_resep'];?></option>
                    <?php
                }
                ?>
            </select>
</div>
<?php
} else if(isset($_GET['hapus'])){
    $kd_obat = $_GET['hapus'];
    $data = $db->hapusData($kd_obat);
    header("Location: index.php");
}
?>
