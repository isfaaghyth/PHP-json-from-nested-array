<?php
	$username ="root";
	$password ="";
	$hostname = "localhost";
	$database_name = "isfaaghyth";

	$con = mysqli_connect($hostname , $username, $password);
	$selected = mysqli_select_db($con, $database_name);

	$result = mysqli_query($con, "SELECT id, nama FROM student"); 
	$info_lengkap = array();
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$mahasiswa = array();
		$mahasiswa['id'] = $row['id'];
		$mahasiswa['nama'] = $row['nama'];
		$id = $mahasiswa['id'];
		$kontak = mysqli_query($con, "SELECT id, alamat, no_telp FROM contact WHERE id = {$id}");
		$kontak_json = array();
		while ($sub_row = mysqli_fetch_array($kontak, MYSQLI_ASSOC)) {
			$kontak_json[] = $sub_row;
		}
		$mahasiswa['contact'] = $kontak_json;
		$info_lengkap[] = $mahasiswa;
	}

echo json_encode(array('result' => $info_lengkap));
?>
