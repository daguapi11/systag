<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class MatriculaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            //'estudiante_id'     =>  ['required', 'exists:estudiantes,id'],
            'estudiante_id'     =>
                ['required', 'exists:estudiantes,id',
                    Rule::unique('matriculas')->where(function ($query) {
                        return $query->where('asignacione_id', $this->asignacione_id);
                    })
                ],
            'asignacione_id'    =>  ['required', 'exists:asignaciones,id'],
            'fecha_matricula'   =>  ['required', 'date'],
            'asignaturas'       =>  ['required', 'exists:asignaturas,id'],
            'tipo'              =>  ['required'],

        ];




        return $rules;
    }
}
