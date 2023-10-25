<!DOCTYPE html>
<html lang="en">

<head>
    <title>ADARO ENERGY</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/adaro.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="site-wrap">
        <div class="site-navbar py-2">
            <div class="search-wrap">
                <div class="container">
                    <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
                    <form action="#" method="post">
                        <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
                    </form>
                </div>
            </div>

            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="logo">
                        <div class="site-logo">
                            <img src="{{ asset('images/adaroenergy.png') }}" alt="Image" width="150">
                        </div>
                    </div>
                    <div class="main-nav d-none d-lg-block">
                        <nav class="site-navigation text-right text-md-center" role="navigation">
                            <ul class="site-menu js-clone-nav d-none d-lg-block">
                                <li class="active"><a href="index.html">Home</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-blocks-cover" style="background-image: url('../images/hero_1.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mx-auto order-lg-2 align-self-center">
                        <div class="site-block-cover-content text-center">
                            <h2 class="sub-title">Effective Medicine, New Medicine Everyday</h2>
                            <h1>Welcome To Pharma</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <div class="row align-items-stretch section-overlap">
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="banner-wrap bg-primary h-100">
                            <a href="#" class="h-100">
                                <h5>Free <br> Shipping</h5>
                                <p>
                                    Amet sit amet dolor
                                    <strong>Lorem, ipsum dolor sit amet consectetur adipisicing.</strong>
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="banner-wrap h-100">
                            <a href="#" class="h-100">
                                <h5>Season <br> Sale 50% Off</h5>
                                <p>
                                    Amet sit amet dolor
                                    <strong>Lorem, ipsum dolor sit amet consectetur adipisicing.</strong>
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="banner-wrap bg-warning h-100">
                            <a href="#" class="h-100">
                                <h5>Buy <br> A Gift Card</h5>
                                <p>
                                    Amet sit amet dolor
                                    <strong>Lorem, ipsum dolor sit amet consectetur adipisicing.</strong>
                                </p>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="title-section text-center col-12">
                        <h2 class="text-uppercase">Daftar Obat</h2>
                    </div>
                    <form action="#" method="post" id="search-form">
                        <div class="form-group">
                            <input type="text" class="form-control" id="search-input" placeholder="Cari obat...">
                        </div>
                    </form>
                </div>
            </div>

            <div class="container">
                <div class="search-wrap">
                    <form action="#" method="post" id="search-form">
                        <div class="form-group">
                            <input type="text" class="form-control" id="search-input" placeholder="Cari obat...">
                        </div>
                    </form>
                </div>
            </div>

            <div class="container">
                <div id="search-results" class="row"></div>
            </div>

            <div class="container">
                <div class="row">
                    @foreach ($assets as $asset)
                        @php
                            $stock = $stocks->where('asset_id', $asset->id)->first();
                        @endphp
                        <div class="col-sm-6 col-lg-4 text-center item mb-4">
                            <div class="card">
                                <div class="card-body">
                                    @if ($asset->image_path)
                                        <a href="shop-single.html">
                                            <img src="{{ asset($asset->image_path) }}" alt="Image" width="250"
                                                height="250">
                                        </a>
                                    @else
                                        <a href="shop-single.html">
                                            Gambar Tidak Tersedia
                                        </a>
                                    @endif
                                    <h3 class="text-dark"><a href="shop-single.html">{{ $asset->name ?? '' }}</a>
                                    </h3>
                                    <p class="price">
                                        @if ($stock)
                                            Stok Tersedia: {{ $stock->current_stock }}
                                        @else
                                            Stok Tidak Tersedia
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <style>
                /* Atur tinggi dan lebar elemen 'item' sesuai kebutuhan Anda */
                .item {
                    height: 300px;
                    /* Sesuaikan dengan tinggi yang Anda inginkan */
                    width: 250px;
                    /* Sesuaikan dengan lebar yang Anda inginkan */
                }
            </style>


        </div>

        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">

                        <div class="block-7">
                            <h3 class="footer-heading mb-4">About Us</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quae reiciendis distinctio
                                voluptates
                                sed dolorum excepturi iure eaque, aut unde.</p>
                        </div>

                    </div>
                    <div class="col-lg-3 mx-auto mb-5 mb-lg-0">
                        <h3 class="footer-heading mb-4">Quick Links</h3>
                        <ul class="list-unstyled">
                            <li><a href="#">Supplements</a></li>
                            <li><a href="#">Vitamins</a></li>
                            <li><a href="#">Diet &amp; Nutrition</a></li>
                            <li><a href="#">Tea &amp; Coffee</a></li>
                        </ul>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="block-5 mb-5">
                            <h3 class="footer-heading mb-4">Contact Info</h3>
                            <ul class="list-unstyled">
                                <li class="address">203 Fake St. Mountain View, San Francisco, California, USA</li>
                                <li class="phone"><a href="tel://23923929210">+2 392 3929 210</a></li>
                                <li class="email">emailaddress@domain.com</li>
                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/main2.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchForm = document.getElementById("search-form");
            const searchInput = document.getElementById("search-input");
            const searchResults = document.getElementById("search-results");
            const assets = @json($assets); // Data aset
            const stocks = @json($stocks); // Data stok

            searchForm.addEventListener("submit", function(event) {
                event.preventDefault(); // Mencegah form submit

                const searchTerm = searchInput.value.trim().toLowerCase();
                const filteredAssets = assets.filter(asset => asset.name.toLowerCase().includes(
                    searchTerm));

                displaySearchResults(filteredAssets);
            });

            function displaySearchResults(results) {
                searchResults.innerHTML = ""; // Mengosongkan hasil pencarian sebelum menampilkan hasil baru

                if (results.length === 0) {
                    searchResults.innerHTML = "<p>No results found</p>";
                } else {
                    results.forEach(asset => {
                        const stock = stocks.find(stock => stock.asset_id === asset.id);
                        const item = document.createElement("div");
                        item.className = "col-sm-6 col-lg-4 text-center item mb-4";
                        item.innerHTML = `
                            <a href="shop-single.html">
                                <img src="${asset.image_path}" alt="Image" width="300">
                            </a>
                            <h3 class="text-dark"><a href="shop-single.html">${asset.name}</a></h3>
                            <p class="price">
                                Stok ${stock ? `Tersedia: ${stock.current_stock}` : 'Tidak Tersedia'}
                            </p>
                        `;
                        searchResults.appendChild(item);
                    });
                }
            }
        });
    </script>




</body>

</html>
