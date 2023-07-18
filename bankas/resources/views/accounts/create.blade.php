@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 style="color: #ef4444" class="card-title">Create new account</h5>
                        <form method="post" action="{{ route('accounts-store') }}">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <select name="client_id" class="form-select">
                                        <option>Select client</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}"
                                                @if ($client->id == old('client_id')) selected @endif>{{ $client->name }} {{ $client->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                               
                                <div class="mb-3">
                                    <label class="form-label">Iban</label>
                                    <input name="iban" type="text" class="form-control" value="{{$iban}}" readonly>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Create</button>
                                <a class="btn btn-secondary m-1" href="{{route('accounts-index')}}">Cancel</a>
                                @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
