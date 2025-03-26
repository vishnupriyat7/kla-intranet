@extends('layouts.default')
@section('content')
    <!-- Single Product Start -->
    <div class="container-fluid py-4" id="search">
        <div class="container py-2">
            <h1>Advanced Search</h1>
            <div class="card mt-4">
                <div class="card-body">
                    <form action="{{ route('home.advanced-search') }}" method="GET">
                        <div class="row g-4">
                            <!-- Order Type Selection -->
                            <div class="col-md-6">
                                <label for="orderType" class="form-label">Select Order Type</label>
                                <select class="form-select" id="orderType" name="order_type" required>
                                    <option value="">Choose...</option>
                                    <option value="go">Govt. Order</option>
                                    <option value="circular">Circular</option>
                                    <option value="office_order">Office Order</option>
                                    <option value="news">News</option>
                                </select>
                            </div>
                            <!-- Year Selection -->
                            <div class="col-md-6">
                                <label for="year" class="form-label">Select Year</label>
                                <select class="form-select" id="year" name="year">
                                    <option value="">Choose...</option>
                                    @for ($i = date('Y'); $i >= 2000; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <!-- Date Selection -->
                            <div class="col-md-6">
                                <label for="date" class="form-label">Select Date</label>
                                <input type="date" class="form-control" id="date" name="date">
                            </div>
                            {{-- Month Selection --}}
                            <div class="col-md-6">
                                <label for="month" class="form-label">Select Month</label>
                                <select class="form-select" id="month" name="month">
                                    <option value="">Choose...</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 10)) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            {{-- Input field to Serch Based on Keyword --}}
                            <div class="col-md-12>
                                <label for="keyword" class="form-label">
                                Search By Keyword</label>
                                <input type="text" class="form-control" id="keyword" name="keyword">
                            </div>
                            <!-- Search Button -->
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
