<?php
require 'koneksi.php';

// Terima payload JSON dari GitHub Webhook
$payload = file_get_contents('php://input');
$data = json_decode($payload, true);

// Pastikan ini adalah event push dan ada commit
if (isset($data['commits']) && is_array($data['commits'])) {
    foreach ($data['commits'] as $commit) {
        $pesan_commit = $commit['message'];
        
        // Regex format: "[Tipe Update] Judul Update | Divisi | Deskripsi"
        $pattern = '/^\[(.*?)\] (.*?) \| (.*?) \| (.*)$/m';
        
        if (preg_match($pattern, $pesan_commit, $matches)) {
            $tipe_update = $conn->real_escape_string(trim($matches[1]));
            $judul_update = $conn->real_escape_string(trim($matches[2]));
            $divisi_terdampak = $conn->real_escape_string(trim($matches[3]));
            $deskripsi_update = $conn->real_escape_string(trim($matches[4]));
            
            // Masukkan ke database
            $sql = "INSERT INTO changelog (judul_update, deskripsi_update, divisi_terdampak, tipe_update) 
                    VALUES ('$judul_update', '$deskripsi_update', '$divisi_terdampak', '$tipe_update')";
            
            if (!$conn->query($sql)) {
                error_log("Gagal insert changelog: " . $conn->error);
            }
        }
    }
}
$conn->close();
http_response_code(200);
echo "Webhook diterima.";
?>