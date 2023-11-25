@extends('authentication.template')
@section('content')
<section class="min-h-screen w-full bg-base-200 flex justify-center items-center prose-sm">
    <div class="max-w-4xl w-full mx-auto bg-base-100 grid grid-cols-1 md:grid-cols-2 overflow-hidden rounded-lg shadow-xl">
        <div class="bg-base-100 p-4">
            <img 
                src={{ asset('assets/images/hero-masuk.png') }}
                alt="Hero Image"
                class="w-full h-full object-contain prose-none my-0"
                />
        </div>
        <div class="bg-base-100 flex flex-col justify-center gap-2 py-8 px-4">
            <h1 class="font-semibold text-center">Masuk</h1>
            @include('components.alert')
            <form method="POST" action="{{ route('masuk-user') }}" class="flex flex-col justify-center gap-4" >
                @csrf
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Email</span>
                    </label>
                    <input type="email" name="email" class="input input-bordered w-full" />
                </div>
                <div class="form-control w-full">
                    <label class="label">
                      <span class="label-text font-semibold">Password</span>
                    </label>
                    <input type="password" name="password" class="input input-bordered w-full" />
                </div>
                <a href="/lupa-password" class="link">Lupa Password ?</a>
                <div class="form-control w-full">
                    <button type="submit" class="btn btn-primary">Masuk</button>
                </div>
            </form>
            <span class="text-center">Belum punya akun? <a href="/daftar" class="link">Daftar</a></span>
        </div>
    </div>
</section>
@endsection