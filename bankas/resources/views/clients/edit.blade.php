@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit client</h5>
                        <form method="post" action="{{ route('clients-update', $client) }}">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input name="name" type="text" class="form-control"
                                    value="{{ old('name', $client->name) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Last name</label>
                                <input name="last_name" type="text" class="form-control"
                                    value="{{ old('last_name', $client->last_name) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Personal id</label>
                                <input name="personal_id" type="text" class="form-control"
                                    value="{{ old('personal_id', $client->personal_id) }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Add</button>
                            <a href="{{ route('clients-index') }}" class="btn btn-secondary">Cancel</a>
                            @method('put')
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
