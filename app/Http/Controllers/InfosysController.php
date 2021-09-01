<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Infosys;
use DB;
use \Image;

class InfosysController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function showInfosys() {
        $dataInfoSys_Main = DB::connection('mysql')
                              ->table('infosys')
                              ->where('type', 'main')
                              ->orderBy('name')
                              ->get();
        $dataInfoSys_SpecProj = DB::connection('mysql')
                                  ->table('infosys')
                                  ->where('type', 'special-project')
                                  ->orderBy('name')
                                  ->get();
        $dataInfoSys_Others = DB::connection('mysql')
                                ->table('infosys')
                                ->where('type', 'others')
                                ->orderBy('name')
                                ->get();
        $dataInfoSys_BackEnd = DB::connection('mysql')
                                 ->table('infosys')
                                 ->where('type', 'back-end')
                                 ->orderBy('name')
                                 ->get();

        if (in_array($_SERVER['HTTP_HOST'], array('192.168.2.79', 'localhost', '127.0.0.1', '::1'))) {
            foreach ($dataInfoSys_Main as $info) {
                if (empty($info->local_url)) {
                    $info->local_url = $info->public_url;
                }

                $info->url = $info->local_url;
            }

            foreach ($dataInfoSys_SpecProj as $info) {
                if (empty($info->local_url)) {
                    $info->local_url = $info->public_url;
                }

                $info->url = $info->local_url;
            }

            foreach ($dataInfoSys_Others as $info) {
                if (empty($info->local_url)) {
                    $info->local_url = $info->public_url;
                }

                $info->url = $info->local_url;
            }

            foreach ($dataInfoSys_BackEnd as $info) {
                if (empty($info->local_url)) {
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

        return view('pages.view-infosys', ['infosysMain' => $dataInfoSys_Main,
                                           'infosysSpecProj' => $dataInfoSys_SpecProj,
                                           'infosysOthers' => $dataInfoSys_Others,
                                           'infosysBackEnd' => $dataInfoSys_BackEnd]);
    }

    public function showCreateForm() {
        return view('pages.create-infosys');
    }

    public function showEditForm($id) {
        $dataInfoSys = Infosys::where('id', $id)->first();
        $type = $dataInfoSys->type;
        $name = $dataInfoSys->name;
        $abrv = $dataInfoSys->abrv;
        $description = $dataInfoSys->description;
        $localURL = $dataInfoSys->local_url;
        $publicURL = $dataInfoSys->public_url;
        $icon = $dataInfoSys->icon;

        return view('pages.edit-infosys', ['type' => $type,
                                           'name' => $name,
                                           'abrv' => $abrv,
                                           'description' => $description,
                                           'localURL' => $localURL,
                                           'publicURL' => $publicURL,
                                           'icon' => $icon,
                                           'id' => $id]);
    }

    public function store(Request $request) {
        $dataID = DB::table('infosys')
                    ->select('id')
                    ->orderBy('id', 'desc')
                    ->first();
        $id = $dataID->id + 1;
        
        try {
            $infoSys = new Infosys;
            $infoSys->name = $request->infosys_name;
            $infoSys->abrv = $request->infosys_abrv;
            $infoSys->description = $request->infosys_desc;
            $infoSys->local_url = $request->infosys_local_url;
            $infoSys->public_url = $request->infosys_public_url;
            $infoSys->type = $request->infosys_type;
            $icon = $request->file('infosys_icon');
            $msg = 'Successfully added "' . strtoupper($request->infosys_name) . '".';

            if ($icon) {
                $iconDir = $this->processIcon($icon, $id, $infoSys);
                $infoSys->icon = $iconDir;
            }
            
            $infoSys->save();

            return redirect()->back()->with('success', $msg);
        } catch (Exception $e) {
            $msg = "There is an error storing the data.";
            return redirect()->back()->with('danger', $msg);
        }
    }

    public function update(Request $request, $id) {
        try {
            $infoSys = Infosys::where('id', $id)->first();
            $infoSys->name = $request->infosys_name;
            $infoSys->abrv = $request->infosys_abrv;
            $infoSys->description = $request->infosys_desc;
            $infoSys->local_url = $request->infosys_local_url;
            $infoSys->public_url = $request->infosys_public_url;
            $icon = $request->file('infosys_icon');
            $infoSys->type = $request->infosys_type;
            $msg = 'Successfully updated "' . strtoupper($request->infosys_name) . '".';

            if ($icon) {
                $iconDir = $this->processIcon($icon, $id, $infoSys);
                $infoSys->icon = $iconDir;
            }
            
            $infoSys->save();

            return redirect()->back()->with('success', $msg);
        } catch (Exception $e) {
            $msg = "There is an error updating the data.";
            return redirect()->back()->with('danger', $msg);
        }  
    }

    public function delete($id) {
        try {
            $dataInfoSys = Infosys::where('id', $id)->first();
            Infosys::where('id', $id)->delete();
            $msg = 'Successfully deleted "' . strtoupper($dataInfoSys->name) . '".';

            return redirect()->back()->with('success', $msg);
        } catch (Exception $e) {
            $msg = "There is an error deleting the data.";
            return redirect()->back()->with('danger', $msg);
        }
    }

    private function processIcon($icon, $id, $data) {
        $iconDir = "";

        if (!empty($icon)) {
            $newFileName = 'infoys-' . $id . '.png';
            $exists = Storage::exists($data->icon);

            $path = $icon->hashName('infosys_icon');
            $image = Image::make($icon)->fit(300, 300);
            Storage::put('public/images/infosys/icons/'.$newFileName, (string) $image->encode());

            if (!empty($data->icon)) {
                if ($exists && ($data->icon != 'storage/images/infosys/icons/'.$newFileName)) {
                    Storage::delete($data->icon);
                }
            }

            $iconDir = 'storage/images/infosys/icons/' . $newFileName;
        }

        return $iconDir;
    }
}