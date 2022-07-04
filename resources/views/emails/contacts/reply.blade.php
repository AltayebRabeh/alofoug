@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@endif

{!! $message !!}

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>

@endisset


{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
<br>
{{ config('app.name') }}
@endif

@endcomponent
