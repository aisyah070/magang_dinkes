{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg py-3 fixed-top shadow">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/icons/logo_dinkes.png') }}"  height="55" width="43"  alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ ($title === "Beranda") ? 'active' : '' }}" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($title === "Foto") ? 'active' : '' }}" href="/foto-dokumentasi-rapat-online">Foto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($title === "Video") ? 'active' : '' }}" href="/video-rekaman-rapat-online">Video</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($title === "Modul") ? 'active' : '' }}" href="/modul-rapat-online">Modul</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($title === "Profil") ? 'active' : '' }}" href="/profil-karyawan">Profil Pegawai</a>
                </li>
            </ul>
    
            <!-- Search button (icon) -->
            <i class="ri-search-line nav__search" id="search-btn"></i> 

            <!-- Button Log Out -->
            <div class="d-flex">
                <form action="/logout" method="post">
                    @csrf
                <button type="submit" class="btn btn-danger">Log Out</button>
                </form>
            </div>

        </div>
    </div>
</nav>
