<x-app-layout>


    {{-- @foreach ($periodicals as $periodical)
        {{ $periodical->name }}
    @endforeach --}}
    <div class="container mt-5">
        <h2 class="mb-4">Periodicals List</h2>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Path</th>
                    <th>File</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($periodicals as $key => $periodical)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $periodical->name }}</td>
                        <td>
                            @if ($periodical->path)
                                {{ asset('storage/' . $periodical->path) }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if ($periodical->img)
                                <!-- Trigger the modal to view the PDF -->
                                <a href="#" data-bs-toggle="modal" data-bs-target="#pdfModal{{ $loop->index }}">
                                    View File
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
                        <td>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>




</x-app-layout>
