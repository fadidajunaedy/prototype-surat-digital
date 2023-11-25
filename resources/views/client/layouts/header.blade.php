<header class="header-nav w-full prose-sm fixed bg-base-200 bg-clip-padding backdrop-filter backdrop-blur-lg bg-opacity-40">
    <div class="navbar w-full max-w-6xl mx-auto">
        <div class="navbar-start">
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
                </label>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 bg-base-100 bg-clip-padding backdrop-filter backdrop-blur-lg bg-opacity-80 rounded-box w-[94vw]">
                <li><a href="/pengajuan-surat">Pengajuan Surat</a></li>
                <li><a href="/tentang">Tentang RT 005/014</a></li>
                </ul>
            </div>
            <a class="btn btn-ghost text-xl" href="/">Surat Digital : RT 005/014</a>
        </div>
        <div class="navbar-end hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li><a href="/pengajuan-surat">Pengajuan Surat</a></li>
                <li><a href="/tentang">Tentang RT 005/014</a></li>
                @if (auth()->user())
                <li>
                  <a>
                    {{ auth()->user()->nama }}
                  </a>
                </li>
                @endif
            </ul>
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                  <div class="w-10 rounded-full">
                    <img 
                        alt="Tailwind CSS Navbar component" 
                        src={{ asset('assets/images/fadidajunaedy-photo.jpg') }}
                        class="object-cover w-full h-full my-0" />
                  </div>
                </label>
                <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                  @if (auth()->user())
                  <li>
                    <a href="/data-diri">
                      Data diri
                    </a>
                  </li>
                  @endif
                  @if (auth()->user())
                  <li>
                    <form method="POST" action="{{ url('/keluar') }}">
                      @csrf
                      <button type="submit">Keluar</button>
                    </form>
                  </li>
                  @else
                  <li>
                    <a href="{{ route('login')}}">Masuk</a>
                  </li>
                  @endif
                  
                </ul>
              </div>
          
        </div>
    </div>
</header>