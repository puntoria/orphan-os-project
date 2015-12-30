<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddOrphanRequest extends Request
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
        'id'         => 'unique:orphans,id,' . $this->update_id,
        'donor_id'   => 'exists:users,id',
        'first_name' => 'required',
        'last_name'  => 'required'
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all()['data'];

        if ($data['donor_id'] == '') $data['donor_id'] = null;

        $data['update_id'] = $this->id ? $this->id : null;

        $this->getInputSource()->replace($data);

        /*modify data before send to validator*/
        return parent::getValidatorInstance();
    }
}
