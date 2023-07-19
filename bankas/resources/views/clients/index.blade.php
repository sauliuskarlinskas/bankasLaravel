@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="m-3">
                    <form action="{{route('clients-index')}}" method="get">
                        <fieldset>
                            <div class="row">
                            <h5 class="card-title">Sort</h5>
                                <div class="col-2">
                                    <select class="form-select" name="sort_by">
                                        <option value="" @if(''==$sortBy) selected @endif>No sort</option>
                                        <option value="last_name" @if('last_name'==$sortBy) selected @endif>Last Name</option>
                                        <option value="name" @if('name'==$sortBy) selected @endif>Name</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select class="form-select" name="order_by">
                                        <option value="asc" @if('asc'==$orderBy) selected @endif>ASC</option>
                                        <option value="desc" @if('desc'==$orderBy) selected @endif>DESC</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-info">Show</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                        <h4 style="color: #ef4444; font-weight:bold" class="card-title">Clients list</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            @forelse($clients as $client)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="d-flex">
                                                <div class="ms-2">
                                                    <div>{{ $client->client }}</div>
                                                    <div>Name: {{ $client->name }}</div>
                                                    <div>Last name: {{ $client->last_name }}</div>
                                                    <div>Personal id: {{ $client->personal_id }}</div>
                                                    @if($client->accounts()->count() > 0)
                                                    <div>Total balance: <span class="fw-bold mb-3">{{$client->accounts()->sum('balance')}} €</span></div>
                                                    
                                                @endif
                                                <div class="mt-3">List of accounts and balance:</div>
                                                @if($client->accounts()->count() > 0)
                                                    <ol class="list-group list-group-numbered list-group-flush">
                                                        @foreach($client->accounts as $account)
                                                            <li class="list-group-item fw-bold">{{$account->iban}} | {{$account->balance}} €</li>
                                                        @endforeach
                                                    </ol>
                                                @else
                                                    <p class="fw-bold mb-3">No accounts</p>
                                                    {{-- <button class="btn btn-outline-success mb-3" onclick="window.location.href='{{route('accounts-create', ['client_id' => $client->id])}}'">Add Account</button> --}}
                                                @endif

                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <a class="btn btn-success" href="{{ route('clients-edit', $client) }}">
                                                Edit
                                            </a>
                                            <a class="btn btn-danger" href="{{ route('clients-delete', $client) }}">
                                                Delete
                                            </a>

                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item">
                                    <p class="text-center">No clients</p>
                                </li>
                            @endforelse
                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                {{ $clients->links() }}
            </div>
        </div>
    </div>
@endsection
