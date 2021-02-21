<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-info modal-dialog-centered" role="document">
        <div class="modal-content bg-gradient-secondary">
            <div class="modal-header">
                <p class="modal-title" id="modal-title-notification">@yield('header')</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="py-3 text-center">
                    <span class="modal-icon display-1-lg"><span class="far fa-envelope-open"></span></span>
                    <h2 class="h4 modal-title my-3">Warning!</h2>
                    <p>@yield('paragraph')</p>
{{--                    <input type=hidden id="user_id" name="user_id" value="">--}}
                    <input type=hidden name="_method" value="DELETE">
                </div>
            </div>
            <div class="modal-footer">
                <form method="post" action="{{route('user.destroy', 'user_id')}}" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-secondary">Yes</button>
                </form>
                <button type="button" class="btn btn-link text-gray ms-auto" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
{{--  action="{{route('user.destroy', $user->id)}}"      --}}
