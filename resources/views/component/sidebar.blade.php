<div class="sidebar-left">
    <div class="sidebar">
        <div class="sidebar-content todo-sidebar">
            <div class="todo-app-menu">
                <div class="add-task">
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#taskModal">
                        Add Task
                    </button>
                </div>
                <div class="sidebar-menu-list">
                    <div class="list-group list-group-filters">
                        <a href="{{ route('task') }}"
                            class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'task' ? 'active' : '' }}">
                            <i data-feather="mail" class="font-medium-3 mr-50"></i>
                            <span class="align-middle"> My Task</span>
                        </a>
                        <a href="{{ route('task.important') }}"
                            class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'task.important' ? 'active' : '' }}">
                            <i data-feather="star" class="font-medium-3 mr-50"></i> <span
                                class="align-middle">Important</span>
                        </a>
                        <a href="{{ route('task.AsCompleted') }}"
                            class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'task.AsCompleted' ? 'active' : '' }}">
                            <i data-feather="check" class="font-medium-3 mr-50"></i> <span
                                class="align-middle">Completed</span>
                        </a>
                        <a href="{{ route('task.deleted') }}"
                            class="list-group-item list-group-item-action {{ Route::currentRouteName() == 'task.deleted' ? 'active' : '' }}">
                            <i data-feather="trash" class="font-medium-3 mr-50"></i> <span
                                class="align-middle">Deleted</span>
                        </a>
                    </div>
                    <div class="mt-3 px-2 d-flex justify-content-between">
                        <h6 class="section-label mb-1">Kategori</h6>

                        <i data-feather="plus" type="button" data-toggle="modal" data-target="#kategoriModal">
                        </i>
                    </div>
                    @php
                        $colors = ['primary', 'success', 'danger', 'warning', 'info', 'dark'];
                    @endphp

                    <div class="list-group list-group-labels">
                        @if (!empty($kategori) && is_iterable($kategori))
                            @foreach ($kategori as $item)
                                @php
                                    $randomColor = $colors[array_rand($colors)];
                                @endphp

                                <div
                                    class="d-flex justify-content-between align-items-center list-group-item list-group-item-action">
                                    <div class="d-flex align-items-center">
                                        <span class="bullet bullet-sm bullet-{{ $randomColor }} mr-1"></span>
                                        <a
                                            href="{{ route('kategori.detail', optional($item)->id) }}">{{ optional($item)->nama_kategori }}</a>
                                    </div>

                                    <div class="dropdown ml-auto">
                                        <a href="javascript:void(0);" class="dropdown-toggle hide-arrow"
                                            id="todoActions" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i data-feather="more-vertical" class="font-medium-2 text-body"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="todoActions">
                                            <a class="dropdown-item sort-asc" data-toggle="modal"
                                                data-target="#editKategoriModal{{ optional($item)->id }}">Edit
                                                Kategori</a>
                                            <a class="dropdown-item sort-asc" data-toggle="modal"
                                                data-target="#deleteKategoriModal{{ optional($item)->id }}">Delete
                                                Kategori</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-danger">Data kategori tidak tersedia.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (!empty($kategori) && is_iterable($kategori))
    @include('kategori.modalEdit', ['kategories' => $kategori])
    @include('kategori.modalHapus', ['kategories' => $kategori])
@endif
