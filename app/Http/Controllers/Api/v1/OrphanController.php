<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use Storage;
use App\Orphan;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddOrphanRequest;

class OrphanController extends ApiController
{

    /**
     * Get all orphans
     *
     * @return JSON Response
     */
    public function index()
    {
        $orphans = Orphan::with('Donor', 'Residence')->get();

        return $this->success($this->prepareCollection($orphans));
    }

    /**
     * Get a single orphan based on the given ID
     *
     * @return JSON Response
     */
    public function show($id) 
    {
        $orphan = Orphan::with('Donor', 'Residence', 'Education', 'Family')->find($id);

        return $this->success($this->prepareSingle($orphan));
    }

    /**
     * Add a new Orphan
     *
     * @return JSON Response
     */
    public function create(AddOrphanRequest $request) 
    {
        $data = $request->all();

        $orphan = Orphan::create($data);
        $orphan->family()->create($data['family']);
        $orphan->education()->create($data['education']);
        $orphan->residence()->create($data['residence']);

        return $this->success([
            'message' => 'Orphan has been added to database.'
            ]);
    }

    /**
     * Update the Orphan with the given ID and data
     *
     * @return JSON Response
     */
    public function update($id, AddOrphanRequest $request) 
    {

        $data = $request->all();
        $orphan = Orphan::find($id);

        // Check if the ID is being updated
        if ($data['id'] != $id) {

            // If so, delete the row with the current ID
            $orphan->delete();

            // And insert a new one with the new ID
            $this->hardUpdate($data);

            return $this->success([
                'message' => 'Orphan has been updated with the new ID.',
                'updated_id' => $data['id']
                ]);
        }

        // Get the old photo so it can be deleted if a new one has been inserted
        $oldPhoto = $orphan->photo;

        $orphan->update($data);
        $orphan->family()->update($data['family']);
        $orphan->education()->update($data['education']);
        $orphan->residence()->update($data['residence']);
        $orphan->updatePhoto($oldPhoto);

        return $this->success([
            'message' => 'Orphan has been updated.'
            ]);
    }

    /**
     * Update multiple orphans' general data
     *
     * @return JSON Response
     */
    public function massUpdate(Request $request) 
    {
        $orphans = Orphan::whereIn('orphans.id', $request->orphans);

        if ($request->category != 'general') {
            $orphans = $orphans->join($request->category, 'orphans.id', '=', $request->category . '.orphan_id');
        }

        $orphans->update([$request->field => $request->value]);

        return $this->success([
            'message' => 'Orphans have been updated.'
            ]);
    }

    /**
     * Save a photo to Storage
     *
     * @return JSON Response
     */
    public function photo(Request $request) 
    {
        if($request->hasFile('photo')) {
            $photo = $request->file('photo');

            $filename = time() . uniqid() . "." . $photo->getClientOriginalExtension();

            $photo->move(storage_path('app/photos'), $filename);
            
            return $this->success([
                'message' => 'Photo has been added.',
                'photo'   => $filename
                ]);
        }
    }

    /**
     * Remove from storage the photo with the given name
     * And if it belongs to an orphan, update his
     * photo to the default one.
     *
     * @return JSON Response
     */
    public function removePhoto($photo) 
    {
        Orphan::where('photo', '=', $photo)->update(['photo' => 'default.jpg']);

        if (Storage::disk('photos')->has($photo)) {
            Storage::disk('photos')->delete($photo);

            return $this->success(['message' => 'Photo has been deleted.',]);
        }

        return $this->error(['message' => 'File does not exist!']);
    }

    /**
     * Used when changing an Orphan's ID
     *
     * @return App\Orphan
     */
    public function hardUpdate($data) 
    {
        $orphan = Orphan::create($data);
        $orphan->family()->create($data['family']);
        $orphan->education()->create($data['education']);
        $orphan->residence()->create($data['residence']);

        return $orphan;
    }

    /**
     * Get table data for a single orphan.
     *
     * @return Array
     */
    public function prepare($orphan) 
    {
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

    /**
     * Get all data for a single orphan for viewing/editing.
     *
     * @return Array
     */
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
}

