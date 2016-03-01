<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'id'    => 'unique:users,id,' . $this->id,
        'name'  => 'required',
        'email' => 'unique:users,email,' . $this->id,
        'username' => 'required|unique:users,username,' . $this->id
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all()['data'];

        $this->getInputSource()->replace($data);

        /*modify data before send to validator*/
        return parent::getValidatorInstance();
    }
}
