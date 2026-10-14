# 🔥 KALINGGA-VISION
> **Integrasi Computer Vision dan Web Dashboard dalam Sistem Deteksi Dini Karhutla: Kreativitas Solusi Berbasis Teknologi untuk Mitigasi Bencana dan Dampak Kabut Asap di Kalimantan Tengah**

[![Python](https://img.shields.io/badge/Python-3.13-blue.svg)](https://www.python.org/)
[![OpenCV](https://img.shields.io/badge/OpenCV-Computer%20Vision-red.svg)](https://opencv.org/)
[![PHP](https://img.shields.io/badge/PHP-8.2-purple.svg)](https://www.php.net/)
[![Bootstrap 5](https://img.shields.io/badge/Bootstrap-5.3-success.svg)](https://getbootstrap.com/)

## 📌 Latar Belakang Proyek
Kebakaran hutan dan lahan (Karhutla) serta dampak kabut asap di Kalimantan Tengah merupakan masalah krusial yang menuntut penanganan cepat dan proaktif. **KALINGGA-VISION** hadir sebagai solusi inovatif berbasis *IoT & Computer Vision* yang dirancang untuk mendeteksi indikasi awal kepulan asap secara otomatis, mempercepat respons darurat, dan meminimalisir kerugian ekologis maupun kesehatan masyarakat.

---

## 🛠️ Teknologi yang Digunakan
* **Python & OpenCV:** Berperan sebagai "mata" sistem untuk memantau *feed* video/kamera secara *real-time* menggunakan analisis rentang warna *HSV Color Space* untuk mendeteksi pola asap.
* **PHP (Native) & MySQL:** Berperan sebagai jembatan *backend* dan pengolah basis data log kejadian.
* **Bootstrap 5:** Kerangka kerja antarmuka untuk membangun *Web Dashboard* pemantauan yang responsif dan interaktif.

---

## 📂 Struktur Direktori Proyek
```text
kalingga-vision/
├── python_detector/
│   ├── main.py             # Skrip utama deteksi komputer vision & pengiriman API
│   └── requirements.txt    # Daftar dependensi pustaka Python
├── web_dashboard/
│   ├── index.php           # Halaman antarmuka pemantauan real-time
│   ├── api_simpan.php      # Endpoint API penerima data darurat
│   └── koneksi.php         # Konfigurasi basis data terpusat
└── README.md               # Dokumentasi proyek