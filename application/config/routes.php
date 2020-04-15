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
$route['default_controller'] = 'Main';

$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;

// artikel
$route['artikel']                 = 'News';
$route['artikel/cari']            = 'News/search_news';
$route['artikel/(:any)']          = 'News/read/$1';
$route['artikel/kategori/(:any)'] = 'News/categoryNews/$1';

// tentang kami, hubungi kami, profil
$route['tentang-kami']         = 'Main/aboutPage';
$route['hubungi-kami']         = 'Inbox';
$route['profil-saya']          = 'Main/profilePage';
$route['ubah-profil']          = 'User/Users/profile';
$route['aksi-ubah-profil']     = 'User/Users/profile_action';
$route['ubah-password']        = 'User/Users/ubah_password';
$route['aksi-ubah-password']   = 'User/Users/ubah_password_action';
$route['p/ubah-profil']        = 'Publisher/Publishers/update_profile';
$route['p/aksi-ubah-profil']   = 'Publisher/Publishers/update_profile_action';

// login
$route['login']           = 'Auth';
$route['register']        = 'Auth/register_user';
$route['logout']          = 'Auth/logout';
$route['aktivasi/(:any)'] = 'Auth/activateAccount/$1';

// event
$route['cari-event']                = 'Main/search_event';
$route['event/v/(:any)']            = 'Main/eventDetail/$1';
$route['event/lokasi']              = 'Main/allLocation';
$route['event/kategori']            = 'Main/allCategory';
$route['event/kategori/(:any)']     = 'Main/eventCategory/$1';
$route['event/lokasi/(:any)']       = 'Main/eventLocation/$1';
$route['konfirmasi-booking/(:any)/(:any)'] = 'User/Booking/bookingEventConfirmation/$1/$2';

// tiket saya
$route['tiket-saya']        = 'User/Users/myTicket';
$route['tiket-saya/(:any)'] = 'User/Users/ticketDetail/$1';
$route['pembayaran/(:any)'] = 'User/Payment/create/$1';

// manage event
$route['manage']                         = 'Publisher/ManageEvent';
$route['manage/jadi-publisher']          = 'Publisher/ManageEvent/bePublisher';
$route['manage/buat-event']              = 'Publisher/ManageEvent/create';
$route['manage/(:any)/edit']             = 'Publisher/ManageEvent/update/$1';
$route['manage/(:any)/hapus']            = 'Publisher/ManageEvent/delete/$1';
$route['manage/(:any)']                  = 'Publisher/ManageEvent/read/$1';
$route['manage/(:any)/ajukan']           = 'Publisher/ManageEvent/mengajukan_event/$1';
$route['manage/(:any)/tiket']            = 'Publisher/ManageEvent/kelola_tiket/$1';
$route['manage/(:any)/tambah-tiket']     = 'Publisher/Ticket/create';
$route['manage/(:any)/hapus-tiket/(:any)'] = 'Publisher/Ticket/delete/$1/$2';
$route['manage/(:any)/edit-tiket/(:any)']  = 'Publisher/Ticket/update/$1/$2';
$route['manage/(:any)/penjualan-tiket']  = 'Publisher/ManageEvent/kelola_penjualantiket/$1';
$route['manage/(:any)/peserta']          = 'Publisher/ManageEvent/kelola_peserta/$1';
$route['manage/(:any)/kedatangan']       = 'Publisher/ManageEvent/kedatangan/$1';
$route['manage/(:any)/scan-kedatangan']  = 'Publisher/ManageEvent/scan_kedatangan/$1';
$route['manage/(:any)/absensi-manual']   = 'Publisher/ManageEvent/printoutPeserta/$1';
$route['manage/(:any)/sertifikat']       = 'Publisher/ManageEvent/sertifikat/$1';
$route['manage/(:any)/tambah-sertifikat']= 'Publisher/ManageEvent/addCertificate/$1';
$route['manage/(:any)/ambil-sertifikat'] = 'Publisher/ManageEvent/ambil_sertifikat/$1';
$route['manage/(:any)/tes-print']        = 'Publisher/ManageEvent/tesPrint/$1';
$route['manage/(:any)/print-for-user']   = 'Publisher/ManageEvent/printCertificate/$1';
$route['manage/(:any)/laporan']          = 'Publisher/ManageEvent/kelola_report/$1';
$route['manage/(:any)/laporan/print']    = 'Publisher/ManageEvent/kelola_report/generateReport/$1';
$route['manage/(:any)/withdraw']         = 'Publisher/ManageEvent/withdraw/$1';

// booking event
$route['booking/(:any)/(:any)'] = 'User/booking/bookingEvent/$1/$2';


//======================= ADMIN ======================================
// Dashboard
$route['admin/dashboard'] = 'Admin/Dashboard';

// inbox
$route['admin/pesan-masuk']              = 'Admin/Inbox';
$route['admin/pesan-masuk/(:any)']       = 'Admin/Inbox/read/$1';
$route['admin/pesan-masuk/(:any)/balas'] = 'Admin/Inbox/inboxReply/$1';
$route['admin/pesan-masuk/(:any)/hapus'] = 'Admin/Inbox/delete/$1';

// event
$route['admin/event']               = 'Admin/Event';
$route['admin/event/(:any)']        = 'Admin/Event/read/$1';
$route['admin/event/(:any)/terima'] = 'Admin/Event/approved/$1';
$route['admin/event/(:any)/tolak']  = 'Admin/Event/declined/$1';
$route['admin/event/(:any)/hapus']  = 'Admin/Event/delete/$1';

$route['admin/pencairan-dana'] = 'Admin/Event/withdraw';
$route['admin/pencairan-dana/(:any)'] = 'Admin/Event/withdrawDetail/$1';
$route['admin/pencairan-dana/(:any)/approve'] = 'Admin/Event/withdrawApprove/$1';
$route['admin/pencairan-dana/(:any)/reject'] = 'Admin/Event/withdrawReject/$1';

// payment
$route['admin/pembayaran'] = 'Admin/payment';
$route['admin/pembayaran/(:any)'] = 'Admin/payment/detail/$1';
$route['admin/pembayaran/(:any)/setujui'] = 'Admin/payment/approveBooking/$1';
$route['admin/pembayaran/(:any)/tolak'] = 'Admin/payment/rejectBooking/$1';

// data master
$route['admin/bank']             = 'Admin/Bank';
$route['admin/kota']             = 'Admin/City';
$route['admin/kategori-event']   = 'Admin/Category';
$route['admin/kategori-artikel'] = 'Admin/News_category';

// artikel / news
$route['admin/artikel']                  = 'Admin/News';
$route['admin/artikel/tambah']           = 'Admin/News/create';
$route['admin/artikel/aksi-tambah']      = 'Admin/News/create_action';
$route['admin/artikel/(:any)/edit']      = 'Admin/News/update/$1';
$route['admin/artikel/(:any)/aksi-edit'] = 'Admin/News/update_action/$1';
$route['admin/artikel/(:any)/hapus']     = 'Admin/News/delete/$1';

// data pengguna
// user / peserta
$route['admin/peserta']                = 'Admin/Users';
$route['admin/peserta/(:any)']         = 'Admin/Users/read/$1';
$route['admin/peserta/(:any)/block']   = 'Admin/Users/block/$1';
$route['admin/peserta/(:any)/unblock'] = 'Admin/Users/unBlock/$1';
$route['admin/publisher']              = 'Admin/Users/publisher';
$route['admin/publisher/(:any)/approve']   = 'Admin/Users/approve/$1';
$route['admin/publisher/(:any)/reject'] = 'Admin/Users/reject/$1';

// admin
$route['admin/admin']                     = 'Admin/Admin';
$route['admin/admin/tambah']              = 'Admin/Admin/create';
$route['admin/admin/aksi-tambah']         = 'Admin/Admin/create_action';
$route['admin/admin/(:any)/edit']         = 'Admin/Admin/update/$1';
$route['admin/admin/aksi-edit']           = 'Admin/Admin/update_action';
$route['admin/admin/(:any)/delete']       = 'Admin/Admin/delete/$1';
$route['admin/admin/(:any)/block']        = 'Admin/Admin/block/$1';
$route['admin/admin/(:any)/unblock']      = 'Admin/Admin/unBlock/$1';

// statistik
$route['admin/statistik'] = 'Admin/Statistik';