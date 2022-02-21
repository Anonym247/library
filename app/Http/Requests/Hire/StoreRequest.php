<?php
declare(strict_types=1);

namespace App\Http\Requests\Hire;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'book_id' => 'required|exists:books,id',
            'due_date' => 'required|date',
        ];
    }
}
