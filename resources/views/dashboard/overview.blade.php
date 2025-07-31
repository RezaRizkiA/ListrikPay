@extends('dashboard.layout')

@section('dashboard-content')
{{-- Di sinilah logika untuk menampilkan komponen yang berbeda --}}
@if(auth()->user()->id_level != 3)
@livewire('overview-livewire')
@else
@livewire('pelanggan.dashboard-overview')
@endif
@endsection