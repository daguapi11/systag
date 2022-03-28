@extends('layouts.layout')
@section('title', ' Docentes |')
@section('content')

@push('styles')
<link href="{{asset('css/wizard-4/style.css')}}" rel="stylesheet">
@endpush

<main class="c-main">
<div class="container-fluid">
    <div class="fade-in">

        <div class="row justify-content-center">
            <div class="col-lg-11">
                @if ($errors->count())
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <em> Corregir <span class="font-weight-bold">{{ count($errors) }}</span> errores encontrados para continuar.</em>
                    </div>
                @endif
                <div class="card shadow-lg">
                    <div class="card-header bg-primary">
                        <h4 class=" text-light"><i class="fas fa-user mr-3"></i> <span class="text-value">DOCENTE</span> </h4>
                    </div>
                    <div class="card-body">
                        <form id="regForm"  method="POST" action="{{ route('docentes.update', $docente)}}">
                            @csrf @method('PUT')
                            <div class="tab">
                                <div class="card shadow-sm">
                                    <div class="col-lg-12 d-flex justify-content-center mt-3">
                                        <h5 class="text-dark font-weight-bold">INFORMACIÓN PERSONAL </h5>
                                    </div>
                                    <div class="card m-3 shadow-sm">
                                        <div class="row m-2">
                                            <div class="form-group col-lg-4">
                                                <label for="tipo_identificacion" class="col-form-label font-weight-bold text-muted">Tipo Documento
                                                    <span class="text-primary">*</span>
                                                </label>
                                                <div class="input-group">
                                                    <select name="tipo_identificacion" class="form-control ">
                                                        <option value="1" {{ old('tipo_identificacion', $docente->tipo_identificacion) == 1 ? 'selected' : '' }}>Cédula</option>
                                                        <option value="0" {{ old('tipo_identificacion', $docente->tipo_identificacion) == 0 ? 'selected' : '' }}>Pasaporte</option>
                                                    </select>
                                                    <div class="input-group-prepend "><span class=" input-group-text">
                                                    <i class=" text-primary fas fa-check"></i></span></div>
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-4">
                                                <label for="dni" class="col-form-label font-weight-bold text-muted">Cédula | Pasaporte
                                                    <span class="text-primary">*</span></label>
                                                <div class="input-group">
                                                    <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror" onkeyup="validar()"
                                                    name="dni" value="{{old('dni', $docente->dni)}}" placeholder=" Nro. Cédula | Pasaporte" >
                                                    <div class="input-group-prepend "><span class=" input-group-text">
                                                        <i class=" text-primary fas fa-id-card"></i></span></div>
                                                    @error ('dni') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span></em> @enderror
                                                </div>
                                                <em id="salida" class="text-danger small"></em>
                                            </div>

                                            <div id="VEnombre" class="form-group col-lg-4">
                                                <label for="nombre" class="col-form-label font-weight-bold text-muted">Nombres
                                                    <span class="text-primary">*</span></label>
                                                <div class="input-group">
                                                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                                                    name="nombre" value="{{old('nombre', $docente->nombre)}}" placeholder="Nombres">
                                                    <div class="input-group-prepend "><span class=" input-group-text">
                                                        <i class=" text-primary fas fa-user"></i></span></div>
                                                    @error ('nombre') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span></em> @enderror
                                                </div>
                                            </div>

                                            <div id="VEapellido"  class="form-group col-lg-4">
                                                <label for="apellido" class="col-form-label font-weight-bold text-muted">Apellidos
                                                    <span class="text-primary">*</span></label>
                                                <div class="input-group">
                                                    <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror"
                                                    name="apellido" value="{{old('apellido', $docente->apellido)}}" placeholder="Apellidos">
                                                    <div class="input-group-prepend "><span class=" input-group-text">
                                                        <i class=" text-primary fas fa-user"></i></span></div>
                                                    @error ('apellido') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span></em> @enderror
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-8">
                                                <label for="titulo_academico" class="col-form-label font-weight-bold text-muted">Título Académico
                                                    <span class="text-primary">*</span></label>
                                                <div class="input-group">
                                                    <input id="titulo_academico" type="text" class="form-control @error('titulo_academico') is-invalid @enderror"
                                                    name="titulo_academico" value="{{old('titulo_academico', $docente->titulo_academico)}}" placeholder="Título Académico" >
                                                    <div class="input-group-prepend "><span class=" input-group-text">
                                                        <i class=" text-primary fas fa-graduation-cap"></i></span></div>
                                                    @error ('titulo_academico') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span> </em> @enderror
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-4">
                                                <label for="abreviatura" class="col-form-label font-weight-bold text-muted">Abreviatura
                                                    <span class="text-primary">*</span></label>
                                                <div class="input-group">
                                                    <input id="abreviatura" type="text" class="form-control @error('abreviatura') is-invalid @enderror"
                                                    name="abreviatura" value="{{old('abreviatura', $docente->abreviatura)}}" placeholder="Título Académico" >
                                                    <div class="input-group-prepend "><span class=" input-group-text">
                                                        <i class=" text-primary fas fa-graduation-cap"></i></span></div>
                                                    @error ('abreviatura') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span> </em> @enderror
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-4">
                                                <label for="fecha_ingreso" class="col-form-label font-weight-bold text-muted">Fecha de Ingreso
                                                    <span class="text-primary">*</span></label>
                                                <div class="input-group">
                                                    <input id="fecha_ingreso" type="date" class="form-control @error('fecha_ingreso') is-invalid @enderror"
                                                    name="fecha_ingreso" value="{{old('fecha_ingreso', $docente->fecha_ingreso)}}" placeholder="Fecha de Ingreso" >
                                                    <div class="input-group-prepend "><span class=" input-group-text">
                                                        <i class=" text-primary fas fa-calendar"></i></span></div>
                                                    @error ('fecha_ingreso') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span> </em> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab">
                                <div class="card shadow-sm">
                                    <div class="col-lg-12 d-flex justify-content-center mt-3">
                                        <h5 class="text-dark font-weight-bold"> INFORMACIÓN DE CONTACTO </h5>
                                    </div>
                                    <div class="card m-3 shadow-sm">
                                        <div class="row m-2">
                                            <div class="form-group col-lg-6">
                                                <label for="email" class="col-form-label font-weight-bold text-muted">E-Mail
                                                    <span class="text-primary">*</span></label>
                                                <div class="input-group">
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{old('email', $docente->email)}}" placeholder="Correo electrónico" >
                                                    <div class="input-group-prepend "><span class=" input-group-text">
                                                        <i class=" text-primary fas fa-envelope"></i></span></div>
                                                    @error ('email') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span></em> @enderror
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-3">
                                                <label for="telefono_fijo" class="col-form-label font-weight-bold text-muted">Teléfono fijo</label>
                                                <div class="input-group">
                                                    <input id="telefono_fijo" type="text" class="form-control @error('telefono_fijo') is-invalid @enderror"
                                                    name="telefono_fijo" value="{{old('telefono_fijo', $docente->telefono_fijo)}}" placeholder="Teléfono fijo" >
                                                    <div class="input-group-prepend "><span class=" input-group-text">
                                                        <i class=" text-primary fas fa-phone-square"></i></span></div>
                                                    @error ('telefono_fijo') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span> </em> @enderror
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-3">
                                                <label for="telefono_movil" class="col-form-label font-weight-bold text-muted">Teléfono celular
                                                    <span class="text-primary">*</span></label>
                                                <div class="input-group">
                                                    <input id="telefono_movil" type="text" class="form-control @error('telefono_movil') is-invalid @enderror"
                                                    name="telefono_movil" value="{{old('telefono_movil', $docente->telefono_movil)}}" placeholder="Número celular">
                                                    <div class="input-group-prepend "><span class=" input-group-text">
                                                        <i class=" text-primary fas fa-mobile"></i></span></div>
                                                    @error ('telefono_movil') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span> </em> @enderror
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-3">
                                                <label for="provincia_id" class="col-form-label font-weight-bold text-muted">Provincia
                                                    <span class="text-primary">*</span></label>
                                                <div class="input-group">
                                                    <select name="provincia_id" id="provincia_id" class="form-control @error('provincia_id') is-invalid @enderror" onchange="cambia_cantones(this)" >
                                                        <option class="form-control " value=""> == Seleccionar == </option>
                                                        @foreach ($provincias as $provincia)
                                                        <option  value="{{$provincia->id}}"
                                                            {{old('provincia_id', $docente->provincia_id)==$provincia->id ? 'selected' : '' }}
                                                            >{{$provincia->provincia}}</option>
                                                            @endforeach
                                                    </select>
                                                    <div class="input-group-prepend "><span class=" input-group-text">
                                                        <i class=" text-primary fas fa-map-marker-alt"></i></span></div>
                                                    @error ('provincia_id') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span> </em> @enderror
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-3">
                                                <label for="cantone_id" class="col-form-label font-weight-bold text-muted">Cantón
                                                    <span class="text-primary">*</span></label>
                                                <div class="input-group">
                                                    <select name="cantone_id" id="cantone_id" class="form-control @error('cantone_id') is-invalid @enderror" >
                                                    </select>
                                                    <div class="input-group-prepend "><span class=" input-group-text">
                                                        <i class=" text-primary fas fa-map-marker-alt"></i></span></div>
                                                    @error ('cantone_id') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span></em> @enderror

                                                </div>
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="calle" class="col-form-label font-weight-bold text-muted">Calles
                                                    <span class="text-primary">*</span></label>
                                                <div class="input-group">
                                                    <input id="calle" type="text" class="form-control @error('calle') is-invalid @enderror"
                                                    name="calle" value="{{old('calle', $docente->calle)}}" placeholder="Calles" >
                                                    <div class="input-group-prepend "><span class=" input-group-text">
                                                        <i class=" text-primary fas fa-map-marker-alt"></i></span></div>
                                                    @error ('calle') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span></em> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab">
                                <div class="row m-2">
                                    <div class="card shadow-sm col-lg-5">
                                        <div class="form-group ">
                                            <div class="col-lg-12 d-flex justify-content-center mt-3" >
                                                <h5 class="text-dark font-weight-bold"> TIPO DE CONTRATO </h5>
                                            </div>
                                            <label for="tipocontrato_id" class="col-form-label font-weight-bold text-muted">Tipo de Contrato
                                                <span class="text-primary">*</span></label>
                                            <div class="input-group">
                                                <select name="tipocontrato_id"  class="form-control @error('tipocontrato_id') is-invalid @enderror">
                                                    <option class="form-control" value=""> == Seleccionar == </option>
                                                    @foreach ($tipocontratos as $tipocontrato)
                                                    <option  value="{{$tipocontrato->id}}"
                                                        {{old('tipocontrato_id', $docente->tipocontrato_id)==$tipocontrato->id ? 'selected' : '' }}
                                                        >{{$tipocontrato->nombre}}</option>
                                                        @endforeach
                                                </select>
                                                <div class="input-group-prepend "><span class=" input-group-text">
                                                    <i class=" text-primary fas fa-file-alt"></i></span></div>
                                                @error ('tipocontrato_id') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span></em> @enderror
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-lg-2"></div>
                                    <div class="card shadow-sm col-lg-5">
                                        <div class="form-group ">
                                            <div class="col-lg-12 d-flex justify-content-center mt-3">
                                                <h5 class="text-dark font-weight-bold"> ESTADO DEL DOCENTE </h5>
                                            </div>
                                            <label for="estado" class="col-form-label font-weight-bold text-muted">Estado
                                                <span class="text-primary">*</span>
                                            </label>
                                            <div class="input-group">
                                                <select name="estado" class="form-control ">
                                                    <option value="1" {{ old('estado', $docente->estado) == 1 ? 'selected' : '' }}>Activo</option>
                                                    <option value="0" {{ old('estado', $docente->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                                                </select>
                                                <div class="input-group-prepend "><span class=" input-group-text">
                                                <i class=" text-primary fas fa-lock"></i></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer border-0 d-flex justify-content-between aling-items-end bg-light " >

                        <button class=" col-sm-2 btn border  btn-dark " type="button" id="prevBtn" onclick="nextPrev(-1)">Anterior</button>

                        <div style="text-align:center; margin-top:8px">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                        </div>
                        <button class=" col-sm-2 btn  border  btn-primary" type="button" id="nextBtn" onclick="nextPrev(1)">Siguiente</button>

                    </div>
                </div>
            </form>
            </div>
        </div>
</div>
</main>
<script>
  cambia_cantones();

  function cambia_cantones(select){
    const docente = @json($docente);
    canton=docente.cantone_id;

    const cantones = @json($cantones);
    provincia = document.getElementById('provincia_id').value;
    const result = cantones.filter(cantones => cantones.provincia_id === Number(provincia));

    if (provincia != 0) {

        num_cantones = result.length;
        document.getElementById("cantone_id").length = num_cantones;
        for(i=0;i<num_cantones;i++){
            cantone_id.options[i].value=result[i].id;
            cantone_id.options[i].text=result[i].canton;
            cantone_id.options[i].selected= (cantone_id.options[i].value == canton) ? true : false;

            if(cantone_id.options[i].value == "{{ old("cantone_id") }}")
            {
                cantone_id.options[i].selected= true;
            }
        }
    }else{

        document.getElementById("cantone_id").length  = 1
        cantone_id.options[0].value = ""
        cantone_id.options[0].text = " == Seleccionar provincia == "
    }
}

//Validar numeros de cédula
function validar() {
    var vdate = document.getElementById("dni").value.trim();
    var total = 0;
    var longitud = vdate.length;
    var longcheck = longitud - 1;

    if (vdate !== "" && longitud === 10){
        for(i = 0; i < longcheck; i++){
        if (i%2 === 0) {
            var aux = vdate.charAt(i) * 2;
            if (aux > 9) aux -= 9;
            total += aux;
        } else {
            total += parseInt(vdate.charAt(i)); // parseInt o concatenará en lugar de sumar
            }
        }
        total = total % 10 ? 10 - total % 10 : 0;

        if (vdate.charAt(longitud-1) == total) {
        document.getElementById("salida").innerHTML = (" ");
        VEnombre.style.display='';
        VEapellido.style.display='';
        }else{
            document.getElementById("salida").innerHTML = ("Número de cédula  no válida");
            VEnombre.style.display='none';
            VEapellido.style.display='none';
        }
    }
}

</script>
@endsection

@push('scripts')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/wizard-4/main.js')}}"></script>
@endpush
