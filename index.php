<?php
require 'koneksi.php';

$sql = "SELECT * FROM changelog ORDER BY tgl_update DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changelog Aplikasi</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .timeline-item { background: white; border-left: 4px solid #0d6efd; box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075); margin-bottom: 1.5rem; padding: 1.5rem; border-radius: 0.25rem; }
        .timeline-date { color: #6c757d; font-size: 0.875rem; margin-bottom: 0.5rem; }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="mb-4 text-center">App Changelog</h1>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <div class="timeline-item">
                            <div class="timeline-date">
                                <strong>📅 <?php echo date('d M Y, H:i', strtotime($row['tgl_update'])); ?></strong>
                                <span class="badge bg-primary ms-2"><?php echo htmlspecialchars($row['tipe_update']); ?></span>
                                <span class="badge bg-secondary ms-1"><?php echo htmlspecialchars($row['divisi_terdampak']); ?></span>
                            </div>
                            <h4 class="mb-2"><?php echo htmlspecialchars($row['judul_update']); ?></h4>
                            <p class="mb-0 text-muted"><?php echo nl2br(htmlspecialchars($row['deskripsi_update'])); ?></p>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="alert alert-info text-center">Belum ada pembaruan (changelog kosong).</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>