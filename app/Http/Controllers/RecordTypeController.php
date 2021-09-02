<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\RecordType;
use DB;

class RecordTypeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $type = $request->r_type;
        $icon = $request->r_icon;
        
        try {
            $typeCount = DB::table('record_types')->count() + 1;

            $instanceRecType = new RecordType;
            $instanceRecType->type = $type;
            $instanceRecType->fa_icon = $icon;
            $instanceRecType->order_no = $typeCount;
            $instanceRecType->save();

            $msg = 'Record type added "' . strtoupper($type) . '".';
            return redirect()->back()->with('success', $msg);
        } catch (\Throwable $th) {
            $msg = "There is an error storing the data.";
            return redirect()->back()->with('danger', $msg);
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRecordType($id) {
        $recTypeDat = RecordType::find($id);
        $type = $recTypeDat->type;
        $icon = $recTypeDat->fa_icon;

        return view('pages.view-record-type', compact(
            'id', 'type', 'icon'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showEditForm($id) {
        $recTypeDat = RecordType::find($id);
        $type = $recTypeDat->type;
        $icon = $recTypeDat->fa_icon;

        return view('pages.edit-record-type', compact(
            'id', 'type', 'icon'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $type = $request->record_type;
        $icon = $request->record_icon;

        try {
            $instanceRecType = RecordType::find($id);
            $instanceRecType->type = $type;
            $instanceRecType->fa_icon = $icon;
            $instanceRecType->save();

            $msg = 'Record type updated "' . strtoupper($type) . '".';
            return redirect()->back()->with('success', $msg);
        } catch (\Throwable $th) {
            $msg = "There is an error updating the data.";
            return redirect()->back()->with('danger', $msg);
        }
    }

    public function updateOrder(Request $request) {
        $recTypeIDs = $request->rec_id;
        $orderNo = 2;

        try {
            foreach ($recTypeIDs as $id) {
                $instanceRecType = RecordType::find($id);
                $instanceRecType->order_no = $orderNo;
                $instanceRecType->save();
                $orderNo++;
            }

            $msg = 'Record types re-ordered successfully.';
            return redirect()->back()->with('success', $msg);
        } catch (Exception $e) {
            $msg = "There is an error re-ordering the 'Record Types'.";
            return redirect()->back()->with('danger', $msg);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        try {
            $dataRecord = RecordType::where('id', $id)->first();
            RecordType::where('id', $id)->delete();
            $msg = 'Successfully deleted "' . strtoupper($dataRecord->type) . '".';

            return redirect()->back()->with('success', $msg);
        } catch (Exception $e) {
            $msg = "There is an error deleting the data.";
            return redirect()->back()->with('danger', $msg);
        }   
    }
}
