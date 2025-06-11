<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	[example.com/class/method/id/](https://example.com/class/method/id/)
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	[http://codeigniter.com/user_guide/general/routing.html](http://codeigniter.com/user_guide/general/routing.html)
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

// Default controller for the public homepage (indihomefiberjogja.com)
$route['default_controller'] = 'Home'; // Set ini ke controller 'home' (yang memuat view utama)
$route['home'] = 'home'; // Rute eksplisit untuk home (jika diperlukan)
$route['404_override'] = 'not_found'; // Controller untuk halaman 404

// ====================================================================
// ================ RUTE PUBLIK (Customer Facing) ====================
// ====================================================================

// Pages
$route['tentang-kami'] = 'page/tentang_kami';
$route['faq'] = 'page/faq';
$route['contact'] = 'page/contact';
$route['syarat-ketentuan'] = 'page/syarat_ketentuan';
$route['kebijakan-privasi'] = 'page/kebijakan_privasi';
$route['keunggulan-sistem'] = 'page/keunggulan_sistem';
$route['paket-indihome-jogja'] = 'page/paket_indihome_jogja';
$route['profil-kami'] = 'page/profil_kami';
$route['career'] = 'page/career';
$route['sales'] = 'page/sales';
$route['pilih-sales'] = 'page/pilih_sales';
$route['indihome-streamix'] = 'page/paket_streamix';
$route['indihome-phoenix'] = 'page/paket_phoenix';
$route['indihome-value'] = 'page/paket_value';
$route['indihome-prestige'] = 'page/paket_prestige';
$route['indihome-fit'] = 'page/paket_fit';
$route['indihome-for-bumn'] = 'page/paket_bumn';
$route['indihome-prepaid'] = 'page/paket_prepaid';
$route['indihome-2P'] = 'page/paket_2P';
$route['indihome-3P'] = 'page/paket_3P';
$route['indihome-BB'] = 'page/paket_BB';
$route['indihome-SBR'] = 'page/paket_SBR';

// Registration
$route['proses-registrasi'] = 'proses_registrasi';
$route['register-result'] = 'register_result';

// ====================================================================
// ================ RUTE ADMIN (Guest Folder - Tanpa Prefix URL) ====================
// Ini adalah rute untuk controller yang berada langsung di public_html/guest/app_custom/controllers/
// Contoh: public_html/guest/app_custom/controllers/Login.php
$route['login'] = 'login';      // Mengarah ke Login.php
$route['register'] = 'register';// Mengarah ke Register.php
$route['logout'] = 'logout';    // Mengarah ke Logout.php
$route['dashboard'] = 'dashboard';// Mengarah ke Dashboard.php
$route['profile'] = 'profile';  // Mengarah ke Profile.php


// ====================================================================
// ============ RUTE ADMIN (Guest Folder - Dengan Prefix URL 'guest/') =============
// Ini adalah rute untuk controller yang berada di subfolder 'guest'
// Contoh: public_html/guest/app_custom/controllers/guest/Message.php
// URL akan menjadi [http://indihomefiberjogja.com/guest/message](http://indihomefiberjogja.com/guest/message)
// $route['guest/message'] = 'guest/message'; // Perhatikan: '/message' controller di dalam subfolder 'guest'
// $route['guest/message/read'] = 'guest/message/read'; // Method 'read' di controller 'message' di subfolder 'guest'

// // Setting Administrator
// $route['guest/setting-administrator'] = 'guest/setting_administrator/lists';
// $route['guest/setting-administrator/add'] = 'guest/setting_administrator/add';
// $route['guest/setting-administrator/edit'] = 'guest/setting_administrator/edit';
// $route['guest/setting-administrator/delete'] = 'guest/setting_administrator/delete';

// // Setting Administrator Sales
// $route['guest/setting-administrator-sales'] = 'guest/setting_administrator_sales/lists';
// $route['guest/setting-administrator-sales/add'] = 'guest/setting_administrator_sales/add';
// $route['guest/setting-administrator-sales/edit'] = 'guest/setting_administrator_sales/edit';

// // Product
// $route['guest/product'] = 'guest/product/lists';
// $route['guest/product/add'] = 'guest/product/add';
// $route['guest/product/edit'] = 'guest/product/edit';
// $route['guest/product/delete'] = 'guest/product/delete';

// // Setting Home Title
// $route['guest/setting-home-title'] = 'guest/setting_home_title/lists';
// $route['guest/setting-home-title/add'] = 'guest/setting_home_title/add';
// $route['guest/setting-home-title/edit'] = 'guest/setting_home_title/edit';
// $route['guest/setting-home-title/delete'] = 'guest/setting_home_title/delete';

// // Setting Home About
// $route['guest/setting-home-about'] = 'guest/setting_home_about/lists';
// $route['guest/setting-home-about/add'] = 'guest/setting_home_about/add';
// $route['guest/setting-home-about/edit'] = 'guest/setting_home_about/edit';
// $route['guest/setting-home-about/delete'] = 'guest/setting_home_about/delete';

// // Setting Home About Detail
// $route['guest/setting-home-about-detail/add'] = 'guest/setting_home_about_detail/add';
// $route['guest/setting-home-about-detail/edit'] = 'guest/setting_home_about_detail/edit';
// $route['guest/setting-home-about-detail/delete'] = 'guest/setting_home_about_detail/delete';

// // Setting Home Why Us
// $route['guest/setting-home-why-us'] = 'guest/setting_home_why_us/lists';
// $route['guest/setting-home-why-us/add'] = 'guest/setting_home_why_us/add';
// $route['guest/setting-home-why-us/edit'] = 'guest/setting_home_why_us/edit';
// $route['guest/setting-home-why-us/delete'] = 'guest/setting_home_why_us/delete';

// // Setting Home Why Us Detail
// $route['guest/setting-home-why-us-detail/add'] = 'guest/setting_home_why_us_detail/add';
// $route['guest/setting-home-why-us-detail/edit'] = 'guest/setting_home_why_us_detail/edit';
// $route['guest/setting-home-why-us-detail/delete'] = 'guest/setting_home_why_us_detail/delete';

// // Setting Home Package
// $route['guest/setting-home-package'] = 'guest/setting_home_package/lists';
// $route['guest/setting-home-package/add'] = 'guest/setting_home_package/add';
// $route['guest/setting-home-package/edit'] = 'guest/setting_home_package/edit';
// $route['guest/setting-home-package/delete'] = 'guest/setting_home_package/delete';

// // Setting Home Package Afiliasi
// $route['guest/setting-home-package-afiliasi'] = 'guest/setting_home_package_afiliasi/lists';
// $route['guest/setting-home-package-afiliasi/add'] = 'guest/setting_home_package_afiliasi/add';
// $route['guest/setting-home-package-afiliasi/edit'] = 'guest/setting_home_package_afiliasi/edit';
// $route['guest/setting-home-package-afiliasi/delete'] = 'guest/setting_home_package_afiliasi/delete';

// // Setting Home Package Blog
// $route['guest/setting-home-package-blog/add'] = 'guest/setting_home_package_blog/add';
// $route['guest/setting-home-package-blog/edit'] = 'guest/setting_home_package_blog/edit';
// $route['guest/setting-home-package-blog/delete'] = 'guest/setting_home_package_blog/delete';

// // Setting Home Package Category
// $route['guest/setting-home-package-category/add'] = 'guest/setting_home_package_category/add';
// $route['guest/setting-home-package-category/edit'] = 'guest/setting_home_package_category/edit';
// $route['guest/setting-home-package-category/delete'] = 'guest/setting_home_package_category/delete';

// // Setting Home Package Detail
// $route['guest/setting-home-package-detail/add'] = 'guest/setting_home_package_detail/add';
// $route['guest/setting-home-package-detail/edit'] = 'guest/setting_home_package_detail/edit';
// $route['guest/setting-home-package-detail/delete'] = 'guest/setting_home_package_detail/delete';

// // Setting Home Testimoni
// $route['guest/setting-home-testimoni'] = 'guest/setting_home_testimoni/lists';
// $route['guest/setting-home-testimoni/add'] = 'guest/setting_home_testimoni/add';
// $route['guest/setting-home-testimoni/edit'] = 'guest/setting_home_testimoni/edit';
// $route['guest/setting-home-testimoni/delete'] = 'guest/setting_home_testimoni/delete';

// // Setting Home Testimoni Detail
// $route['guest/setting-home-testimoni-detail/add'] = 'guest/setting_home_testimoni_detail/add';
// $route['guest/setting-home-testimoni-detail/edit'] = 'guest/setting_home_testimoni_detail/edit';
// $route['guest/setting-home-testimoni-detail/delete'] = 'guest/setting_home_testimoni_detail/delete';

// // Setting Home Find Us
// $route['guest/setting-home-find-us'] = 'guest/setting_home_find_us/lists';
// $route['guest/setting-home-find-us/add'] = 'guest/setting_home_find_us/add';
// $route['guest/setting-home-find-us/edit'] = 'guest/setting_home_find_us/edit';
// $route['guest/setting-home-find-us/delete'] = 'guest/setting_home_find_us/delete';

// // Setting Home Contact
// $route['guest/setting-home-contact'] = 'guest/setting_home_contact/lists';
// $route['guest/setting-home-contact/add'] = 'guest/setting_home_contact/add';
// $route['guest/setting-home-contact/edit'] = 'guest/setting_home_contact/edit';
// $route['guest/setting-home-contact/delete'] = 'guest/setting_home_contact/delete';

// // Setting Home Contact Us
// $route['guest/setting-home-contact-us'] = 'guest/setting_home_contact_us/lists';
// $route['guest/setting-home-contact-us/add'] = 'guest/setting_home_contact_us/add';
// $route['guest/setting-home-contact-us/edit'] = 'guest/setting_home_contact_us/edit';
// $route['guest/setting-home-contact-us/delete'] = 'guest/setting_home_contact_us/delete';

// // Setting Home Contact Us Title
// $route['guest/setting-home-contact-us-title/add'] = 'guest/setting_home_contact_us_title/add';
// $route['guest/setting-home-contact-us-title/edit'] = 'guest/setting_home_contact_us_title/edit';
// $route['guest/setting-home-contact-us-title/delete'] = 'guest/setting_home_contact_us_title/delete';

// // Setting Home FAQ
// $route['guest/setting-home-faq'] = 'guest/setting_home_faq/lists';
// $route['guest/setting-home-faq/add'] = 'guest/setting_home_faq/add';
// $route['guest/setting-home-faq/edit'] = 'guest/setting_home_faq/edit';
// $route['guest/setting-home-faq/delete'] = 'guest/setting_home_faq/delete';

// // Setting Home FAQ Category
// $route['guest/setting-home-faq-category/add'] = 'guest/setting_home_faq_category/add';
// $route['guest/setting-home-faq-category/edit'] = 'guest/setting_home_faq_category/edit';
// $route['guest/setting-home-faq-category/delete'] = 'guest/setting_home_faq_category/delete';

// // Setting Home Join
// $route['guest/setting-home-join'] = 'guest/setting_home_join/lists';
// $route['guest/setting-home-join/add'] = 'guest/setting_home_join/add';
// $route['guest/setting-home-join/edit'] = 'guest/setting_home_join/edit';
// $route['guest/setting-home-join/delete'] = 'guest/setting_home_join/delete';

// // Setting Home Join Detail
// $route['guest/setting-home-join-detail/add'] = 'guest/setting_home_join_detail/add';
// $route['guest/setting-home-join-detail/edit'] = 'guest/setting_home_join_detail/edit';
// $route['guest/setting-home-join-detail/delete'] = 'guest/setting_home_join_detail/delete';

// // Setting Home Company Profile
// $route['guest/setting-home-company-profile'] = 'guest/setting_home_company_profile/lists';
// $route['guest/setting-home-company-profile/add'] = 'guest/setting_home_company_profile/add';
// $route['guest/setting-home-company-profile/edit'] = 'guest/setting_home_company_profile/edit';
// $route['guest/setting-home-company-profile/delete'] = 'guest/setting_home_company_profile/delete';

// // Setting Home Partner
// $route['guest/setting-home-partner'] = 'guest/setting_home_partner/lists';
// $route['guest/setting-home-partner/add'] = 'guest/setting_home_partner/add';
// $route['guest/setting-home-partner/edit'] = 'guest/setting_home_partner/edit';
// $route['guest/setting-home-partner/delete'] = 'guest/setting_home_partner/delete';

// // Setting Home SK
// $route['guest/setting-home-sk'] = 'guest/setting_home_sk/lists';
// $route['guest/setting-home-sk/add'] = 'guest/setting_home_sk/add';
// $route['guest/setting-home-sk/edit'] = 'guest/setting_home_sk/edit';
// $route['guest/setting-home-sk/delete'] = 'guest/setting_home_sk/delete';

// // Setting Home SK Detail
// $route['guest/setting-home-sk-detail/add'] = 'guest/setting_home_sk_detail/add';
// $route['guest/setting-home-sk-detail/edit'] = 'guest/setting_home_sk_detail/edit';
// $route['guest/setting-home-sk-detail/delete'] = 'guest/setting_home_sk_detail/delete';

// // Setting Home KP
// $route['guest/setting-home-kp'] = 'guest/setting_home_kp/lists';
// $route['guest/setting-home-kp/add'] = 'guest/setting_home_kp/add';
// $route['guest/setting-home-kp/edit'] = 'guest/setting_home_kp/edit';
// $route['guest/setting-home-kp/delete'] = 'guest/setting_home_kp/delete';

// // Setting Home KP Detail
// $route['guest/setting-home-kp-detail/add'] = 'guest/setting_home_kp_detail/add';
// $route['guest/setting-home-kp-detail/edit'] = 'guest/setting_home_kp_detail/edit';
// $route['guest/setting-home-kp-detail/delete'] = 'guest/setting_home_kp_detail/delete';

// // Setting Home KP Title
// $route['guest/setting-home-kp-title/add'] = 'guest/setting_home_kp_title/add';
// $route['guest/setting-home-kp-title/edit'] = 'guest/setting_home_kp_title/edit';
// $route['guest/setting-home-kp-title/delete'] = 'guest/setting_home_kp_title/delete';

// // Setting Home Feature
// $route['guest/setting-home-feature'] = 'guest/setting_home_feature/lists';
// $route['guest/setting-home-feature/add'] = 'guest/setting_home_feature/add';
// $route['guest/setting-home-feature/edit'] = 'guest/setting_home_feature/edit';
// $route['guest/setting-home-feature/delete'] = 'guest/setting_home_feature/delete';

// // Setting Home Feature Title
// $route['guest/setting-home-feature-title/add'] = 'guest/setting_home_feature_title/add';
// $route['guest/setting-home-feature-title/edit'] = 'guest/setting_home_feature_title/edit';
// $route['guest/setting-home-feature-title/delete'] = 'guest/setting_home_feature_title/delete';

// // Setting Home Feature Detail
// $route['guest/setting-home-feature-detail/add'] = 'guest/setting_home_feature_detail/add';
// $route['guest/setting-home-feature-detail/edit'] = 'guest/setting_home_feature_detail/edit';
// $route['guest/setting-home-feature-detail/delete'] = 'guest/setting_home_feature_detail/delete';

// // Setting Home Feature Ext
// $route['guest/setting-home-feature-ext'] = 'guest/setting_home_feature_ext/lists';
// $route['guest/setting-home-feature-ext/add'] = 'guest/setting_home_feature_ext/add';
// $route['guest/setting-home-feature-ext/edit'] = 'guest/setting_home_feature_ext/edit';
// $route['guest/setting-home-feature-ext/delete'] = 'guest/setting_home_feature_ext/delete';

// // Setting Home Feature Ext Detail
// $route['guest/setting-home-feature-ext-detail/add'] = 'guest/setting_home_feature_ext_detail/add';
// $route['guest/setting-home-feature-ext-detail/edit'] = 'guest/setting_home_feature_ext_detail/edit';
// $route['guest/setting-home-feature-ext-detail/delete'] = 'guest/setting_home_feature_ext_detail/delete';

// // Setting Bank
// $route['guest/setting-bank'] = 'guest/setting_bank/lists';
// $route['guest/setting-bank/add'] = 'guest/setting_bank/add';
// $route['guest/setting-bank/edit'] = 'guest/setting_bank/edit';
// $route['guest/setting-bank/delete'] = 'guest/setting_bank/delete';

// // Setting Home Prosedur Daftar
// $route['guest/setting-home-prosedur-daftar'] = 'guest/setting_home_prosedur_daftar/lists';
// $route['guest/setting-home-prosedur-daftar/add'] = 'guest/setting_home_prosedur_daftar/add';
// $route['guest/setting-home-prosedur-daftar/edit'] = 'guest/setting_home_prosedur_daftar/edit';
// $route['guest/setting-home-prosedur-daftar/delete'] = 'guest/setting_home_prosedur_daftar/delete';

// // Setting Home Prosedur Daftar Detail
// $route['guest/setting-home-prosedur-daftar-detail/add'] = 'guest/setting_home_prosedur_daftar_detail/add';
// $route['guest/setting-home-prosedur-daftar-detail/edit'] = 'guest/setting_home_prosedur_daftar_detail/edit';
// $route['guest/setting-home-prosedur-daftar-detail/delete'] = 'guest/setting_home_prosedur_daftar_detail/delete';

// // Setting Home Keunggulan Sistem
// $route['guest/setting-home-keunggulan-sistem'] = 'guest/setting_home_keunggulan_sistem/lists';
// $route['guest/setting-home-keunggulan-sistem/add'] = 'guest/setting_home_keunggulan_sistem/add';
// $route['guest/setting-home-keunggulan-sistem/edit'] = 'guest/setting_home_keunggulan_sistem/edit';
// $route['guest/setting-home-keunggulan-sistem/delete'] = 'guest/setting_home_keunggulan_sistem/delete';

// // Setting Home Keunggulan Sistem Detail
// $route['guest/setting-home-keunggulan-sistem-detail'] = 'guest/setting_home_keunggulan_sistem_detail/lists';
// $route['guest/setting-home-keunggulan-sistem-detail/add'] = 'guest/setting_home_keunggulan_sistem_detail/add';
// $route['guest/setting-home-keunggulan-sistem-detail/edit'] = 'guest/setting_home_keunggulan_sistem_detail/edit';
// $route['guest/setting-home-keunggulan-sistem-detail/delete'] = 'guest/setting_home_keunggulan_sistem_detail/delete';

// // Setting Home Highlight
// $route['guest/setting-home-highlight'] = 'guest/setting_home_highlight/lists';
// $route['guest/setting-home-highlight/add'] = 'guest/setting_home_highlight/add';
// $route['guest/setting-home-highlight/edit'] = 'guest/setting_home_highlight/edit';
// $route['guest/setting-home-highlight/delete'] = 'guest/setting_home_highlight/delete';

// // Setting Home Profil Kami
// $route['guest/setting-home-profil-kami'] = 'guest/setting_home_profil_kami/lists';
// $route['guest/setting-home-profil-kami/add'] = 'guest/setting_home_profil_kami/add';
// $route['guest/setting-home-profil-kami/edit'] = 'guest/setting_home_profil_kami/edit';
// $route['guest/setting-home-profil-kami/delete'] = 'guest/setting_home_profil_kami/delete';

// // Setting Home Profil Kami Title
// $route['guest/setting-home-profil-kami-title/add'] = 'guest/setting_home_profil_kami_title/add';
// $route['guest/setting-home-profil-kami-title/edit'] = 'guest/setting_home_profil_kami_title/edit';
// $route['guest/setting-home-profil-kami-title/delete'] = 'guest/setting_home_profil_kami_title/delete';

// // Setting Home Career
// $route['guest/setting-home-career'] = 'guest/setting_home_career/lists';
// $route['guest/setting-home-career/add'] = 'guest/setting_home_career/add';
// $route['guest/setting-home-career/edit'] = 'guest/setting_home_career/edit';
// $route['guest/setting-home-career/delete'] = 'guest/setting_home_career/delete';

// // Setting Home Career Category
// $route['guest/setting-home-career-category/add'] = 'guest/setting_home_career_category/add';
// $route['guest/setting-home-career-category/edit'] = 'guest/setting_home_career_category/edit';
// $route['guest/setting-home-career-category/delete'] = 'guest/setting_home_career_category/delete';

// // Setting Home Career Title
// $route['guest/setting-home-career-title/add'] = 'guest/setting_home_career_title/add';
// $route['guest/setting-home-career-title/edit'] = 'guest/setting_home_career_title/edit';
// $route['guest/setting-home-career-title/delete'] = 'guest/setting_home_career_title/delete';

// // Setting Home Career Culture
// $route['guest/setting-home-career-culture/add'] = 'guest/setting_home_career_culture/add';
// $route['guest/setting-home-career-culture/edit'] = 'guest/setting_home_career_culture/edit';
// $route['guest/setting-home-career-culture/delete'] = 'guest/setting_home_career_culture/delete';

// /* End of file routes.php */
// /* Location: ./application/config/routes.php */

// // HAPUS RUTE CATCH-ALL YANG BERMASALAH INI!
// $route['(:any)'] = 'Dashboard'; // <--- Ini yang menyebabkan semua URL mengarah ke Dashboard/Home

/* End of file routes.php */
/* Location: ./application/config/routes.php */
