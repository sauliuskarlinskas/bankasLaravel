@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Create new account</h5>
                        <form method="post" action="{{ route('accounts-store') }}">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label class="form-label">Client</label>
                                    <select name="client_id" class="form-select">
                                        <option>Open this select menu</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}"
                                                @if ($client->id == old('client_id')) selected @endif>{{ $client->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                                @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection