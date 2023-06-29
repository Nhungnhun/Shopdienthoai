<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InforController extends Controller
{
    //
    public function index() {
        $users = User::where('role_as','!=','1')->orderBy('last_seen','DESC')->paginate(6);
        return view('admin.information.infor', compact('users'));
    }

    public function search(Request $request) {

        $validator = Validator::make($request->all(), [
            'searchTerm' => 'required',
        ], [
            'searchTerm.required' => 'Please enter search keyword.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $searchTerm = $request->input('searchTerm');
        $userSearch = User::where('name', 'like', '%'.$searchTerm.'%')->where('role_as', '!=', '1')->paginate(6);
        return view('admin.information.infor', ['userSearch' => $userSearch->appends(['searchTerm' => $searchTerm])]);
    }
}
