@extends('layouts.layout')
@section('title', ' Usuario |')
@section('content')

<main class="c-main">
<div class="container-fluid">
    <div class="fade-in">
        @include('partials.success')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-accent-primary ">
                    <div class="card-header bg-primary d-flex justify-content-between aling-items-end ">
                        <font class=" text-light align-self-center text-black vertical-align-inherit "> <i class="font-weight-bold fas fa-user-friends mr-3"></i> USUARIOS </font>
                        {{-- @can('create', $users->first()) --}}
                            <a class=" btn btn-primary " href="{{route('users.create')}}"> <i class=" font-weight-bold fas fa-plus mr-1"></i>Agregar</a>
                        {{-- @endcan  --}}
                    </div>
                    <livewire:users-tabla> </livewire:users-tabla>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
@endsection
