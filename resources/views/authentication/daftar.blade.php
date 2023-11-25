@extends('authentication.template')
@section('content')
<section class="min-h-screen w-full bg-base-200 flex justify-center items-center prose-sm">
    <div class="max-w-4xl w-full mx-auto bg-base-100 grid grid-cols-1 md:grid-cols-2 overflow-hidden rounded-lg shadow-xl">
        <div class="bg-base-100 p-4">
            <img 
                src={{ asset('assets/images/hero-daftar.png') }}
                alt="Hero Image"
                class="w-full h-full object-contain prose-none my-0"
                />
        </div>
        <div class="bg-base-100 flex flex-col justify-center gap-2 py-8 px-4">
            <h1 class="font-semibold text-center">Daftar</h1>
            @include('components.alert')
            <form class="flex flex-col justify-center gap-4" method="POST" action="{{ route('daftar-user') }}">
                @csrf
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Nama</span>
                    </label>
                    <input type="text" name="nama" class="input input-bordered w-full" required />
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Email</span>
                    </label>
                    <input type="email" name="email" class="input input-bordered w-full" required />
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Password</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="password" id="password" class="input input-bordered w-full" required />
                        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Confirm Password</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="input input-bordered w-full" required />
                        <span toggle="#password_confirmation" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                </div>
                <div class="form-control w-full">
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
            </form>
            <span class="text-center">Sudah punya akun? <a href="/masuk" class="link">Masuk</a></span>
        </div>
    </div>
</section>
@endsection
