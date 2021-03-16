<div>
    @if(Session::has('status'))
        <div class="text-center">
            <div class="alert alert-success">
                {{ Session::get('status') }}
            </div>
        </div>
    @endif
</div>
