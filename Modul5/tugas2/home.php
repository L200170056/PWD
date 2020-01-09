<?php
include('config/koneksi.php');
include('config/kode.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masukkan Data Mahasiswa</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
   <!-- cek apakah sudah login -->
	<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:index.php?pesan=belum_login");
	}
	?>
	<h4>Selamat datang, <?php echo $_SESSION['username']; ?>! anda telah login.</h4>
    <br>
    <a href="logout.php">LOGOUT</a>
    <div class="inner">
    <center>
        <br>
        <h4>Silahkan Isi Nama dan pilih Penempatan Gudang</h4>
    <form action="" method="POST">
        <table border='0'>
            <tr>
                <?php 
                $kodeBarang=kodeBarangOtomatis($dbc);
                ?>
                <td>Kode Barang</td>
                <td>:</td>
                <td>
                    <input type="text" name="kode_barang" disabled="" value="<?php echo $kodeBarang; ?>">
                </td>
            </tr>
            <tr>
                <td>Nama Barang</td>
                <td>:</td>
                <td>
                    <input type="text" name="nama_barang">
                </td>
            </tr>

            <tr>
                <td>Gudang</td>
                <td>:</td>
                <td>
                    <select name="kode_gudang" id="kode_gudang">
                        <?php
                        $query=mysqli_query($dbc, "SELECT * FROM gudang WHERE 1");
                        while ($data=mysqli_fetch_array($query)) {
                        ?>
                        <option value="<?php echo $data['kode_gudang']; ?>"><?php echo $data['nama_gudang']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="3" align='center'><br><br>
                    <input type="submit" name="submit" value="Tambah">
                </td>
            </tr>
        </table>
    </form>
        </div>
    <?php
    if(isset($_POST['submit'])){
        $kodeBarang=kodeBarangOtomatis($dbc);
        if ($kodeBarang==False) {
            echo "<script>alert('Kode Barang Error');window.location='./';</script>";
            exit;
        }

        $nama=mysqli_escape_string($dbc, $_POST['nama_barang']);
        $kode_gudang=mysqli_escape_string($dbc, $_POST['kode_gudang']);

        $query=mysqli_query($dbc, "SELECT kode_gudang FROM gudang WHERE kode_gudang='$kode_gudang'");
        if ($query) {
            if (mysqli_num_rows($query) == 0) {
                echo "<script>alert('Kode Gudang Tidak Valid');window.location='./';</script>";
            exit;
            }
        } else {
            echo "<script>alert('Kode Gudang Error');window.location='./';</script>";
            exit;
        }

        $query=mysqli_query($dbc, "INSERT INTO barang(kode_barang,nama_barang,kode_gudang) VALUES('$kodeBarang','$nama','$kode_gudang')");
        if ($query) {
            echo "<script>alert('Data Berhasil Ditambahkan');window.location='./';</script>";
            exit;
        } else {
            echo "<script>alert('Data Berhasil Ditambahkan');window.location='./';</script>";
            exit;
        }
        
    }
    ?>
    </center>
    
    <h3 align="center">Data Barang</h3>
    <table align="center" id="mantap">
        <tr>
            <td class="td">Kode Barang</td>
            <td class="td">Nama Barang</td>
            <td class="td">Lokasi Gedung</td>
            <td class="td">Aksi</td>
        </tr>
        <?php
        $sql=mysqli_query($dbc, "SELECT barang.kode_barang, barang.nama_barang, gudang.lokasi_gudang FROM barang INNER JOIN gudang ON barang.kode_gudang=gudang.kode_gudang");
        if(mysqli_num_rows($sql) > 0) {
            $no=1;
            while($data=mysqli_fetch_array($sql)) {
        ?>
        <tr>
            <td><?php echo $data['kode_barang']; ?></td>
            <td><?php echo $data['nama_barang']; ?></td>
            <td><?php echo $data['lokasi_gudang']; ?></td>
            <td><a href="edit.php?kode=<?php echo $data['kode_barang']; ?>">UBAH</a> / <a href="hapus.php?kode=<?php echo $data['kode_barang']; ?>">Hapus</a></td>
        </tr>
        <?php
            $no++;
            }
        } else {
        ?>
        <tr>
            <td colspan='6'>Data Mahasiswa Kosong</td>
        </tr>
        <?php
        }
        
        ?>
    </table>
    
    <div class="footer">
    Credit : Naufal Alip Pratama | L200170056
    </div>
</body>
</html>