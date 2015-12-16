<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\Orphan;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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

    public function create(Request $request) {

        if (Orphan::where('id', '=', $request->data['id'])->exists()) {
            return $this->error(['message' => 'Orphan with this ID already exists.']);
        }

        $orphan = Orphan::create($request->data);
        $orphan->family()->create($request->data['family']);
        $orphan->education()->create($request->data['education']);
        $orphan->residence()->create($request->data['residence']);

        return $this->success(['message' => 'Orphan has been added to database.']);
    }

    public function update($id, Request $request) {
        $test = '{"first_name":"","first_name_ar":"","middle_name":"","middle_name_ar":"","last_name":"","last_name_ar":"","photo":"","gender":"1","birthday":"2001-01-21","video":"","health_state":"1","has_donation":"1","donor_id":"4","id":"25","phone":"","email":"","national_id":"","bank_id":"","family":{"family_members":"","brothers":"","sisters":"","no_parents":"0","parent_death":"","caretaker_name":"","caretaker_relation":""},"education":{"level":"4","class":"0","grades":"5","with_pay":"1"},"residence":{"country":"","city":"","village":"","ownership":"1"},"note":""}';

        $data = json_decode($test, true);
        unset($data['id']);
// dd($data);
        $orphan = Orphan::find($id);

        $main = $data;
        unset($main['family']);
        unset($main['education']);
        unset($main['residence']);
        // dd($data, $main);
        $orphan->update($main);
        dd($orphan->education()->create($data['education']));
        dd($orphan->education()->updateOrCreate($data['education']));
        $orphan->education->update($data['education']);

    }

    public function prepareCollection($collection) 
    {
        return array_map([$this, 'prepare'], $collection->toArray());
    }

    public function prepare($orphan) {
        return [
        'id'          => "<span class=\"select-row\">{$orphan['id']}</span>",
        'donor'       => $orphan['donor']['name'],
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
        'no_parents'   => $orphan->no_parents,
        'parent_death' => $orphan->parent_death,

        'sisters'        => $orphan->sisters,
        'brothers'       => $orphan->brothers,
        'family_members' => $orphan->family_members,

        'caretaker_name'     => $orphan->caretaker_name,
        'caretaker_relation' => $orphan->caretaker_relation
        ],

        'education' => [
        'level'    => $orphan->level,
        'class'    => $orphan->class,
        'grades'   => $orphan->grades,
        'with_pay' => $orphan->with_pay
        ],


        'residence' => [
        'city'      => $orphan->city,
        'country'   => $orphan->country,
        'village'   => $orphan->village,
        'ownership' => $orphan->ownership
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

