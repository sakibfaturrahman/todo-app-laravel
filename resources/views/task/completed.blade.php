@extends('layouts.app')

@section('title')
    Task
@endsection
@section('content')
    <div class="col-12">
        <div class="app-content content todo-application">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>

            <div class="content-area-wrapper">
                @include('component.sidebar')
                <div class="content-right">
                    <div class="content-wrapper">
                        <div class="content-header row">
                        </div>
                        <div class="content-body">
                            <div class="body-content-overlay"></div>
                            <div class="todo-app-list">
                                <!-- Todo search starts -->
                                @include('component.search')
                                <!-- Todo search ends -->

                                <!-- Todo List starts -->
                                <div class="todo-task-list-wrapper list-group">
                                    <ul class="todo-task-list media-list" id="todo-task-list">
                                        @foreach ($task as $item)
                                            <li class="todo-item">
                                                <div class="todo-title-wrapper">
                                                    <div class="todo-title-area">
                                                        <i data-feather="more-vertical" class="drag-icon"></i>
                                                        <div class="title-wrapper">
                                                            @if ($item->status == 'Selesai')
                                                                <div class="badge badge-pill badge-light-success">
                                                                    {{ $item->status }}</div>
                                                            @endif
                                                            <span class="todo-title">{{ $item->judul }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="todo-item-action">
                                                        <div class="badge-wrapper mr-1">
                                                            @if ($item->priority == 'ya')
                                                                <span>
                                                                    <i data-feather="star"class="font-medium-3 mr-50"></i>
                                                                    <span>
                                                            @endif
                                                            <div class="badge badge-pill badge-light-primary">
                                                                {{ $item->kategori->nama_kategori }}</div>
                                                        </div>
                                                        <small class="text-nowrap text-muted mr-1">
                                                            {{ \Carbon\Carbon::parse($item->due_date)->translatedFormat('l, d F Y') }}
                                                        </small>


                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="no-results">
                                        <h5>No Items Found</h5>
                                    </div>
                                </div>
                                <!-- Todo List ends -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('task.modal')

    @include('kategori.modal')
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.flatpickr').flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                defaultDate: new Date()
            });
        });
    </script>
@endpush
