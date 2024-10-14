<?php 
 
$koneksi = mysqli_connect("217.21.72.28","u9468307_syam","ADAAPADENGANCINTA","u9468307_survey");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
echo "ok";
$data = $koneksi->query("SELECT * FROM users");
$data = $data->fetch_assoc();
print_r($data);
?>