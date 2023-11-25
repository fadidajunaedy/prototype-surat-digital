@extends('authentication.template')
@section('content')
<section class="min-h-screen w-full bg-base-200 flex flex-col justify-center items-center prose-sm">
    @if (session('verified'))
        <img 
        src={{ asset('assets/images/email-verification-confirmed.png') }}
        alt="Hero Image"
        class="max-w-md"
        />
        <h1 class="font-semibold max-w-xl text-center">
            {{ session('verified') }}
        </h1>
        <p>Beralih ke halaman utama...</p>
        <script>
            setTimeout(function(){
                window.location.href ="{{ url('/') }}";
            }, 3000);
        </script>
    @endif
</section>
@endsection