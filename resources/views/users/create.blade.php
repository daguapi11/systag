@extends('layouts.layout')
@section('title', ' Usuario |')
@section('content')

<main class="c-main">
<div class="container-fluid">
    <div class="fade-in">
        <div class="row justify-content-center ">
              <div class=" col-lg-10">
                <div class="card  shadow-lg">
                    <div class="card-header bg-primary">
                        <h4 class=" text-light"><i class="fas fa-user  mr-3"></i> <span class="text-value">USUARIO</span> </h4>
                    </div>
                  <div class="card-body">
                      <div class="card shadow-sm">
                        <form method="POST"  action="{{ route('users.store')}} ">
                            @csrf
                          <div class="row m-3">
                                <div class="card shadow-sm col-lg-7 m-2">
                                    <div class="card-header"><label class="font-weight-bold text-muted">PERFIL</label></div>
                                    <div class="form-group m-1">
                                        <label for="dni" class="col-form-label font-weight-bold text-muted">Cédula | Pasaporte
                                            <span class="text-primary">*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('dni') is-invalid @enderror"
                                            name="dni" value="{{old('dni')}}" id="dni" placeholder="Nro. Cédula | Pasaporte" onkeyup="verUsuario();" onchange="verUsuario();">
                                            <div class="input-group-prepend "><span class=" input-group-text">
                                                <i class=" text-primary fas fa-id-card "></i></span></div>
                                            @error ('dni') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span></em> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group m-1">
                                        <label for="nombre" class="col-form-label font-weight-bold text-muted">Nombres
                                            <span class="text-primary">*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                            name="nombre" value="{{old('nombre')}}" id="nombre" placeholder="Nombres">
                                            <div class="input-group-prepend "><span class=" input-group-text">
                                                <i class=" text-primary fas fa-user"></i></span></div>
                                            @error ('nombre') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span></em> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group m-1">
                                        <label for="apellido" class="col-form-label font-weight-bold text-muted">Apellidos
                                            <span class="text-primary">*</span></label>
                                        <div class="input-group">
                                            <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror"
                                            name="apellido" value="{{old('apellido')}}" placeholder="Apellidos">
                                            <div class="input-group-prepend "><span class=" input-group-text">
                                                <i class=" text-primary fas fa-user"></i></span></div>
                                            @error ('apellido') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span></em> @enderror
                                        </div>
                                    </div>

                                    <div class="form-group m-1">
                                        <label for="email" class="col-form-label font-weight-bold text-muted">E-Mail
                                            <span class="text-primary">*</span></label>
                                        <div class="input-group">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{old('email')}}" placeholder="Correo electrónico" >
                                            <div class="input-group-prepend "><span class=" input-group-text">
                                                <i class=" text-primary fas fa-envelope"></i></span></div>
                                            @error ('email') <span class="invalid-feedback" role="alert"> <em>{{$message}}</span></em> @enderror
                                        </div>
                                    </div>

                                    <em class="m-3 text-info"> SYSTAG  enviará una contraseña al correo electrónico registrado</em>

                                    <div class="card-footer bg-light">
                                            <button class=" col-4 btn btn-primary" type="submit">Guardar</button>
                                    </div>
                                </div>
                                <div class="col"></div>
                                <div class="card col-lg-4 shadow-sm m-2">
                                    <div class="card-header mb-3"><label class="col-form-label font-weight-bold text-muted"> ROLES</label></div>
                                    <div class="form-group">
                                        @include('users.partials.roleCheckbox')
                                    </div>
                                </div>
                                <div class="card col-lg-7 shadow-sm mt-4 ml-2 ">
                                    <div class="card-header"><label class="col-form-label font-weight-bold text-muted"> PERMISOS</label></div>
                                    <div class="form-group ">
                                        @include('users.partials.permissionCheckbox', ['model'=>$user])
                                    </div>
                                </div>
                          </div>
                        </form>
                      </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
</main>
@endsection

@push('scripts')
<script src="{{asset('js/axios.min.js')}}"></script>
@endpush()

<script>
    function verUsuario(){
    document.getElementById('nombre').value='';
            document.getElementById('apellido').value='';
            document.getElementById('email').value='';
    var id = document.getElementById('dni').value;
    axios.get('/getUsuarios/'+id)
      .then((resp)=>{
        for (i = 0; i < Object.keys(resp.data).length; i++) {
            //console.log(resp.data[i].nombre);
            document.getElementById('nombre').value=resp.data[i].nombre;
            document.getElementById('apellido').value=resp.data[i].apellido;
            document.getElementById('email').value=resp.data[i].email;
        }
      })
      .catch(function (error) {console.log(error);})
}
</script>

