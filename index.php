<?php
// session_start();
require_once("config.php");
$db = new Koneksi();
$db->check_db();
if (!isset($_SESSION['login'])) {
    header("Location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="assets/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="assets/js/jquery.min.js"></script>
    <title>UTS Pemrograman Web Lanjut</title>
</head>
<body>
	<?php require_once 'header.php' ?>
    <h1 style="text-align: left">Apotek Sehat Sejahtera</h1>
    <?php if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    } ?>
    <button type="button" style="margin-left: 20px" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
        Input Obat
    </button><br /><br/>

    <div class="alert alert-success" role="alert">
    <p>Daftar Obat</p>
    </div>
    <table class="table table-striped">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Obat</th>
            <th>Jenis</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Expired Date</th>
            <th>Resep Dokter</th>
            <th>Aksi</th>
        </tr>
        <?php 
        $no = 1;
        $data = $db->getData();
        foreach($data as $data){ ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?= $data["kd_obat"]; ?></td>
            <td><?= $data["nama_obat"]; ?></td>
            <td><?= $data["jenis_obat"]; ?></td>
            <td><?= $data["jumlah_obat"]; ?></td>
            <td><?= "Rp " . number_format($data["harga_obat"],2,',','.')?></td>
            <td><?= $data["tanggal_obat"]; ?></td>
            <td><?= $data["resep_obat"]; ?></td>
            
            
            <td>
                <a href="javascript:void(0)" data-kd_obat="<?= $data['kd_obat']; ?>" class="btn btn-primary btn-edit">Edit</a>
                <a href="crud.php?hapus=<?= $data['kd_obat']; ?>" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php
        $no++; 
        } ?>
    </table>
    <!-- Modal tambah -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="crud.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kd_obat">Kode Obat</label>
                            <input class="form-control" type="text" name="kd_obat" placeholder="Masukkan Kode Obat" />
                        </div>
                        <div class="form-group">
                            <label for="nama_obat">Nama Obat</label>
                            <input class="form-control" type="text" name="nama_obat" placeholder="Masukkan Nama Obat" />
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
                            <input class="form-control" type="number" name="jumlah_obat" placeholder="Masukkan Jumlah" />
                        </div>
                        <div class="form-group">
                            <label for="harga_obat">Harga</label>
                            <input class="form-control" type="number" name="harga_obat" placeholder="Masukkan Harga" />
                        </div>
                        <div class="form-group">
                            <label for="tanggal_obat">Expired</label>
                            <input class="form-control" type="date" name="tanggal_obat" placeholder="Masukan Expired" />
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Data Barang -->
    <div class="modal fade" id="detailObat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="crud.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailObatTitle" style="color: black">Edit Data Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="dataObat"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="edit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $('.btn-edit').on('click',function(){
        const data = "<img src='assets/img/loading.gif'/> Silahkan Tunggu";
        $('#data').html(data);
        // get data from button edit
        const kd_obat = $(this).data('kd_obat');
        // Set data to Form Edit
        $.ajax({
			url: 'crud.php?edit='+kd_obat,
			type: 'get',
			success: function(data) {
				// Show Data
				$('#dataObat').html(data);
			}
		});
        // Call Modal Detail Pendaftar
        $('#detailObat').modal('show');
    });
    </script>
</body>
</html>