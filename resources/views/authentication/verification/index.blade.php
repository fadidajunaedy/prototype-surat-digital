@extends('authentication.template')
@section('content')
<section class="min-h-screen w-full bg-base-200 flex flex-col justify-center items-center prose-sm">
    @if (session('success'))
        <img 
        src={{ asset('assets/images/email-verification.png') }}
        alt="Hero Image"
        class="max-w-md"
        />
        <h1 class="font-semibold max-w-xl text-center">
            {{ session('success') }}
        </h1>
        <a href="{{ route('verification.resend') }}" class="btn btn-primary">Kirim ulang</a>
    @endif
    @if (session('success-resend'))
        <img 
        src={{ asset('assets/images/email-verification.png') }}
        alt="Hero Image"
        class="max-w-md"
        />
        <h1 class="font-semibold max-w-xl text-center">
            {{ session('success-resend') }}
        </h1>
        <a href="{{ route('verification.resend') }}" class="btn btn-primary">Kirim ulang</a>
    @endif
</section>
@endsection