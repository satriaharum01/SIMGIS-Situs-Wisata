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

        tbody > tr > td{
            padding-top: 2em;
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
                <span class="text-light h4"></span> <span class="text-light h4" id="nav-content">{{ucwords($rows->nama)}}</span>
            </a>
        </div>
    </nav>
    <!-- Start Service -->
    <section class="service-wrapper py-3">
        <div class="container">
            <div class="card-body d-flex justify-content-between">
                <div class="card-body text-center" style="margin-top: 5%; width:75%;">
                    <p>
                        <img style="position: relative;" src="{{url('images\situs')}}\{{$image}}"></img>
                    </p>
                
                </div>
                <table id="data-unit" width="100%" style="height:fit-content;">
                    <tbody class="table" style="text-align:center;">
                        <tr>
                            <td width="30%"></td>
                            <td width="10%"></td>
                            <td class="text-left ">
                                <h2>{{$rows->nama}}</h2>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right"><b>Alamat</b></td>
                            <td width="10%"></td>
                            <td class="text-left">{{$rows->alamat}}</td>
                        </tr>
                        <tr>
                            <td class="text-right"><b>Latidude</b> </td>
                            <td width="10%"></td>
                            <td class="text-left">{{$rows->lat}}</td>
                        </tr>
                        <tr>
                            <td class="text-right"><b>Longitude</b> </td>
                            <td width="10%"></td>
                            <td class="text-left">{{$rows->long}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
                <p style="text-align:left;"><b>Deskripsi</b></p>
                <p style="text-align:justify;">{{$rows->deskripsi}}</p>
            </div>
    </section>
    <section class="service-wrapper py-3">
        <div class="container-fluid">
            <div class="map-box">
                <div class="mapouter">
                    <div class="gmap_canvas" id="map">
                        <br>
                    </div>
                </div>
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
        window.LRM = {
            tileLayerUrl: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
            osmServiceUrl: 'https://routing.openstreetmap.de/routed-car/route/v1',
            orsServiceUrl: 'https://api.openrouteservice.org/geocode/',
            apiToken: '5b3ce3597851110001cf6248ff41dc332def43858dff1ecccdd19bbc'
        };
        var map = L.map('map').setView([3.586506, 98.735657], 15);
        L.tileLayer(LRM.tileLayerUrl, {
            attribution: 'Maps and routes from <a href="https://www.openstreetmap.org">OpenStreetMap</a>. ' +
                'data uses <a href="http://opendatacommons.org/licenses/odbl/">ODbL</a> license'
        }).addTo(map);

        var markers = L.markerClusterGroup();
        var firstpolyline;
    </script>
    <script>
        var globaid = <?= $id_article ?>;
        $(function() {
            clearMap();
            newPin(globaid);
            map.addLayer(markers);
        })

        function clearMap() {
            map.removeLayer(markers);
        }

        function newPin(id) {
            markers = new L.markerClusterGroup({
                disableClusteringAtZoom: 5,
                maxClusterRadius: 100,
                animateAddingMarkers: true
            });
            $.ajax({
                url: "{{ url('/welcome/peta/get/') }}/" + id,
                type: "GET",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    console.log(dataResult);
                    var row = dataResult;
                    var marker = L.marker([row.lat, row.long]);
                    marker.bindPopup('<span>' + row.nama + '<br> <img src="{{url("images/situs")}}/' + row.foto + '" width="200px" style="position:relative;z-index:1;" alt=""></span>').openPopup();;
                    map.panTo(new L.LatLng(row.lat, row.long));
                    //Add Marker
                    markers.addLayer(marker);
                }
            });

        }
    </script>
</body>

</html>