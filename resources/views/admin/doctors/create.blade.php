@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.doctor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.doctors.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.doctor.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="img">{{ trans('cruds.doctor.fields.img') }}</label>
                <input class="form-control {{ $errors->has('img') ? 'is-invalid' : '' }}" type="text" name="img" id="img" value="{{ old('img', '') }}">
                @if($errors->has('img'))
                    <div class="invalid-feedback">
                        {{ $errors->first('img') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.img_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="speciality_id">{{ trans('cruds.doctor.fields.speciality') }}</label>
                <select class="form-control select2 {{ $errors->has('speciality') ? 'is-invalid' : '' }}" name="speciality_id" id="speciality_id" required>
                    @foreach($specialities as $id => $entry)
                        <option value="{{ $id }}" {{ old('speciality_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('speciality'))
                    <div class="invalid-feedback">
                        {{ $errors->first('speciality') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.speciality_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection