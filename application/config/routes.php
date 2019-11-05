<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';

// Halaman Depan
$route['daftar'] = 'welcome/daftar';
$route['login'] = 'welcome/login';
$route['keluar'] = 'welcome/keluar';
$route['berita'] = 'welcome/berita';
$route['berita/detail/(:any)'] = 'welcome/detail_berita/$1';
$route['visi-misi'] = 'welcome/visi_misi';
$route['profil'] = 'welcome/profil';
$route['direktori'] = 'welcome/direktori';
$route['download'] = 'welcome/download';
$route['agenda'] = 'welcome/agenda';
$route['galeri'] = 'welcome/galeri';
$route['tentang-kami'] = 'welcome/tentang_kami';
$route['hubungi-kami'] = 'welcome/hubungi_kami';
$route['saran'] = 'welcome/saran';
// Batas Halaman Depan

// Siswa
$route['siswa/profil'] = 'siswa/profil';
$route['siswa/nilai-ujian-nasional'] = 'siswa/nilai_ujian_nasional';
$route['siswa/ujian-peminatan'] = 'siswa/ujian_peminatan';
$route['siswa/mulai-ujian'] = 'siswa/mulai_ujian';
// $route['siswa/ujian-peminatan/soal'] = 'siswa/ujian_peminatan';
$route['siswa/pengumuman'] = 'siswa/pengumuman';
// Batas Siswa

// Admin
$route['admin/profil'] = 'admin/profil';
$route['admin/informasi'] = 'admin/informasi';
$route['admin/slide'] = 'admin/slide';
$route['admin/berita'] = 'admin/berita';
$route['admin/pengumuman'] = 'admin/pengumuman';
$route['admin/agenda'] = 'admin/agenda';
$route['admin/galeri'] = 'admin/galeri';
$route['admin/download'] = 'admin/download';
$route['saran'] = 'admin/saran';

$route['admin/siswa'] = 'admin/siswa';
$route['admin/nilai/(:any)'] = 'admin/nilai/$1';
$route['admin/jurusan'] = 'admin/jurusan';
$route['admin/soal'] = 'admin/soal';
$route['admin/perhitungan'] = 'admin/perhitungan';
$route['admin/kriteria/(:any)'] = 'admin/kriteria/$1';
$route['admin/user/admin'] = 'admin/user_admin';
// Batas Admin

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
