<?php

$content = @$_GET['content'];
$action	 = @$_GET['action'];
$extends = @$_GET['extends'];

# Home Page
if ($content == "") :
	include 'views/partials/home.php';
elseif ($content == "home") :
	include 'views/partials/home.php';


# Admin Page
elseif ($content == "m_users") :
	switch ($action): case 'tambah_user':
			include 'views/admin/users/tambah_user.php';
			break;
		case 'edit_user':
			include 'views/admin/users/edit_user.php';
			break;
		default:
			include 'views/admin/users/user.php';
			break;
	endswitch;

## Karyawan Page
elseif ($content == "karyawan") :
	if ($action == "tambah_karyawan") :
		include 'views/admin/karyawan/tambah_karyawan.php';
	elseif ($action == "lihat_karyawan") :
		include 'views/admin/karyawan/lihat_karyawan.php';
	elseif ($action == "edit_karyawan") :
		include 'views/admin/karyawan/edit_karyawan.php';
	else :
		include 'views/admin/karyawan/karyawan.php';
	endif;

## Pengambilan Page
elseif ($content == "pengambilan") :
	if ($action == "tambah_pengembalian") :
		include 'views/admin/pengambilan/tambah_pengembalian.php';
	elseif ($action == "lihat_pengembalian") :
		include 'views/admin/pengambilan/lihat_pengembalian.php';
	elseif ($action == "edit_pengembalian") :
		include 'views/admin/pengambilan/edit_pengembalian.php';
	else :
		include 'views/admin/pengambilan/pengambilan.php';
	endif;

## Pengembalian Page
elseif ($content == "pengembalian") :
	if ($action == "tambah_pengembalian") :
		include 'views/admin/pengembalian/tambah_pengembalian.php';
	elseif ($action == "lihat_pengembalian") :
		include 'views/admin/pengembalian/lihat_pengembalian.php';
	elseif ($action == "edit_pengembalian") :
		include 'views/admin/pengembalian/edit_pengembalian.php';
	else :
		include 'views/admin/pengembalian/pengembalian.php';
	endif;

## Penilaian Page
elseif ($content == "penilaian") :
	if ($action == "tambah_penilaian") :
		include 'views/admin/penilaian/tambah_penilaian.php';
	elseif ($action == "lihat_penilaian") :
		include 'views/admin/penilaian/lihat_penilaian.php';
	elseif ($action == "edit_penilaian") :
		include 'views/admin/penilaian/edit_penilaian.php';
	else :
		include 'views/admin/penilaian/penilaian.php';
	endif;

## Stok Gudang Page
elseif ($content == "stok_gudang") :
	if ($action == "tambah_barang") :
		include 'views/admin/stok_gudang/tambah_barang.php';
	elseif ($action == "permintaan") :
		switch ($extends) {
			case 'tambah_barang':
				include 'views/admin/stok_gudang/permintaan_barang.php';
				break;
			default:
				include 'views/admin/stok_gudang/permintaan.php';
				break;
		} elseif ($action == "edit_stok_gudang") :
		include 'views/admin/stok_gudang/edit_stok_gudang.php';
	else :
		include 'views/admin/stok_gudang/stok_gudang.php';
	endif;



# User Page
elseif ($content == "users") :
	if ($action == "new_user") :
		include 'views/users/new_user.php';
	else :
		include 'views/users/users.php';
	endif;

# Profile Page
elseif ($content == "profile") :
	if ($action == "edit_profile") :
		include 'views/profile/edit_profile.php';
	else :
		include 'views/profile/profile.php';
	endif;
endif;
