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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Font CSS -->
    <link href="{{ asset('landing/assets/css/boxicon.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Load Tempalte CSS -->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/templatemo.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('landing/assets/css/custom.css') }}">
    <style>
        #prev {
            display: inline-block;
            position: relative;
            left: 8%;
        }

        #next {
            display: inline-block;
            position: relative;
            right: 8%;
        }

        .badge.ribbon {
            background-color: #2AC11D;
            border-radius: 0;
            box-shadow: 5px 5px 9px rgb(0, 0, 0, .5);
            left: -1rem;
            letter-spacing: .075rem;
            line-height: 2.1rem;
            padding: 0 1rem 0 1.2rem;
            position: absolute;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, .3);
            text-transform: uppercase;
            text-decoration: none;
            top: 1.2rem;
            z-index: 10;
        }

        .badge.ribbon:hover {
            color: #c2ffbc;
        }

        .badge.ribbon::before {
            border-top: 15px solid #747474;
            border-left: 16px solid transparent;
            content: '';
            left: 0;
            position: absolute;
            top: 2.1rem;
        }

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
            position: relative;
            width: 100%;
            max-width: 100%;
            height: auto;
            z-index: -1;
        }

        tr>td {
            vertical-align: top;
            text-align: justify;
        }

        .card-img-top {
            width: inherit;
            height: 250px;
            z-index: 1;
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
                <i class='bx bx-building bx-sm text-light'></i>
                <span class="text-light h4"></span><span class="text-light h4">Situs Wisata</span>
            </a>
        </div>
    </nav>
    <!-- Start Service -->
    <section class="service-wrapper d-flex flex-row py-3">
        <button type="button" id="prev" class="btn-outline-info rounded-pill ">
            <i class='bx bx-left-arrow text-dark'></i></button>
        <div class="container d-flex justify-content-between align-items-center" style="width: 75%;">
            <div class="align-self-center overflow-hidden" id="menu">
                <div class="mb-2" style="width: 150%;">
                    <ul class="nav navbar-nav d-flex flex-row flex-nowrap justify-content-center mx-xl-5 text-center text-dark">
                        <li class="nav-item">
                            <a class="filter-btn nav-link btn-outline-primary  active shadow rounded-pill text-light px-4 light-300 text-dark" data-id="all">Semua Kategori</a>
                        </li>
                        <li class="nav-item mx-lg-4">
                            <a class="filter-btn nav-link btn-outline-primary text-dark rounded-pill text-light px-4 light-300" data-id="Bebatuan">Bebatuan</a>
                        </li>
                        <li class="nav-item mx-lg-4">
                            <a class="filter-btn nav-link btn-outline-primary text-dark rounded-pill text-light px-4 light-300" data-id="Benteng">Benteng</a>
                        </li>
                        <li class="nav-item mx-lg-4">
                            <a class="filter-btn nav-link btn-outline-primary text-dark rounded-pill text-light px-4 light-300" data-id="Candi">Candi</a>
                        </li>
                        <li class="nav-item mx-lg-4">
                            <a class="filter-btn nav-link btn-outline-primary text-dark rounded-pill text-light px-4 light-300" data-id="Candi">Goa</a>
                        </li>
                        <li class="nav-item mx-lg-4">
                            <a class="filter-btn nav-link btn-outline-primary text-dark rounded-pill text-light px-4 light-300" data-id="Istana">Istana</a>
                        </li>
                        <li class="nav-item mx-lg-4">
                            <a class="filter-btn nav-link btn-outline-primary text-dark rounded-pill text-light px-4 light-300" data-id="Makam">Makam</a>
                        </li>
                        <li class="nav-item mx-lg-4">
                            <a class="filter-btn nav-link btn-outline-primary text-dark rounded-pill text-light px-4 light-300" data-id="Museum">Museum</a>
                        </li>
                        <li class="nav-item mx-lg-4">
                            <a class="filter-btn nav-link btn-outline-primary text-dark rounded-pill text-light px-4 light-300" data-id="Prasasti">Prasasti</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <button type="button" id="next" class="btn-outline-info rounded-pill text-dark"><i class='bx bx-right-arrow text-dark'></i></button>
        <!-- Start slider -->
        <!-- End slider -->
    </section>
    <section class="service-wrapper py-3">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3" id="content_wisata">
            </div>
            <div class="py-3 text-center">
                <button type="button" class="btn btn-primary btn-load">Load More
                    <i class="fas fa-plus-circle"></i>
                </button>
            </div>
        </div>
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
        var loadmore = 1;

        $(window).load(function() {
            // init Isotope
            var $projects = $('.projects').isotope({
                itemSelector: '.project',
                layoutMode: 'fitRows'
            });
            $(".filter-btn").click(function() {
                var id = jQuery(this).attr("data-id");
                if (id === "all") {
                    wisata_all();
                    var data_filter = $(this).attr("data-filter");
                    $projects.isotope({
                        filter: data_filter
                    });
                    $(".filter-btn").removeClass("active");
                    $(".filter-btn").removeClass("shadow");
                    $(this).addClass("active");
                    $('.btn-load').prop("hidden",false);
                    $(this).addClass("shadow");
                    return false;
                } else {
                    wisata(id);
                    var data_filter = $(this).attr("data-filter");
                    $projects.isotope({
                        filter: data_filter
                    });
                    $('.btn-load').prop("hidden",true);
                    $(".filter-btn").removeClass("active");
                    $(".filter-btn").removeClass("shadow");
                    $(this).addClass("active");
                    $(this).addClass("shadow");
                    return false;
                }
            });
        });

        $(function() {
            wisata_all();
        })

        $('#prev').on('click', function() {
            //alert('function run !');
            $('#menu').animate({
                scrollLeft: '-=100'
            }, 300, 'swing');
        });

        $('#next').on('click', function() {
            //alert('function run !');
            $('#menu').animate({
                scrollLeft: '+=100'
            }, 300, 'swing');
        });

        function wisata_all() {
            $('#content_wisata').html("");
            $.ajax({
                url: "{{ url('/welcome/wisata/all')}}",
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult);
                    var resultData = dataResult;
                    $.each(resultData, function(index, row) {
                        //alert(row.to_html);
                        $('#content_wisata').append(row.to_html);
                    })
                }
            });
        }

        function wisata(id) {
            $('#content_wisata').html("");
            $.ajax({
                url: "{{ url('/welcome/wisata/get')}}/" + id,
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult);
                    var resultData = dataResult;
                    $.each(resultData, function(index, row) {
                        //alert(row.to_html);
                        $('#content_wisata').append(row.to_html);
                    })
                }
            });
        }

        function load_more_all() {
            $('#content_wisata').html("");
            $.ajax({
                url: "{{ url('/welcome/wisata/all/get')}}/" + loadmore,
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult);
                    var resultData = dataResult;
                    $.each(resultData, function(index, row) {
                        //alert(row.to_html);
                        $('#content_wisata').append(row.to_html);
                    })
                }
            });
        }

        $("body").on("click", ".btn-load", function() {
            loadmore = loadmore + 1;
            load_more_all();
        });
    </script>
    <!-- Templatemo -->
    <script src="{{ asset('landing/assets/js/templatemo.js')}}"></script>
    <!-- Custom -->
    <script src="{{ asset('landing/assets/js/custom.js')}}"></script>
</body>

</html>