<?php
//koneksi ke database
	include('koneksi.php');
	include('funtion.php');

//ambil id dari $_GET id
$id = addslashes($_GET['id']);

//query ke database
$query = mysqli_query($con, "SELECT * FROM akun WHERE id='$id'");
$row = mysqli_fetch_assoc($query);
$image_db = $row['password'];

header("Content-type: image/jpeg");

echo $image_db;

// <?php 


$user = $_POST["username"];
$src = $image_db;
// $target_hasil = "img/img_hasil/";
// $im = imagecreatefrompng($target_hasil.$src);
$real_message = '';

print_r($_POST);

for($x=0;$x<40;$x++){
  $y = $x;
  $rgb = imagecolorat($im,$x,$y);
  $r = ($rgb >>16) & 0xFF;
  $g = ($rgb >>8) & 0xFF;
  $b = $rgb & 0xFF;
  
  $blue = toBin($b);
  $real_message .= $blue[strlen($blue)-1];
}
$real_message = toString($real_message);
echo $real_message;
// $username = $_POST['username'];
// $password = $_POST['password'];

$query = mysqli_query($db,"SELECT * from user where username='$user'");
	
if (mysqli_num_rows($query)>0) {
	while($row = mysqli_fetch_assoc($query)){	
		$query1 = mysqli_query($db,"SELECT * from user where username='$user' AND password='$real_message'");
		if (mysqli_num_rows($query1)) {
			while ($row1 = mysqli_fetch_assoc($query1)) {
				$_SESSION['user'] = $row1["username"];
				$_SESSION['id'] = $row1["id"];
				header("location:sukses.php");
			}
		}
	}
}

die;
?>