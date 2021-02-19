<div class="modal fade" id="modal-achievement" tabindex="-1" role="dialog" aria-labelledby="modal-achievement" aria-hidden="true">
    <div class="modal-dialog modal-tertiary modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header mx-auto">
                <p class="lead mb-0 text-white">All set!</p>
            </div>
            <div class="modal-body">
                <div class="py-3 px-5 text-center">
                    <span class="modal-icon display-1 text-white"><span class="fas fa-medal"></span></span>
                    <h2 class="h3 modal-title mb-3 text-white">@yield('header')</h2>
                    <p class="mb-4 text-white">@yield('paragraph')</p>
                    <div class="progress mb-0">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center pt-0 pb-3">
                <button type="button" class="btn btn-sm btn-white text-tertiary" @yield('route')>Awesome!</button>
            </div>
        </div>
    </div>
</div>
