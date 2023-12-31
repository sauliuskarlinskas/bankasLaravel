@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                        <h4 style="color: #ef4444; font-weight:bold" class="card-title">Accounts list</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            @forelse($accounts as $account)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="d-flex">
                                                <div class="ms-2">
                                                    <div >Name: {{ $account->client->name }}</div>
                                                    <div>Last name: {{ $account->client->last_name }}</div>
                                                    <div>Personal id: {{ $account->client->personal_id }}</div>
                                                    <div>Account number: LT {{ $account->iban }}</div>
                                                    <div>Balance: {{ $account->balance }} €</div>

                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <a class="btn btn-success" href="{{ route('accounts-edit', $account) }}">
                                                Edit balance
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
            <div class="col-md-12 mt-4">
                {{ $accounts->links() }}
            </div>
        </div>
    </div>
@endsection
