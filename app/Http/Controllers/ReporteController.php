<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Calificacione;
use App\Models\Convalidacione;
use App\Models\Estudiante;
use App\Models\Horario;
use App\Models\Matricula;
use App\Models\Suspenso;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
        //MATRICULAS
        public function reporteMatricula($id)
        {
            $this->authorize('view', new Matricula);
            $matricula = Matricula::findOrFail($id);

            //realizar convalidacion
            $estudiante=$matricula->estudiante_id;
            $convalidacion = Convalidacione::where('estudiante_id',$estudiante)->get();

            //dd($convalidacion->asignatura->nombre);

            $pdf = PDF::loadView('reportes.reporteMatricula',['matricula'=>$matricula, 'convalidacion'=>$convalidacion]);
            return $pdf->stream('Reporte Matricula.pdf',compact('matricula'));
        }

        // HORARIOS POR ESPECIALIDAD
        public function reporteHorarioE($dato)
        {
            $this->authorize('view', new horario);
            //revisar como pasar 2 parametros se empleo parche para recibir dos datos
            $datoNuevo=explode("_",$dato);
            $query=$datoNuevo[0];
            $queryCarrera=$datoNuevo[1];
            $horarios = Horario::
                join('asignacione_periodacademico','asignacione_periodacademico.asignacione_id','=','horarios.asignacione_id')
                ->join('asignacione_carrera','asignacione_carrera.asignacione_id','=','horarios.asignacione_id')
                ->where('asignacione_periodacademico.periodacademico_id',$query)
                ->where('asignacione_carrera.carrera_id',$queryCarrera)
                ->get();
            $pdf = PDF::loadView('reportes.reporteHorarioE',['horarios'=>$horarios])
            ->setPaper('a4', 'landscape');
            return $pdf->stream('Reporte Horario.pdf', compact('horarios'));
        }

        //CALIFICACIONES
        public function reporteCalificacion($dato)
        {
            $this->authorize('view', new Calificacione);

            $datoNuevo=explode("_",$dato);
            $asignacione_id=$datoNuevo[0];
            $queryAsignatura=$datoNuevo[1];
            //$asignacione_id=$id;
            //$queryAsignatura=1; //trim($request->get('asignatura_id'));

            $calificaciones = Calificacione::
                where('asignacione_id', $asignacione_id)
                ->where('asignatura_id', $queryAsignatura)
                ->get();

            $pdf = PDF::loadView('reportes.reporteCalificacion',['calificaciones'=>$calificaciones]);
            return $pdf->stream(' Reporte Calificacion.pdf');
        }

        //SUSPENSO
        public function reporteSuspenso($id)
        {
            $this->authorize('view', new suspenso);
            $asignacione_id=$id;
            $suspensos = Suspenso::
                where('asignacione_id',$asignacione_id)
                ->get();
            $pdf = PDF::loadView('reportes.reporteSuspenso',['suspensos'=>$suspensos]);
            return $pdf->stream('Reporte Suspenso.pdf', compact('suspensos'));
        }

        //CALIFICACION X PERIODO
        public function reporteCalificacionperiodo($id)
        {
            $datoNuevo=explode("_",$id);
        $estudiante=$datoNuevo[0];
        $periodo_id=$datoNuevo[1];

       $calificaciones=Calificacione::
        join('asignaturas','asignaturas.id','=','calificaciones.asignatura_id')
        ->where('calificaciones.estudiante_id',$estudiante)
        ->where('asignaturas.periodo_id',$periodo_id)
        ->get();

        $pdf = PDF::loadView('reportes.reporteCalificacionperiodo', ['calificaciones'=>$calificaciones])
            ->setPaper('a4', 'landscape');
        return $pdf->stream('Calificación por periodo', compact('calificaciones'));
        }


}
