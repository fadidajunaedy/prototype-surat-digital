@extends('admin.layouts.template')
@section('content')
<section class="min-h-[90vh] w-full prose-sm">
    <div class="text-sm breadcrumbs px-0 ">
        <ul class="mx-0 px-0 my-0">
          <li class="mx-0 px-0"><a href="{{ route('admin.kk') }}">Kartu Keluarga</a></li> 
          <li>Create</li>
        </ul>
    </div>
    <h2 class="font-semibold my-4 mb-4">Create Kartu Keluarga</h2>
    @include('components.alert')
    <div class="overflow-x-auto bg-base-100 p-4 rounded-xl shadow-xl max-w-xl">
        <form 
        action="{{ route('admin.kk.store') }}" 
        method="POST"
        class="grid grid-cols-1 gap-4"
        >
            @csrf
            @method('POST')
            <div class="form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Nomor Kartu Keluarga<span class="text-red-400">*</span></span>
                </label>
                <input type="number" name="nomor_kk" class="input input-sm input-bordered" value="{{ old('nomor_kk') }}">
            </div>
            <div class="form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Nama Kepala<span class="text-red-400">*</span></span>
                </label>
                <input type="text" name="nama_kepala" class="input input-sm input-bordered" value="{{ old('nama_kepala') }}">
            </div>
            <div>
                <button type="reset" class="btn btn-sm">Reset</button>
                <button type="submit" class="btn btn-sm btn-primary">Create</button>
            </div>
        </form>
    </div>
</section>
@endsection