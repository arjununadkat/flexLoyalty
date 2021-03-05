<div class="modal fade" id="modal-warning" tabindex="-1" role="dialog" aria-labelledby="modal-warning" aria-hidden="true">
    <div class="modal-dialog modal-tertiary modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <button type="button" class="btn-close btn-close-white text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-3">
                <span class="modal-icon display-1"><span class="fas fa-envelope-open-text"></span></span>
                <h3 class="modal-title mb-3">@yield('Wheader')</h3>
                <p class="mb-4 lead">@yield('Wparagraph')</p>
                <div class="form-group px-lg-5">
                    <div class="d-flex mb-3 justify-content-center">
                        <div>
                            <button type="button" class="ms-2 btn large-form-btn btn-tertiary" data-bs-dismiss="modal" aria-label="Close">Go Back</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer z-2 mx-auto text-center">
            </div>
        </div>
    </div>
</div>
