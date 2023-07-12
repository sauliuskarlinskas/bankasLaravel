@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Clients list</h5>
                        <ul class="list-group list-group-flush">
                            @forelse($clients as $client)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="d-flex">
                                                <div class="ms-2">
                                                    <div>{{ $client->client }}</div>
                                                    <div>{{ $client->name }}</div>
                                                    <div>{{ $client->last_name }}</div>
                                                    <div>{{ $client->personal_id }}</div>

                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <a class="btn btn-success" href="{{ route('clients-edit', $color) }}">
                                                Edit
                                            </a>
                                            <a class="btn btn-danger" href="{{ route('clients-delete', $color) }}">
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
        </div>
    </div>
@endsection
