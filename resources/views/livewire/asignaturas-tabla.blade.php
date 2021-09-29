<div>
    <div class="card-header  bg-light ">
            <div class="row m-2 ">
                <div class="col-lg-2 p-2">
                    <select wire:model="perPage" class="form-control" >
                        <option value="10">10 por página</option>
                        <option value="15">15 por página</option>
                        <option value="25">25 por página</option>
                    </select>
                </div>
                <div class="col"></div>
                <div class="col-lg-8  p-2">
                    <input wire:model="search"  type="text" class="form-control " placeholder="Buscar...">
                </div>
                <div class="col"></div>
                @if($search !== '')
                    <div class="col-lg-1 p-2 ">
                        <button wire:click="clear" class="btn btn-primary btn-gradient" type="button"><i class="fas fa-window-close"></i></button>
                    </div>
                @endif
            </div>
    </div>
    <div class="card-table  table-responsive">
        <table class="table table-hover  table-bordered align-middle">
            <thead class="thead-light">
                <tr>
                    <th class="text-center align-middle"><font>Nro</font></th>
                    <th class="align-middle"><font>Carrera</font></th>
                    <th class="align-middle"><font>Periodo</font></th>
                    <th class="align-middle"><font>Código</font></th>
                    <th class="align-middle"><font>Nombre</font></th>
                    <th class="align-middle"><font>Horas</font></th>
                    <th class="text-center"><font>Acción</font></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($asignaturas as $asignatura)
                <tr>
                <td class="text-center align-middle" >{{$asignatura->id}} </td>
                <td class="align-middle">{{$asignatura->carrera->nombre}} </td>
                <td class="align-middle">{{$asignatura->periodo->nombre}} </td>
                <td class="align-middle">{{$asignatura->cod_asignatura}} </td>
                <td class="align-middle">{{$asignatura->nombre}} <br> <span class="text-muted small"> PREREQUISITOS | {{($asignatura->prerequisitos) ? $asignatura->prerequisitos : 'Ninguno' }} </span> </td>
                <td class="align-middle">{{$asignatura->cantidad_hora}} </td>


                <td class="align-middle">
                    <div class=" form-inline justify-content-center px-4 ">
                        @can('update', $asignatura)
                            <a class=" btn btn-sm   btn-primary mr-3 mt-2" href="{{route('asignaturas.edit', $asignatura)}}"><i class="fas fa-pencil-alt"></i></a>
                        @endcan

                        @can('delete', $asignatura)
                            <form class="mr-3 mt-2 " method="POST"
                                action="{{route('asignaturas.destroy', $asignatura )}}">
                                @csrf @method('DELETE')

                                <button class=" btn btn-sm btn-danger"
                                    onclick="return confirm('¿Estas Seguro de Eliminar?.')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        @endcan
                    </div>
                </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer bg-light border-0 align-middle">
        @if($asignaturas->count())
            <nav class="d-flex justify-content-end mt-2">
                {{ $asignaturas->links() }}
            </nav>
        @else
            <div class="m-1 p-2 ">
                <em class=" text-muted">No hay resultados para la búsqueda "{{$search}}" en la página {{$page}} al mostrar {{$perPage}} por página.</em>
            </div>
        @endif
    </div>
</div>

