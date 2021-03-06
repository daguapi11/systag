@extends('layouts.layout')
@section('title', ' Record Académico |')
@push('styles')
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet">
<link href="{{asset('css/select2-bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('content')
<main class="c-main">
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-accent-primary shadow-sm">
                    <div class="card-header bg-primary">
                        <font class=" text-light"> <i class="font-weight-bold fas fa-microchip mr-3"></i> RECORD ACADÉMICO </font>
                    </div>
                    <form action="">
                        <div class="card-body bg-light">
                            <div class="row m-2">
                                <div class="card col-lg-7 m-2 bg-light shadow-sm">
                                    <div class="form-group p-2">
                                        <label for="record_estudiante" class="text-muted font-weight-bold  small">ESTUDIANTE</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend "><span class=" input-group-text">
                                                <i class=" text-primary fas fa-user"></i></span></div>
                                                <select name="estudiante_id" id="record_estudiante" class=" form-control">
                                                    <option class="form-control" value=""> == Seleccionar == </option>
                                                    @foreach ($estudiantes as $estudiante)
                                                        <option  value="{{$estudiante->id}}"
                                                            >{{$estudiante->nombre}} {{$estudiante->apellido}} - {{$estudiante->dni}}</option>
                                                    @endforeach
                                                </select>
                                                <button class=" btn  btn-primary ml-1" type="submit" formtarget="_blank"> <i class="fas fa-print mr-2"> </i>Imprimir</button>
                                        </div>
                                    </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
@endsection
@push('scripts')
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/select2.full.min.js')}}"></script>

<script>
$(function () {
    //Inicializa Select2 Estudiantes
    $('#record_estudiante').select2({
      theme: 'bootstrap4'
    });
});

</script>
@endpush
