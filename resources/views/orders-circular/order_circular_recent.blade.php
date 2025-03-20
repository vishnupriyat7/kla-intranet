@extends('layouts.default')

@section('content')
    <!-- Single Product Start -->
    <div class="container-fluid populer-news py-5">
        <div class="container py-5">
            <h1>{{ $orderType }}</h1>
            </br>
            {{-- <ol class="breadcrumb justify-content-start mb-4">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-dark">Single Page</li>
            </ol> --}}


            {{-- i want to add 3 tabs here for government order types like government order manuscript, government order routine and government order print --}}



            <!-- Tabs for Manuscript, Routine, Print -->
            <div class="border mb-4 rounded mb-2">
                <ul class="nav nav-pills d-flex text-center">
                    <li class="nav-item flex-fill">
                        <a class="nav-link active py-3 border-end" data-bs-toggle="pill" href="#manuscript">
                            <span class="text-dark">Manuscript</span>
                        </a>
                    </li>
                    <li class="nav-item flex-fill">
                        <a class="nav-link py-3 border-end" data-bs-toggle="pill" href="#routine">
                            <span class="text-dark">Routine</span>
                        </a>
                    </li>
                    <li class="nav-item flex-fill">
                        <a class="nav-link py-3" data-bs-toggle="pill" href="#print">
                            <span class="text-dark">Print</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Content for each order type (Manuscript, Routine, Print) -->
            <div class="tab-content">
                <!-- Manuscript Tab -->
                <div id="manuscript" class="tab-pane fade show active">
                    @include('orders-circular.monthly_orders', [
                        'orders' => $orders,
                        'months' => $months,
                        'type' => 'M',
                    ])
                </div>

                <!-- Routine Tab -->
                <div id="routine" class="tab-pane fade">
                    @include('orders-circular.monthly_orders', [
                        'orders' => $orders,
                        'months' => $months,
                        'type' => 'R',
                    ])
                </div>

                <!-- Print Tab -->
                <div id="print" class="tab-pane fade">
                    @include('orders-circular.monthly_orders', [
                        'orders' => $orders,
                        'months' => $months,
                        'type' => 'P',
                    ])
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->
@endsection
