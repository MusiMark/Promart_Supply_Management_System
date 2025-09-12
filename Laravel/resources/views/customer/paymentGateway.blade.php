@if (isset($htmlCode))
    {!! $htmlCode !!}
@else
    <h1>Error Message</h1>
    <p>{{ $msg }}</p>
@endif