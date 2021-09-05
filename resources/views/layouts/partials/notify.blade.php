<div class="success-message">
    {{ isset($icon) ? svg($icon) : svg('icon-mood-sad') }}
    {{ $message }}
</div>
