<?= $this->extend('home/layouts/template-home'); ?>

<?= $this->section('content'); ?>
<body id="page-top">
    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase">Adversity Quotient Test</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">Embrace Challenges, Discover Your Strength.</h2>
                    <a class="btn btn-primary" href="<?= base_url('auth') ?>">Get Started</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?= base_url('home/js/scripts.js') ?>"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>
<?= $this->endSection(); ?>