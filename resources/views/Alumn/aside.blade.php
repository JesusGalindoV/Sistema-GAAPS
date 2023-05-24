<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #d2691e !important;">

    <a href="/portal" class="brand-link">

        <img src="{{ asset('img/temple/unisierra.png') }}" alt="" class="brand-image img-circle elevation-3"
            style="opacity: .8">

        <span class="brand-text font-weight-light">Archivero</span>

    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">

            <img src="{{ Croppa::url(current_user()->photo, 200,200) }}" class="user-image img-circle" >

            </div>

            <div class="info">

                <a href="{{route('alumn.user')}}" class="d-block">{{ Auth::guard('alumn')->user()->name }}</a>

            </div>

        </div>

        <nav class="mt-2">
            
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">

                    <a href="{{route('alumn.home')}}" class="nav-link">

                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Inicio
                        </p>
                    </a>

                </li>

                <li class="nav-item">

                    <a href="{{route('alumn.memorias')}}" class="nav-link" >

                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Memorias de estadía
                        </p>
                    </a>

                </li>

                {{-- @if(Auth::guard('alumn')->user()->id_alumno != null) --}}

                    <li class="nav-item">
                        <a href="{{route('alumn.user')}}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Mi cuenta
                            </p>
                        </a>
                    </li>
                
                {{-- @endif --}}

            </ul>

        </nav>

    </div>

</aside>