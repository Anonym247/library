<?php
declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Models\Librarian;
use App\Models\Reader;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string',
            'username' => ['required', 'string', Rule::unique($this->getUsersTableName())],
            'password' => 'required|string|min:6',
        ];
    }

    /**
     * @return string
     */
    private function getUsersTableName(): string
    {
        return match ($this->get('role_id')) {
            Librarian::ROLE_ID => 'librarians',
            Reader::ROLE_ID => 'readers',
            default => 'users',
        };
    }
}
