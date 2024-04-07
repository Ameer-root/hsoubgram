<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(){
        $user = User::find($this->route('user')->id);
        return Gate::allows('edit-update-profile', $user);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', Rule::unique('users')->ignore($this->user())],
            'bio' => 'nullable',
            'image' => 'sometimes|image',
            'email' => ['required', 'email', Rule::unique(User::class)->ignore($this->user())],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'lang' => 'required'
        ];
    }
}
