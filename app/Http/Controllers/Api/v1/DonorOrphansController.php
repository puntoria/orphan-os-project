<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\Orphan;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DonorOrphansController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $filter = "data", Request $request)
    {
        $orphans = Orphan::with('Residence')->where('donor_id', '=', $id);

        $orphans = $this->manage($orphans, $request);

        $orphans = $this->filter($filter, $orphans);
        
        $orphans = $orphans->get();
        
        $count = $this->count($filter, $id);

        return $this->success($this->prepareCollection($orphans), [
            'recordsTotal'    => $count,
            'recordsFiltered' => $count
            ]);
    }

    /**
     * List all orphans without donation in the donor panel
     *
     * @return \Illuminate\Http\Response
     */
    public function withoutDonation(Request $request)
    {
        $orphans = Orphan::with('Residence')->where('has_donation', '=', 0);

        $orphans = $this->manage($orphans, $request);

        $orphans = $orphans->get();

        $count = Orphan::where('has_donation', '=', 0)->count();

        return $this->success($this->prepareCollection($orphans, 'prepareForDonation'), [
            'recordsTotal'    => $count,
            'recordsFiltered' => $count
            ]);
    }


    /**
     * Count Orphans with the given filter
     *
     * @return Query Builder
     */
    public function count($filter, $id) 
    {
        if ($filter == "withDonation")    return Orphan::where(['donor_id' => $id, 'has_donation' => 1])->count();
        if ($filter == "withoutDonation") return Orphan::where(['donor_id' => $id, 'has_donation' => 0])->count();

        return Orphan::where(['donor_id' => $id])->count();
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
    public function stats($id) 
    {
        return $this->success([
            'totalCount'           => Orphan::where(['donor_id' => $id])->count(),
            'withDonationCount'    => Orphan::where(['donor_id' => $id, 'has_donation' => 1])->count(),
            'withoutDonationCount' => Orphan::where(['donor_id' => $id, 'has_donation' => 0])->count()
            ]);
    }


    /**
     * Generate CSV file 
     *
     * @return CSV File
     */
    public function csv($id) 
    {
        $orphans = Orphan::with('Residence', 'Family', 'Education', 'Donor')->where('donor_id', '=', $id)->get();

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

        header('Content-Encoding: UTF-8');
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename=Orphans_List_' . $id . '.csv');

        echo chr(255) . chr(254) . mb_convert_encoding(file_get_contents($csvFile), 'UTF-16LE', 'UTF-8');

        die();
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
            'donation'    => $orphan['has_donation'],
            'first_name'  => $orphan['first_name' . $ar],
            'last_name'   => $orphan['last_name' . $ar],
        ],

        'residence' => [
            'city' => $orphan['residence']['city'],
        ],

        'video'       => $orphan['video'],
        'info'        => [
        'options' => view('admin.partials.settings.orphan', ['id' => $orphan['id']])->render(),
        'id'      => $orphan['id']
        ]
        ];
    }


    /**
     * Prepare Orphans without Donation
     *
     * @return Array
     */
    public function prepareForDonation($orphan) 
    {
        $ar = (app()->getLocale() == 'ar-kw') ? '_ar' : '';

        return [
        'orphans' => [
            'id'          => "<div class=\"select-row\">{$orphan['id']}</div>",
            'first_name'  => $orphan['first_name' . $ar],
            'middle_name' => $orphan['middle_name' . $ar],
            'last_name'   => $orphan['last_name' . $ar],
        ],

        'residence' => [
            'city'        => $orphan['residence']['city'],
        ],

        'video'       => $orphan['video'] ? '<div class="play-video" data-video="' . $orphan['video'] . '"><i class="fa fa-youtube-play"></i></div>' : '',
        'info'        => [
        'options' => view('donor.partials.settings.orphan', [
            'id'   => $orphan['id'],
            'name' => $orphan['first_name' . $ar] . " " . $orphan['last_name' . $ar]
            ])->render(),
        'id'      => $orphan['id']
        ]
        ];
    }
}
