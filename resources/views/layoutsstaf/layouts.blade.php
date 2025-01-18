<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--=============== ICON WEB ===============-->
    <link rel="shortcut icon" href="{{ asset('assets/icons/logo_dinkes.ico') }}">
    <!--=============== BOOTSTRAP ===============-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--=============== AOS CSS ===============-->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!--=============== MAGNIFIC POPUP CSS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!--=============== ICON UNTUK DOKUMEN DARI FONT AWESOME ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!--=============== REMIXICONS (ICON SEARCH )===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">


    <title>Sistem Arsip Rapat Online KKG</title>
</head>
<body>
    {{-- NAVBAR --}}
    @include('layoutsstaf.navbar')
    
    {{-- CONTENT --}}
    @yield('content')

    
    <!--==================== SEARCH FORM ====================-->
    <div class="search" id="search">
        <form action="/cari" class="search__form" method="GET" >
        <i class="ri-search-line search__icon"></i>
            <input type="search" placeholder="Apa yang ingin kamu cari?" class="search__input" name="query">
            <button type="submit" style="display: none;">search</button>
        </form>

        <i class="ri-close-line search__close" id="search-close"></i>
    </div>



    <!--=============== BOOTSTRAP JS ===============-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!--=============== AOS JS ===============-->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!--=============== jQuery 1.7.2+ or Zepto.js 1.0+ ===============-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--=============== MAGNIFIC IMAGE JS ===============-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    
    <script>

        /*=============== JS MAGNIFIC POPUP IMAGE ===============*/
        $(document).ready(function() {
            $('.image-link').magnificPopup({
                type: 'image',  // Tipe konten yang akan ditampilkan
                gallery: {
                    enabled: true  // Mengaktifkan galeri jika ada beberapa gambar
                }
            });
        });
        

        /*=============== SEARCH ===============*/
        const search = document.getElementById('search'),
        searchBtn = document.getElementById('search-btn'),
        searchClose = document.getElementById('search-close')

        /* Search show */
        searchBtn.addEventListener('click', () =>{
            search.classList.add('show-search')
        })

        /* Search hidden */
        searchClose.addEventListener('click', () =>{
            search.classList.remove('show-search')
        })

        /*=============== TRANSISI MENGGUNAKAN AOS ===============*/
        AOS.init();
        
    </script>    

</body>
</html>