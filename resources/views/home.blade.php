@extends('layouts.default')

@section('content')
    <!-- Single Product Start -->
    <!-- Features Start -->
    <div class="container-fluid features mb-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="row g-4 align-items-center features-item">
                        <div class="col-4">
                            <div class="rounded-circle position-relative">
                                {{-- <div class="overflow-hidden rounded-circle">
                                    <img src="img/features-sports-1.jpg" class="img-zoomin img-fluid rounded-circle w-100"
                                        alt="">
                                </div> --}}
                                <span
                                    class="rounded-circle border border-2 border-white bg-primary btn-sm-square text-white position-absolute"
                                    style="top: 10%; right: -10px;">{{$goCount}}</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="features-content d-flex flex-column">
                                <p class="text-uppercase mb-2">Government Orders</p>
                                @foreach ($gos as $go)
                                    <small>
                                        <i class="bi bi-link"></i>
                                        <a href="{{ asset('storage/' . $go->path)}}" class="h6" target="_blank">
                                            {{-- <i class="fas fa-solid fa-paperclip me-1"></i> --}}
                                            {{ $go->title }}
                                        </a>
                                        </br>
                                        {{-- <i class="fas fa-calendar-alt me-1"></i> --}}
                                        {{ \Carbon\Carbon::parse($go->date)->format('M d Y') }}</small>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="row g-4 align-items-center features-item">
                        <div class="col-4">
                            <div class="rounded-circle position-relative">
                                {{-- <div class="overflow-hidden rounded-circle">
                                    <img src="img/features-technology.jpg" class="img-zoomin img-fluid rounded-circle w-100"
                                        alt="">
                                </div> --}}
                                <span
                                    class="rounded-circle border border-2 border-white bg-primary btn-sm-square text-white position-absolute"
                                    style="top: 10%; right: -10px;">{{$ooCount}}</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="features-content d-flex flex-column">
                                <p class="text-uppercase mb-2">Office Orders</p>
                                @foreach ($oos as $oo)
                                    <small>
                                        <i class="bi bi-link"></i>
                                        <a href="{{ asset('storage/' . $oo->path)}}" class="h6" target="_blank">
                                            {{-- <i class="fas fa-solid fa-paperclip me-1"></i> --}}
                                            {{ $oo->title }}
                                        </a>
                                        </br>
                                        {{ \Carbon\Carbon::parse($oo->date)->format('M d Y') }}
                                    </small>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="row g-4 align-items-center features-item">
                        <div class="col-4">
                            <div class="rounded-circle position-relative">
                                {{-- <div class="overflow-hidden rounded-circle">
                                    <img src="img/features-fashion.jpg" class="img-zoomin img-fluid rounded-circle w-100"
                                        alt="">
                                </div> --}}
                                <span
                                    class="rounded-circle border border-2 border-white bg-primary btn-sm-square text-white position-absolute"
                                    style="top: 10%; right: -10px;">{{$clrCount}}</span>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="features-content d-flex flex-column">
                                <p class="text-uppercase mb-2">Ciculars</p>
                                @foreach ($crcls as $crclr)
                                    <small>
                                        <i class="bi bi-link"></i>
                                        <a href="{{ asset('storage/' . $crclr->path)}}" class="h6" target="_blank">
                                            {{-- <i class="fas fa-solid fa-paperclip me-1"></i> --}}
                                            {{ $crclr->title }}
                                        </a>
                                        </br>
                                        {{-- <i class="fas fa-calendar-alt me-1"></i> --}}
                                        {{ \Carbon\Carbon::parse($crclr->date)->format('M d Y') }}
                                    </small>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->

    <div class="container-fluid py-5">
        <div class="container py-5">
            {{-- <ol class="breadcrumb justify-content-start mb-4">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-dark">Single Page</li>
            </ol> --}}
            <div class="row g-4">

                <div class="col-lg-8">
                    <div class="row g-4">
                        @foreach ($newsupdates as $news)
                            <div class="features-content d-flex flex-column">
                                <a href="{{ asset('storage/' . $news->path)}}" class="h6" target="_blank"><i
                                        class="fas fa-comment-dots me-1"></i>
                                    {{ $news->title }}
                                </a>
                                <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i>
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
                <div class="col-lg-4">
                    <div class="row mb-4">
                        <div class="p-3 rounded border">
                            <div id="calendar"></div>


                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="p-3 rounded border">
                                <h4 class="mb-4">Periodicals</h4>
                                <div class="row g-2">
                                    @foreach ($periodicals as $periodical)
                                        <div class="col-12">
                                            <a href="{{ asset('storage/' . $periodical->path)}}" target="_blank"
                                                class="link-hover btn btn-light w-100 rounded text-uppercase text-dark py-3">
                                                {{ $periodical->periodicalMaster->name ?? 'N/A' }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->

@endsection
