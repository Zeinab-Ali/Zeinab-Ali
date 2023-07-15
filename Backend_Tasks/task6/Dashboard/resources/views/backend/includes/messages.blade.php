<div class="col-12">
    @if (session()->has('success'))
        <div class="alert aert-success">{{ session()->get('success') }}</div>
    @elseif(session()->has('success'))
    <div class="alert aert-danger">{{ session()->get('error') }}</div>
    @endif
</div>