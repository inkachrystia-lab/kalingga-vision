<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KALINGGA-VISION | Dashboard Pemantauan Karhutla</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Auto-refresh halaman tiap 5 detik agar real-time -->
    <meta http-equiv="refresh" content="5">
</head>
<body class="bg-secondary bg-opacity-10">

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <span class="navbar-brand mb-0 h1"><i class="fa-solid fa-fire-flame-curved text-warning"></i> KALINGGA-VISION Dashboard</span>
            <span class="text-light small">Mitigasi Karhutla Kalimantan Tengah</span>
        </div>
    </nav>

    <div class="container my-4">
        
        <?php
        $conn = new mysqli("localhost", "root", "", "kalingga_db");
        $latest = null;
        if(!$conn->connect_error) {
            $result =$conn->query("SELECT * FROM log_status ORDER BY id DESC LIMIT 1");
            if($result) {
                $latest =$result->fetch_assoc();
            }
        }
        
        $badge_bg = "bg-success";
        $teks_status = "SISTEM AMAN - Tidak Ada Indikasi Asap";
        $icon_status = "fa-shield-check";
        
        if($latest && isset($latest['tingkat_bahaya']) && $latest['tingkat_bahaya'] == 'TINGGI') {$badge_bg = "bg-danger";
            $teks_status = $latest['status_pesan'];$icon_status = "fa-triangle-exclamation fa-beat";
        }
        ?>

        <!-- Card Status Utama dengan Background Hutan Samar -->
        <div class="card text-white mb-4 shadow border-0 overflow-hidden position-relative" style="
            background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), url('https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
        ">
            <!-- Indikator Garis Samping (Merah/Hijau) -->
            <div class="position-absolute top-0 start-0 bottom-0 <?php echo ($latest && isset($latest['tingkat_bahaya']) &&$latest['tingkat_bahaya'] == 'TINGGI') ? 'bg-danger' : 'bg-success'; ?>" style="width: 8px;"></div>
            
            <div class="card-body text-center py-5 ps-4">
                <i class="fa-solid <?php echo $icon_status; ?> fa-3x mb-3 text-warning"></i>
                <h5 class="text-uppercase tracking-wide opacity-75">Status Pemantauan Menara</h5>
                <h1 class="display-5 fw-bold mb-0 text-white"><?php echo $teks_status; ?></h1>
                <?php if($latest && isset($latest['waktu'])): ?>
                    <p class="mt-3 mb-0 small text-light opacity-75">Pembaruan Terakhir: <?php echo $latest['waktu']; ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Tabel Riwayat Deteksi -->
        <div class="card shadow border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-dark fw-bold"><i class="fa-solid fa-clock-rotate-left text-primary"></i> Riwayat Log Deteksi Sistem</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-3">No</th>
                                <th>Keterangan Status</th>
                                <th>Tingkat Bahaya</th>
                                <th class="pe-3">Waktu Kejadian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!$conn->connect_error) {$no = 1;
                                $logs =$conn->query("SELECT * FROM log_status ORDER BY id DESC LIMIT 10");
                                if($logs &&$logs->num_rows > 0) {
                                    while($row =$logs->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="ps-3"><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['status_pesan']); ?></td>
                                <td><span class="badge bg-danger px-3 py-2"><?php echo htmlspecialchars($row['tingkat_bahaya']); ?></span></td>
                                <td class="pe-3"><?php echo htmlspecialchars($row['waktu']); ?></td>
                            </tr>
                            <?php 
                                    endwhile;
                                } else {
                                    echo '<tr><td colspan="4" class="text-center py-4 text-muted">Belum ada data riwayat deteksi.</td></tr>';
                                }
                            } else {
                                echo '<tr><td colspan="4" class="text-center py-4 text-danger">Koneksi Database Gagal. Pastikan tabel sudah dibuat.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4 text-muted