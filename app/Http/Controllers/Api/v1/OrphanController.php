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

        return response()->json([
            'data' => $this->prepareCollection($orphans)
            ], 200);
    }

    public function show($id) {
        $orphan = Orphan::with('Donor', 'Residence', 'Education', 'Family')->find($id);

        return response()->json([
            'data' => $this->prepareSingle($orphan)
            ], 200);
    }

    public function update($id, Request $request) {
        $test = '{"first_name":"Orphan 5","first_name_ar":"Ar: Orphan 5","middle_name":"Midname 5","middle_name_ar":"Ar: Midname 5","last_name":"Last name 5","last_name_ar":"Ar: Last name 5","photo":"test5.png","video":"test5.com","gender":0,"birthday":"2002-02-02","health_state":1,"donor_id":"4","has_donation":1,"id":"5","phone":"00386491234565","email":"Orphan5@orphandb.org","bank_id":"0102030405060705","national_id":"1112223334445555","family":{"no_parents":null,"parent_death":"","sisters":"","brothers":"","family_members":"","caretaker_name":"","caretaker_relation":""},"education":{"level":"5","class":null,"grades":null,"with_pay":null},"residence":{"city":"","country":"","village":"","ownership":null},"note":"Asddf gf gh 5"}';
        
        $data = json_decode($test, true);
        unset($data['id']);

        $orphan = Orphan::find($id);

        $main = $data;
        unset($main['family']);
        unset($main['education']);
        unset($main['residence']);
        // dd($data, $main);
        $orphan->update($main);
        dd($orphan->education()->create($data['education']));
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
}

