@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 style="color: #ef4444" class="card-title">Confirm delete</h5>
                        <form method="post" action="{{ route('accounts-destroy', $account) }}">
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <a href="{{ route('accounts-index') }}" class="btn btn-secondary">Cancel</a>
                            @method('delete')
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection