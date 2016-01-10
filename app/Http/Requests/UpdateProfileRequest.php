<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->id == $this->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'name'  => 'required',
        'email' => 'unique:users,email,' . $this->id,
        'username' => 'required|unique:users,username,' . $this->id,
        'password' => 'confirmed|min:6'
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
