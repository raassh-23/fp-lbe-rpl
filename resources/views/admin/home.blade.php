@extends('layouts.app')

@section('content')
    <div class="container">
    	<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active" aria-current="page">Admin</li>
			</ol>
		</nav>
        <h1>Admin</h1>
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <p>Selamat datang di halaman Admin, {{ Auth()->user()->name }}!</p>
        <h3>Control</h3>
        <ul>
        	<li>
        		<a href="{{ route('admin.game.list') }}">Manage games</a>
        	</li>
        </ul>
    </div>
@endsection