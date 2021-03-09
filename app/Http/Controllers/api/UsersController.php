<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller {
    public function index() {
        return User::all();
    }

    public function store(Request $request) {
        User::create($request->all());
    }

    public function show($id) {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $userSelected = User::findOrFail($id);
        $userSelected->update($request->all());
    }

    public function destroy($id) {
        $userSelected = User::findOrFail($id);
        $userSelected->delete();
    }
}
