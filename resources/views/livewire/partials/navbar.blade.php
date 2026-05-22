<header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-transparent text-sm py-6 px-2 lg:px-5 md:fixed top-0 left-0 z-50 bg-black">
  @if (!request()->is('verify-otp*') && !request()->is('verify-account*') && !request()->is('not-accepted'))
    <nav class="max-w-[85rem] w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between">
      <a class="flex-none text-xl font-medium focus:outline-none focus:opacity-80" href="#" aria-label="Brand">
        <span class="inline-flex items-center gap-x-2 text-xl text-white font-medium uppercase">
          {{-- <img class="w-32 h-auto" src="{{ asset('images/iBroccoGreensLogo.png')}} " alt="Logo"> --}}
          {{-- iBroccoGreens --}}
        </span>
      </a>
      <div class="sm:order-3 flex items-center gap-x-2">
        <button type="button" class="sm:hidden hs-collapse-toggle relative size-7 flex justify-center items-center gap-x-2 rounded-lg bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" id="hs-navbar-alignment-collapse" aria-expanded="false" aria-controls="hs-navbar-alignment" aria-label="Toggle navigation" data-hs-collapse="#hs-navbar-alignment">
          <svg class="hs-collapse-open:hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
          <svg class="hs-collapse-open:block hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
          <span class="sr-only">Toggle</span>
        </button>
        <a href="/ibroccogreens-admin">
          <button type="button" class="py-2 px-3 uppercase inline-flex items-center gap-x-2 text-sm font-medium rounded-lg text-white shadow-sm bg-[#639e2e] hover:bg-[#c0dac1] disabled:opacity-50 disabled:pointer-events-none">
            Login
          </button>
        </a>
      </div>
      <div id="hs-navbar-alignment" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:grow-0 sm:basis-auto sm:block sm:order-2 ml-auto mr-5" aria-labelledby="hs-navbar-alignment-collapse">
        <div class="flex flex-col gap-5 mt-5 sm:flex-row sm:items-center sm:mt-0 sm:ps-5">
          <a 
            href="{{ route('home') }}" 
            class="font-medium uppercase focus:outline-none
                {{ request()->routeIs('home') ? 'text-[#639e2e]' : 'text-gray-600 hover:text-gray-400 focus:text-gray-400' }}"
            aria-current="{{ request()->routeIs('home') ? 'page' : '' }}">
            Home
          </a>

          <a 
              href="{{ route('about') }}" 
              class="font-medium uppercase focus:outline-none
                  {{ request()->routeIs('about') ? 'text-[#639e2e]' : 'text-gray-600 hover:text-gray-400 focus:text-gray-400' }}"
              aria-current="{{ request()->routeIs('about') ? 'page' : '' }}">
              About
          </a>
        </div>
      </div>
    </nav>
  @endif
</header>
