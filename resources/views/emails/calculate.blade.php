<p>Имя: {{ $data['name'] }}</p>
<p>E-mail: {{ $data['email'] }}</p>
<p>Телефон: {{ $data['phone'] }}</p>
@if($data['comment'])
    <p>{{ $data['comment'] }}</p>
@endif
