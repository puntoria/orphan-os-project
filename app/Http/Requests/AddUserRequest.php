<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddUserRequest extends Request
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
        'username' => 'required|unique:users,username,' . $this->id,
        'password' => 'required|min:4'
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all()['data'];

        $data['id'] = \App\User::nextAvailableID();

        $this->getInputSource()->replace($data);

        /*modify data before send to validator*/
        return parent::getValidatorInstance();
    }
}
