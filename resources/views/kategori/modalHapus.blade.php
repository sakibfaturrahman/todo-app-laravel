@foreach ($kategories as $item)
    <div class="modal fade" id="deleteKategoriModal{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="deleteKategoriModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteKategoriModalTitle">Hapus Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kategori.destroy', $item->id) }}" method="GET">
                    @csrf
                    <div class="modal-body">
                        <span>Yakin akan mengahapus <strong>{{ $item->nama_kategori }}</strong> dari daftar
                            kategori?</span>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
