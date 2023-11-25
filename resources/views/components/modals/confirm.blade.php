<dialog id="modalConfirm" class="modal bg-base-200 bg-clip-padding backdrop-filter backdrop-blur-md bg-opacity-10">
    <div class="modal-box prose-sm">
        <h3 class="font-bold text-lg mb-4 text-center">Konfirmasi Hapus</h3>
        <p>Apakah anda yakin ingin menghapus ?</p>
        {{-- <form action="">
            <div class="w-full grid grid-cols-3 gap-4">
                <label for="keperluan" class="label-text font-semibold">Keperluan</label>
                <textarea name="keperluan" class="textarea textarea-bordered h-24 w-full col-span-2" required></textarea>
                <label for="keperluan" class="label-text font-semibold">Data diri</label>
                <input type="text" disabled placeholder="Otomatis dari data akun anda" class="w-full col-span-2 bg-base-100">
            </div>
            <button id="btn-hidden-ajukan" type="submit" class="hidden">Ajukan</button>
        </form> --}}
        <div class="modal-action">
            <form method="dialog">
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