@extends('layouts.default')

@section('content')
    <!-- Single Product Start -->
    <div class="container-fluid py-5" id="order-circular">
        <div class="container py-5">
            <!-- Title -->
            <h1>{{ $orderType }}</h1>
            </br>
            @if ($orderTypeKey == 'go')
                <!-- Tabs for Manuscript, Routine, Print -->
                <div class="border mb-4 rounded mb-4">
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
                        {{-- <li class="nav-item flex-fill">
                            <a class="nav-link py-3" data-bs-toggle="pill" href="#print">
                                <span class="text-dark">Print</span>
                            </a>
                        </li> --}}
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
                    {{-- <div id="print" class="tab-pane fade">
                        @include('orders-circular.monthly_orders', [
                            'orders' => $orders,
                            'months' => $months,
                            'type' => 'P',
                        ])
                    </div> --}}
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
                                    <div class="col-12 p-4">

                                        @foreach ($orders as $order)
                                            @if (\Carbon\Carbon::parse($order->date)->format('m') == $month['no'])
                                                <div class="features-content d-flex flex-column mt-3">
                                                    {{-- <a href="{{ asset('storage/' . $order->path) }}" class="h6"
                                                        target="_blank">
                                                        <i class="fas fa-solid fa-paperclip me-1"></i> {{ $order->title }}
                                                    </a> --}}
                                                    <a href="{{ asset('storage/' . $order->path) }}" class="h6"
                                                        data-bs-toggle="modal" data-bs-target="#pdfModal"
                                                        data-pdf="{{ asset('storage/' . $order->path) }}"
                                                        data-title="{{ $order->title }}">
                                                        {{-- <i class="fas fa-comment-dots me-1"></i> --}}
                                                        <i class="fas fa-solid fa-paperclip me-1"
                                                            style="color: rgb(60, 93, 240)"></i> {{ $order->title }}
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

<!-- 🔹 Single PDF Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">PDF Viewer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="pdfViewer" src="" width="100%" height="700px" style="border: none;"></iframe>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        var pdfModal = document.getElementById("pdfModal");

        pdfModal.addEventListener("show.bs.modal", function(event) {
            var link = event.relatedTarget; // Link that triggered the modal
            var pdfUrl = link.getAttribute("data-pdf");
            var pdfTitle = link.getAttribute("data-title");

            // Set modal title and PDF source
            document.getElementById("pdfModalLabel").textContent = pdfTitle;
            document.getElementById("pdfViewer").src = pdfUrl;
        });

        pdfModal.addEventListener("hidden.bs.modal", function() {
            document.getElementById("pdfViewer").src = ""; // Reset iframe when modal is closed
        });
    });
</script>
