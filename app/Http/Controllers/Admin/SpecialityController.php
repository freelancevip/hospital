<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySpecialityRequest;
use App\Http\Requests\StoreSpecialityRequest;
use App\Http\Requests\UpdateSpecialityRequest;
use App\Models\Speciality;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SpecialityController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('speciality_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialities = Speciality::all();

        return view('admin.specialities.index', compact('specialities'));
    }

    public function create()
    {
        abort_if(Gate::denies('speciality_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specialities.create');
    }

    public function store(StoreSpecialityRequest $request)
    {
        $speciality = Speciality::create($request->all());

        return redirect()->route('admin.specialities.index');
    }

    public function edit(Speciality $speciality)
    {
        abort_if(Gate::denies('speciality_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specialities.edit', compact('speciality'));
    }

    public function update(UpdateSpecialityRequest $request, Speciality $speciality)
    {
        $speciality->update($request->all());

        return redirect()->route('admin.specialities.index');
    }

    public function show(Speciality $speciality)
    {
        abort_if(Gate::denies('speciality_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specialities.show', compact('speciality'));
    }

    public function destroy(Speciality $speciality)
    {
        abort_if(Gate::denies('speciality_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $speciality->delete();

        return back();
    }

    public function massDestroy(MassDestroySpecialityRequest $request)
    {
        Speciality::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
