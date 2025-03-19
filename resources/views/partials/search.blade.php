@extends('layouts.default')
@section('content')
    <!-- Single Product Start -->
    <div class="container-fluid populer-news py-5">
        <div class="container py-5">
            <h1>Search</h1>
            <div class="row g-4">
                <div class="col-12">
                    @foreach ($results as $result)
                        <div class="features-content d-flex flex-column">
                            <a href="{{ asset('storage/' . $result->path)}}" class="h6" target="_blank"><i
                                    class="fas fa-solid fa-paperclip me-1"></i>
                                {{ $result->title }}
                            </a>
                            <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i>
                                {{ \Carbon\Carbon::parse($result->date)->format('M d Y') }}</small>
                            </br>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
