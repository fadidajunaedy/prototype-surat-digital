@extends('admin.layouts.template')
@section('content')
<section class="min-h-[90vh] w-full prose-sm">
    <div class="text-sm breadcrumbs px-0 ">
        <ul class="mx-0 px-0 my-0">
          <li class="mx-0 px-0"><a href="{{ route('admin.kk') }}">Kartu Keluarga</a></li> 
          <li class="mx-0 px-0">{{ $data->nomor_kk}}</li> 
          <li>Edit</li>
        </ul>
    </div>
    <h2 class="font-semibold my-4 mb-4">Edit Kartu Keluarga</h2>
    @include('components.alert')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="md:col-span-2 bg-base-100 p-4 rounded-xl shadow-xl">
            <form 
            action="{{ url('admin/kk/' . $data->id . '/update') }}" 
            method="POST"
            class="grid grid-cols-1 md:grid-cols-2 gap-4"
            >
                @csrf
                @method('PATCH')
                <div class="form-control w-full">
                    <label class="label">
                    <span class="label-text font-semibold">Nomor Karu Keluarga <span class="text-red-400">*</span></span>
                    </label>
                    <input 
                    type="text" 
                    name="nomor_kk"
                    class="input input-sm input-bordered" 
                    value="{{ $data->nomor_kk }}"
                    disabled
                    required
                    />
                </div>
                <div class="form-control w-full">
                    <label class="label">
                    <span class="label-text font-semibold">Nama Kepala <span class="text-red-400">*</span></span>
                    </label>
                    <input 
                    type="text" 
                    name="nama_kepala"
                    class="input input-sm input-bordered" 
                    value="{{ $data->nama_kepala }}"
                    required
                    />
                </div>
                <div class="flex gap-2">
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
@endsection