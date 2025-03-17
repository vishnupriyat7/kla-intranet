@extends('layouts.default')

@section('content')
    <!-- Most Populer News Start -->
    <div class="container-fluid populer-news py-5">
        <div class="container py-5">
            <div class="tab-class mb-4">
                <div class="row g-4">
                    <div class="col-lg-7 col-xl-8">
                        <div class="d-flex flex-column flex-md-row justify-content-md-between border-bottom mb-4">
                            <h1 class="mb-4">What’s New</h1>
                            <ul class="nav nav-pills d-inline-flex text-center">
                                <li class="nav-item mb-3">
                                    <a class="d-flex py-2 bg-light rounded-pill active me-2" data-bs-toggle="pill"
                                        href="#tab-1">
                                        <span class="text-dark" style="width: 100px;">Govt. Order</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-3">
                                    <a class="d-flex py-2 bg-light rounded-pill me-2" data-bs-toggle="pill" href="#tab-2">
                                        <span class="text-dark" style="width: 100px;">Office Order</span>
                                    </a>
                                </li>
                                <li class="nav-item mb-3">
                                    <a class="d-flex py-2 bg-light rounded-pill me-2" data-bs-toggle="pill" href="#tab-3">
                                        <span class="text-dark" style="width: 100px;">Circular</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="tab-content mb-4">
                            <div id="tab-1" class="tab-pane fade show p-0 active">
                                <div class="row g-4">
                                    <div class="col-lg-10">
                                        <div class="features-content d-flex flex-column">
                                            <h4 class="text-uppercase mb-3">Government Orders</h4>
                                            {{-- <a href="#" class="h6">Get the best speak market,
                                                    news.</a>
                                                <small class="text-body d-block"><i
                                                        class="fas fa-calendar-alt me-1"></i> Dec 9,
                                                    2024</small> --}}
                                            @foreach ($gos as $go)
                                                <div class="mb-4">
                                                    <small>
                                                        <i class="bi bi-link"></i>
                                                        <a href="{{ asset('storage/' . $go->path) }}" class="h6"
                                                            target="_blank">
                                                            <i class="fas fa-solid fa-paperclip me-1"></i>
                                                            {{ $go->title }}
                                                        </a>
                                                        </br>
                                                        <i class="fas fa-calendar-alt me-1"></i>
                                                        {{ \Carbon\Carbon::parse($go->date)->format('M d Y') }}
                                                    </small>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane fade show p-0">
                                <div class="row g-4">
                                    <div class="col-lg-12">

                                        <div class="features-content d-flex flex-column">
                                            <h4 class="text-uppercase mb-2">Office Orders</h4>
                                            {{-- <a href="#" class="h6">Get the best speak market,
                                                    news.</a>
                                                <small class="text-body d-block"><i
                                                        class="fas fa-calendar-alt me-1"></i> Dec 9,
                                                    2024</small> --}}
                                            @foreach ($oos as $oo)
                                                <div class="mb-4">
                                                    <small>
                                                        <i class="bi bi-link"></i>
                                                        <a href="{{ asset('storage/' . $oo->path) }}" class="h6"
                                                            target="_blank">
                                                            <i class="fas fa-solid fa-paperclip me-1"></i>
                                                            {{ $oo->title }}
                                                        </a>
                                                        </br>
                                                        {{ \Carbon\Carbon::parse($oo->date)->format('M d Y') }}
                                                    </small>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div id="tab-3" class="tab-pane fade show p-0">
                                <div class="row g-4">
                                    <div class="col-12">
                                        <div class="features-content d-flex flex-column">
                                            <h4 class="text-uppercase mb-2">Circulars</h4>
                                            {{-- <a href="#" class="h6">Get the best speak market,
                                                news.</a>
                                            <small class="text-body d-block"><i
                                                    class="fas fa-calendar-alt me-1"></i> Dec 9,
                                                2024</small> --}}
                                            @foreach ($crcls as $crclr)
                                                <div class="mb-4">
                                                    <small>
                                                        <i class="bi bi-link"></i>
                                                        <a href="{{ asset('storage/' . $crclr->path) }}" class="h6"
                                                            target="_blank">
                                                            {{-- <i class="fas fa-solid fa-paperclip me-1"></i> --}}
                                                            {{ $crclr->title }}
                                                        </a>
                                                        </br>
                                                        <i class="fas fa-calendar-alt me-1"></i>
                                                        {{ \Carbon\Carbon::parse($crclr->date)->format('M d Y') }}
                                                    </small>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-md-row justify-content-md-between border-bottom mb-4">
                            <h1 class="mb-4">Rescent News</h1>

                        </div>
                        <div class="tab-content mb-4">
                            <div id="tab-1" class="tab-pane fade show p-0 active">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="row g-4">
                                            @foreach ($newsupdates as $news)
                                                <div class="features-content d-flex flex-column">
                                                    <a href="{{ asset('storage/' . $news->path) }}" class="h6"
                                                        target="_blank"><i class="fas fa-comment-dots me-1"></i>
                                                        {{ $news->title }}
                                                    </a>
                                                    <small class="text-body d-block"><i
                                                            class="fas fa-calendar-alt me-1"></i>
                                                        {{ \Carbon\Carbon::parse($news->date)->format('M d Y') }}</small>
                                                </div>
                                            @endforeach
                                            <div class="col-lg-12">
                                                <a href="{{ route('updatesmore') }}"
                                                    class="link-hover btn border border-primary rounded-pill text-dark w-100 py-3 mb-4">View
                                                    More</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        {{-- <div class="border-bottom mb-4">
                            <h2 class="my-4">Most Views News</h2>
                        </div> --}}

                    </div>
                    <div class="col-lg-5 col-xl-4">
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="p-3 rounded border">


                                    <div id="calendar"></div>

                                    <h4 class="my-4">Periodicals</h4>
                                    <div class="row g-4">
                                        <div class="col-12">
                                            {{-- <div class="p-3 rounded border"> --}}
                                            {{-- <h4 class="mb-4">Periodicals</h4> --}}
                                            <div class="row g-2">
                                                @foreach ($periodicals as $periodical)
                                                    <div class="col-12">
                                                        <a href="{{ asset('storage/' . $periodical->path) }}"
                                                            target="_blank"
                                                            class="link-hover btn btn-light w-100 rounded text-uppercase text-dark py-3">
                                                            {{ $periodical->periodicalMaster->name ?? 'N/A' }}
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                            {{-- </div> --}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Most Populer News End -->




    <!-- Single Product End -->
@endsection
