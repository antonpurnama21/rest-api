<?php 

	// $mahasiswa = [
	// 	[
	// 	"nama" => "Anton Purnama",
	// 	"nim" => "312015051",
	// 	"email" => "masantonpurnama@gmail.com"
	// 	],
	// 	[
	// 	"nama" => "Sadam Husen",
	// 	"nim" => "312015069",
	// 	"email" => "sadam@gmail.com"
	// 	]
	// ];

	$dbh = new PDO('mysql:host=localhost;dbname=mahasiswa','root','');
	$db = $dbh->prepare('SELECT * FROM mahasiswa');
	$db->execute();
	$mahasiswa = $db->fetchAll(PDO::FETCH_ASSOC);

	$data = json_encode($mahasiswa);
	echo $data;

 ?>