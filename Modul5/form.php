<html>
<head>
<title>Data Mahasiswa</title>    
    <?php
    $conn = mysql_connect('localhost','root','','informatika');
    ?>
    
</head>
<body>
<center>
    <h3>Masukan data Mahasiswa :</h3>
    <table border="0" width='30%'>
        <form method="post" action="form.php">
            <tr>
                <td width='25%'>NIM</td>
                <td width='5%'>:</td>
                <td width='65%'><input type='text' name='nim' size='10'></td>
            </tr>
            <tr>
                <td width='25%'>Kelas</td>
                <td width='5%'>:</td>
                <td width='65%'><input type='radio' value='A' checked name='kelas'>A<input type='radio' value='B' name='kelas'>B<input type='radio' value='C' name='kelas'>C</td>
            </tr>
            <tr>
                <td width='25%'>Alamat</td>
                <td width='5%'>:</td>
                <td width='65%'><input type='text' name='alamat' size="40"></td>
            </tr>
        </form>
        
    </table>
    <input type="submit" value="Masukan" name='submit'>
    
    <?php
    eroor_reporting(E_ALL ^ E_NOTICE);
    $nim = $_POST[]'nim'];
    $nama = $_POST[]'nama'];
    $kelas = $_POST[]'kelas'];
    $alamat = $_POST[]'alamat'];
    $submit = $_POST[]'submit'];
    $input="insert into mahasiswa (nim, nama, kelas, alamat) values ('$nim','$nama','$kelas','$alamat')";
        if($submit){
            if($nim==''){
                echo "<br>NIM tidak boleh kosong, diisi dulu bree";}elseif($nama==''){
                echo "<br>Nama tidak boleh kosong, diisi dulu bree";}elseif($alaamt==''){
                echo "<br>Alamat tidak boleh kosong, diisi dulu bree";}else{
                mysqli_querry($conn,$input);
                echo"<br> Data berhasil Dimasukan ";
            }
        }
    ?>
<hr>
    <h3>Data Mahasiswa</h3>
    <table border="1" width='50%'>
        <tr>
            <td align='center' width='20%'><B>NIM</B></td>
            <td align='center' width='30%'><B>Nama</B></td>
            <td align='center' width='10%'><B>Kelas</B></td>
            <td align='center' width='30%'><B>Alamat</B></td>
        </tr>
            <?php
                $cari="select * from mahasiswa order by nim";
                $hasil_cari=mysqli_query($conn,$cari);
                    while($data=mysqli_fetch_row($hasil_cari)){
                    echo"
                        <tr>
                            <td width='20%'>$data[0]</td>
                            <td width='30%'>$data[1]</td>
                            <td width='10%'>$data[2]</td>
                        </tr>
                        "
                    }
            ?>
        
    </table>
</center>    
</body>
    
</html>