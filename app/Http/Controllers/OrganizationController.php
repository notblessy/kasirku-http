<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class OrganizationController extends Controller
{
    public function index(Request $request)
    {
        $organization = Organization::query()->paginate(10);

        return $request->wantsJson() ? $organization : Inertia::render('Organization/List', ["organization" => $organization]);
    }

    public function store(OrganizationRequest $request)
    {
        Organization::firstOrCreate([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'description' => $request->description,
            'photo' => $request->photo,
        ]);

        return redirect()->back();
    }

    public function show($id)
    {
        $Organization = Organization::query()->find($id);

        return Inertia::render('Organization/Detail', ["Organization" => $Organization]);
    }

    public function update(OrganizationRequest $request)
    {
        $Organization = Organization::query()->find($request->id);

        $Organization->update([
            "name" => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'description' => $request->description,
            'photo' => $request->photo,
        ]);

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $Organization = Organization::query()->find($request->id);
        $Organization->delete();

        return redirect()->back();
    }
}
