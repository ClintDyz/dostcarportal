<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Record;
use App\RecordType;
use Auth;
use DB;
use File;

class RecordsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function showRecord($type) {
        $recordType = RecordType::where('id', $type)->first();
        $dataRecords = $this->getRecords(0, $type, 'all');
        $htmlElemID = preg_replace("/[^a-zA-Z]/", "", $recordType->type);
        $recElemID = strtolower(trim($htmlElemID));

        return view('pages.view-records', ['records' => $dataRecords,
                                           'recordType' => $recordType,
                                           'recElemID' => $recElemID]);
    }

    public function showSearchRecord(Request $request) {
        $search = trim($request->search);
        $dataRecordTypes = DB::table('record_types')
                             ->orderBy('id')
                             ->get();
        $search = trim($request->search);
        $dataRecordTypes = DB::table('record_types')
                             ->orderBy('id')
                             ->get();
        $dataAnnouncement = $this->getRecords(0, 1, 'search', $search);
        $dataMemo = $this->getRecords(0, 2, 'search', $search);
        $dataSO = $this->getRecords(0, 3, 'search', $search);
        $dataTO = $this->getRecords(0, 4, 'search', $search);
        $dataGuidelines = $this->getRecords(0, 5, 'search', $search);
        $dataPolicies = $this->getRecords(0, 6, 'search', $search);
        $dataReports = $this->getRecords(0, 7, 'search', $search);
        $dataForms = $this->getRecords(0, 8, 'search', $search);
        $dataManCom = $this->getRecords(0, 9, 'search', $search);
        $dataInfoMaterials = $this->getRecords(0, 10, 'search', $search);
        $dataOtherReports = $this->getRecords(0, 11, 'search', $search);
        $dataRecords = [$dataAnnouncement, 
                        $dataMemo, 
                        $dataSO, 
                        $dataTO,
                        $dataGuidelines, 
                        $dataPolicies, 
                        $dataReports, 
                        $dataForms,
                        $dataManCom,
                        $dataInfoMaterials,
                        $dataOtherReports];

        return view('pages.view-search-record', ['recordTypes' => $dataRecordTypes,
                                                 'records' => $dataRecords]);
    }

    public function showView(Request $request, $_type) {
        $id = $request->id;
        $recordType = RecordType::where('id', $_type)->first();
        $dataRecord = $this->getRecords($id, $_type, 'this');
        $attachDirectories = array_filter(explode(';', $dataRecord->attachment));
        $attachments = [];

        foreach ($attachDirectories as $key => $directory) {
            if (!empty($directory)) {
                $filename = str_replace('storage/record/' . $id . '/', '', $directory);
                $attachments[] = (object)['filename' => $filename,
                                        'directory' => $directory];
            }
        }

        return view('pages.view-record', ['type' => $_type,
                                          'id' => $id,
                                          'recordType' => $recordType,
                                          'title' => $dataRecord->title,
                                          'subject' => $dataRecord->subject,
                                          'recType' => $dataRecord->type,
                                          'remarks' => $dataRecord->remarks,
                                          'dateDue' => $dataRecord->date_due,
                                          'attachment' => $dataRecord->attachment,
                                          'postedBy' => $dataRecord->user,
                                          'createdAt' => $dataRecord->created_at,
                                          'attachments' => $attachments]);
    }

    public function showCreateForm($type) {
        if ($type >= 1) {
            $recordType = RecordType::where('id', $type)->first();

            return view('pages.create-record', ['type' => $type,
                                                'recordType' => $recordType]);
        } else {
            return '<div id="record-type-disp" class="well">
                    <p class="grey-text"> Please select a record type.</p>
                    </div>';
        }
    }

    public function showEditForm(Request $request, $_type) {
        $id = $request->id;
        $recordType = RecordType::where('id', $_type)->first();
        $recordTypes = RecordType::all();
        $dataRecord = $this->getRecords($id, $_type, 'this');
        $attachDirectories = array_filter(explode(';', $dataRecord->attachment));
        $attachments = [];

        foreach ($attachDirectories as $key => $directory) {
            if (!empty($directory)) {
                $filename = str_replace('storage/record/' . $id . '/', '', $directory);
                $attachments[] = (object)['filename' => $filename,
                                        'directory' => $directory];
            }
        }

        return view('pages.edit-record', ['type' => $_type,
                                          'id' => $id,
                                          'recordType' => $recordType,
                                          'recordTypes' => $recordTypes,
                                          'title' => $dataRecord->title,
                                          'subject' => $dataRecord->subject,
                                          'recType' => $dataRecord->type,
                                          'remarks' => $dataRecord->remarks,
                                          'dateDue' => $dataRecord->date_due,
                                          'attachment' => $dataRecord->attachment,
                                          'attachments' => $attachments]);
    }

    public function store(Request $request, $type) {
        $dataRecordCount = DB::table('records')
                             ->count();
        $id = $dataRecordCount + 1;

        try {
            $record = new Record;
            $record->title = $request->record_title;
            $record->subject = $request->record_subject;
            $record->record_type = $type;
            $record->remarks = $request->record_remarks;
            $record->date_due = $request->record_date_due;
            $record->posted_by = Auth::user()->emp_id;
            $attachment = $request->file('attachment');
            $msg = 'Record added "' . strtoupper($request->record_title) . '".';
            
            if (count($attachment) > 0) {
                $attachmentDir = $this->storeAttachment($attachment, $id, $record);
                $record->attachment = $attachmentDir;
            }

            $record->save();

            return redirect()->back()->with('success', $msg);
        } catch (Exception $e) {
            $msg = "There is an error storing the data.";
            return redirect()->back()->with('danger', $msg);
        }
    }

    public function update(Request $request, $type) {
        $id = $request->id;

        try {
            $record = Record::where('id', $id)->first();
            $record->title = $request->record_title;
            $record->subject = $request->record_subject;
            $record->record_type = $request->record_type;
            $record->remarks = $request->record_remarks;
            $record->date_due = $request->record_date_due;
            $record->posted_by = Auth::user()->emp_id;
            $attachment = $request->file('attachment');
            $msg = 'Record updated "' . strtoupper($request->record_title) . '".';

            if (count($attachment) > 0) {
                $attachmentDir = $this->storeAttachment($attachment, $id, $record);
                $arrDocDir = explode(';', $record->attachment);
                $arrAddDir = explode(';', $attachmentDir);

                foreach ($arrAddDir as $addedFile) {
                    $inArray = in_array($addedFile, $arrDocDir);

                    if (!$inArray) {
                        $record->attachment .= $addedFile . ';';
                    }
                }
            }
                
            $record->save();

            return redirect()->back()->with('success', $msg);
        } catch (Exception $e) {
            $msg = "There is an error updating the data.";
            return redirect()->back()->with('danger', $msg);
        } 
    }

    public function delete($id) {
        try {
            $dataRecord = Record::where('id', $id)->first();
            Record::where('id', $id)->delete();
            $msg = 'Successfully deleted "' . strtoupper($dataRecord->title) . '".';

            return redirect()->back()->with('success', $msg);
        } catch (Exception $e) {
            $msg = "There is an error deleting the data.";
            return redirect()->back()->with('danger', $msg);
        }   
    }

    public function deleteAttachment(Request $request, $id) {
        $filePath = $request->filepath;
        $announcement = Record::where('id', $id)->first();
        $docDirectories = array_filter(explode(';', $announcement->attachment));
        $attachment = "";

        foreach ($docDirectories as $directory) {
            if (!empty($directory) && $directory != $filePath) {
                $attachment .= $directory . ';';
            }
        }

        $announcement->attachment = $attachment;
        $announcement->save();

        File::delete($filePath);

        return "Successfully deleted.";
    }

    private function getRecords($id, $type, $toggle, $otherParam = "") {
        $dataRecords = DB::table('records as rec')
                         ->select('rec.id', 'rec.title', 'rec.subject','rec.date_due', 'rec.remarks', 
                                  DB::raw("concat(firstname, ' ', lastname) as user"),
                                  'rec.record_type', 'rec.attachment', 'rec.created_at', 
                                  'rec_typ.type')
                         ->join('users as us', 'us.id', '=', 'rec.posted_by')
                         ->join('record_types as rec_typ', 'rec_typ.id', '=', 'rec.record_type')
                         ->whereNull('rec.deleted_at');

        if ($toggle == 'all') {
            if ($type > 1) {
                $dataRecords = $dataRecords->where('rec.record_type', $type);
            }
                
            $dataRecords = $dataRecords->orderBy('id', 'desc')
                                       ->paginate(20);
        } else if ($toggle == 'this') {
            $dataRecords = $dataRecords->where([['rec.record_type', $type],
                                                ['rec.id', $id]])
                                       ->orderBy('id', 'desc')
                                       ->first();
        } else if ($toggle == 'search') {
            $dataRecords = $dataRecords->where('rec.record_type', $type)
                                       ->orderBy('id', 'desc')
                                       ->where(function ($query) use ($otherParam) {
                                             $query->where('rec.title', 'LIKE', '%' . $otherParam . '%')
                                                   ->orWhere('rec.subject', 'LIKE', '%' . $otherParam . '%')
                                                   ->orWhere('rec.date_due', 'LIKE', '%' . $otherParam . '%')
                                                   ->orWhere('rec.remarks', 'LIKE', '%' . $otherParam . '%')
                                                   ->orWhere('us.firstname', 'LIKE', '%' . $otherParam . '%')
                                                   ->orWhere('us.lastname', 'LIKE', '%' . $otherParam . '%');
                                         })
                                       ->get();
        }

        return $dataRecords;
    }

    private function storeAttachment($attachments, $id, $data) {
        $attachmentDir = "";

        foreach ($attachments as $key => $attachment) {
            if (!empty($attachment)) {
                $newFileName = $attachment->getClientOriginalName();
                Storage::put('public/record/' . $id . '/' . $newFileName, 
                             file_get_contents($attachment->getRealPath()));
                $attachmentDir .= 'storage/record/' . $id . '/' . $newFileName . ';';
            }   
        }

        return $attachmentDir;
    }
}