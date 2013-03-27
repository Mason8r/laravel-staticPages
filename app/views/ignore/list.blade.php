@extends('mainLayout')

@section('title')
Ignorowane strony
@stop
@section('content')
<nav>
<a href="/public/ignore/add">Dodaj ignorowaną stronę</a> 
</nav>

<ul>
@foreach ($sites as $site)
  <li>
   {{ $site->site_url }} {{ $site->site_id }} 
   <form style="display:inline" method="POST" action="">
    <input name="_method" type="hidden" value="delete" />
    <input type="hidden" name="site_id" value="{{ $site->site_id }}" />
    <input type="submit" value="usuń z ignorowanych" />
   </form>

  </li>
@endforeach
</ul>
@stop