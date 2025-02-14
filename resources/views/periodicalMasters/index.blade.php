<x-app-layout>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Periodicals List</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('periodical-masters.create') }}" class="btn btn-primary">Add New</a>
                </div>

                {{-- <h2 class="mb-4">Periodicals List</h2> --}}
                <table id="periodicalsTable" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#periodicalsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('periodical-masters.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'img',
                    name: 'img',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
