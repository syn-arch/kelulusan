<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

$route['login'] = 'auth';

// master
$route['master/jurusan'] = 'jurusan';
$route['master/tambah_jurusan'] = 'jurusan/tambah';
$route['master/ubah_jurusan/(:any)'] = 'jurusan/ubah/$1';
$route['master/hapus_jurusan/(:any)'] = 'jurusan/hapus/$1';
$route['master/get_jurusan_json'] = 'jurusan/get_jurusan_json';

$route['master/kelas'] = 'kelas';
$route['master/tambah_kelas'] = 'kelas/tambah';
$route['master/ubah_kelas/(:any)'] = 'kelas/ubah/$1';
$route['master/hapus_kelas/(:any)'] = 'kelas/hapus/$1';
$route['master/get_kelas_json'] = 'kelas/get_jurusan_json';

$route['master/siswa'] = 'siswa';
$route['master/tambah_siswa'] = 'siswa/tambah';
$route['master/ubah_siswa/(:any)'] = 'siswa/ubah/$1';
$route['master/hapus_siswa/(:any)'] = 'siswa/hapus/$1';
$route['master/get_siswa_json'] = 'siswa/get_siswa_json';
$route['master/hapus_bulk_siswa'] = 'siswa/hapus_bulk';

// kelulusan
$route['kelulusan/berkas'] = 'berkas';
$route['kelulusan/tambah_berkas'] = 'berkas/tambah';
$route['kelulusan/ubah_berkas/(:num)'] = 'berkas/ubah/$1';
$route['kelulusan/hapus_berkas/(:num)'] = 'berkas/hapus/$1';
$route['kelulusan/tambah_berkas/(:num)'] = 'berkas/tambah_berkas/$1';
$route['kelulusan/get_berkas_json'] = 'berkas/get_berkas_json';

// kelulusan
$route['kelulusan/verifikasi'] = 'verifikasi';
$route['kelulusan/verifikasi/(:num)/(:num)'] = 'verifikasi/verifikasi/$1/$2';
$route['kelulusan/get_verifikasi_json'] = 'verifikasi/get_verifikasi_json';

// front
$route['cek'] = 'home/cek';
$route['cek_kelulusan'] = 'home/cek_kelulusan';