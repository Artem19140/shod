<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string']
        ]);

        Organization::create([
            'name' => $request->input('name')
        ]);

        return redirect()->route('organizations.index');
    }
}
