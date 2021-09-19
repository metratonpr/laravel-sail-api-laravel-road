<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $task = $this->route('task');
        return $this->user()->can('update',$task);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required',
            'description' => 'nullable|string',
            'expired_at' => 'nullable|date',
            'user_id' => 'exists:users,id',
            
        ];
    }
}
