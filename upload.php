<?php 

if (isset($_POST['submit']) && isset($_FILES['my_image']) && isset($_POST['adname']) ) {
	include "dbconn.php";

	echo "<pre>";
	print_r($_FILES['my_image']);
	echo "</pre>";

	$img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];
	$adname = $_POST['adname'];


	if ($error === 0) {
		if ($img_size > 99999999) {
			$em = "Peso excedido.";
		    header("Location: index.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = '../../assets/uploads/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);


				$sql = "INSERT INTO ads(image_url,adName) 
				        VALUES('$new_img_name','$adname')";
				mysqli_query($conn, $sql);
			
				header("location:../ads.php?mensaje=hecho");
			}else {
				echo "No puedes subir imagenes de este tipo";
		        header("location:../ads.php?mensaje=error");
			}
		}
	}else {
		echo "error desconocido";
		header("location:../ads.php?mensaje=error");
	}

}else {
	echo "error desconocido";
	header("location:../ads.php?mensaje=error");
}

?>