
<?php
	$conn= mysqli_connect('localhost','id11872983_informatika2','','id11872983_informatika2');
	
	$kodebarang=$_GET['kode_barang'];
	$hapus="delete from barang where kode_barang = '$kodebarang'";
	$data=mysqli_query($conn,$hapus);
	
	if($data > 0){
		echo "
		<script>
		alert('data berhasil di hapus');
		document.location.href='home.php';
		</script>";
	}else
		echo "
		<script>
		alert('data gagal di hapus');
		document.location.href='home.php';
		</script>";
?>