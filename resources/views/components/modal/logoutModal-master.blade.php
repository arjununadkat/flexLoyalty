<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModal" aria-hidden="true">
    <div class="modal-dialog modal-info modal-dialog-centered" role="document">
        <div class="modal-content bg-gradient-secondary">
            <div class="modal-header">
                <p class="modal-title" id="modal-title-notification">@yield('Lheader')</p>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="py-3 text-center">
                    <span class="modal-icon display-1-lg"><span class="far fa-envelope-open"></span></span>
                    <h2 class="h4 modal-title my-3">Warning!</h2>
                    <p>@yield('Lparagraph')</p>

                </div>
            </div>
            <div class="modal-footer">
                <form method="post" @yield('Laction') enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    @yield('Linput')
                    <button type="submit" class="btn btn-secondary">Yes</button>
                </form>
                <button type="button" class="btn btn-link text-gray ms-auto" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
{{--  action="{{route('user.destroy', $user->id)}}"      --}}

