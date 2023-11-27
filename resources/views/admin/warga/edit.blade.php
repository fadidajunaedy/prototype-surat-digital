@extends('admin.layouts.template')
@section('content')
<section class="min-h-[90vh] w-full prose-sm">
    <div class="text-sm breadcrumbs px-0 ">
        <ul class="mx-0 px-0 my-0">
          <li class="mx-0 px-0"><a href="{{ route('admin.warga') }}">Warga</a></li> 
          <li class="mx-0 px-0">{{ $data->id }}</li> 
          <li>Edit</li>
        </ul>
    </div>
    <h2 class="font-semibold my-4 mb-4">Edit Warga</h2>
    @include('components.alert')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="md:col-span-2 bg-base-100 p-4 rounded-xl shadow-xl">
            <form 
            action="{{ url('admin/warga/' . $data->id . '/update') }}" 
            method="POST"
            enctype="multipart/form-data" 
            class="grid grid-cols-1 md:grid-cols-2 gap-4"
            >
                @csrf
                @method('PATCH')
                <div class="md:col-span-2 form-control w-full h-auto">
                    <div class="w-[220px] h-[220px] rounded-lg overflow-hidden shadow-lg relative mx-auto md:mx-0" >
                        <img 
                        @if ($data->foto_profil !== null)
                            src={{ asset('foto-profil'.'/'.$data->foto_profil) }}
                        @else
                            src={{ asset('assets/images/pp-placeholder.png') }}
                        @endif
                        alt="Foto Profil Warga"
                        id="foto_profil"
                        class="w-full h-full object-cover prose-none my-0 cursor-pointer"
                        />
                        <div class="absolute bottom-2 right-2 flex gap-2">
                            @if ($data->foto_profil !== null)
                            <input type="hidden" id="delete_foto_profil" name="delete_foto_profil">
                            <button id="button_delete_profil" type="button" type="button" class="btn btn-sm btn-sm btn-square bg-base-200 bg-clip-padding backdrop-filter backdrop-blur-sm bg-opacity-20 border-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </button>
                            @endif
                            <button id="button_edit_profil" type="button" class="btn btn-sm btn-sm btn-square bg-base-200 bg-clip-padding backdrop-filter backdrop-blur-sm bg-opacity-20 border-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <input type="file" id="input_foto_profil" name="foto_profil" class="file-input file-input-bordered w-full hidden" accept="image/png, image/gif, image/jpeg"/>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Nama <span class="text-red-400">*</span></span>
                    </label>
                    <input type="text" name="nama" class="input input-sm input-bordered w-full" value="{{ $data->nama }}" required/>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Nomor Kartu Keluarga <span class="text-red-400">*</span></span>
                    </label>
                    <input type="number" name="nomor_kk" class="input input-sm input-bordered w-full" value="{{ $data->nomor_kk }}" required/>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">NIK <span class="text-red-400">*</span></span>
                    </label>
                    <input type="number" name="nik" class="input input-sm input-bordered w-full" value="{{ $data->nik }}" required/>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Email <span class="text-red-400">*</span></span>
                    </label>
                    <input type="hidden" name="email" value="{{ $data->email }}">
                    <input type="email" class="input input-sm input-bordered w-full" value="{{ $data->email }}" disabled/>
                </div>  
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">No Telepon <span class="text-red-400">*</span></span>
                    </label>
                    <input type="number" name="nomor_telepon" class="input input-sm input-bordered w-full" value="{{ $data->nomor_telepon }}" required/>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Tempat Lahir <span class="text-red-400">*</span></span>
                    </label>
                    <input type="text" name="tempat_lahir" class="input input-sm input-bordered w-full" value="{{ $data->tempat_lahir }}" required/>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Tanggal Lahir <span class="text-red-400">*</span></span>
                    </label>
                    <input type="date" name="tanggal_lahir" class="input input-sm input-bordered w-full" value="{{ $data->tanggal_lahir }}" required/>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-semibold">Jenis Kelamin <span class="text-red-400">*</span></span>
                    </label>
                    <div class="flex gap-4">
                        <label class="label cursor-pointer justify-start gap-2">
                            <input type="radio" name="jenis_kelamin" value="l" class="radio radio-sm checked:bg-blue-500" {{ $data->jenis_kelamin === 'l' ? 'checked' : '' }} required/>
                            <span class="label-text">Laki-laki</span> 
                        </label>
                        <label class="label cursor-pointer justify-start gap-2">
                            <input type="radio" name="jenis_kelamin" value="p" class="radio radio-sm checked:bg-pink-500" {{ $data->jenis_kelamin === 'p' ? 'checked' : '' }} required/>
                            <span class="label-text">Perempuan</span> 
                        </label>    
                    </div>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Kewarganegaraan <span class="text-red-400">*</span></span>
                    </label>
                    <select name="kewarganegaraan" class="select select-sm select-bordered" required>
                        <option disabled selected>Pilih salah satu</option>
                        <option value="wni"  {{ $data->kewarganegaraan == 'wni' ? 'selected' : '' }}>WNI</option>
                        <option value="wna" {{ $data->kewarganegaraan == 'wna' ? 'selected' : '' }}>WNA</option>
                    </select>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Agama <span class="text-red-400">*</span></span>
                    </label>
                    <select name="agama" class="select select-sm select-bordered" required>
                        <option disabled selected>Pilih salah satu</option>
                        <option value="islam" {{ $data->agama == 'islam' ? 'selected' : '' }}>Islam</option>
                        <option value="kristen_protestan" {{ $data->agama == 'kristen_protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                        <option value="kristen_katolik" {{ $data->agama == 'kristen_katolik' ? 'selected' : '' }}>Kristen Katolik</option>
                        <option value="hindu" {{ $data->agama == 'hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="buddha" {{ $data->agama == 'buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="konghucu" {{ $data->agama == 'konghucu' ? 'selected' : '' }}>Konghucu</option>
                    </select>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Pendidikan Terakhir <span class="text-red-400">*</span></span>
                    </label>
                    <select name="pendidikan_terakhir" class="select select-sm select-bordered" required>
                        <option disabled selected>Pilih salah satu</option>
                        <option value="sd" {{ $data->pendidikan_terakhir == 'sd' ? 'selected' : '' }}>SD (Sederajat)</option>
                        <option value="smp" {{ $data->pendidikan_terakhir == 'smp' ? 'selected' : '' }}>SMP (Sederajat)</option>
                        <option value="sma" {{ $data->pendidikan_terakhir == 'sma' ? 'selected' : '' }}>SMA (Sederajat)</option>
                        <option value="diploma" {{ $data->pendidikan_terakhir == 'diploma' ? 'selected' : '' }}>Diploma (D1/D2/D3)</option>
                        <option value="sarjana" {{ $data->pendidikan_terakhir == 'sarjana' ? 'selected' : '' }}>Sarjana (S1)</option>
                        <option value="magister" {{ $data->pendidikan_terakhir == 'magister' ? 'selected' : '' }}>Magister (S2)</option>
                        <option value="doktor" {{ $data->pendidikan_terakhir == 'doktor' ? 'selected' : '' }}>Doktor (S3)/option>
                    </select>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Status <span class="text-red-400">*</span></span>
                    </label>
                    <select name="status" class="select select-sm select-bordered" required>
                        <option disabled selected>Pilih salah satu</option>
                        <option value="belum_menikah" {{ $data->status == 'belum_menikah' ? 'selected' : '' }}>Belum Menikah</option>
                        <option value="menikah" {{ $data->status == 'menikah' ? 'selected' : '' }}>Menikah</option>
                        <option value="cerai_hidup" {{ $data->status == 'cerai_hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                        <option value="cerai_mati" {{ $data->status == 'cerai_mati' ? 'selected' : '' }}>Cerai Mati</option>
                    </select>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Kelurahan <span class="text-red-400">*</span></span>
                    </label>
                    <input type="text" name="kelurahan" class="input input-sm input-bordered w-full" value="{{ $data->kelurahan }}" disabled/>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Kecamatan <span class="text-red-400">*</span></span>
                    </label>
                    <input type="text" name="kecamatan" class="input input-sm input-bordered w-full" value="{{ $data->kecamatan }}" disabled/>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">RT <span class="text-red-400">*</span></span>
                    </label>
                    <input type="number" name="rt" class="input input-sm input-bordered w-full" value="{{ $data->rt }}" disabled/>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">RW <span class="text-red-400">*</span></span>
                    </label>
                    <input type="number" name="rw" class="input input-sm input-bordered w-full" value="{{ $data->rw }}" disabled/>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Nomor Rumah <span class="text-red-400">*</span></span>
                    </label>
                    <input type="number" name="nomor_rumah" class="input input-sm input-bordered w-full" value="{{ $data->nomor_rumah }}" required/>
                </div>
                <div class="md:col-span-2 flex gap-2">
                    <a href="{{ url()->previous() }}" class="btn btn-sm">Cancel</a>
                    <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
        <div class="col-span-1 bg-base-100 p-6 rounded-xl shadow-xl flex flex-col justify-center gap-2 h-[260px]">
            <div class="mb-8">
                <span class="font-semibold">Created At</span>
                <p>{{ $data->created_at->diffForHumans() }}</p>
            </div>
            <div>
                <span class="font-semibold">Updated At</span>
                <p>{{ $data->updated_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>
</section>
<script>
    document.getElementById('button_edit_profil').addEventListener('click', function() {
        document.getElementById('input_foto_profil').click();
    });

    document.getElementById('input_foto_profil').addEventListener('change', function(e) {
        let file = e.target.files[0];
        let reader = new FileReader();

        reader.onload = function() {
            document.getElementById('foto_profil').setAttribute('src', reader.result);
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            document.getElementById('foto_profil').setAttribute('src', '../../../assets/images/pp-placeholder.png');
        }
    });

    document.getElementById('button_delete_profil').addEventListener('click', function() {
        document.getElementById('foto_profil').src = '../../../assets/images/pp-placeholder.png';
        document.getElementById('delete_foto_profil').value = '1';
    });

</script>
@endsection