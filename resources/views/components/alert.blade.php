@if (session('success'))
    <div role="alert" class="alert alert-success flex justify-between items-center mb-4">
        <span class="text-white font-semibold">{{ session('success') }}</span>
        <button type="button" onclick="this.parentElement.remove();">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6 text-white hover:text-green-200" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </button>
    </div>
@endif

@if (session('warning'))
    <div role="alert" class="alert alert-warning flex justify-between items-center mb-4">
        <span class="text-white font-semibold">{{ session('warning') }}</span>
        <button type="button" onclick="this.parentElement.remove();">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6 text-white hover:text-yellow-200" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </button>
    </div>
@endif

@if ($errors->any())
<div role="alert" class="alert alert-error flex justify-between items-center mb-4">
    <ul>
    @foreach ($errors->all() as $error)
        <li class="text-white font-semibold">{{ $error }}</li>
    @endforeach
    </ul>
    <button type="button" onclick="this.parentElement.remove();">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6 text-white hover:text-red-200" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
    </button>
</div>
@endif