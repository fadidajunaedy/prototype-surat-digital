@extends('admin.layouts.template')
@section('content')
<section class="min-h-[90vh] w-full prose-sm">
    <div class="text-sm breadcrumbs px-0 ">
        <ul class="mx-0 px-0 my-0">
          <li class="mx-0 px-0"><a href="{{ route('admin.editor') }}">Editor</a></li> 
          <li>Create</li>
        </ul>
    </div>
    <h2 class="font-semibold my-4 mb-4">Create Editor</h2>
    @include('components.alert')
    <div class="overflow-x-auto bg-base-100 p-4 rounded-xl shadow-xl max-w-xl">
        <form 
        action="{{ route('admin.editor.store') }}" 
        method="POST"
        class="grid grid-cols-2 gap-4"
        >
            @csrf
            @method('POST')
            <div class="form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Nama<span class="text-red-400">*</span></span>
                </label>
                <input type="text" name="nama" class="input input-sm input-bordered" value="{{ old('nama') }}">
            </div>
            <div class="form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Email<span class="text-red-400">*</span></span>
                </label>
                <input type="email" name="email" class="input input-sm input-bordered" value="{{ old('email') }}">
            </div>
            <div class="form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Password<span class="text-red-400">*</span></span>
                </label>
                <input type="password" name="password" class="input input-sm input-bordered" value="{{ old('password') }}">
            </div>
            <div class="form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Konfirmasi Password<span class="text-red-400">*</span></span>
                </label>
                <input type="password" name="password_confirmation" class="input input-sm input-bordered" value="{{ old('password_confirmation') }}">
            </div>
            <div class="form-control w-full">
                <label class="label">
                  <span class="label-text font-semibold">Role<span class="text-red-400">*</span></span>
                </label>
                <select name="role" class="select select-sm select-bordered">
                    <option disabled selected>Pilih salah satu</option>
                    <option value="rt" {{ old('role') == 'rt' ? 'selected' : '' }}>RT</option>
                    <option value="rw" {{ old('role') == 'rw' ? 'selected' : '' }}>RW</option>
                </select>
            </div>
            <div class="col-span-2">
                <button type="reset" class="btn btn-sm">Reset</button>
                <button type="submit" class="btn btn-sm btn-primary">Create</button>
            </div>
        </form>
    </div>
</section>
@endsection