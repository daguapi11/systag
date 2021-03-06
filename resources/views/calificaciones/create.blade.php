@extends('layouts.layout')
@section('title', ' Notas |')

@push('styles')
<link href="{{asset('css/select2.min.css')}}" rel="stylesheet">
<link href="{{asset('css/select2-bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{asset('css/invalidated.css')}}" rel="stylesheet">

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
    input[type=number] { -moz-appearance:textfield; }
</style>
@endpush

@section('content')

<main class="c-main">
<div class="container-fluid">
    <div class="fade-in">
        @include('partials.errors')
        <div class="card c-callout bg-light c-callout-primary shadow-lg ">
            <div class="card-header bg-primary">
                <font class=" text-light font-weight-bold "> <i class="font-weight-bold  fas fa-user  mr-3"></i> ESTUDIANTE </font>
            </div>
            <div class="card-body ">
                <form class="form-horizontal"  method="POST"  action="{{ route('calificaciones.store')}}" onsubmit="return checkSubmit();">
                    @csrf
                    <div class="row">
                        <div class="card col-lg-5 shadow-sm bg-light shadow-sm">
                            <div class="form-group ">
                                <label for="periodacademico_id" class="col-form-label font-weight-bold text-muted  small">PERIODO ACADÉMICO</label>
                                <div class="input-group">
                                    <select name="periodacademico_id" id="periodacademico_id" class="form-control  @error('periodacademico_id') is-invalid @enderror"  onchange="calificacionPeriodo();" required>
                                        <option value="" class="form-control  "> == Seleccionar == </option>
                                        @foreach ($periodacademicos as $periodacademico)
                                        <option  value="{{$periodacademico->id}}"
                                            {{old('periodacademico_id')==$periodacademico->id ? 'selected' : '' }}
                                            >{{$query.''.$periodacademico->periodo}}</option>
                                        @endforeach
                                    </select>
                                    @error ('periodacademico_id') <span class="invalid-feedback" role="alert"> <strong>{{$message}}</strong></span> @enderror
                                    <div class="input-group-prepend "><span class=" input-group-text">
                                        <i class=" text-primary fas fa-calendar-check"></i></span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col"></div>
                        <div class="card col-lg-6 shadow-sm bg-light shadow-sm">
                            <div class="form-group">
                                <label for="asignacione_id" class="col-form-label font-weight-bold text-muted small"> CARRERA | PERIODO | SECCIÓN | PARALELO  </label>
                                <div class="input-group">
                                    <select name="asignacione_id" id="asignacione_id" class=" form-control @error('asignacione_id') is-invalid @enderror" onchange="calificacionAsignacion();" required>
                                        {{-- <option class="form-control" value=""> == Seleccionar == </option> --}}
                                    </select>
                                    <div class="input-group-prepend "><span class=" input-group-text">
                                        <i class=" text-primary fas fa-layer-group"></i></span></div>
                                    @error ('asignacione_id') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span></em> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card  col-lg-5 shadow-sm bg-light shadow-sm">
                            <div class="form-group">
                                <label for="asignacione_id" class="col-form-label font-weight-bold text-muted small">ASIGNATURAS
                                </label>
                                <div class="input-group">
                                    <select name="asignatura_id" id="asignatura_id" class=" form-control @error('asignatura_id') is-invalid @enderror" onchange="calificacionEstudiante();" required>
                                        {{-- <option class="form-control" value=""> == Seleccionar == </option> --}}
                                    </select>
                                    <div class="input-group-prepend "><span class=" input-group-text">
                                        <i class=" text-primary fas fa-book"></i></span></div>
                                    @error ('asignatura_id') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span></em> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col"></div>
                        <div class="card col-lg-6 shadow-sm bg-light shadow-sm">
                            <div class=" form-group">
                                <label for="matricula_id" class="col-form-label font-weight-bold text-muted small">ESTUDIANTES
                                </label>
                                <div class="input-group">
                                    <select name="estudiante_id" id="matricula_id" class=" form-control @error('estudiante_id') is-invalid @enderror" required>
                                        {{-- <option class="form-control" value=""> == Seleccionar == </option> --}}
                                    </select>
                                    <div class="input-group-prepend "><span class=" input-group-text">
                                        <i class=" text-primary fas fa-user"></i></span></div>
                                    @error ('estudiante_id') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span></em> @enderror
                                </div>
                            </div>
                        </div>
                        <em class="text-dark "> Registro de notas permitido hasta 15 posterior de la fecha de suspensión establecida en el horario</em>
                    </div>
            </div>
        </div>

            <div class="card ">

                <div class="card-header bg-primary  ">
                    <font class=" text-light font-weight-bold  "> <i class="font-weight-bold  fas fa-star  mr-3"></i> REGISTRO DE NOTAS </font>
                </div>

                <div class="card-body ">
                <div class="card shadow-sm">
                    <div class="row m-2">
                        <div class="col-lg-3 " >
                            <div class="c-callout c-callout-primary"><font class="small text-muted font-weight-bold">DOCENCIA</font>
                                <div class="text-value-lg">
                                    <input type="number" value="{{old( 'docencia')}}"  name="docencia" id="docencia"  class="form-control  @error('docencia') is-invalid @enderror "
                                    step="0.01" oninput="calcular()" onkeyup="vDocencia();" required min="0" max="10">
                                @error ('docencia') <span class="invalid-feedback" role="alert"> <small><em>{{$message}}</span> </em></small> @enderror
                                </div>
                                <em id="ms-docencia" class="text-danger small" > </em>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="c-callout c-callout-primary"><font class="small text-muted font-weight-bold">EXPERIMENTO APLICACIÓN</font>
                                <div class="text-value-lg">
                                    <input type="number" value="{{old( 'experimento_aplicacion')}}"  name="experimento_aplicacion" id="experimento_aplicacion" oninput="calcular()" class="form-control @error('experimento_aplicacion') is-invalid @enderror"
                                    step="0.01" onkeyup="vExperiment();" required min="0" max="10">
                                @error ('experimento_aplicacion') <span class="invalid-feedback" role="alert"> <em class="small">{{$message}}</span> </em> @enderror
                                </div>
                                <em id="ms-experimento" class="text-danger small" > </em>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="c-callout c-callout-primary"><font class="small text-muted font-weight-bold">TRABAJO AUTÓNOMO</font>
                                <div class="text-value-lg">
                                    <input type="number" value="{{old( 'trabajo_autonomo')}}"  name="trabajo_autonomo" id="trabajo_autonomo" oninput="calcular()" class="form-control @error('trabajo_autonomo') is-invalid @enderror" step="0.01"
                                    onkeyup="vTrabajo();" required min="0" max="10">
                                @error ('trabajo_autonomo') <span class="invalid-feedback" role="alert"> <em class="small">{{$message}}</span> </em> @enderror
                                </div>
                                <em id="ms-trabajo" class="text-danger small" > </em>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="c-callout c-callout-primary"><font class="small text-muted font-weight-bold">EXAMEN PRINCIPAL</font>
                                <div class="text-value-lg">
                                    <input type="number" value="{{old('examen_principal')}}" name="examen_principal" id="examen_principal" oninput="calcular()" class="form-control @error('examen_principal') is-invalid @enderror " step="0.01"
                                    onkeyup="vExamen();" required min="0" max="10">
                                @error ('examen_principal') <span class="invalid-feedback" role="alert"> <em class="small">{{$message}}</span> </em> @enderror
                                </div>
                                <em id="ms-examen" class="text-danger small" > </em>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="row m-2">
                        <div class="col-lg-3">
                            <div class="c-callout c-callout-info"><font class="small text-muted font-weight-bold">SUMA</font>
                                <div class="text-value-lg">
                                    <input type="number" value="{{old('suma')}}" name="suma" id="suma" class="form-control @error('suma') is-invalid @enderror text-info bg-light" readonly step="0.01">
                                    @error ('suma') <span class="invalid-feedback" role="alert"> <em class="small">{{$message}}</span> </em> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="c-callout c-callout-info"><font class="small text-muted font-weight-bold">PROMEDIO EN DECIMALES</font>
                                <div class="text-value-lg">
                                    <input type="decimal" value="{{old('promedio_decimal')}}"  name="promedio_decimal" id="promedio_decimal" class="form-control @error('promedio_decimal') is-invalid @enderror text-info bg-light" readonly step="0.01">
                                    @error ('promedio_decimal') <span class="invalid-feedback" role="alert"> <em class="small">{{$message}}</span> </em> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="c-callout c-callout-info"><font class="small text-muted font-weight-bold">PROMEDIO FINAL (entero)</font>
                                    <div class="text-value-lg">
                                        <input type="number" value="{{old('promedio_final')}}"   name="promedio_final" id="promedio_final" class="form-control @error('promedio_final') is-invalid @enderror text-info bg-light" readonly step="0.01">
                                    @error ('promedio_final') <span class="invalid-feedback" role="alert"> <em class="small">{{$message}}</span> </em> @enderror
                                    </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="c-callout c-callout-info"><font class="small text-muted font-weight-bold">PROMEDIO EN LETRAS</font>
                                    <div class="text-value-lg">
                                        <input type="text" value="{{old('promedio_letra')}}" name="promedio_letra" id="promedio_letra" class="form-control @error('promedio_letra') is-invalid @enderror text-info bg-light " readonly>
                                    @error ('promedio_letra') <span class="invalid-feedback" role="alert"> <em class="small">{{$message}}</span> </em> @enderror
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm">
                    <div class="row m-2">
                        <div class="col-lg-3">
                            <div class="c-callout c-callout-info"><font class="small text-muted font-weight-bold">NÚMERO DE HORAS</font>
                                <div class="text-value-lg">
                                    <input type="text" value="{{old('numero_asistencia')}}" name="numero_asistencia" id="numero_horas" class="form-control @error('numero_asistencia') is-invalid @enderror" readonly >
                                @error ('numero_asistencia') <span class="invalid-feedback" role="alert"> <em class="small">{{$message}}</span> </em> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="c-callout c-callout-primary"><font class="small text-muted font-weight-bold">PORCENTAJE ASISTENCIA</font>
                                <div class="text-value-lg">
                                    <input type="number" value="{{old('porcentaje_asistencia')}}" name="porcentaje_asistencia" id="porcentaje_asistencia" class="form-control @error('porcentaje_asistencia') is-invalid @enderror"
                                    onkeyup="vPorcentaje();" required min="0" max="100">
                                @error ('porcentaje_asistencia') <span class="invalid-feedback" role="alert"><em class="small">{{$message}}</span> </em> @enderror
                                </div>
                                <em id="ms-porcentaje" class="text-danger small" > </em>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="c-callout c-callout-info"><font class="small text-muted font-weight-bold">OBSERVACIÓN</font>
                                <div class="text-value-lg">
                                    <input type="text" value="{{old('observacion')}}"  name="observacion" id="observacion"   class="form-control @error('observacion') is-invalid @enderror text-info bg-light" readonly>
                                @error ('observacion') <span class="invalid-feedback" role="alert"> <em class="small">{{$message}}</span> </em> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer border-0 d-flex justify-content-between aling-items-end bg-light">
            <button class=" col-sm-2 border btn btn-primary" type="submit">Guardar</button>
            <a class=" btn  col-sm-2 border  btn-dark " href="{{route('calificaciones.index')}}">Cancelar</a>
            </div>
        </form>

    </div>

    </div>
</div>
</main>


@push('scripts')
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
<script src="{{asset('js/select2.full.min.js')}}"></script>
<script src="{{asset('js/validateCalificacion.js')}}"></script>
<script>


// calcula el promedio de notas

function calcular(){

    docencia=document.getElementById('docencia').value;
    experimento_aplicacion=document.getElementById('experimento_aplicacion').value;
    trabajo_autonomo=document.getElementById('trabajo_autonomo').value;
    examen_principal=document.getElementById('examen_principal').value;

    var total=parseFloat(docencia)+parseFloat(experimento_aplicacion)+parseFloat(trabajo_autonomo);
    total=parseFloat(total).toFixed(2)
    document.getElementById("suma").value = total;

  promedio=parseFloat(total).toFixed(2) / 3;
  promedio=parseFloat(promedio).toFixed(2)
  document.getElementById("promedio_decimal").value = promedio;


  promedio_final=(Number(promedio)+Number(examen_principal))/2;

  promedio_final=parseFloat(promedio_final).toFixed(0);

  if (total>0){
    document.getElementById("promedio_final").value = parseFloat(promedio_final).toFixed(2);
    document.getElementById("promedio_letra").value = Unidades(parseInt(promedio_final));
  }

  if (promedio_final<7){
    document.getElementById("observacion").value='SUSPENSO';
  }else{
   document.getElementById("observacion").value="APROBADO";
  }
  if(promedio_final==10){
    document.getElementById("observacion").value="EXONERADO";
  }

  if(promedio_final<=2){
    document.getElementById("observacion").value="REPROBADO";
  }

}

//-------------------------------------------//
function Unidades(num){

 switch(num)
 {
   case 0: return "CERO";
   case 1: return "UNO";
   case 2: return "DOS";
   case 3: return "TRES";
   case 4: return "CUATRO";
   case 5: return "CINCO";
   case 6: return "SEIS";
   case 7: return "SIETE";
   case 8: return "OCHO";
   case 9: return "NUEVE";
   case 10: return "DIEZ";
 }

 return "";
}

calificacionPeriodo();

function calificacionPeriodo(){
    var asignaciones = document.getElementById("asignacione_id");
    for (let i = asignaciones.options.length; i >= 0; i--) {
        asignaciones.remove(i);
    }
    var id = document.getElementById('periodacademico_id').value;
    if(id){
        axios.get('/getAsignacionescal/'+id)
        .then((resp)=>{
            var asignaciones = document.getElementById("asignacione_id");
            for (i = 0; i < Object.keys(resp.data).length; i++) {
            var option = document.createElement('option');
            option.value = resp.data[i].id;
            option.text = resp.data[i].nombre+' | '+resp.data[i].nombrePeriodo+' | '+resp.data[i].nombreSeccion+' | '+resp.data[i].nombreParalelo;
            if(resp.data[i].id == "{{ old("asignacione_id") }}")
            {
                option.selected= true;
            }

            asignaciones.appendChild(option);
            }
            if(Object.keys(resp.data).length==0){
                document.getElementById("asignacione_id").length  = 1
                asignaciones.options[0].value = ""
                asignaciones.options[0].text = " == Selecionar == "
            }
            calificacionAsignacion();
        })
        .catch(function (error) {console.log(error);})
      } else{
        document.getElementById("asignacione_id").length  = 1
        asignaciones.options[0].value = ""
        asignaciones.options[0].text = " == Selecionar == "
        calificacionAsignacion();
      }
}


function calificacionAsignacion(){
    var asignaturas = document.getElementById("asignatura_id");
    for (let i = asignaturas.options.length; i >= 0; i--) {
        asignaturas.remove(i);
    }
    var id = document.getElementById('asignacione_id').value;
    //console.log(id);
    if(id){
        axios.get('/getAsignaturascal/'+id)
        .then((resp)=>{
            var asignaturas = document.getElementById("asignatura_id");
            //console.log(resp.data);

            for (i = 0; i < Object.keys(resp.data).length; i++) {
            var option = document.createElement('option');
            option.value = resp.data[i].asignatura_id;
            option.text = resp.data[i].nombre;

            if(resp.data[i].asignatura_id == "{{ old("asignatura_id") }}")
                {
                    option.selected= true;
                }
            asignaturas.appendChild(option);
            }
            if(Object.keys(resp.data).length==0){
                var option = document.createElement('option');
                option.value = '';
                option.text = 'No hay datos';
                asignaturas.appendChild(option);
            }
            calificacionEstudiante();
        })
        .catch(function (error) {console.log(error);})
    }else{
        document.getElementById("asignatura_id").length  = 1
        asignaturas.options[0].value = ""
        asignaturas.options[0].text = " == Selecionar == "
        calificacionEstudiante();

    }
}


function calificacionEstudiante(){
    var estudiantes = document.getElementById("matricula_id");
    for (let i = estudiantes.options.length; i >= 0; i--) {
        estudiantes.remove(i);
    }

    //var periodos_id = document.getElementById('periodacademico_id').value;
    var asignacion_id = document.getElementById('asignacione_id').value;
    var asignatura_id = document.getElementById('asignatura_id').value;
    //console.log('/getEstudiantescal/'+periodos_id+'_'+asignacion_id+'_'+asignatura_id);
    if(asignatura_id){
        // colocar el numero_horas
        axios.get('/getNumeroHoras/'+asignatura_id)
        .then((resp)=>{
            //console.log(resp.data);
            document.getElementById('numero_horas').value = resp.data;
        })
        .catch(function (error) {console.log(error);})

        //Estudiante
        axios.get('/getEstudiantescal/'+asignacion_id+'_'+asignatura_id)
        .then((resp)=>{
            var estudiantes = document.getElementById("matricula_id");
            for (i = 0; i < Object.keys(resp.data).length; i++) {
            var option = document.createElement('option');
            option.value = resp.data[i].estudiante_id;
            option.text = resp.data[i].nombre + ' '+ resp.data[i].apellido + ' '+ resp.data[i].dni;
            if(resp.data[i].estudiante_id == "{{ old("matricula_id") }}")
                {
                    option.selected= true;
                }
            estudiantes.appendChild(option);
            }
        })
        .catch(function (error) {console.log(error);})
    }else{
        document.getElementById("matricula_id").length  = 1
        estudiantes.options[0].value = ""
        estudiantes.options[0].text = " == Selecionar == "
        //calificacionEstudiante();

    }
}

// Disable keyboard scrolling
$('input[type=number]').on('mousewheel',function(e){ $(this).blur(); });
$('input[type=number]').on('keydown',function(e) {
    var key = e.charCode || e.keyCode;
    // Disable Up and Down Arrows on Keyboard
    if(key == 38 || key == 40 ) {
	e.preventDefault();
    } else {
	return;
    }
});

//deshabilitar doble clic
login = false;
    function checkSubmit() {
        if (!login) {
            login= true;
            return true;
        } else {
            return false;
        }
    }
</script>
@endpush
@endsection
