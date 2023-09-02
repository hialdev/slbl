<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Meta --}}
    @yield('seo')
    {{-- Favicon --}}
    <?php $admin_favicon = Voyager::setting('site.favicon', ''); ?>
    @if($admin_favicon == '')
        <link rel="shortcut icon" href="/src/img/logo1.png" type="image/x-icon" sizes="auto">
    @else
        <link rel="shortcut icon" href="{{ Voyager::image($admin_favicon) }}" type="image/x-icon" sizes="auto">
    @endif
    
    <!-- Animate on Scroll -->
    <link rel="stylesheet" href="/lib/aos/dist/aos.css" />
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="/lib/bootstrap/dist/bootstrap.min.css">
    <!-- Owl Carousel 2 -->
    <link rel="stylesheet" href="/lib/owlcarousel/dist/owl.carousel.min.css">
    <link rel="stylesheet" href="/lib/owlcarousel/dist/owl.theme.min.css">

    <!-- Internal CSS -->
    <link rel="stylesheet" href="/src/css/style.css">

    @yield('inhead')
</head>
<body>
    @include('partials.header')
    <main>

        {{-- Contact Modal --}}
        @include('modals.contact')

        @yield('content')
        
    </main>
    @include('partials.footer')
    

    <!-- Jquery -->
    <script src="/lib/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 5 -->
    <script src="/lib/bootstrap/dist/bootstrap.bundle.min.js"></script>
    <!-- Owl Carousel 2 -->
    <script src="/lib/owlcarousel/dist/owl.js"></script>
    <!-- Iconify -->
    <script src="/lib/iconify/dist/iconify.min.js"></script>
    <!-- Animate on Scroll -->
    <script src="/lib/aos/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- Internal JS -->
    <script src="/src/js/carousel.js"></script>
    <script src="/src/js/script.js"></script>

    <script>
        // Mendapatkan elemen-elemen HTML yang diperlukan
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
    
        // Menambahkan event listener untuk mengarahkan ke /search/{inputan} saat tombol "Search" diklik
        searchButton.addEventListener('click', function() {
            const inputValue = searchInput.value.trim(); // Mendapatkan nilai input dan menghapus spasi di awal dan akhir
    
            // Memeriksa apakah nilai input kosong atau tidak
            if (inputValue !== '') {
                window.location.href = `/search/${encodeURIComponent(inputValue)}`;
            }
        });
    </script>
    
    @yield('beforebody')

</body>
</html>