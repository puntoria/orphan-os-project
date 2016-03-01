<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddDonorRequest extends Request
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
        'id'    => 'unique:users,id,' . $this->update_id,
        'name'  => 'required',
        'email' => 'unique:users,email,' . $this->update_id,
        'username' => 'unique:users,username,' . $this->update_id
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all()['data'];

        $data['username']  = $data['email'];
        $data['update_id'] = $this->id ? $this->id : null;

        $this->getInputSource()->replace($data);

        /*modify data before send to validator*/
        return parent::getValidatorInstance();
    }
}
