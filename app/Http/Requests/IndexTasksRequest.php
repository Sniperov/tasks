<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexTasksRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('api')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'filter' => 'nullable|string|max:255',
            'startRow' => 'nullable|integer',
            'rowsPerPage' => 'nullable|integer',
            'sortBy' => 'nullable|string|max:255',
            'descending' => 'nullable|in:true,false',
        ];
    }
}
