<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
            <div class="d-flex align-items-center">
                <!-- Search form -->
                <form class="navbar-search form-inline" id="navbar-search-main">

                </form>
            </div>
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="media d-flex align-items-center">
                            <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                                <span class="mb-0 font-medium fw-bold">
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                        {{auth()->user()->username}}
                                    @endif</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-0">
                        <a class="dropdown-item rounded-top fw-bold" href="{{route('user.profile.show', auth()->user())}}"><span class="far fa-user-circle"></span>My Profile</a>
                        @if(\Illuminate\Support\Facades\Gate::allows('isAdmin'))
                        <a class="dropdown-item fw-bold" href="{{route('project.index')}}"><span class="fas fa-cog"></span>Project Settings</a>
                        @endif
                        <div role="separator" class="dropdown-divider my-0"></div>
                        <button type="button" id="logoutbutton" class="btn btn-danger delete"
                                data-toggle="modal"
                                data-target="#deletemodal">Logout</button>
{{--                        <a class="dropdown-item rounded-bottom fw-bold" href="/logout" ><span class="fas fa-sign-out-alt text-danger" data-toggle="modal" data-target="#deletemodal"></span>Logout</a>--}}
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<x-modal.Dmodal-master>
    @section('Dheader')
        You are about to logout of the system
    @endsection
    @section('Dparagraph')
        Are you sure you want to Log out?
    @endsection
    @section('Daction')
            action="{{route('logout')}}"
    @endsection
    @section('Dinput')

    @endsection

</x-modal.Dmodal-master>
