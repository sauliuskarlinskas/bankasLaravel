@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Accounts list</h5>
                        <ul class="list-group list-group-flush">
                            @forelse($accounts as $account)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="d-flex">
                                                <div class="ms-2">
                                                    <div>{{ $account->client->name }}</div>
                                                    <div>{{ $account->client->last_name }}</div>
                                                    <div>{{ $account->client->personal_id }}</div>
                                                    <div>{{ $account->iban }}</div>
                                                    <div>{{ $account->balance }}</div>

                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <a class="btn btn-success">
                                                Edit
                                            </a>
                                            <a class="btn btn-danger" href="{{ route('accounts-delete', $account) }}">
                                                Delete
                                            </a>

                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item">
                                    <p class="text-center">No accounts</p>
                                </li>
                            @endforelse
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection