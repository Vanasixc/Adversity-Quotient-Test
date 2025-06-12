<?= $this->extend('aq/layouts/template-aq') ?>
<?= $this->section('content'); ?>

<body>
    <a href="<?= site_url('/') ?>" class="back-to-home-btn">
        <i class="fa fa-home"></i>
        Home
    </a>
    
    <div class="container-fluid main-container">
        <div class="d-flex align-items-center justify-content-center min-vh-100 p-4">
            <!-- Start Screen -->
            <div id="start-screen" class="text-center p-5 bg-white rounded-4 shadow-lg fade-in">
                <h1 class="display-5 fw-bold text-custom-primary">Tes Adversity Quotient (AQ)</h1>
                <h2 class="display-9 fw-bold text-custom-primary mt-3">Halo <?= session()->get('username') ?></h2>
                <p class="mt-3 text-secondary">Temukan seberapa tangguh Anda dalam menghadapi tantangan hidup. Tes ini
                    terdiri dari 15 pertanyaan yang akan membantu Anda memahami tipe ketahanan Anda: apakah Anda seorang
                    <span class="fw-semibold text-custom-secondary">Climber</span>, <span
                        class="fw-semibold text-custom-tertiary">Camper</span>, atau <span class="fw-semibold"
                        style="color:#d97706;">Quitter</span>.
                </p>
                <p class="mt-3 text-muted small">Jawablah setiap pertanyaan dengan jujur sesuai dengan diri Anda.</p>
                <button id="start-btn" class="btn btn-custom-primary btn-lg mt-4 py-2 px-5 rounded-pill">
                    Mulai Tes
                </button>
            </div>

            <!-- Quiz Screen -->
            <div id="quiz-screen" class="d-none">
                <div id="question-container" class="p-5 bg-white rounded-4 shadow-lg fade-in qContainer">
                    <p id="question-number" class="text-custom-secondary fw-semibold">Pertanyaan 1 dari 15</p>
                    <h2 id="question-text" class="h3 fw-bold mt-2"></h2>
                    <div id="options-container" class="mt-4">
                        <!-- Options will be injected here by JS -->
                    </div>
                </div>
            </div>

            <!-- Result Screen -->
            <div id="result-screen" class="d-none">
                <div class="p-5 bg-white rounded-4 shadow-lg fade-in text-center">
                    <h2 class="h4 fw-semibold text-secondary">Selamat <?= session()->get('username') ?>! Hasil Tes Anda adalah:</h2>
                    <h1 id="result-type" class="display-3 fw-bold text-custom-primary mt-2"></h1>

                    <div class="mt-5">
                        <div class="chart-container">
                            <canvas id="result-chart"></canvas>
                        </div>
                    </div>

                    <div id="result-description" class="mt-5 text-start p-4 rounded-3"
                        style="background-color: #f5f5f4;">
                        <!-- Description will be injected here by JS -->
                    </div>

                    <button id="retake-btn" class="btn btn-custom-primary btn-lg mt-4 py-2 px-5 rounded-pill">
                        Ulangi Tes
                    </button>
                </div>
            </div>
        </div>

    </div>
    <?= $this->endSection() ?>