<x-app-layout>
    <div class="container">
        <div class="mb-4 d-flex justify-content-end">
            <a href="{{ route('orders-circular.create') }}" class="btn btn-primary">Add New</a>
        </div>
        <h2 class="mb-4">Orders / Circulars</h2>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>GO Type</th>
                    <th>No</th>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Keyword</th>
                    <th>Path</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                @if ($orders->count()) @foreach ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->type }}</td>
                            <td>{{ $order->go_type }}</td>
                            <td>{{ $order->number }}</td>
                            <td>{{ $order->date }}</td>
                            <td>{{ $order->title }}</td>
                            <td>{{ $order->keywords }}</td>
                            <td>{{ $order->path }}</td>
                            <td>
                                @if ($order->path)
                                    <!-- Trigger the modal to view the PDF -->
                                    <a href="#" data-bs-toggle="modal" class="btn btn-outline-info btn-sm text-black"
                                        data-bs-target="#pdfModal{{ $loop->index }}">
                                        <i class="ri-eye-fill"></i> PDF
                                    </a>

                                    <!-- Modal -->
                                    <div class="modal fade " id="pdfModal{{ $loop->index }}" tabindex="-1"
                                        aria-labelledby="pdfModalLabel{{ $loop->index }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="pdfModalLabel{{ $loop->index }}">PDF
                                                        Preview</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <iframe src="{{ asset('storage/' . $order->path) }}" width="100%"
                                                        height="500px" style="border: none;"></iframe>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @else
                                   <td> N/A </td>
                                   @endif
                </td>
                </tr>
                {{-- <td>
                        <a href="{{ route('orders-circular.edit', $order->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('orders-circular.destroy', $order->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td> --}}
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-center">No Data Found</td>
                </tr>

                @endif


            </tbody>
        </table>
    </div>
</x-app-layout>
