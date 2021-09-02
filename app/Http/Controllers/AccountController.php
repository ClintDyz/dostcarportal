<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Gender;
use App\UserType;
use App\Division;
use DB;
use App\Http\Requests;

class AccountController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getAccount($id) {
        $data = array();
        $account = User::where('id', $id)->first();

        $data = ['emp_id' => $account->emp_id,
                 'firstname' => $account->firstname,
                 'middlename' => $account->middlename,
                 'lastname' => $account->lastname,
                 'gender' => $account->gender,
                 'username' => $account->username,
                 'email' => $account->email,
                 'phone_no' => $account->phone_no,
                 'position' => $account->position,
                 'division' => $account->division,
                 'type' => $account->type,
                 'password' => $account->password];

        $data = json_encode($data);

        return $data;
    }

    public function viewAccounts() {
        $accounts = User::select('users.id', DB::raw("concat(lastname, ', ', firstname) name"),
                                 'users.position', 'divisions.division')
                         ->join('divisions', 'divisions.id', '=', 'users.division')
                         ->orderBy('lastname', 'asc')
                         ->whereNull('deleted_at')
                         ->paginate(30);
        /*
        $genders = Gender::select('id', 'gender')
                              ->orderBy('id', 'asc')
                              ->get();*/
        $genders = [
            '-', 'male', 'female'
        ];
        $userTypes = UserType::select('id', 'type')
                              ->orderBy('id', 'asc')
                              ->get();
        $divisions = Division::select('id', 'division')
                              ->orderBy('id', 'asc')
                              ->get();

        return view('accounts', ['dataAccounts' => $accounts,
                                 'dataGenders' => $genders,
                                 'dataUserTypes' => $userTypes,
                                 'dataDivisions' => $divisions]);
    }

    public function addAccount(Request $request) {
        $empID = $request->input('empid');
        $firstname = $request->input('firstname');
        $middlename = $request->input('middlename');
        $lastname = $request->input('lastname');
        $gender = $request->input('gender');
        $username = $request->input('username');
        $email = $request->input('email');
        $phone_no = $request->input('phonenumber');
        $position = $request->input('position');
        $division = $request->input('division');
        $type = $request->input('type');
        $picture = $request->input('picture');
        $password = $request->input('password');

        if (empty($request->input('password'))) {
            $password = bcrypt('default');
        }
        
        $account = User::insert([['emp_id' => $empID,
                                  'firstname' => $firstname,
                                  'middlename' => $middlename,
                                  'lastname' => $lastname,
                                  'gender' => $gender,
                                  'username' => $username,
                                  'email' => $email,
                                  'phone_no' => $phone_no,
                                  'position' => $position,
                                  'division' => $division,
                                  'type' => $type,
                                  'password' => $password,
                                ]]);

        return back();
    }

    public function editAccount(Request $request, $id) {
        $empID = $request->input('empid-' . $id);
        $firstname = $request->input('firstname-' . $id);
        $middlename = $request->input('middlename-' . $id);
        $lastname = $request->input('lastname-' . $id);
        $gender = $request->input('gender-' . $id);
        $username = $request->input('username-' . $id);
        $email = $request->input('email-' . $id);
        $phone_no = $request->input('phonenumber-' . $id);
        $position = $request->input('position-' . $id);
        $division = $request->input('division-' . $id);
        $type = $request->input('type-' . $id);
        $picture = $request->input('picture-' . $id);
        $password = $request->input('password-' . $id);

        if ($password = 1) {
            $password = bcrypt('default');
        }

        $account = User::where('id', $id)
                        ->update(['emp_id' => $empID,
                                  'firstname' => $firstname,
                                  'middlename' => $middlename,
                                  'lastname' => $lastname,
                                  'gender' => $gender,
                                  'username' => $username,
                                  'email' => $email,
                                  'phone_no' => $phone_no,
                                  'position' => $position,
                                  'division' => $division,
                                  'type' => $type,
                                  'password' => $password,
                                ]);

        return back();
    }

    public function deleteAccount($id) {
        $account = User::where('id', $id);

        $account->delete();
        return back();
    }
}
