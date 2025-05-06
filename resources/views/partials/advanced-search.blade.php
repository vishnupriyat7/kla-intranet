@extends('layouts.default')
@section('content')
    <!-- Single Product Start -->
    <div class="container-fluid py-4" id="search">
        <div class="container py-2">
            <h1>Advanced Search</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card mt-4">
                <div class="card-body">
                    <form id="advancedSearchForm" action="{{ route('home.advanced-search') }}" method="GET">
                        <div class="row g-4">
                            <!-- Order Type Selection -->
                            <div class="col-md-4">
                                <label for="orderType" class="form-label">Select Order Type</label>
                                <select class="form-select" id="orderType" name="order_type" required>
                                    <option value="">Choose...</option>
                                    <option value="G" {{ request('order_type') == 'G' ? 'selected' : '' }}>Govt. Order
                                    </option>
                                    <option value="C" {{ request('order_type') == 'C' ? 'selected' : '' }}>Circular
                                    </option>
                                    <option value="O" {{ request('order_type') == 'O' ? 'selected' : '' }}>Office Order
                                    </option>
                                    {{-- <option value="news">News</option> --}}
                                </select>
                            </div>
                            <!-- Year Selection -->
                            <div class="col-md-4">
                                <label for="year" class="form-label">Select Year</label>
                                <select class="form-select" id="year" name="year">
                                    <option value="">Choose...</option>
                                    @for ($i = date('Y'); $i >= 2000; $i--)
                                        <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <!-- Date Selection -->
                            <div class="col-md-4">
                                <label for="date" class="form-label">Select Date</label>
                                <input type="date" class="form-control" id="date" name="date"
                                    value="{{ request('date') }}">
                            </div>
                            {{-- Month Selection --}}
                            <div class="col-md-4">
                                <label for="month" class="form-label">Select Month</label>
                                <select class="form-select" id="month" name="month">
                                    <option value="">Choose...</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                            {{ date('F', mktime(0, 0, 0, $i, 10)) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            {{-- Input field to Serch Based on Keyword --}}
                            <div class="col-md-8">
                                <label for="keyword" class="form-label">
                                    Search By Keyword</label>
                                <input type="text" class="form-control" id="keyword" name="keyword"
                                    value="{{ request('keyword') }}">
                            </div>
                            <!-- Search Button -->
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-primary text-white">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div><br>
            <div class="card">
                <div class="card-header">
                    <h4>Search Results</h4>
                </div>
                <div class="card-body">
                    @if (isset($results) && count($results) > 0)
                        <div class="card-body">
                            {{-- <ul class="list-group">
                        @foreach ($results as $result)
                        <li class="list-group-item">
                            <a href="{{ asset('storage/' . $result->path) }}" class="h6"
                                data-bs-toggle="modal" data-bs-target="#pdfModal"
                                data-pdf="{{ asset('storage/' . $result->path) }}"
                                data-title="{{ $result->title }}">
                                {{ $result->title ?? 'N/A' }}
                            </a>
                            <small class="text-muted d-block">{{ ucfirst($result->type ?? 'N/A') }} |
                                {{ $result->date ?? 'N/A' }}</small>
                        </li>
                        @endforeach
                    </ul> --}}
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Number</th>
                                            <th scope="col">Date</th>

                                            <th scope="col">Title</th>
                                            {{-- <th scope="col">Type</th> --}}

                                            <th scope="col">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($results as $index => $result)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>

                                                <td>
                                                    @if ($result->type === 'G')
                                                        @if ($result->go_type === 'M')
                                                            G.O.(Ms) No.{{ $result->number }}
                                                        @elseif ($result->go_type === 'R')
                                                            G.O.(Rt) No.{{ $result->number }}
                                                        @elseif ($result->go_type === 'P')
                                                            G.O.(P) No.{{ $result->number }}
                                                        @else
                                                            G.O. No.{{ $result->number }}
                                                        @endif
                                                    @elseif ($result->type === 'O')
                                                        Offc.O.No.{{ $result->number }}
                                                    @elseif ($result->type === 'C')
                                                        Circular.No.{{ $result->number }}
                                                    @else
                                                        {{ $result->number ?? 'N/A' }}
                                                    @endif
                                                </td>
                                                <td>{{ $result->date ?? ($result->published_date ?? 'N/A') }}</td>
                                                <td>{{ $result->title ?? 'N/A' }}</td>
                                                {{-- <td>{{ ucfirst($result->type ?? 'N/A') }}</td> --}}

                                                <td>
                                                    @if (isset($result->path))
                                                        <a href="{{ asset('storage/' . $result->path) }}" class="h6"
                                                            data-bs-toggle="modal" data-bs-target="#pdfModal"
                                                            data-pdf="{{ asset('storage/' . $result->path) }}"
                                                            data-title="{{ $result->title }}">
                                                            {{-- <i class="fas fa-comment-dots me-1"></i> --}}
                                                            <i class="bi bi-eye-fill"
                                                                style="font-size:18px;color:rgb(60, 93, 240)"></i>
                                                        </a>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- </div> --}}
                    @elseif(isset($results))
                        <div class="alert alert-warning mt-4">Please select an Order Type to proceed with the search. </div>
                    @endif

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
