@extends('admin.layouts.template')
@section('content')
<section class="min-h-[90vh] w-full prose-sm">
    <div class="text-sm breadcrumbs px-0 ">
        <ul class="mx-0 px-0 my-0">
          <li class="mx-0 px-0"><a href="{{ route('admin.pengajuan') }}">Pengajuan</a></li> 
          <li>Create</li>
        </ul>
    </div>
    <h2 class="font-semibold my-4 mb-4">Create Pengajuan</h2>
    @include('components.alert')
    <div class="overflow-x-auto bg-base-100 p-4 rounded-lg shadow-xl max-w-xl">
        <form 
        action="{{ route('admin.pengajuan.store') }}" 
        method="POST"
        class="grid grid-cols-1 gap-4"
        >
            @csrf
            @method('POST')
            <div class="form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">ID Warga <span class="text-red-400">*</span></span>
                </label>
                <select name="warga_id" class="select select_bordered">
                    <option disabled selected>Pilih salah satu</option>
                    @foreach ($data as $item)
                        <option value="{{ $item->id }}">{{ $item->id }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Keperluan <span class="text-red-400">*</span></span>
                </label>
                <textarea 
                name="keperluan" 
                class="textarea textarea-bordered h-24" required></textarea>
            </div>
            <div class="flex gap-2">
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Status RT <span class="text-red-400">*</span></span>
                    </label>
                    <select name="status_rt" class="select select-bordered">
                        <option disabled>Pilih salah satu</option>
                        <option value="pending">Pending</option>
                        <option value="accepted">Accepted</option>
                        <option value="declined">Declined</option>
                    </select>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Status RW <span class="text-red-400">*</span></span>
                    </label>
                    <select name="status_rw" class="select select-bordered">
                        <option disabled>Pilih salah satu</option>
                        <option value="pending">Pending</option>
                        <option value="accepted">Accepted</option>
                        <option value="declined">Declined</option>
                    </select>
                </div>
            </div>
            <div>
                <button type="reset" class="btn btn-sm">Reset</button>
                <button type="submit" class="btn btn-sm btn-primary">Create</button>
            </div>
        </form>
    </div>
</section>
@endsection