@extends('layouts.default')

@section('content')
    <!-- Single Product Start -->
    <div class="container-fluid populer-news py-5">
        <div class="container py-5">
            <h1>{{ $orderType }}</h1>
            </br>
            @if ($orderTypeKey == 'go')
                <!-- Tabs for Manuscript, Routine, Print -->
                <div class="border mb-4 rounded mb-5">
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
                <div class="tab-content p-3">
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
            @endif
            @if ($orderTypeKey == 'oo' || $orderTypeKey == 'cr')
                <!-- Month Tabs for Office Order & Circular -->
                <div class="tab-class">
                    <div class="d-flex justify-content-between border-bottom mb-4">
                        <ul class="nav nav-pills d-inline-flex text-center">
                            @foreach ($months as $month)
                                <li class="nav-item mb-3">
                                    <a class="d-flex py-2 bg-light rounded-pill me-2 {{ $month['no'] == date('n') ? 'active' : '' }}"
                                        data-bs-toggle="pill" href="#tab-{{ $month['no'] }}">
                                        <span class="text-dark" style="width: 200px;">{{ $month['name'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Month-wise Order Listings -->
                    <div class="tab-content p-3">
                        @foreach ($months as $month)
                            <div id="tab-{{ $month['no'] }}"
                                class="tab-pane fade show {{ $month['no'] == date('m') ? 'active' : '' }}">
                                <div class="row g-4">
                                    <div class="col-12">
                                        @foreach ($orders as $order)
                                            @if (\Carbon\Carbon::parse($order->date)->format('m') == $month['no'])
                                                <div class="features-content d-flex flex-column">
                                                    <a href="{{ asset('storage/' . $order->path) }}" class="h6"
                                                        target="_blank">
                                                        <i class="fas fa-solid fa-paperclip me-1"></i> {{ $order->title }}
                                                    </a>
                                                    <small class="text-body d-block">
                                                        <i class="fas fa-calendar-alt me-1"></i>
                                                        {{ \Carbon\Carbon::parse($order->date)->format('M d Y') }}
                                                    </small>
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
            @endif
        </div>
    </div>
    <!-- Single Product End -->
@endsection
