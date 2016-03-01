<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use PDF;
use Storage;
use Validator;
use App\Orphan;
use App\Finance;
use App\Document;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddOrphanRequest;

class OrphanController extends ApiController
{

    public function __construct()
    {
        $this->middleware('auth.superadmin', ['except' => [
            'index', 'pdf', 'csv', 'count', 'filter', 'stats', 'massPdf', 'finances'
            ]]);
    }


    /**
     * Get all orphans
     *
     * @return JSON Response
     */
    public function index(Request $request, $filter = "data")
    {
        $orphans = Orphan::with('Finances')
        ->join('residence', 'orphans.id', '=', 'residence.orphan_id')
        ->leftJoin('users', 'orphans.donor_id', '=', 'users.id')
        ->select(['orphans.*', 'users.name as donor_name', 'residence.city']);

        $orphans = $this->manage($orphans, $request);

        $orphans = $this->filter($filter, $orphans);
        
        $orphans = $orphans->get();

        $count = $this->count($filter);

        return $this->success($this->prepareCollection($orphans), [
            'recordsTotal'    => $count,
            'recordsFiltered' => $count
            ]);
    }


    /**
     * Get a single orphan based on the given ID
     *
     * @return JSON Response
     */
    public function show($id) 
    {
        $orphan = Orphan::with('Donor', 'Residence', 'Education', 'Family', 'Documents')->find($id);

        return $this->success($this->prepareSingle($orphan));
    }


    /**
     * Generate CSV file 
     *
     * @return CSV File
     */
    public function csv() 
    {
        $orphans = Orphan::with('Residence', 'Family', 'Education', 'Donor')->get();

        app()->setLocale('ar-kw');

        $data = array_map(function($orphan) {
            $line = [];

            $line[] = $orphan['id'];
            $line[] = $orphan['donor_id'];
            $line[] = $orphan['has_donation'] == 0 ? trans('general.actions.no') : trans('general.actions.yes');
            $line[] = $orphan['first_name_ar']  . " (" . $orphan['first_name'] . ")";
            $line[] = $orphan['middle_name_ar'] . " (" . $orphan['middle_name'] . ")";
            $line[] = $orphan['last_name_ar']   . " (" . $orphan['last_name'] . ")";
            $line[] = $orphan['gender'] == 0 ? trans('general.gender.male') : trans('general.gender.female');
            $line[] = $orphan['birthday'];
            $line[] = (string) $orphan['phone'] . "\t";
            $line[] = $orphan['email'];
            $line[] = $orphan['health_state'] == 0 ? trans('general.health_state.sick') : trans('general.health_state.healthy');

            $line[] = $orphan['family']['parent_death'];
            $line[] = $orphan['family']['no_parents'] == 0 ? trans('general.actions.no') : trans('general.actions.yes');
            $line[] = $orphan['family']['caretaker_name'];
            $line[] = $orphan['family']['caretaker_relation'];
            $line[] = $orphan['family']['family_members'];
            $line[] = $orphan['family']['brothers'];
            $line[] = $orphan['family']['sisters'];

            $line[] = $orphan['residence']['country'];
            $line[] = $orphan['residence']['city'];
            $line[] = $orphan['residence']['village'];
            $line[] = $orphan['residence']['ownership'] == 0 ? trans('general.residence.with_pay') : trans('general.residence.personal');

            $line[] = $orphan['education']['level'];
            $line[] = $orphan['education']['class'] == 0 ? trans('general.education.pre_school') : $orphan['education']['class'];
            $line[] = trans("general.education.grades." . $orphan['education']['grades']);
            $line[] = $orphan['education']['with_pay'] == 0 ? trans('general.actions.no') : trans('general.actions.yes');
            $line[] = $orphan['note'];

            return $line;
        }, $orphans->toArray());

        $headings = [
        'رقم اليتيم', 'رقم الكافل', 'حالة الكفالة', 'اسم اليتيم', 'اسم الأب', 'اسم العائلة', 'الجنس',
        'تاريخ الميلاد', 'الهاتف', 'بريد الألكتروني', 'الحالة الصحية', 'تاريخ الوفات الأب', 'يتيم الأبوين', 'ولي أمر اليتيم', 'صلة القرابة',
        'عدد أفراد الأسرة', 'عدد الأخوة', 'عدد الأخوات', 'دولة', 'مدينة', 'قرية', 'الإمتلاكات', 'المستوى', 'الصف', 'النجاح', 'نوع التعليم'
        ];

        array_unshift($data, $headings);

        $csvFile = tempnam('./csv', '');
        $csv = fopen($csvFile, 'w');

        foreach ($data as $row) fputcsv($csv, $row, "\t");

        fclose($csv);

        /*header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"Orphans-List.csv\"");
        readfile($csvFile);*/

        header('Content-Encoding: UTF-8');
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename=Orphans_List.csv');
        // echo "\xEF\xBB\xBF";
        echo chr(255) . chr(254) . mb_convert_encoding(file_get_contents($csvFile), 'UTF-16LE', 'UTF-8');
        // readfile($csvFile);


        die();
    }


    /**
     * Count Orphans with the given filter
     *
     * @return Query Builder
     */
    public function count($filter) 
    {
        if ($filter == "withDonation")    return Orphan::where(['has_donation' => 1])->count();
        if ($filter == "withoutDonation") return Orphan::where(['has_donation' => 0])->count();

        return Orphan::count();
    }


    /**
     * Filter Orphans query with the given filter
     *
     * @return Query Builder
     */
    public function filter($filter, $query) 
    {
        if ($filter == "withDonation")    return $query->where(['has_donation' => 1]);
        if ($filter == "withoutDonation") return $query->where(['has_donation' => 0]);

        return $query;
    }


    /**
     * Stats for Orphans
     *
     * @return JSON Response
     */
    public function stats() 
    {
        return $this->success([
            'totalCount'           => Orphan::count(),
            'withDonationCount'    => Orphan::where(['has_donation' => 1])->count(),
            'withoutDonationCount' => Orphan::where(['has_donation' => 0])->count()
            ]);
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

        if (!empty($request->documents)) {
            $orphan->saveDocuments($request->documents);
        }

        return $this->success([
            'message' => trans('general.responses.orphan.added')
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
                'message' => trans('general.responses.orphan.updated'),
                'updated_id' => $data['id']
                ]);
        }

        // Get the old photo so it can be deleted if a new one has been inserted
        $oldPhoto = $orphan->photo;

        $orphan->update($data);
        $orphan->family()->update($data['family']);
        $orphan->education()->update($data['education']);
        $orphan->residence()->update($data['residence']);
        $orphan->updateFinances($data['finances']['list']);
        $orphan->updatePhoto($oldPhoto);

        if (!empty($request->documents)) {
            $orphan->saveDocuments($request->documents);
        }

        return $this->success([
            'message' => trans('general.responses.orphan.updated')
            ]);
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
        $orphan->updateFinances($data['finances']['list']);

        return $orphan;
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
            'message' => trans('general.responses.orphan.mass-updated')
            ]);
    }


    /**
     * Delete the Orphan with the given ID
     *
     * @return JSON Response
     */
    public function delete($id) 
    {
        Orphan::where('id', '=', $id)->delete();

        return $this->success([
            'message' => trans('general.responses.orphan.deleted')
            ]);
    }


    /**
     * Delete multiple orphans
     *
     * @return JSON Response
     */
    public function massDelete(Request $request) 
    {
        Orphan::whereIn('id', $request->orphans)->delete();

        return $this->success([
            'message' => trans('general.responses.orphan.mass-deleted')
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

            $validator = Validator::make($request->all(), ['photo' => 'image|max:4096']);

            if ($validator->fails()) {
                return $this->error(['message' => trans('general.errors.file-not-image')]);
            }

            $photo = $request->file('photo');

            $filename = time() . uniqid() . "." . $photo->getClientOriginalExtension();

            $photo->move(storage_path('app/photos'), $filename);
            
            return $this->success([
                'message' => trans('general.responses.orphan.photo-added'),
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

            return $this->success(['message' => trans('general.responses.orphan.photo-deleted')]);
        }

        return $this->error(['message' => trans('general.erros.file-not-exists')]);
    }


    /**
     * Save a document to Storage
     *
     * @return JSON Response
     */
    public function document(Request $request) 
    {
        if($request->hasFile('doc')) {
            $doc = $request->file('doc');

            $validator = Validator::make($request->all(), ['doc' => 'image|max:4096']);

            if ($validator->fails()) {
                return $this->error(['message' => trans('general.errors.file-not-image')]);
            }

            $filename = time() . uniqid() . "." . $doc->getClientOriginalExtension();

            $doc->move(storage_path('app/docs'), $filename);
            
            return $this->success([
                'message' => trans('general.responses.orphan.document-added'),
                'doc'     => $filename
                ]);
        }
    }


    /**
     * Remove document from storage and database
     *
     * @return JSON Response
     */
    public function removeDocument($doc) 
    {
        Document::where('location', '=', $doc)->delete();

        if (Storage::disk('docs')->has($doc)) {
            Storage::disk('docs')->delete($doc);

            return $this->success(['message' => trans('general.responses.orphan.document-deleted')]);
        }

        return $this->error(['message' => trans('general.errors.file-not-exists')]);
    }


    /**
     * Return the pdf report for the specified orphan
     *
     * @return PDF
     */
    public function pdf($id) 
    {
        Orphan::find($id)->report()->output("pdf-$id.pdf", 'D');
    }


    /**
     * Download PDF for multiple users
     *
     * @return PDF
     */
    public function massPdf(Request $request)
    {
        set_time_limit(24 * 60 * 60);

        $files = [];

        $orphans = Orphan::whereIn('orphans.id', json_decode($request->orphans))->get();

        foreach ($orphans as $orphan) {
            $filename = $orphan->id . "-" . $orphan->first_name . "_" . $orphan->last_name . time() . ".pdf";
            $orphan->report()->output(storage_path("app/reports/$filename"), 'F');

            $files[] = $filename;
        }

        $zip = new \ZipArchive;

        $tmpFile = tempnam('.', '');

        $zip->open($tmpFile, \ZipArchive::CREATE);

        foreach($files as $file){

            $fileContents = file_get_contents(storage_path("app/reports/$file"));

            $zip->addFromString($file, $fileContents);
        }

        $zip->close();

        Storage::disk('reports')->delete($files);

        header("Content-type: application/zip"); 
        header("Content-Disposition: attachment; filename=Orphan_Reports.zip");
        header("Content-length: " . filesize($tmpFile));
        header("Pragma: no-cache"); 
        header("Expires: 0"); 
        readfile("$tmpFile");
    }


    /**
     * Return the financial report for the given orphan in the given year
     *
     * @return PDF
     */
    public function finances($id, $year) 
    {
        Orphan::find($id)->financialReport($year)->output("report-$id-$year.pdf", 'D');
    }


    /**
     * Delete Orphan's finances from the given year
     *
     * @return JSON Response
     */
    public function deleteFinances($id, $year) 
    {
        Finance::where(['orphan_id' => $id, 'year' => $year])->delete();

        return $this->success([
            'message' => trans('general.responses.orphan.finances-removed', ['year' => $year])
            ]);
    }


    /**
     * Get table data for a single orphan.
     *
     * @return Array
     */
    public function prepare($orphan) 
    {

        // $ar = (app()->getLocale() == 'ar-kw') ? '_ar' : '';
        $ar = '_ar';

        return [
        'orphans' => [
        'id'          => "<div class=\"select-row\">{$orphan['id']}</div>",
        'has_donation' => $orphan['has_donation'] ? trans('general.actions.yes') : trans('general.actions.no'),
        'first_name'  => $orphan['first_name' . $ar],
        'middle_name' => $orphan['middle_name' . $ar],
        'last_name'   => $orphan['last_name' . $ar],
        ],

        'residence' => [
        'city' => $orphan['city']
        ],

        'info' => [
        'id'      => $orphan['id'],
        'options' => view('admin.partials.settings.orphan', [
            'id' => $orphan['id'],
            'reports' => array_values( array_unique( array_map( function($finance) {
                return $finance['year'];
            }, $orphan['finances'])))
            ])->render()
        ],

        'users' => [
        'name' => $orphan['donor_name']
        ],

        'video' => $orphan['video'] ? '<div class="play-video" data-video="' . $orphan['video'] . '"><i class="fa fa-youtube-play"></i></div>' : '',
        ];
    }


    /**
     * Get all data for a single orphan for viewing/editing.
     *
     * @return Array
     */
    public function prepareSingle($orphan) 
    {
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

        'finances' => $this->prepareFinances($orphan),

        'documents' => array_map(function($doc) {
            return [
            'name' => $doc['location'], 
            'description' => $doc['description']
            ];
        }, $orphan->documents->toArray()),

        'note' => $orphan->note
        ];
    }

    /**
     * Prepare Orphan Finances
     *
     * @return Array
     */
    public function prepareFinances($orphan)
    {
        $finances = array_map(function($finance) {
            unset($finance['orphan_id']);

            return $finance;
        }, $orphan->finances->toArray());

        $years = array_values( array_unique( array_map( function($finance) {
            return $finance['year'];
        }, $finances)));

        return [
        'list' => $finances,
        'years' => $years
        ];
    }
}

