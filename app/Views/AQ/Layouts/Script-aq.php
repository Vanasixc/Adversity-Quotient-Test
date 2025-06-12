<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script>
    // Deklarasi variabel elemen HTML (tetap sama)
    const startScreen = document.getElementById('start-screen');
    const quizScreen = document.getElementById('quiz-screen');
    const resultScreen = document.getElementById('result-screen');
    const startBtn = document.getElementById('start-btn');
    const retakeBtn = document.getElementById('retake-btn');
    const questionNumberEl = document.getElementById('question-number');
    const questionTextEl = document.getElementById('question-text');
    const optionsContainer = document.getElementById('options-container');
    const resultTypeEl = document.getElementById('result-type');
    const resultDescriptionEl = document.getElementById('result-description');
    const chartCanvas = document.getElementById('result-chart');
    let resultChart;


    // DATA STATIS DI BAWAH INI SEKARANG DIKOSONGKAN
    let questions = [];
    let scoreMatrix = {};

    // Deskripsi bisa kita simpan di sini karena tidak sering berubah
    const resultDescriptions = {
        QUITTER: '<ul><li class="mb-2">Gaya hidup datar dan tidak menyenangkan.</li><li class="mb-2">Menolak untuk berjuang dan mendaki lebih tinggi lagi.</li><li class="mb-2">Cenderung menghindari tantangan yang timbul dari sebuah komitmen.</li><li class="mb-2">Terampil dalam menggunakan kata-kata yang sifatnya membatasi, seperti "tidak mau" atau "mustahil".</li><li class="mb-2">Tidak memiliki visi dan keyakinan akan masa depan.</li></ul>',
        CAMPER: '<ul><li class="mb-2">Mau berusaha untuk mendaki, namun berhenti pada satu titik tertentu.</li><li class="mb-2">Cukup puas saat mencapai suatu tahapan tertentu.</li><li class="mb-2">Masih memiliki sejumlah inisiatif, sedikit semangat, dan beberapa usaha.</li><li class="mb-2">Menahan diri terhadap perubahan karena merasa nyaman dengan kondisi yang ada.</li><li class="mb-2">Menggunakan kata-kata yang bersifat kompromistis, seperti: "ini cukup bagus".</li></ul>',
        CLIMBER: '<ul><li class="mb-2">Berusaha untuk terus mendaki dan melihat kesulitan sebagai bagian dari hidup.</li><li class="mb-2">Seorang pemikir yang selalu memikirkan kemungkinan-kemungkinan.</li><li class="mb-2">Menyambut baik suatu tantangan dan terus memotivasi diri sendiri.</li><li class="mb-2">Menyambut baik setiap perubahan bahkan mendorong menuju perubahan yang positif.</li><li class="mb-2">Memberikan kontribusi yang cukup besar karena bisa mewujudkan potensi yang ada dalam dirinya.</li></ul>'
    };

    let currentQuestionIndex = 0;
    let userAnswers = [];

    // Fungsi startQuiz diubah menjadi async untuk bisa menggunakan 'await'
    async function startQuiz() {
        try {
            // Ambil data soal dan matrix dari API yang kita buat di CI4
            const [questionsRes, matrixRes] = await Promise.all([
                fetch('<?= site_url('/questions/apiquestions') ?>'),
                fetch('<?= site_url('/questions/matrix') ?>')
            ]);

            if (!questionsRes.ok || !matrixRes.ok) {
                throw new Error('Gagal mengambil data kuis dari server.');
            }

            // Masukkan data dari server ke dalam variabel JavaScript
            questions = await questionsRes.json();
            scoreMatrix = await matrixRes.json();

            // Setelah data siap, baru mulai kuisnya
            currentQuestionIndex = 0;
            userAnswers = [];
            showScreen('quiz-screen');
            displayQuestion();

        } catch (error) {
            console.error("Gagal memulai kuis:", error);
            alert("Terjadi kesalahan saat memuat kuis. Silakan coba lagi nanti.");
        }
    }

    function displayQuestion() {
        const currentQuestion = questions[currentQuestionIndex];
        questionNumberEl.textContent = `Pertanyaan ${currentQuestionIndex + 1} dari ${questions.length}`;
        questionTextEl.textContent = currentQuestion.question;
        optionsContainer.innerHTML = '';

        currentQuestion.options.forEach(option => {
            const button = document.createElement('button');
            button.innerHTML = option.text;
            button.className = 'w-100 text-start p-3 rounded-3 option-card mb-3';
            button.onclick = () => selectAnswer(option.type);
            optionsContainer.appendChild(button);
        });
        document.getElementById('question-container').classList.remove('fade-out');
        document.getElementById('question-container').classList.add('fade-in');

        //Button repeat
        const repeatBut = '<a href="<?= site_url('questions') ?>" class="back-to-question-btn"><i class="fa fa-repeat"></i>Back to Test</a>';

        optionsContainer.insertAdjacentHTML('beforeend', repeatBut);
    }

    function selectAnswer(type) {
        userAnswers.push(type);
        currentQuestionIndex++;

        document.getElementById('question-container').classList.add('fade-out');

        setTimeout(() => {
            if (currentQuestionIndex < questions.length) {
                displayQuestion();
            } else {
                showResult();
            }
        }, 500);
    }

    function showResult() {
        showScreen('result-screen');

        const scores = {
            Q: userAnswers.filter(ans => ans === 'Q').length,
            Ca: userAnswers.filter(ans => ans === 'Ca').length,
            Cl: userAnswers.filter(ans => ans === 'Cl').length
        };

        const scoreKey = `${scores.Q}_${scores.Ca}_${scores.Cl}`;

        let finalType = scoreMatrix[scoreKey];
        if (!finalType) {
            const maxScore = Math.max(scores.Q, scores.Ca, scores.Cl);
            if (scores.Cl === maxScore) finalType = "CLIMBER";
            else if (scores.Ca === maxScore) finalType = "CAMPER";
            else finalType = "QUITTER";
        }

        resultTypeEl.textContent = finalType;
        resultDescriptionEl.innerHTML = resultDescriptions[finalType];

        displayChart(scores);
    }

    function displayChart(scores) {
        if (resultChart) {
            resultChart.destroy();
        }
        const ctx = chartCanvas.getContext('2d');
        resultChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Quitter', 'Camper', 'Climber'],
                datasets: [{
                    label: 'Komposisi Jawaban',
                    data: [scores.Q, scores.Ca, scores.Cl],
                    backgroundColor: [
                        'rgba(217, 119, 6, 0.4)',
                        'rgba(180, 83, 9, 0.6)',
                        'rgba(120, 53, 15, 0.8)'
                    ],
                    borderColor: [
                        'rgb(217, 119, 6)',
                        'rgb(180, 83, 9)',
                        'rgb(120, 53, 15)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#44403c'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += `${context.parsed} jawaban`;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    }

    function showScreen(screenId) {
        [startScreen, quizScreen, resultScreen].forEach(screen => {
            screen.classList.add('d-none');
        });
        document.getElementById(screenId).classList.remove('d-none');
    }

    startBtn.addEventListener('click', startQuiz);
    retakeBtn.addEventListener('click', () => {
        showScreen('start-screen');
    });
</script>