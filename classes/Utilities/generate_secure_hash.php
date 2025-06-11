<?php
// SCRIPT SEMENTARA UNTUK MENGHASILKAN HASH PASSWORD BARU
// HAPUS FILE INI SEGERA SETELAH DIGUNAKAN UNTUK KEAMANAN!

require_once 'RandomStringGenerator.php'; // Path ini bekerja karena file ada di direktori yang sama

// --- GANTI DUA VARIABEL INI ---
$username_admin_anda = 'Yudha'; // Ganti dengan username admin Anda
$password_baru_yang_anda_inginkan = 'Indihome12345'; // Ganti dengan password baru Anda

// --- JANGAN UBAH KODE DI BAWAH INI ---
$randomStringGenerator = new \Utilities\RandomStringGenerator();
$hashedPasswordFinal = $randomStringGenerator->encryptStringAgent($password_baru_yang_anda_inginkan, $username_admin_anda);

echo "<!DOCTYPE html><html><head><title>Generate Hash</title></head><body>";
echo "<h2>--- HASIL GENERASI HASH PASSWORD ---</h2>";
echo "<p><strong>Username:</strong> " . htmlspecialchars($username_admin_anda) . "</p>";
echo "<p><strong>Password Plaintext (Yang Anda Masukkan):</strong> " . htmlspecialchars($password_baru_yang_anda_inginkan) . "</p>";
echo "<p style='font-size: 1.5em; color: green; font-weight: bold;'>HASH UNTUK DATABASE: <br><code>" . htmlspecialchars($hashedPasswordFinal) . "</code></p>";
echo "<p><strong>SALIN TEKS HASH DI ATAS DENGAN HATI-HATI.</strong></p>";
echo "<p>Kemudian, lanjutkan ke Langkah 2.</p>";
echo "<p style='color: red;'><strong>PENTING: JANGAN LUPA HAPUS FILE INI SEGERA SETELAH SELESAI!</strong></p>";
echo "</body></html>";

die();
?>