@extends('layouts.layout')
@section('title', ' Carrera |')
@section('content')

<main class="c-main">
<div class="container-fluid">
    <div class="fade-in">
        <div class="row  justify-content-center ">
            <div class="col-lg-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary">
                        <h4 class=" text-light"><i class="fas fa-graduation-cap  mr-3"></i> <span class="text-value">CARRERA</span> </h4>
                    </div>
                    <div class="card-body ">
                        <form class="form-horizontal" method="POST"  action="{{ route('carreras.store')}} " enctype="multipart/form-data" onsubmit="return checkSubmit();">
                            @csrf
                            <div class="card shadow-sm">
                                <div class="row m-2">
                                    <div class="form-group col-lg-5">
                                        <label for="codigo" class="col-form-label font-weight-bold text-muted">Código
                                            <span class="text-primary">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('codigo') is-invalid @enderror"
                                                name="codigo" id="codigo" value="{{old('codigo')}}" placeholder="SFD01">
                                            <div class="input-group-prepend "><span class=" input-group-text">
                                                <i class=" text-primary fas fa-qrcode"></i></span></div>
                                            @error ('codigo') <span class="invalid-feedback" role="alert"> <em> {{$message}}</span> </em> @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-7">
                                        <label for="nombre" class="col-form-label font-weight-bold text-muted">Nombre
                                            <span class="text-primary">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                                name="nombre" id="nombre" value="{{old('nombre')}}" placeholder="Nombre">
                                            <div class="input-group-prepend "><span class=" input-group-text">
                                                <i class=" text-primary fas fa-file"></i></span></div>
                                            @error ('nombre') <span class="invalid-feedback" role="alert"> <em> {{$message}}</span> </em> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-5">
                                        <label for="titulo" class="col-form-label font-weight-bold text-muted">Título de la carrera
                                            <span class="text-primary">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('titulo') is-invalid @enderror"
                                                name="titulo" id="titulo" value="{{old('titulo')}}" placeholder="Título de la carrera">
                                            <div class="input-group-prepend "><span class=" input-group-text">
                                                <i class=" text-primary fas fa-file"></i></span></div>
                                            @error ('titulo') <span class="invalid-feedback" role="alert"> <em> {{$message}}</span> </em> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label for="numero_periodo" class="col-form-label font-weight-bold text-muted">Duración en periodos
                                            <span class="text-primary">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="number" class="form-control @error('numero_periodo') is-invalid @enderror"
                                                name="numero_periodo" id="numero_periodo" value="{{old('numero_periodo')}}" placeholder="Ejemplo: 4">
                                            <div class="input-group-prepend "><span class=" input-group-text">
                                                <i class=" text-primary fas fa-table"></i></span></div>
                                            @error ('numero_periodo') <span class="invalid-feedback" role="alert"> <em> {{$message}}</span> </em> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-4">
                                        <label for="condicion" class="col-form-label font-weight-bold text-muted">Estado
                                            <span class="text-primary">*</span>
                                        </label>
                                        <div class="input-group">
                                            <select name="condicion" id="condicion" class="form-control @error('condicion') is-invalid @enderror ">
                                                <option value=""> == Selecionar == </option>
                                                <option value="1" >Activo</option>
                                                <option value="0" >Cerrado</option>
                                            </select>
                                            <div class="input-group-prepend "><span class=" input-group-text">
                                                <i class=" text-primary fas fa-lock"></i></span></div>
                                            @error ('condicion') <span class="invalid-feedback" role="alert"> <em> {{$message}}</span> </em> @enderror
                                        </div>
                                    </div>
                                    <div class="card col-lg-5 m-3 shadow-sm">
                                        <div class="form-group m-3 ">
                                            <div class="card-header ">
                                                <label for="logo" class="col-form-label font-weight-bold text-muted small"> == SELECCIONAR LOGO ==
                                                    <span class="text-primary">*</span>
                                                </label>
                                            </div>
                                            <div class="profile-header-container mt-2 ">
                                                <div class="profile-header-img d-flex justify-content-center ">
                                                    <img style="border: solid #3D9970 1px" class="imagenPrevisualizacion rounded-circle" width="113px" height="113px" id="imagenPrevisualizacion">
                                                </div>
                                                <div class="custom-file mt-2">
                                                    <input type="file" id="seleccionArchivos" aria-describedby="inputGroupFileAddon01" class="form-control  custom-file-input mt-2 @error('logo') is-invalid @enderror"
                                                    name="logo" value="{{old('logo')}}" placeholder="Logo Carrera" >
                                                    <label class="custom-file-label" for="inputGroupFile01">Seleccionar logo </label>
                                                    @error ('logo') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span> </em> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer border-0 d-flex justify-content-between aling-items-end bg-light">
                            <button class=" col-sm-3 border btn btn-primary" type="submit">Guardar</button>
                            <a class=" btn  col-sm-2 border  btn-dark " href="{{route('carreras.index')}}">Cancelar</a>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

<script>

    const $seleccionArchivos = document.querySelector("#seleccionArchivos"),
        $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");
        $seleccionArchivos.addEventListener("change", () => {
            const archivos = $seleccionArchivos.files;
            if (!archivos || !archivos.length) {
            $imagenPrevisualizacion.src = "";
            return;
            }
            const primerArchivo = archivos[0];
            const objectURL = URL.createObjectURL(primerArchivo);
            $imagenPrevisualizacion.src = objectURL;
    });

    //select con opciones estaticos
    var condicion = null;
        for(var i=0; i!=document.querySelector("#condicion").querySelectorAll("option").length; i++)
        {
            condicion = document.querySelector("#condicion").querySelectorAll("option")[i];
            if(condicion.getAttribute("value") == "{{ old("condicion") }}")
            {
                condicion.setAttribute("selected", "selected");
            }
        }

    //deshabilitar doble clic
    login = false; //Obligaremos entrar el if al primer submit
    function checkSubmit() {
        if (!login) {
            login= true;
            return true;
        } else {
            // pulsaron 2 veces el  submit
            return false;
        }
    }
</script>
@endsection
