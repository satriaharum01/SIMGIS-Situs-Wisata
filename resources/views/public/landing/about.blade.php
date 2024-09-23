<!DOCTYPE html>
<html lang="en">

<head>
    <title>Situs Wisata Sejarah dan Kepurbakalaan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/images/Laravel.svg') }}">
    <!-- Load Require CSS -->
    <link href="{{ asset('landing/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font CSS -->
    <link href="{{ asset('landing/assets/css/boxicon.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Load Tempalte CSS -->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/templatemo.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/custom.css') }}">
    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js"></script>
    <script src="{{ asset('lib/leaflet-routing-machine.js') }}"></script>
    <script src="{{ asset('lib/osmtogeojson.js') }}"></script>
    <style>
        .mapouter {
            position: relative;
            text-align: right;
            height: 100%;
            width: 100%;
        }

        .map-box {
            margin: auto;
            height: 600px;
            width: 100%;
        }

        .gmap_canvas {
            overflow: hidden;
            background: none !important;
            height: 100%;
            width: 100%;
        }

        img {
            position: absolute;
            width: 100%;
            max-width: 100%;
            height: auto;
            z-index: -1;
        }

        tr>td {
            vertical-align: top;
            text-align: justify;
        }
    </style>
    <!--
    
TemplateMo 561 Purple Buzz

https://templatemo.com/tm-561-purple-buzz

-->
</head>

<body>
    <!-- Header -->
    @include('public/navbar')
    <!-- Close Header -->
    <nav id="2nd_nav" class="navbar navbar-expand-lg navbar-light bg-secondary shadow py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand h1" href="#">
                <i class='bx bx-user bx-sm text-light'></i>
                <span class="text-light h4">Tentang</span> <span class="text-light h4">Situs Wisata</span>
            </a>
        </div>
    </nav>
    <!-- Start Service -->
    <section class="service-wrapper py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="align-self-center collapse navbar-collapse flex-fill flex-column d-lg-flex justify-content-lg-between" id="navbar-toggler-success">
                <div class="mb-2">
                    <ul class="nav navbar-nav d-flex flex-row justify-content-center mx-xl-5 text-center text-dark">
                        <li class="nav-item">
                            <a class="filter-btn nav-link btn-outline-primary  active shadow rounded-pill text-light px-4 light-300 text-dark" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active">Profil</a>
                        </li>
                        <li class="nav-item mx-lg-4">
                            <a class="filter-btn nav-link btn-outline-primary text-dark rounded-pill text-light px-4 light-300" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1">Visi</a>
                        </li>
                        <li class="nav-item mx-lg-4">
                            <a class="filter-btn nav-link btn-outline-primary text-dark rounded-pill text-light px-4 light-300" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2">Misi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">

            <div id="carouselExampleIndicators" class="carousel slide col-md-10 mx-auto mt-5" data-bs-interval="false">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="color: black;">
                        <h3 class="text-center">Profil Dinas Kebudayaan dan Pariwisata Provinsi Sumatera Utara </h3>
                        <div class="container d-flex flex-column justify-content-between align-items-center">
                            <img src="{{url('images/struktur.png')}}" style="position:relative;z-index:1;" alt="">
                            <p><strong>Struktur Organisasi</strong></p>
                            <p style="text-align:justify;">
                                Dinas Kebudayaan dan Pariwisata Provinsi Sumatera Utara dipimpin oleh seorang kepala dinas yang dalam melaksanakan tugas berada di bawah danbertanggung jawab kepada gubernur melalui sekretaris daerah, sebagai mana ditetapkan dalam peraturan gubernur Sumatera Utara Nomor 41 Tahun 2007 tentang rincian tugas pokok dan fungsi masing-masing jabatan pada Dinas Kebudayaan dan Pariwisata Provinsi Sumatera Utara. Dinas Kebudayaaan dan Pariwisata mempunyai tugas pokok melaksanakan urusan bidang kebudayaan dan pariwisata yang menjadi kewenangan provinsi dan tugas pembantuan kepada daerah provinsi.
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item" style="color: black;">
                        <h3 class="text-center">Visi</h3>
                        <div class="container d-flex flex-column justify-content-between align-items-center">
                            <p style="text-align:justify;">
                                Adapun visi dari Dinas Kebudayaan dan Pariwisata Provinsi Sumatera Utara yaitu <strong>“Terwujudnya Sumatera Utara Menjadi Daerah Tujuan Wisata yang Berbudaya dan Berdaya Saing”.</strong> Makna yang terkandung dalam visi tersebut adalah bahwa dalam lima tahun ke depan diharapkan pembangunan kebudayaan dan pariwisata Sumatera Utara menjamin keberlangsungan ekonomi, kehidupan sosial budaya, pelestarian lingkungan hidup dan pelestarian kebudayaan daerah serta memberikan ruang kepada masyarakat lokal untuk menggali potensi guna menghasilkan produk-produk yang berdaya saing dalam peningkatan kesejahteraan secara berkelanjutan.
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item" style="color: black;">
                        <h3 class="text-center">Misi</h3>
                        <div class="container d-flex flex-column justify-content-between align-items-center">
                            <p style="text-align:justify;">
                                Misi dari Dinas Kebudayaan dan Pariwisata Provinsi Sumatera Utara sebagai berikut :
                            </p>
                            <table>
                                <tr>
                                    <td width="10%">1. </td>
                                    <td>Melindungi dan melestarikan nilai budaya dan kekayaan budaya
                                        Yang bermakna meningkatkan kualitas perlindungan, pengembangan dan pemanfaatan bidang kesenian, meningkatkan pelestarian nilai-nilai tradisi dan peningkatan kualitas pelestarian warisan budaya.
                                    </td>
                                </tr>
                                <tr>
                                    <td>2. </td>
                                    <td>Mengembangkan pariwisata menjadi daerah tujuan wisata yang berdaya saing
                                        Yang bermakna pengembangan pariwisata melalui promosi dan pencitraan pariwisata sehingga menghasilkan produk destinasi pariwisata yang berdaya saing dan berbasis sapta pesona / sadar wisata.
                                    </td>
                                </tr>
                                <tr>
                                    <td>3. </td>
                                    <td>Meningkatkan profesionalisme SDM di bidang kebudayaan dan pariwisata\
                                        Yang bermakna peningkatan kapasitas dan profesionalisme melalui pengembangan standar kompetensi dan sertifikasi terhadap profesi pelaku kebudayaan dan pariwisata serta peningkatan kerjasama dan kemitraan / kelembagaan.
                                    </td>
                                </tr>
                                <tr>
                                    <td>4. </td>
                                    <td>Meningkatkan industri kepariwisataan
                                        Yang bermakna penciptaan inovasi melalui penelitian dan pengembangan di sektor pariwisata dan ekonomi kreatif.
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start slider -->
        <!-- End slider -->
    </section>


    <!-- Start Footer -->
    @include('public/footer')
    <!-- End Footer -->


    <!-- Bootstrap -->
    <script src="{{ asset('landing/assets/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Load jQuery require for isotope -->
    <script src="{{ asset('landing/assets/js/jquery.min.js')}}"></script>
    <!-- Isotope -->
    <script src="{{ asset('landing/assets/js/isotope.pkgd.js')}}"></script>
    <!-- Page Script -->
    <script>
        $(window).load(function() {
            // init Isotope
            var $projects = $('.projects').isotope({
                itemSelector: '.project',
                layoutMode: 'fitRows'
            });
            $(".filter-btn").click(function() {
                var data_filter = $(this).attr("data-filter");
                $projects.isotope({
                    filter: data_filter
                });
                $(".filter-btn").removeClass("active");
                $(".filter-btn").removeClass("shadow");
                $(this).addClass("active");
                $(this).addClass("shadow");
                return false;
            });
        });
    </script>
    <!-- Templatemo -->
    <script src="{{ asset('landing/assets/js/templatemo.js')}}"></script>
    <!-- Custom -->
    <script src="{{ asset('landing/assets/js/custom.js')}}"></script>
</body>

</html>