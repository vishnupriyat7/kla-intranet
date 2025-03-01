@extends('layouts.default')

@section('content')
    <!-- Single Product Start -->
    <div class="container-fluid populer-news py-5">
        <div class="container py-5">
            <h1>{{$orderType}}</h1>
            </br>
            {{-- <ol class="breadcrumb justify-content-start mb-4">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-dark">Single Page</li>
            </ol> --}}
            <div class="tab-class">
                <div class="d-flex justify-content-between border-bottom mb-4">
                    <ul class="nav nav-pills d-inline-flex text-center">
                        @foreach ($months as $month)
                            <li class="nav-item mb-3">
                                <a class="d-flex py-2 bg-light rounded-pill me-2 {{ $month['no'] == date('n') ? 'active' : '' }}"
                                    data-bs-toggle="pill" href="#tab-{{ $month['no'] }}">
                                    <span class="text-dark" style="width: 200px;">
                                        {{$month['name']}}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-content">
                        @foreach ($months as $month)
                            <div id="tab-{{ $month['no'] }}"
                                class="tab-pane fade show {{$month['no'] == date('m') ? 'active' : ''}}">
                                <div class="row g-4">
                                    <div class="col-12">
                                        @foreach ($orders as $order)
                                            @if(\Carbon\Carbon::parse($order->date)->format('m') == $month['no'])
                                                <div class="features-content d-flex flex-column">
                                                    <a href="{{ asset('storage/' . $order->path)}}" class="h6" target="_blank"><i
                                                            class="fas fa-solid fa-paperclip me-1"></i>
                                                        {{ $order->title }}
                                                    </a>
                                                    <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i>
                                                        {{ \Carbon\Carbon::parse($order->date)->format('M d Y') }}</small>
                                                    </br>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->
@endsection
