@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Edit Alat
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.alat.update", [$alat->id]) }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.asset.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                           id="name" value="{{ old('name', $alat->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.asset.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="description">{{ trans('cruds.asset.fields.description') }}</label>
                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                              name="description"
                              id="description">{{ old('description', $alat->description) }}</textarea>
                    @if($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.asset.fields.description_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}"
                              name="keterangan"
                              id="keterangan">{{ old('keterangan', $alat->keterangan) }}</textarea>
                    @if($errors->has('keterangan'))
                        <div class="invalid-feedback">
                            {{ $errors->first('keterangan') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.asset.fields.description_helper') }}</span>
                </div>
                <div class="form-group">
                    @if($errors->has('team'))
                        <div class="invalid-feedback">
                            {{ $errors->first('team') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.team_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
