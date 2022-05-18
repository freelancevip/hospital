<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRecordRequest;
use App\Http\Requests\StoreRecordRequest;
use App\Http\Requests\UpdateRecordRequest;
use App\Models\Doctor;
use App\Models\Record;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecordController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('record_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $records = Record::with(['doctor'])->get();

        return view('admin.records.index', compact('records'));
    }

    public function create()
    {
        abort_if(Gate::denies('record_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctors = Doctor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.records.create', compact('doctors'));
    }

    public function store(StoreRecordRequest $request)
    {
        $record = Record::create($request->all());

        return redirect()->route('admin.records.index');
    }

    public function edit(Record $record)
    {
        abort_if(Gate::denies('record_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctors = Doctor::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $record->load('doctor');

        return view('admin.records.edit', compact('doctors', 'record'));
    }

    public function update(UpdateRecordRequest $request, Record $record)
    {
        $record->update($request->all());

        return redirect()->route('admin.records.index');
    }

    public function show(Record $record)
    {
        abort_if(Gate::denies('record_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $record->load('doctor');

        return view('admin.records.show', compact('record'));
    }

    public function destroy(Record $record)
    {
        abort_if(Gate::denies('record_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $record->delete();

        return back();
    }

    public function massDestroy(MassDestroyRecordRequest $request)
    {
        Record::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
