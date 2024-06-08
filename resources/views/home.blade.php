@extends('layouts.app', ['headerClass' => 'home-header'])

@section('title', 'Home')

@section('content')
@auth
<p>Welcome, {{ auth()->user()->name }}</p>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
@else
<p>You are not logged in.</p>
@endauth
@endsection