<div class="success-message {{ $cssClass ?? ''  }}">
    {{ isset($icon) ? svg($icon) : svg('mood-sad') }}
    {{ $message }}
</div>
