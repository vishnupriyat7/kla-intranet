<div class="tab-class">
    <!-- Month Tabs for the selected Order Type -->
    <div class="d-flex justify-content-between border-bottom mb-1">
        <ul class="nav nav-pills d-inline-flex text-center">
            @foreach ($months as $month)
                <li class="nav-item mb-3">
                    <a class="d-flex py-2 bg-light rounded-pill me-2 {{ $month['no'] == date('m') ? 'active' : '' }} month-tab"
                        data-bs-toggle="pill" href="#{{ $type }}-tab-{{ $month['no'] }}"
                        data-month="{{ $month['no'] }}" data-type="{{ $type }}">
                        <span class="text-dark" style="width: 200px;">
                            {{ $month['name'] }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>

    </div>

    <!-- Month-wise Order Listings -->
    <div class="tab-content p-3">
        @foreach ($months as $month)
        <div id="{{ $type }}-tab-{{ $month['no'] }}"
             class="tab-pane fade show {{ $month['no'] == date('m') ? 'active' : '' }}">
            <div class="row g-4">
                <div class="col-12 p-4">
                    @php
                        $hasOrders = $orders
                            ->where('go_type', $type)
                            ->filter(function ($order) use ($month) {
                                return \Carbon\Carbon::parse($order->date)->format('m') == str_pad($month['no'], 2, '0', STR_PAD_LEFT);
                            })
                            ->isNotEmpty();
                    @endphp

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover yajra-table"
                               id="datatable-{{ $type }}-{{ $month['no'] }}">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Number</th>
                                    <th class="no-wrap">Date</th>
                                    <th class="no-wrap">Title</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    @if (!$hasOrders)
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <span>No {{ $type == 'M' ? 'Govt.Order Manuscript' : 'Govt.Order Routine' }} uploaded for this month.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
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
        // PDF modal logic
        const pdfModal = document.getElementById("pdfModal");

        pdfModal.addEventListener("show.bs.modal", function(event) {
            const link = event.relatedTarget;
            const pdfUrl = link.getAttribute("data-pdf");
            const pdfTitle = link.getAttribute("data-title");

            document.getElementById("pdfModalLabel").textContent = pdfTitle;
            document.getElementById("pdfViewer").src = pdfUrl;
        });

        pdfModal.addEventListener("hidden.bs.modal", function() {
            document.getElementById("pdfViewer").src = "";
        });

        // Handle month tab clicks for both Manuscript and Routine
        document.querySelectorAll('.tab-class').forEach(container => {
            container.addEventListener('shown.bs.tab', function(event) {
                const tab = event.target;
                if (!tab.classList.contains('month-tab')) return; // Only handle month tabs

                const month = tab.getAttribute('data-month');
                const type = tab.getAttribute('data-type');
                const tableId = `#datatable-${type}-${month}`;

                console.log(
                    `Initializing DataTable for type: ${type}, month: ${month}, tableId: ${tableId}`
                );

                // Destroy existing DataTable if initialized
                if ($.fn.DataTable.isDataTable(tableId)) {
                    $(tableId).DataTable().destroy();
                }

                // Initialize DataTable
                $(tableId).DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('home.order-circular', ['type' => $orderTypeKey]) }}',
                        method: 'GET',
                        data: {
                            month: month,
                            go_type: type,
                            _t: new Date().getTime()
                        },
                        error: function(xhr, status, error) {
                            console.error(
                                `AJAX error for type ${type}, month ${month}:`,
                                status, error);
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'number',
                            name: 'number'
                        },
                        {
                            data: 'date',
                            name: 'date'
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'view',
                            name: 'view',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            });
        });

        // Initialize DataTable for the active month tab on page load
        const activeTab = document.querySelector('.month-tab.active');
        if (activeTab) {
            activeTab.dispatchEvent(new CustomEvent('shown.bs.tab'));
        }
    });
</script>
