<x-app-layout>
    <div class="container mt-3">
        {{-- add card here --}}
        <div class="card ">
            <div class="card-header">
                <h4>Periodicals</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('periodicals.create') }}" class="btn btn-primary">Add New</a>
                </div>

                {{-- <h2 class="mb-4">Periodicals List</h2> --}}
                <table id="periodicalsTable" class="table table-striped table-bordered">
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
                </table>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#periodicalsTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('periodicals.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'periodicalMaster.name'
                        },
                        {
                            data: 'path',
                            name: 'path'
                        },
                        {
                            data: 'file',
                            name: 'file',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'date',
                            name: 'date'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    createdRow: function(row, data, dataIndex) {
                        $('td:eq(3)', row).css('white-space', 'nowrap'); // Prevent wrap on index column
                        $('td:eq(6)', row).css('white-space', 'nowrap'); // Prevent wrap on action column
                    }
                });
            });
        </script>
    </div>
</x-app-layout>
