@extends('client.layouts.template')
@section('content')
@include('components.modals.confirm')
<section class="min-h-screen max-w-6xl mx-auto flex flex-col justify-center items-center gap-6 p-4 prose-sm">
    <div class="w-full grid grid-cols-2 gap-4 mt-[12vh]">
        <div class="text-sm breadcrumbs col-span-2 px-0">
            <ul class="px-0">
              <li><a href="/">Beranda</a></li> 
              <li>Data Diri</li>
            </ul>
        </div>
        <div class="col-span-2 w-full">
            @include('components.alert')

        </div>
        <div class="col-span-2 lg:col-span-1 bg-base-100 w-full p-4 rounded-lg shadow-xl">
            <h2 class="font-semibold text-center mb-4">Data Diri</h2>
            <div class="overflow-x-auto w-full">
                <table class="table">
                    <tbody>
                        <tr>
                            <th colspan="2" class=""> 
                                <div class="w-[220px] h-[220px] rounded-lg overflow-hidden shadow-lg mx-auto">
                                    <img 
                                    @if ($data->foto_profil)
                                        src={{ asset('foto-profil'.'/'.$data->foto_profil) }}
                                    @else
                                        src={{ asset('assets/images/pp-placeholder.png') }}
                                    @endif
                                    alt="Hero Image"
                                    class="w-full h-full object-cover prose-none my-0"
                                    />
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>: {{ $data->nama }}</td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>: {{ $data->nik }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: {{ $data->email }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Telepon</th>
                            <td>: {{ $data->nomor_telepon }}</td>
                        </tr>
                        <tr>
                            <th>Tempat Lahir</th>
                            <td>: {{ $data->tempat_lahir }}</td>
                        </tr>
                        @php
                            $tanggal_lahir = null;

                            if ($data->tanggal_lahir) {
                                $tanggal_lahir = \Carbon\Carbon::parse($data->tanggal_lahir)->locale('id');
                            }
                        @endphp

                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>
                                @if ($tanggal_lahir)
                                    : {{ $tanggal_lahir->isoFormat('DD MMMM YYYY') }} ({{ \Carbon\Carbon::parse($data->tanggal_lahir)->age }})
                                @else
                                    :
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>
                                @if ($data->jenis_kelamin)
                                    :  {{ $data->jenis_kelamin == 'l' ? 'Laki-laki' : 'Perempuan'}}
                                @else
                                    :
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Kewarganegaraan</th>
                            <td>: {{ strtoupper($data->kewarganegaraan) }}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>: {{ ucfirst($data->agama) }}</td>
                        </tr>
                        <tr>
                            <th>Pendidikan Terakhir</th>
                            <td>: {{ strlen($data->pendidikan_terakhir) > 3 ? ucfirst($data->pendidikan_terakhir) : strtoupper($data->pendidikan_terakhir) }}</td>
                        </tr>
                        @php
                            $status = str_replace('_', ' ', $data->status);

                        @endphp
                        <tr>
                            <th>Status</th>
                            <td>: {{ ucwords($status); }}</td>
                        </tr>
                        <tr>
                            <th>Kelurahan</th>
                            <td>: {{ $data->kelurahan }}</td>
                        </tr>
                        <tr>
                            <th>Kecamatan</th>
                            <td>: {{ $data->kecamatan }}</td>
                        </tr>
                        <tr>
                            <th>Rukun Tetangga (RT)</th>
                            <td>: {{ $data->rt }}</td>
                        </tr>
                        <tr>
                            <th>Rukun Warga (RW)</th>
                            <td>: {{ $data->rw }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Rumah</th>
                            <td>: {{ $data->nomor_rumah }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <form 
        action="{{ route('data-diri.update') }}"
        method="POST"
        enctype="multipart/form-data" 
        class="col-span-2 lg:col-span-1 bg-base-100 w-full grid grid-cols-2 gap-4 p-4 rounded-lg shadow-xl">
            @csrf
            @method('PATCH')
            <h2 class="col-span-2 font-semibold text-center">Ubah Data Diri</h2>
            <div class="col-span-2 form-control w-full h-auto">
                <div class="w-[220px] h-[220px] rounded-lg overflow-hidden shadow-lg mx-auto relative" >
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
                        <button id="button_delete_profil" type="button" type="button" class="btn btn-sm btn-square bg-base-200 bg-clip-padding backdrop-filter backdrop-blur-sm bg-opacity-20 border-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                            </svg>
                        </button>
                        @endif
                        <button id="button_edit_profil" type="button" class="btn btn-sm btn-square bg-base-200 bg-clip-padding backdrop-filter backdrop-blur-sm bg-opacity-20 border-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <input type="file" id="input_foto_profil" name="foto_profil" class="file-input file-input-bordered w-full hidden" />
            </div>
            <div class="col-span-2 md:col-span-1 form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Nama</span>
                </label>
                <input type="text" name="nama" class="input input-bordered w-full" value="{{ $data->nama }}" required/>
            </div>
            <div class="col-span-2 md:col-span-1 form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Nomor Kartu Keluarga</span>
                </label>
                <input type="number" name="nomor_kk" class="input input-bordered w-full" value="{{ $data->nomor_kk }}" required/>
            </div>
            <div class="col-span-2 md:col-span-1 form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">NIK</span>
                </label>
                <input type="number" name="nik" class="input input-bordered w-full" value="{{ $data->nik }}" required/>
            </div>
            <div class="col-span-2 md:col-span-1 form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Email</span>
                </label>
                <input type="hidden" name="email" value="{{ $data->email }}">
                <input type="email" class="input input-bordered w-full" value="{{ $data->email }}" disabled/>
            </div>  
            <div class="col-span-2 md:col-span-1 form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">No Telepon</span>
                </label>
                <input type="number" name="nomor_telepon" class="input input-bordered w-full" value="{{ $data->nomor_telepon }}" required/>
            </div>
            <div class="col-span-2 md:col-span-1 form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Tempat Lahir</span>
                </label>
                <input type="text" name="tempat_lahir" class="input input-bordered w-full" value="{{ $data->tempat_lahir }}" required/>
            </div>
            <div class="col-span-2 md:col-span-1 form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Tanggal Lahir</span>
                </label>
                <input type="date" name="tanggal_lahir" class="input input-bordered w-full" value="{{ $data->tanggal_lahir }}" required/>
            </div>
            <div class="col-span-2 md:col-span-1 form-control w-full">
                <label class="label">
                    <span class="label-text font-semibold">Jenis Kelamin</span>
                </label>
                <div class="flex gap-4">
                    <label class="label cursor-pointer justify-start gap-2">
                        <input type="radio" name="jenis_kelamin" value="l" class="radio checked:bg-blue-500" {{ $data->jenis_kelamin === 'l' ? 'checked' : '' }} required/>
                        <span class="label-text">Laki-laki</span> 
                    </label>
                    <label class="label cursor-pointer justify-start gap-2">
                        <input type="radio" name="jenis_kelamin" value="p" class="radio checked:bg-pink-500" {{ $data->jenis_kelamin === 'p' ? 'checked' : '' }} required/>
                        <span class="label-text">Perempuan</span> 
                    </label>    
                </div>
            </div>
            <div class="col-span-2 md:col-span-1 form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Kewarganegaraan</span>
                </label>
                <select name="kewarganegaraan" class="select select-bordered" required>
                    <option disabled>Pilih salah satu</option>
                    <option value="wni"  {{ $data->kewarganegaraan == 'wni' ? 'selected' : '' }}>WNI</option>
                    <option value="wna" {{ $data->kewarganegaraan == 'wna' ? 'selected' : '' }}>WNA</option>
                </select>
            </div>
            <div class="col-span-2 md:col-span-1 form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Agama</span>
                </label>
                <select name="agama" class="select select-bordered" required>
                    <option disabled selected>Pilih salah satu</option>
                    <option value="islam" {{ $data->agama == 'islam' ? 'selected' : '' }}>Islam</option>
                    <option value="kristen_protestan" {{ $data->agama == 'kristen_protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                    <option value="kristen_katolik" {{ $data->agama == 'kristen_katolik' ? 'selected' : '' }}>Kristen Katolik</option>
                    <option value="hindu" {{ $data->agama == 'hindu' ? 'hindu' : '' }}>Hindu</option>
                    <option value="buddha" {{ $data->agama == 'buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="konghucu" {{ $data->agama == 'konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
            </div>
            <div class="col-span-2 md:col-span-1 form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Pendidikan Terakhir</span>
                </label>
                <select name="pendidikan_terakhir" class="select select-bordered" required>
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
            <div class="col-span-2 md:col-span-1 form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Status</span>
                </label>
                <select name="status" class="select select-bordered" required>
                    <option disabled selected>Pilih salah satu</option>
                    <option value="belum_menikah" {{ $data->status == 'belum_menikah' ? 'selected' : '' }}>Belum Menikah</option>
                    <option value="menikah" {{ $data->status == 'menikah' ? 'selected' : '' }}>Menikah</option>
                    <option value="cerai_hidup" {{ $data->status == 'cerai_hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                    <option value="cerai_mati" {{ $data->status == 'cerai_mati' ? 'selected' : '' }}>Cerai Mati</option>
                </select>
            </div>
            <div class="col-span-2 md:col-span-1 form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Kelurahan</span>
                </label>
                <input type="text" name="kelurahan" class="input input-bordered w-full" value="{{ $data->kelurahan }}" disabled/>
            </div>
            <div class="col-span-2 md:col-span-1 form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Kecamatan</span>
                </label>
                <input type="text" name="kecamatan" class="input input-bordered w-full" value="{{ $data->kecamatan }}" disabled/>
            </div>
            <div class="col-span-2 md:col-span-1 form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">RT</span>
                </label>
                <input type="number" name="rt" class="input input-bordered w-full" value="{{ $data->rt }}" disabled/>
            </div>
            <div class="col-span-2 md:col-span-1 form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">RW</span>
                </label>
                <input type="number" name="rw" class="input input-bordered w-full" value="{{ $data->rw }}" disabled/>
            </div>
            <div class="col-span-2 md:col-span-1 form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Nomor Rumah</span>
                </label>
                <input type="number" name="nomor_rumah" class="input input-bordered w-full" value="{{ $data->nomor_rumah }}" required/>
            </div>
            <div class="col-span-2 form-control w-full col-span-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        <div class="col-span-2 bg-base-100 rounded-lg shadow-xl p-4">
            <h2 class="font-semibold mb-4">Ubah Password</h2>
            <form 
                action="{{ route('data-diri.change-password') }}"
                method="POST" 
                class="w-full grid grid-cols-3 gap-4">
                @csrf
                @method('PATCH')
                <div class="col-span-3 lg:col-span-1 form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Password Saat ini</span>
                    </label>
                    <input type="password" name="old_password" class="input input-bordered w-full" />
                </div>
                <div class="col-span-3 lg:col-span-1 form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Password Baru</span>
                    </label>
                    <input type="password" name="new_password" class="input input-bordered w-full" />
                </div>
                <div class="col-span-3 lg:col-span-1 form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Konfirmasi Password Baru</span>
                    </label>
                    <input type="password" name="new_password_confirmation" class="input input-bordered w-full" />
                </div>
                <div class="col-span-3 flex justify-end items-center gap-2">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
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
            document.getElementById('foto_profil').setAttribute('src', "");
        }
    });

    document.getElementById('button_delete_profil').addEventListener('click', function() {
        document.getElementById('foto_profil').src = "assets/images/pp-placeholder.png";
        document.getElementById('delete_foto_profil').value = '1';
    });

</script>
@endsection