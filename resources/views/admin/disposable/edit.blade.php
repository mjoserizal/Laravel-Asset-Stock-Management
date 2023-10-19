@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Edit Obat
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.disposable.update", [$disposable->id]) }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.asset.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                           id="name" value="{{ old('name', $disposable->name) }}" required>
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
                              id="description">{{ old('description', $disposable->description) }}</textarea>
                    @if($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.asset.fields.description_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="expired_at">Expired At:</label>
                    <input type="date" class="form-control" id="expired_at" name="expired_at"
                           value="{{ old('expired_at', now()->format('Y-m-d')) }}">
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
