<?php

namespace Lang;

class IndonesiaLang extends RootLang
{
    public function __construct($urlBuilder)
    {
        // ERROR MESSAGE
    	$this->notValidEmail = '%s tidak valid email!';
        $this->requiredErrorMessage = '%s belum diisi!';
        $this->notValidErrorMessage = 'Format %s tidak valid! %s';
        $this->notEqualErrorMessage = '%s dan %s tidak sama!';
        $this->minLengthErrorMessage = '%s minimal %s karakter!';
        $this->maxLengthErrorMessage = '%s maksimal %s karakter!';
        $this->betweenErrorMessage = '%s nilainya harus diantara %s dan %s!';
        $this->inputErrorMessage = 'Input %s salah!';
        $this->hasRegisteredMessage = '%s sudah terdaftar! Silakan login <a href="'.$urlBuilder->build('member/login').'" style="color:#fff;text-shadow: 0px 1px 0px #96221a;">di sini</a>';
        $this->startWithLetterErrorMessage = '%s harus diawali dengan huruf!';
        $this->isDigitErrorMessage = 'Input %s harus berupa angka!';
    	$this->isAlphaNumericErrorMessage = 'Input %s harus berupa huruf dan angka!';
        $this->hasDefaultValueErrorMessage = '%s tidak boleh kosong! Beri nilai %s jika ingin kosong.';
        $this->expiredPromoErrorMessage = '%s tidak ditemukan, sudah expired, atau melebihi dari maksimum penggunaan!';
        $this->notLoggedInErrorMessage = 'Maaf, Anda tidak bisa mengakses halaman ini!';
        $this->bannedErrorMessage = 'Maaf, status member tidak dapat digunakan, silahkan menghubungi admin!';
        $this->loggedInErrorMessage = 'Maaf, Anda harus login untuk bisa mengakses halaman ini!';
        $this->isNotAvailableErrorMessage = 'Maaf, %s sudah digunakan. Silakan menggunakan %s yang lain.';
        $this->internalErrorMessage = 'Maaf, terjadi kesalahan internal. Kami sudah mencatat dan akan segera memperbaikinya. Mohon maaf atas ketidaknyamanan ini.';
        $this->notFoundDataErrorMessage = 'Tidak ditemukan %s dengan data %s bernilai %s!';
        $this->minimalNominalErrorMessage = '%s minimal sejumlah %s!';
        $this->hasTokiCreatedErrorMessage = 'Anda masih mempunyai transaksi Toki yang belum diselesaikan!';
        $this->hasNoTokiCreatedErrorMessage = 'Anda tidak mempunyai transaksi Toki untuk dikonfirmasi. Silakan membuat transaksi Toki terlebih dahulu.';
        $this->hasNoPermissionErrorMessage = 'Anda tidak mempunyai hak akses untuk halaman ini!';
        $this->hasDuplicateErrorMessage = 'Terjadi duplikasi data pada %s!';
    	$this->notValidParameter = 'Parameter %i tidak valid pada halaman ini';
    	$this->notValidSelectBox = 'Silahkan memilih %s dari select box yang ada.';
    	$this->notEnoughSaldo = 'Saldo tidak mencukupi untuk transaksi';
    	$this->notValidSerializeInput = 'Ada data pada %s yang belum lengkap! Silahkan mengulangi proses.';
    	$this->alreadyRegistered = '%s sudah terdaftar pada class-grade %s';
    	$this->expiredSchedule = 'Waktu yang anda buat sudah terlewati..';

    	$this->usernameRegistered = 'Username %s sudah terdaftar!';
    	$this->emailRegistered = 'Email %s sudah terdaftar!';
    	$this->exceedDownlineNumber = 'Anda sudah tidak bisa membuat downline lagi, silahkan hubungi admin';
    	$this->exceedShareDownlineNumber = 'Anda tidak bisa memberikan %s kepada downline baru, silahkan hubungi admin';

    	$this->notValidFinger = 'Fingerprint tidak valid..!';

    	$this->statusChange = 'Data %s berhasil dirubah menjadi %s ';
    	$this->dateBackSmallerErrorMessage = 'Tanggal kembali harus lebih dari tanggal berangkat..';
    	$this->flightNotSet = 'Penerbangan belum ditentukan, silahkan memilih penerbangan anda..';
    	$this->confirmOrder = 'Anda sudah mengisi data penumpang untuk penerbangan ini, silahkan lanjutkan proses atau tekan tombol kembali untuk membatalkan proses..';
		$this->bookingErrorMessage = 'Terjadi Error pada saat booking, silahkan mengulangi proses';
    	$this->bookingSuccessMessage = 'Booking berhasil, silahkan segera melakukan proses issued!';
    	$this->dateNotValidMessage = 'Tanggal %s minimal adalah hari ini';

    	$this->issuedNotPrivilege = 'Akun anda tidak diberikan hak untuk melakukan issued, silahkan menghubungi agent anda.';
    	$this->issuedNotPermitted = 'Akun anda tidak diperbolehkan untuk melakukan issued pada tiket ini.';
    	$this->insufficientBalance = 'Akun anda tidak memiliki saldo yang cukup untuk melakukan issued pada tiket ini.';
        $this->issuedError = 'Issued gagal dilakukan, silahkan hubungi admin untuk melakukan konfirmasi.';
    	$this->issuedSuccess = 'Issued telah berhasil di lakukan. silahkan melakukan tindakan lanjut berkaitan dengan tiket ini.';

        $this->downloadTicketNotPermited = 'Anda tidak diperbolehkan mendownload tiket ini.';

        // SUCCESS
        $this->deletedSuccessMessage = 'Data %s dengan data %s bernilai %s berhasil dihapus!';
        $this->insertSuccessMessage = 'Data berhasil disimpan!';
        $this->updateSuccessMessage = 'Data Berhasil diedit!';
    	$this->registerFingerSuccess = 'Fingerprint %s berhasil didaftarkan ';

        $this->fileNotFound = 'File Tidak Ditemukan!';
    }
}