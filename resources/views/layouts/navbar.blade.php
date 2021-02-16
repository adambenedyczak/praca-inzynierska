<nav class="navbar navbar-expand-md bg-dark navbar-dark" style="border-bottom: 1px solid #a6a6a6;">
    @auth
        <button class="navbar-toggler" id="menu-toggle">
            <span class="navbar-toggler-icon"></span>
        </button>
    @endauth


        <a class="navbar-brand ml-2" href="{{ route('home')}}">{{ config('app.name', 'Laravel') }}</a>
        
    
    @auth
        <div class="dropdown ml-auto">
            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle mr-1" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"></path>
                </svg>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('profile.show') }}" >
                    {{ __('auth.btn_edit_data') }}
                </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('auth.btn_log_out') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    @endauth
            

</nav>