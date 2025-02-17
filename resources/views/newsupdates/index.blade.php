<x-app-layout>
    {{-- <div class="container mt-5">
        <h2 class="mb-4">News List</h2>
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('news-updates.create') }}" class="btn btn-primary">Add News</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>


        </table>

    </div> --}}

    <div class="container mt-3">
        {{-- add card here --}}
        <div class="card ">
            <div class="card-header">
                <h4>News List</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('news-updates.create') }}" class="btn btn-primary">Add New</a>
                </div>

                {{-- <h2 class="mb-4">Periodicals List</h2> --}}
                <table id="periodicalsTable" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
<script>
    $(document).ready(function() {
        $('#periodicalsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('news-updates.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            createdRow: function(row, data, dataIndex) {
                $('td:eq(4)', row).css('white-space', 'nowrap'); // Prevent wrap on action column
            }
        });
    });
</script>
