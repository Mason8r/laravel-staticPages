@extends('layout')

@section('title')
Prognoza
@stop
@section('content')
<h1>Strony, które jeszcze nie płacą</h1>
<h2>Kliknij na nagłówek, aby sortować</h2>
<div class="container">

<table id="tosort" class="sorted table">
<thead>
<tr>
<th>Strona</th><th>Data rozpoczęcia płatności</th><th>Kwota z tego miesiąca</th>
<th>Kwota z ostatnich 31 dni</th>
</tr>
</thead>
@foreach ($sites as $site)
<tr>    
      <td>{{ $site->site_url }}</td>
      <td>{{ $site->monitoringUser->start_payment }}</td>
      <td>{{ $site->getForecast() }}</td>
      <td>{{ $site->getForecast(true) }}</td>
  @endforeach
</tr>
</table>

</div>
@stop