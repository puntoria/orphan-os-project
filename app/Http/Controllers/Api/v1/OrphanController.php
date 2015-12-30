<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\Orphan;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddOrphanRequest;

class OrphanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orphans = Orphan::with('Donor', 'Residence')->get();

        return $this->success($this->prepareCollection($orphans));
    }

    public function show($id) {
        $orphan = Orphan::with('Donor', 'Residence', 'Education', 'Family')->find($id);

        return $this->success($this->prepareSingle($orphan));
    }

    public function create(AddOrphanRequest $request) {
        $data = $request->all();
        $orphan = Orphan::create($data);
        $orphan->family()->create($data['family']);
        $orphan->education()->create($data['education']);
        $orphan->residence()->create($data['residence']);

        return $this->success([
            'message' => 'Orphan has been added to database.'
            ]);
    }

    public function update($id, AddOrphanRequest $request) {

        $data = $request->all();
        $orphan = Orphan::find($id);

        if ($data['id'] != $id) {
            $orphan->delete();

            $this->hardUpdate($data);

            return $this->success([
                'message' => 'Orphan has been updated with the new ID.',
                'updated_id' => $data['id']
                ]);
        }

        $orphan->update($data);
        $orphan->family()->update($data['family']);
        $orphan->education()->update($data['education']);
        $orphan->residence()->update($data['residence']);

        return $this->success([
            'message' => 'Orphan has been updated.'
            ]);
    }

    public function hardUpdate($data) {
        $orphan = Orphan::create($data);
        $orphan->family()->create($data['family']);
        $orphan->education()->create($data['education']);
        $orphan->residence()->create($data['residence']);

        return $orphan;
    }

    public function prepareCollection($collection) 
    {
        return array_map([$this, 'prepare'], $collection->toArray());
    }

    public function prepare($orphan) {
        return [
        'id'          => "<span class=\"select-row\">{$orphan['id']}</span>",
        'donor'       => isset($orphan['donor']) ? $orphan['donor']['name'] : false,
        'donation'    => $orphan['has_donation'],
        'first_name'  => $orphan['first_name'],
        'middle_name' => $orphan['middle_name'],
        'last_name'   => $orphan['last_name'],
        'city'        => $orphan['residence']['city'],
        'video'       => $orphan['video'],
        'info'        => [
        'options' => view('admin.partials.settings.orphan', ['id' => $orphan['id']])->render()
        ]
        ];
    }

    public function prepareSingle($orphan) {
        return [
        'first_name'    => $orphan->first_name,
        'first_name_ar' => $orphan->first_name_ar,

        'middle_name'    => $orphan->middle_name,
        'middle_name_ar' => $orphan->middle_name_ar,

        'last_name'    => $orphan->last_name,
        'last_name_ar' => $orphan->last_name_ar,

        'photo'        => $orphan->photo,
        'video'        => $orphan->video,
        'gender'       => $orphan->gender,
        'birthday'     => $orphan->birthday,
        'health_state' => $orphan->health_state,

        'donor_id'     => $orphan->donor_id,
        'has_donation' => $orphan->has_donation,

        'id'          => $orphan->id,
        'phone'       => $orphan->phone,
        'email'       => $orphan->email,
        'bank_id'     => $orphan->bank_id,
        'national_id' => $orphan->national_id,

        'family' => [
        'no_parents'   => (bool) $orphan->family->no_parents,
        'parent_death' => $orphan->family->parent_death,

        'sisters'        => $orphan->family->sisters,
        'brothers'       => $orphan->family->brothers,
        'family_members' => $orphan->family->family_members,

        'caretaker_name'     => $orphan->family->caretaker_name,
        'caretaker_relation' => $orphan->family->caretaker_relation
        ],

        'education' => [
        'level'    => $orphan->education->level,
        'class'    => $orphan->education->class,
        'grades'   => $orphan->education->grades,
        'with_pay' => (bool) $orphan->education->with_pay
        ],


        'residence' => [
        'city'      => $orphan->residence->city,
        'country'   => $orphan->residence->country,
        'village'   => $orphan->residence->village,
        'ownership' => (string) $orphan->residence->ownership
        ],

        'note' => $orphan->note
        ];
    }

    public function respond($data, $status = 200, $error = false) {
        return response()->json([
            'data' => $data,
            'error' => $error
            ], $status);
    }

    public function success($data) {
        return $this->respond($data, 200, false);
    }

    public function error($data) {
        return $this->respond($data, 400, true);
    }
}

