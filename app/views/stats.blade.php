@extends('layout')

@section('title')
Statystyki
@stop
@section('content')
<div class="container">
  <div class="row">
    <div class="span-3">
      <table id="noresults" class="table">
      <thead>
      <tr>
      <th>Strona</th>
      <th>Keywordsy w top10</th>
      <th>Ilość pozycjonowanych keywordów</th>
      <th>Współczynnik</th>
      </tr>
      </thead>
      @foreach ($sites as $site)
        <tr>
          <?php $topResult = $site->getTopTenResult(); ?>

          <td>{{ $site->site_url }}</td>
          <td>{{ $topResult['intt'] }}</td>
          <td>{{ $topResult['all'] }}</td>
          <td> {{ $topResult['intt'] / $topResult['all']}} </td>
        </tr>
      @endforeach
      </table>
    </div>
  </div>
</div>
@stop