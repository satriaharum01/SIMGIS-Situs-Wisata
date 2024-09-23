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
                <i class='bx bx-map-alt bx-sm text-light'></i>
                <span class="text-light h4">Peta</span> <span class="text-light h4">Situs Wisata</span>
            </a>
            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="navbar-toggler-success">
                <div class="flex-fill mb-2">
                    <ul class="nav navbar-nav d-flex justify-content-center mx-xl-5 text-center text-dark">
                        <li class="nav-item">
                            <a class="nav-link px-3 text-light" href="#">Titik Awal</a>
                        </li>
                        <li class="nav-item">
                            <select class="nav-link btn-outline-primary rounded-pill px-3" name="titik_awal" id="titik_awal" onchange="changeAwal()">
                                <option value="0" selected disabled>--- Pilih Titik Awal ---</option>
                            </select>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light px-3" href="#">Tujuan</a>
                        </li>
                        <li class="nav-item">
                            <select class="nav-link btn-outline-primary rounded-pill px-3" name="tujuan" id="tujuan" onchange="changeTujuan()">
                                <option value="0" selected disabled>--- Pilih Tujuan ---</option>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Start Service -->
    <section class="service-wrapper py-3">
        <div class="container-fluid">
            <!-- Disabled Content ->
            <div class="row">
                <h2 class="h2 text-center col-12 py-5 semi-bold-600">Cari Rute Wisata</h2>
                <div class="service-header col-2 col-lg-3 text-end light-300">
                    <i class='bx bx-gift h3 mt-1'></i>
                </div>
                <div class="service-heading col-10 col-lg-9 text-start float-end light-300">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <h2 class="h3 pb-4 typo-space-line ">Titik Asal </h2>
                                </td>
                                <td>
                                    <h2 class="h3 pb-4"> : </h2>
                                </td>
                                <td>
                                    <h2 class="h3 pb-4 ">
                                        <select name="titik_awal" id="titik_awal" onchange="changeAwal()">
                                            <option value="0" selected disabled>--- Pilih Titik Awal ---</option>
                                        </select>
                                    </h2>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h2 class="h3 pb-4 typo-space-line ">Titik Tujuan </h2>
                                </td>
                                <td>
                                    <h2 class="h3 pb-4 "> : </h2>
                                </td>
                                <td>
                                    <h2 class="h3 pb-4">
                                        <select name="tujuan" id="tujuan" onchange="changeTujuan()">
                                            <option value="0" selected disabled>--- Pilih Tujuan ---</option>
                                        </select>
                                    </h2>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <-- Disabled Content -->
            <div class="map-box">
                <div class="mapouter">
                    <div class="gmap_canvas" id="map">
                        <br>
                    </div>
                </div>
            </div>
        </div>

        <div id="nav-bar" class="service-tag py-5 bg-secondary mt-5">
            <div class="col-md-12">
                <ul class="nav d-flex justify-content-center">
                    <li class="nav-item mx-lg-4">
                        <a class="filter-btn nav-link btn-outline-primary active shadow rounded-pill text-light px-4 light-300" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active">Navigasi</a>
                    </li>
                    <li class="nav-item mx-lg-4">
                        <a class="filter-btn nav-link btn-outline-primary rounded-pill text-light px-4 light-300" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1">Wisata Disekitar</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Start slider -->
        <div id="carouselExampleIndicators" class="carousel slide col-md-10 mx-auto mt-5" data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="#" alt="">
                    <div class="py-5 row d-flex align-items-center">
                        <div class="banner-content col-lg-8 col-8 offset-2 m-lg-auto text-left py-5 pb-5">
                            <h1 class="banner-heading h1 text-secondary display-3 mb-0 pb-5 mx-0 px-0 light-300 typo-space-line">
                                Navigasi <strong>Tujuan</strong>
                            </h1>
                            <p class="banner-body text-muted py-3 mx-0 px-0 jalan">

                            </p>
                            <p class="banner-body text-muted py-3 mx-0 px-0 jarak">
                                Total Jarak :
                            </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="#" alt="">
                    <div class="py-5 row d-flex align-items-center">
                        <div class="banner-content col-lg-8 col-8 offset-2 m-lg-auto text-left py-5 pb-5">
                            <h1 class="banner-heading h1 text-secondary display-3 mb-0 pb-3 mx-0 px-0 light-300">
                                Wisata Disekitar
                            </h1>
                            <p class="banner-body text-muted py-3 wisata-sekitar">
                                wisata 1 wisata 2
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script>
        var sekitar = L.icon({
            iconUrl: "{{ asset('icon/marker_red.png') }}",
            shadowUrl: "{{ asset('icon/marker_shadow.png') }}",
            iconSize: [25, 41], // size of the icon
            shadowSize: [40, 76], // size of the shadow
            iconAnchor: [12, 41], // point of the icon which will correspond to marker's location
            shadowAnchor: [10, 76], // the same for the shadow
            popupAnchor: [1, -35] // point from which the popup should open relative to the iconAnchor
        });
        window.LRM = {
            tileLayerUrl: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
            osmServiceUrl: 'https://routing.openstreetmap.de/routed-car/route/v1',
            orsServiceUrl: 'https://api.openrouteservice.org/geocode/',
            apiToken: '5b3ce3597851110001cf6248ff41dc332def43858dff1ecccdd19bbc'
        };
        var map = L.map('map').setView([3.586506, 98.735657], 10);
        L.tileLayer(LRM.tileLayerUrl, {
            attribution: 'Maps and routes from <a href="https://www.openstreetmap.org">OpenStreetMap</a>. ' +
                'data uses <a href="http://opendatacommons.org/licenses/odbl/">ODbL</a> license'
        }).addTo(map);

        var markers = L.markerClusterGroup();
        var firstpolyline;
    </script>
    <script>
        $(function() {
            //Hiding nav-bar-bottom
            $('#nav-bar').toggle(false);
            $('#carouselExampleIndicators').toggle(false);

            $.ajax({
                url: "{{ url('/welcome/situs/titik_awal')}}",
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult);
                    var resultData = dataResult.data;
                    $.each(resultData, function(index, row) {
                        $('#titik_awal').append('<option value="' + row.id_wisata + '">' + row.nama + '</option>');
                    })
                }
            });
        })

        function clearMap() {
            map.removeLayer(markers);
        }

        function newPin(e) {
            markers = new L.markerClusterGroup({
                disableClusteringAtZoom: 5,
                maxClusterRadius: 100,
                animateAddingMarkers: true
            });
            $.ajax({
                url: "{{ url('/welcome/situs/get/') }}/" + e,
                type: "GET",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult);
                    var resultData = dataResult;
                    $.each(resultData, function(index, row) {
                        var marker = L.marker([row.lat, row.long]);
                        marker.bindPopup('<span>' + row.nama + '<br> <img src="{{url("images/situs")}}/' + row.foto + '" width="200px" style="position:relative;z-index:1;" alt=""></span>').openPopup();;

                        //Add Marker
                        markers.addLayer(marker);
                    })
                }
            });

        }

        function getLokNias() {
            $.ajax({
                url: "{{ url('/welcome/situs/tujuan/nias')}}",
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult);
                    var resultData = dataResult.data;
                    $.each(resultData, function(index, row) {
                        $('#tujuan').append('<option value="' + row.id_wisata + '">' + row.nama + '</option>');
                    })
                }
            });
        }

        function getLokOther() {
            $.ajax({
                url: "{{ url('/welcome/situs/tujuan/other')}}",
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult);
                    var resultData = dataResult.data;
                    $.each(resultData, function(index, row) {
                        $('#tujuan').append('<option value="' + row.id_wisata + '">' + row.nama + '</option>');
                    })
                }
            });
        }

        function getTujuan(e) {
            var id = $('#titik_awal option:selected').val();
            $('#tujuan').children().remove().end();
            $('#tujuan').append('<option value="0" disabled selected>---- Pilih Tujuan -----</option>');
            $.ajax({
                url: "{{ url('/welcome/situs/get')}}/" + id,
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult);
                    var resultData = dataResult;
                    $.each(resultData, function(index, row) {
                        map.panTo(new L.LatLng(row.lat, row.long));
                        if (row.lokasi === 'Other') {
                            getLokOther();
                        } else {
                            getLokNias();
                        }
                    })
                }
            });

            $('#nav-bar').toggle(true);
            $('#carouselExampleIndicators').toggle(true);
        }

        function changeAwal() {
            var val = $('#tujuan option:selected').val();
            var id = $('#titik_awal option:selected').val();
            getTujuan(id);
            clearMap();
            if (val === null) {
                newPin(id);
                map.addLayer(markers);
            } else {
                newPin(id);
                newPin(val);
                map.addLayer(markers);
            }
        };

        function changeTujuan() {
            var val = $('#titik_awal option:selected').val();
            var id = $('#tujuan option:selected').val();;
            clearMap();
            if (val === 0) {
                newPin(id);
                map.addLayer(markers);
            } else {
                newPin(id);
                newPin(val);
                getGraf()
                map.addLayer(markers);
            }
        };

        function getGraf() {
            markers = new L.markerClusterGroup({
                disableClusteringAtZoom: 5,
                maxClusterRadius: 100,
                animateAddingMarkers: true
            });

            if (firstpolyline != null) {
                map.removeLayer(firstpolyline);
            }
            const pointlist = [];
            const jalan = [];
            var val = $('#titik_awal option:selected').val();
            var id = $('#tujuan option:selected').val();
            $.ajax({
                url: "{{ url('welcome/getgraf/')}}/" + id,
                type: "GET",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult);
                    var jarak = dataResult.jarak;
                    var resultData = dataResult.data;
                    var i = 1;
                    $.each(resultData, function(index, row) {
                        var dist = new L.LatLng(row.lat, row.long);
                        //alert(row.path);
                        pointlist.push(dist);
                        jalan.push(row.nama_jalan);
                        if (i === resultData.length) {} else {
                            jalan.push(' >> ');
                        }
                        i++;
                    })

                    $(".jalan").html(jalan);
                    $(".jarak").html('Total Jarak : ' + jarak.toFixed(2) + ' KM');
                    console.log(pointlist);

                    firstpolyline = new L.Polyline(pointlist, {
                        color: "red",
                        weight: 3,
                        opacity: 1,
                        smoothFactor: 1
                    });
                    firstpolyline.addTo(map);
                }
            });

            $.ajax({
                url: "{{ url('welcome/rute/wisata')}}/" + id,
                type: "GET",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult) {

                    $(".wisata-sekitar").html("");
                    console.log(dataResult);
                    var resultData = dataResult;
                    var i = 1;
                    $.each(resultData, function(index, row) {
                        if (i === resultData.length) {
                            $(".wisata-sekitar").append("Wisata : ");
                            $(".wisata-sekitar").append(row.wisata);
                            $(".wisata-sekitar").append("<br>");
                            $(".wisata-sekitar").append("Jarak : ");
                            $(".wisata-sekitar").append(row.jarak.toFixed(2) + " KM");
                        } else {
                            $(".wisata-sekitar").append("Wisata : " + row.wisata);
                            $(".wisata-sekitar").append("<br>");
                            $(".wisata-sekitar").append("Jarak : ");
                            $(".wisata-sekitar").append(row.jarak.toFixed(2) + " KM");
                            $(".wisata-sekitar").append("<br>");
                        }
                        var marker = L.marker([row.lat, row.long], {
                            icon: sekitar
                        });
                        marker.bindPopup('<span>' + row.wisata + '<br> <img src="{{url("images/situs")}}/' + row.foto + '" width="200px" style="position:relative;z-index:1;" alt=""></span>').openPopup();;

                        //Add Marker
                        markers.addLayer(marker);
                        i++;
                    })
                }
            });
        }
    </script>
</body>

</html>