<html>
<head>
	<title>register</title>
</head>
<body>

	<h1>Upload Image</h1>

	<form action="" method="post" enctype="multipart/form-data">
		Pilih File : <input type="text" name="username">
		Pilih File : <input type="file" name="image"> <input type="submit" value="Upload">
	</form>

	<?php
	//koneksi ke database
	require 'koneksi.php';
	$username = $_POST['username'];
	$file = $_FILES['image']['tmp_name'];

	if(!isset($file)){
		echo 'Pilih file gambar';
	}else{
		$image 		= addslashes(file_get_contents($_FILES['image']['tmp_name']));
		$image_name	= addslashes($_FILES['image']['name']);
		$image_size	= getimagesize($_FILES['image']['tmp_name']);

		if($image_size == false){
			echo 'File yang anda pilih tidak gambar';
		}else{
			// INSERT INTO `akun`(`id`, `username`, `nama_password`, `password`) VALUES ([value-1],[value-2],[value-3],[value-4])
			if(!$insert = mysqli_query($con, "INSERT INTO akun VALUES(NULL,'$username', '$image_name', '$image')")){
				echo 'Gagal upload gambar';
			}else{
				//ambil id terakhir insert
				$lastid = mysqli_insert_id($con);

				echo 'Gambar berhasil di upload.<p>Gambar anda:</p><img src="get.php?id='.$lastid.'">';
			}
		}
	}
	?>

</body>
</html>