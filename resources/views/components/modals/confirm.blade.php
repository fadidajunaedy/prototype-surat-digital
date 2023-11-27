<dialog id="modalConfirm" class="modal bg-base-200 bg-clip-padding backdrop-filter backdrop-blur-md bg-opacity-10">
    <div class="modal-box prose-sm">
        <h3 class="font-bold text-lg mb-4 text-center">Konfirmasi Hapus</h3>
        <p>Apakah anda yakin ingin menghapus ?</p>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Batal</button>
            </form>
            <form method="dialog">
                @csrf 
                @method('DELETE')
                <button class="btn">Batal</button>
            </form>
            <button id="btn-ajukan" class="btn btn-primary">Hapus</button>
        </div>
    </div>
</dialog>

<script>
    document.getElementById('btn-ajukan').addEventListener('click', function() {
       document.getElementById('btn-hidden-ajukan').click();
   });
</script>