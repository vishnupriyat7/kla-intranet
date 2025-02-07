<x-app-layout>


    <div class="container mt-5">
        <div class="mb-4 d-flex justify-content-end">
            <a href="{{ route('periodicals.create') }}" class="btn btn-primary">Add New</a>
        </div>

        <h2 class="mb-4">Periodicals List</h2>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Path</th>
                    <th>File</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($periodicals as $key => $periodical)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $periodical->periodicalMaster->name ?? 'N/A' }}</td>
                        <td>
                            @if ($periodical->path)
                                {{ $periodical->path }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if ($periodical->path)
                                <!-- Trigger the modal to view the PDF -->
                                <a href="#" data-bs-toggle="modal" class="btn btn-outline-info btn-sm text-black"
                                    data-bs-target="#pdfModal{{ $loop->index }}">
                                    <i class="ri-eye-fill"></i> PDF
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="pdfModal{{ $loop->index }}" tabindex="-1"
                                    aria-labelledby="pdfModalLabel{{ $loop->index }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="pdfModalLabel{{ $loop->index }}">PDF
                                                    Preview</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <iframe src="{{ asset('storage/' . $periodical->path) }}" width="100%"
                                                    height="500px" style="border: none;"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Default fallback -->
                                <span>No image or PDF available</span>
                            @endif
                        </td>
                        <td>{{ $periodical->date }}</td>
                        <td>
                            @if ($periodical->status == '0')
                                <span class="badge bg-danger">Unpublished</span>
                            @else
                                <span class="badge bg-success">Published</span>
                            @endif
                        </td>
                        <td>
                            <!-- View Button -->
                            <a href="{{ route('periodicals.show', $periodical->id) }}" class="btn btn-info btn-sm">
                                <i class="ri-eye-fill"></i>
                            </a>

                            <!-- Edit Button -->
                            <a href="{{ route('periodicals.edit', $periodical->id) }}" class="btn btn-warning btn-sm">
                                <i class="ri-edit-2-fill"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        {{-- Provide Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $periodicals->links() }}

        </div>
    </div>



</x-app-layout>
