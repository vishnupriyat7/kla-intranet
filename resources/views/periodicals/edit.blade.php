<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mt-5">
        <h1>Edit Periodical</h1>
        <form action="{{ route('periodicals.update', $periodical->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH') <!-- Specify PATCH method explicitly -->

            <div class="mb-3">
                <label for="name_eng" class="form-label">Periodical Master</label>
                <select class="form-select" id="name_eng" name="name_eng" required>
                    <option value="">Select Periodical Item</option>
                    @foreach ($periodicalMasters as $periodicalMaster)
                        <option value="{{ $periodicalMaster->id }}"
                            {{ $periodical->periodical_master_id == $periodicalMaster->id ? 'selected' : '' }}>
                            {{ $periodicalMaster->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date"
                    value="{{ $periodical->date }}">
            </div>
            {{-- Place the choose file input field inside a row and view current pdf button in same row --}}

            <div class="row">
                <div class="col-md-6">
                    @if ($periodical->path)
                        <!-- Trigger the modal to view the PDF -->
                        <a href="#" data-bs-toggle="modal" class="btn btn-success btn-sm"
                            data-bs-target="#pdfModal">
                            View PDF
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="pdfModalLabel">PDF Preview</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body
                            "> <iframe
                                            src="{{ asset('storage/' . $periodical->path) }}" width="100%"
                                            height="500px" style="border: none;"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Default fallback -->
                        <span>No image or PDF available</span>
                    @endif
                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="path">Choose PDF File To Upload</label><br><br>
                        <input type="file" class="form-control" id="path" name="path" rows="3"
                            value="{{ $periodical->path }}">
                    </div>
                </div>

            </div>

            {{-- End of row --}}

            <button type="submit" class="btn btn-primary">Update Periodical</button>
            <a href="{{ route('periodicals.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</x-app-layout>
