<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\Gender;
use App\UserType;
use App\Division;

class PortalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function portal()
    {
        $firstRecordTypeID = 0;
        $dataRecordTypes = DB::table('record_types')
                             ->orderBy('id')
                             ->get();
        $dataAnnouncement = [];//$this->getRecords(1);
        /*
        $dataMemo = $this->getRecords(2);
        $dataSO = $this->getRecords(3);
        $dataGuidelines = $this->getRecords(4);
        $dataPolicies = $this->getRecords(5);
        $dataReports = $this->getRecords(6);
        $dataOtherReports = $this->getRecords(7);
        $dataRecords = [$dataAnnouncement, $dataMemo, $dataSO, $dataGuidelines, 
                        $dataPolicies, $dataReports, $dataOtherReports,];*/
        $dataTraceMemo = DB::connection('mysql_trace')
                           ->table('t_events')
                           ->select('e_name as event', 'e_type as type', 
                                    'e_start_date as startDate', 'e_start_time as startTime',
                                    'e_end_date as endDate')
                           ->orderBy('e_id', 'desc')
                           ->take(10)
                           ->get();
        $dataInfoSys_Main = DB::table('infosys')
                              ->where('type', 'main')
                              ->orderBy('name')
                              ->get();
        $dataInfoSys_SpecProj = DB::table('infosys')
                                  ->where('type', 'special-project')
                                  ->orderBy('name')
                                  ->get();
        $dataInfoSys_Others = DB::table('infosys')
                                ->where('type', 'others')
                                ->orderBy('name')
                                ->get();
        $dataInfoSys_BackEnd = DB::table('infosys')
                                 ->where('type', 'back-end')
                                 ->orderBy('name')
                                 ->get();

        foreach ($dataRecordTypes as $ctr => $rType) {
            if ($ctr == 0) {
                $firstRecordTypeID = $rType->id;
            }
            
            $htmlElemID = preg_replace("/[^a-zA-Z]/", "", $rType->type);
            $rType->elem_id = strtolower(trim($htmlElemID));
        }

        if (in_array($_SERVER['HTTP_HOST'], array('192.168.2.79', 'localhost', '127.0.0.1', '::1'))) {
            foreach ($dataInfoSys_Main as $info) {
                if (empty($info->local_url) && !empty($info->public_url)) {
                    $info->local_url = $info->public_url;
                }

                $info->url = $info->local_url;
            }

            foreach ($dataInfoSys_SpecProj as $info) {
                if (empty($info->local_url) && !empty($info->public_url)) {
                    $info->local_url = $info->public_url;
                }

                $info->url = $info->local_url;
            }

            foreach ($dataInfoSys_Others as $info) {
                if (empty($info->local_url) && !empty($info->public_url)) {
                    $info->local_url = $info->public_url;
                }

                $info->url = $info->local_url;
            }

            foreach ($dataInfoSys_BackEnd as $info) {
                if (empty($info->local_url) && !empty($info->public_url)) {
                    $info->local_url = $info->public_url;
                }
                
                $info->url = $info->local_url;
            }
        } else {
            foreach ($dataInfoSys_Main as $info) {
                $info->url = $info->public_url;
            }

            foreach ($dataInfoSys_SpecProj as $info) {
                $info->url = $info->public_url;
            }

            foreach ($dataInfoSys_Others as $info) {
                $info->url = $info->public_url;
            }

            foreach ($dataInfoSys_BackEnd as $info) {
                $info->url = $info->public_url;
            }
        }

        return view('pages.portal', ['firstRecordType' => $firstRecordTypeID,
                                     'recordTypes' => $dataRecordTypes,
                                     'records' => $dataAnnouncement,
                                     'memos' => $dataTraceMemo,
                                     'infosysMain' => $dataInfoSys_Main,
                                     'infosysSpecProj' => $dataInfoSys_SpecProj,
                                     'infosysOthers' => $dataInfoSys_Others,
                                     'infosysBackEnd' => $dataInfoSys_BackEnd]);
    }

    private function getRecords($type) {
        $dataRecords = DB::table('records as rec')
                         ->select('rec.id', 'rec.title', 'rec.subject','rec.date_due', 'rec.remarks', 
                                  DB::raw("concat(firstname, ' ', lastname) as user"),
                                  'rec.record_type', 'rec_typ.type')
                         ->join('users as us', 'us.id', '=', 'rec.posted_by')
                         ->join('record_types as rec_typ', 'rec_typ.id', '=', 'rec.record_type')
                         ->whereNull('rec.deleted_at');

        if ($type > 1) {
            $dataRecords = $dataRecords->where('rec.record_type', $type);
        }

        $dataRecords = $dataRecords->orderBy('id', 'desc')
                                   ->paginate(20);
  
        return $dataRecords;
    }

}
