<div class="modal fade" id="nav-help-modal" tabindex="-1" role="dialog" aria-labelledby="help-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="help-modal-title">Trouble using the website?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <ol>
                            <li>New to our platform? <a href="{{ url('/register') }}"><u><strong>Create an account</strong></u></a>.</li>
                            <li>Already have an account? <a href="{{ url('/login') }}"><u><strong>Sign in</strong></u></a>.</li>
                            <li><a href="{{ url('/search') }}"><u><strong>Search</strong></u></a> for events in your area.</li>
                            <li>Don't miss <a href="{{ url('/') }}"><u><strong>new activity</strong></u></a> from your favourite events and users on our platform.</li>
                            <li>Do you host events? <a href="{{ url('/events/create') }}"><u><strong>Create an event</strong></u></a>.</li>
                            <li>Learn more <a href="{{ url('/about') }}"><u><strong>about us</strong></u></a>.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>