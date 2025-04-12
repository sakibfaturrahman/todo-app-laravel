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
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox"
                                                                    class="custom-control-input task-checkbox"
                                                                    id="task-{{ $item->id }}"
                                                                    data-id="{{ $item->id }}" />
                                                                <label class="custom-control-label"
                                                                    for="task-{{ $item->id }}"></label>
                                                            </div>
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

                                                        <div class="dropdown">
                                                            <a href="javascript:void(0);"
                                                                class="dropdown-toggle hide-arrow mr-1" id="todoActions"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i data-feather="more-vertical"
                                                                    class="font-medium-2 text-body"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right"
                                                                aria-labelledby="todoActions">
                                                                <a class="dropdown-item sort-asc" data-toggle="modal"
                                                                    data-target="#editModal{{ $item->id }}">Edit
                                                                    Task</a>
                                                                <a class="dropdown-item sort-asc" data-toggle="modal"
                                                                    data-target="#deleteModal{{ $item->id }}">Delete
                                                                    Task</a>
                                                            </div>
                                                        </div>
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

    {{-- modal-edit --}}
    @foreach ($task as $item)
        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editTaskModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Update Task</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('task.update', $item->id) }}" method="POST" id="editTaskForm">
                        @csrf

                        <div class="modal-body">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="edit_priority" name="priority"
                                    value="ya" {{ $item->priority == 'ya' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="edit_priority">Tandai sebagai Penting</label>
                            </div>

                            <label for="edit_judul" class="mt-2">Judul</label>
                            <input type="text" name="judul" id="edit_judul" class="form-control"
                                placeholder="Judul Task" required value="{{ $item->judul }}">

                            <label for="edit_kategori_id" class="mt-2">Kategori</label>
                            <select name="kategori_id" id="edit_kategori_id" class="form-control">
                                <option value="" disabled>Pilih Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $item->kategori_id ? 'selected' : '' }}>
                                        {{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>

                            <label for="edit_due_date" class="mt-2">Due Date</label>
                            <input type="text" name="due_date" id="edit_due_date" class="form-control flatpickr"
                                placeholder="Pilih tanggal" required value="{{ $item->due_date }}">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- modal-delete --}}
    @foreach ($task as $item)
        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="deleteModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Konfirmasi Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('task.destroy', $item->id) }}" method="get">
                        @csrf
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus tugas ini?</p>
                            <p class="text-danger"><strong>Catatan:</strong> Task akan dipindahkan ke sampah. Anda dapat
                                memulihkannya atau menghapusnya secara permanen.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                            <button type="submit" class="btn btn-primary">Ya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- modal-delete --}}

    @include('task.modal')

    @include('kategori.modal')

    @include('task.modalConfirm', ['tasks' => $task])
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

    <script>
        $(document).ready(function() {
            let selectedTaskId = null;
            $('.task-checkbox').change(function() {
                if ($(this).is(':checked')) {
                    selectedTaskId = $(this).data('id');
                    $('#confirmModal').modal('show');
                }
            });
            $('#confirmModal').on('hidden.bs.modal', function() {
                if (selectedTaskId) {
                    $('#task-' + selectedTaskId).prop('checked', false);
                }
                selectedTaskId = null;
            });
        });
    </script>
@endpush
