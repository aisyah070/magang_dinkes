@extends('layoutsstaf.layouts')

@section('content')
    {{-- VIDEO --}}
    <section id="video_youtube" style="margin-top: 50px" class="py-5">
        <div class="container py-5" data-aos="fade-down">
            <div class="header-berita text-center">
                <h2 class="fw-bold">Video Rekaman Rapat Online</h2>
            </div>

            <div class="row py-5">
                @foreach ($data as $video)
                    <div class="kotak-video col-lg-4 mb-3">
                        <div class="card box-video">
                            @if (!empty($video->iframe_video))
                                <iframe width="100%" height="215" 
                                    src="{{ $video->iframe_video }}" 
                                    title="YouTube video player" 
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" 
                                    allowfullscreen>
                                </iframe>
                            @elseif (!empty($video->file_video))
                                <video width="100%" height="215" controls>
                                    <source src="/video/lihat/{{ $video->id }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif

                            <div class="card-body judul-video">
                                <h6 class="card-title">{{ $video->judul }}</h6>
                                <p class="card-text">{{ $video->deskripsi }}</p>
                                <p class="card-text">
                                    <small class="text-body-secondary">
                                        {{ $video->updated_at->format('d M Y') }}
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
