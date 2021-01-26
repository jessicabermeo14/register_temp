@extends('layouts.app')

@section('content')
<a href="{{ route('visitantes.home') }}" class="btn btn-primary mb-3">INICIO</a>
<h1>Tu temperatura es superior a la permitida</h1>
@endsection