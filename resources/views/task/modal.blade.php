<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalTitle">Add Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('task.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="priority" name="priority"
                            value="ya">
                        <label class="custom-control-label" for="priority">Tandai sebagai Penting</label>
                    </div>

                    <label for="judul" class="mt-2">Judul</label>
                    <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul Task"
                        required>

                    <label for="kategori_id" class="mt-2">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-control">
                        <option value="" disabled selected>Pilih Kategori</option>
                        @if (!empty($kategori) && is_iterable($kategori))
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                        @endif
                    </select>

                    <label for="due_date" class="mt-2">Due Date</label>
                    <input type="text" name="due_date" id="due_date" class="form-control flatpickr"
                        placeholder="Pilih tanggal" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
