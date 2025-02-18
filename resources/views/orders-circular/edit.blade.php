{{-- Edit page for create form --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Order / Circular
        </h2>
    </x-slot>

    <div class="container mt-5">
        <h1 class="mb-5">Edit Order / Circular</h1>
        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('orders-circular.update', $order->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group mb-3">
                <label for="type" class="form-label">Select Type</label>
                <select class="form-select" id="type" name="type" required onchange="toggleGoType()">
                    <option value="">Select Type</option>
                    <option value="G" {{ $order->type == 'G' ? 'selected' : '' }}>Govt Order</option>
                    <option value="O" {{ $order->type == 'O' ? 'selected' : '' }}>Office Order</option>
                    <option value="C" {{ $order->type == 'C' ? 'selected' : '' }}>Circular</option>
                </select>

            </div>
            <div class="form-group mb-3" id="goType" style="display: none">
                <label for="go_type" class="form-label">Select GO Type</label>
                <select class="form-select" id="go_type" name="go_type" required>
                    <option value="">Select GO Type</option>
                    <option value="M" {{ $order->go_type == 'M' ? 'selected' : '' }}>സർക്കാർ ഉത്തരവുകൾ
                        കയ്യെഴുത്തു (Govt.Order Manuscript)</option>
                    <option value="R" {{ $order->go_type == 'R' ? 'selected' : '' }}>സർക്കാർ ഉത്തരവുകൾ സാധാ
                        (Govt.Order Routine)</option>
                    <option value="P" {{ $order->go_type == 'P' ? 'selected' : '' }}>സർക്കാർ ഉത്തരവുകൾ അച്ചടി
                        (Govt. Order Print) </option>
                </select>

            </div>
            <div class="form-group mb-3">
                <label for="no" class="form-label">Number</label>
                <input type="text" class="form-control" id="no" name="no" value="{{ $order->number }}">
                @error('no')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $order->date }}">
                @error('date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $order->title }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="keywords" class="form-label">Keywords</label>
                <input type="text" class="form-control" id="keywords" name="keywords"
                    value="{{ $order->keywords }}">
                    @error('keywords')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
            </div>

            {{-- <div class="form-group mb-3">
                <label for="path" class="form-label">PDF</label>

                <input type="file" class="form-control" id="path" name="path">
            </div> --}}
            <div class="row">
                <div class="col-6">
                    @if ($order->path)
                        <a href="#" data-bs-toggle="modal" class="btn btn-success btn-sm"
                            data-bs-target="#pdfModal">
                            View PDF
                        </a>
                        <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="pdfModalLabel">PDF Preview</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <iframe src="{{ asset('storage/' . $order->path) }}" width="100%"
                                            height="500px" style="border: none;"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <p>No PDF available</p>
                    @endif
                </div>
                <div class="col-6">
                    <div class="form-group mb-3">
                        <label for="path" class="form-label">Choose File</label>
                        <input type="file" class="form-control" id="path" name="path">

                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('orders-circular.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
    </div>
</x-app-layout>
{{-- Script to toggle GO Type --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        toggleGoType();
    });

    function toggleGoType() {
        var type = document.getElementById('type').value;
        if (type == 'G') {
            document.getElementById('goType').style.display = 'block';
            document.getElementById('go_type').setAttribute('required', 'required');
        } else {
            document.getElementById('goType').style.display = 'none';
            document.getElementById('go_type').removeAttribute('required');
        }
    }
</script>
