<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Adversity Quotient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="<?= base_url('AQ/css/style.css') ?>">
    <link rel="stylesheet" type="text/css"
        href="<?= base_url('home/fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
        
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('favicon/apple-touch-icon.png') ?> ">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('favicon/favicon-32x32.png') ?> ">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('favicon/favicon-16x16.png') ?>">
	<link rel="manifest" href="<?= base_url('favicon/site.webmanifest') ?> ">
    <!-- Chosen Palette: Warm Sand (Replicated in Bootstrap) -->
    <!-- Application Structure Plan: Aplikasi ini menggunakan struktur Single-Page Application (SPA) dengan tiga tampilan utama: (1) Halaman Pembuka, (2) Halaman Kuis, dan (3) Halaman Hasil. Alur ini dipilih karena sangat intuitif untuk tugas linear seperti mengisi kuis. Pengguna dipandu langkah demi langkah dari awal hingga akhir, mengurangi kebingungan dan menjaga fokus. Penggunaan transisi halus antar halaman memberikan pengalaman pengguna yang mulus dan modern. -->
    <!-- Visualization & Content Choices: Soal disajikan satu per satu untuk menjaga fokus pengguna. Setelah kuis selesai, hasilnya disajikan dalam bentuk dashboard ringkas. Tipe AQ (Climber, Camper, Quitter) ditampilkan secara jelas sebagai hasil utama. Untuk memvisualisasikan komposisi jawaban, sebuah diagram donat (Doughnut Chart) dari Chart.js digunakan. Pilihan ini efektif untuk menunjukkan proporsi jawaban pengguna secara visual dan cepat dipahami. Di bawahnya, penjelasan rinci untuk setiap tipe memberikan konteks dan wawasan mendalam, sesuai dengan konten dari laporan sumber. Interaksi utama adalah memilih jawaban dan memulai ulang kuis. -->
    <!-- CONFIRMATION: NO SVG graphics used. NO Mermaid JS used. -->

</head>