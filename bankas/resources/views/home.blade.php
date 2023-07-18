@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h3 style="color: #ef4444" class="card-header">Statistics</h3>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4>Total clients in bank: {{$clients->count()}}</h4>
                    <h4>Total accounts in bank: {{$accounts->count()}}</h4>
                    <h4>Total ammount in bank: {{$accounts->sum('balance')}} €</h4>
                    <h4>Biggest ammount in account: {{$accounts->max('balance')}} €</h4>
                    <h4>Smallest ammount in account: {{$accounts->min('balance')}} €</h4>
                    <h4>Average ammount in account: {{round($accounts->avg('balance'),2)}} €</h4>
                    <h4>Total accounts with 0 balance: {{$accounts->where('balance', 0)->count()}}</h4>
                    <h4>Total accounts with negative balance: {{$accounts->where('balance','<', 0)->count()}}</h4>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection