@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 style="color: #ef4444" class="card-title">Funds transfare</h5>

                        <div class="container m-3">
                            <form >
                                {{-- class='col-4' action="{{route('account-execute', ['account'=>$account, 'account2'=>$account2])}}" method="post" --}}
                                <div>
                                    <label class="mr-3">Transfare from</label>
                                    <select>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}">{{ $account->client->name }}
                                                {{ $account->client->last_name }} {{ $account->iban }}
                                                {{ $account->balance }}€</option>
                                        @endforeach
                                    </select>

                                    <label class="mr-3" for="fname">Transfare to</label>
                                    <select>
                                        @foreach ($accounts as $account2)
                                            <option value="{{ $account2->id }}">{{ $account2->client->name }}
                                                {{ $account2->client->last_name }} {{ $account2->iban }}
                                                {{ $account2->balance }}€</option>
                                        @endforeach
                                    </select>

                                    <div style="" class="m-3">
                                        <input class="form-control" type="number" name="amount" id="amount"
                                            placeholder="Enter amount to transfare" required>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary m-3">transfare</button>
                                @csrf
                            </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
