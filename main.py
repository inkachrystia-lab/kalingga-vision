import cv2
import numpy as np

# Membuka kamera utama (atau masukkan path video simulasi di sini)
cap = cv2.VideoCapture(0)

print("[INFO] KALINGGA-VISION Detector Berjalan... Tekan 'q' untuk keluar.")

while cap.isOpened():
    ret, frame = cap.read()
    if not ret:
        break

    # 1. Konversi warna dari BGR ke HSV (lebih mudah untuk mendeteksi warna spesifik)
    hsv = cv2.cvtColor(frame, cv2.COLOR_BGR2HSV)

    # 2. Tentukan rentang warna untuk simulasi asap (warna putih/abu-abu terang dengan saturasi rendah)
    # Nilai ini bisa disesuaikan nanti saat uji coba dengan video/asap asli
    lower_smoke = np.array([0, 0, 200])
    upper_smoke = np.array([180, 30, 255])

    # 3. Buat mask untuk menyaring warna sesuai rentang
    mask = cv2.inRange(hsv, lower_smoke, upper_smoke)

    # 4. Hitung jumlah piksel putih (indikasi adanya asap)
    smoke_pixel_count = cv2.countNonZero(mask)

    # Tentukan ambang batas (threshold) peringatan
    status_text = "STATUS: AMAN"
    color_box = (0, 255, 0) # Hijau

    if smoke_pixel_count > 5000: # Jika area putih terlalu luas (terdeteksi asap)
        status_text = "STATUS: PERINGATAN! POTENSI ASAP TERDETEKSI!"
        color_box = (0, 0, 255) # Merah

    # 5. Tampilkan teks status ke layar
    cv2.putText(frame, status_text, (30, 50), cv2.FONT_HERSHEY_SIMPLEX, 0.7, color_box, 2)
    
    # Tampilkan jendela video
    cv2.imshow('KALINGGA-VISION - Live Monitoring', frame)
    cv2.imshow('Smoke Mask Detection', mask)

    # Tekan 'q' untuk berhenti
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

cap.release()
cv2.destroyAllWindows()