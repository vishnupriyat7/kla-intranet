@extends('layouts.default')

@section('content')
    <!-- Single Product Start -->
    <div class="container-fluid populer-news py-5">
        <div class="container py-5">
            <h1>Government Order</h1>
            </br>
            <div class="tab-class">
                <div class="d-flex justify-content-between border-bottom mb-4">
                    <ul class="nav nav-pills d-inline-flex text-center">
                        <li class="nav-item mb-3">
                            <a class="d-flex py-2 bg-light rounded-pill me-2 active" data-bs-toggle="pill" href="#tab-ms">
                                <span class="text-dark" style="width: 200px;">
                                    Manuscript
                                </span>
                            </a>
                        </li>
                        <li class="nav-item mb-3">
                            <a class="d-flex py-2 bg-light rounded-pill me-2" data-bs-toggle="pill" href="#tab-rt">
                                <span class="text-dark" style="width: 200px;">
                                    Routine
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="tab-ms" class="tab-pane fade show active">

                        {{-- {{ app('App\Http\Controllers\HomeController')->orderCircular(request('goms')) }} --}}
                        <!-- Manuscript content will be loaded here -->
                        <script>
                            window.onload = function() {
                                window.location.href = "{{ route('home.order-circular', ['type' => 'goms']) }}";
                            };
                        </script>
                    </div>
                    <div id="tab-rt" class="tab-pane fade">
                        <script>
                            window.onload = function() {
                                window.location.href = "{{ route('home.order-circular', ['type' => 'gor']) }}";
                            };
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->

@endsection