@extends('mainLayout')

@section('title')
Ignorowane strony
@stop
@section('content')
<nav>
	<a href="/public/">Powrót</a>
</nav>
<div class="container">
  <div class="row">
    <h1>Ignoruj stronę</h1>
    <div class="span12">
      <form method="POST">
        <label for="site_id">Id strony</label>
        <input type="text" name="site_id" /><br />
        <input type="submit" value="Ignoruj" /> 
      </form>
    </div>
  </div>
</div>
@stop