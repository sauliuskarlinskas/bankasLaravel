<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $perPage = (int) 5;

        $accounts = Account::select('accounts.*');
        $accounts = $accounts->paginate($perPage)->withQueryString();

        return view('accounts.index', [
            'accounts' => $accounts,
            'perPage' => $perPage
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $iban = Account::generateLithuanianIBAN();

        return view('accounts.create', [
            'clients' => $clients,
            'iban' => $iban
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'iban' => 'required|unique:accounts|size:20',
                'client_id' => 'required|integer'
            ],
            [
                'iban.required' => 'Please enter account No!',
                'client_id.required' => 'Please select client!'
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $account = new Account;
        $account->client_id = $request->client_id;
        $account->iban = $request->iban;
        $account->balance = 0;
        $account->save();
        return redirect()
            ->route('accounts-index')
            ->with('success', 'New account has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        $clients = Client::all();

        return view('accounts.edit', [
            'account' => $account,
            'clients' => $clients
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        $amount = $request->amount;

        $validator = Validator::make(
            $request->all(),
            [
                'amount' => 'required|integer|min:0'
            ],
            [
                'amount.required' => 'Please enter the amount!',
                'amount.integer' => 'The amount has to be integer!',
                'amount.min' => 'The amount must be a positive integer!'
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        // Add money
        if (isset($request->add)) {

            $account->balance += $amount;

            $account->save();
            return redirect()
                ->route('accounts-index')
                ->with('success', $amount . ' € has been added to the ' . $account->client->name . ' ' . $account->client->last_name . ' account ' . $account->iban . '!');
        }

        // Withdraw money
        if (isset($request->withdraw)) {

            if ($account->balance < $amount) {
                return redirect()
                    ->back()
                    ->with('warning', 'You have only ' . $account->balance . '€. You cannot withdrawn ' . $amount . '€');
            }

            $account->balance -= $amount;

            $account->save();
            return redirect()
                ->route('accounts-index')
                ->with('success', $amount . ' € has been withdrawn from the ' . $account->client->name . ' ' . $account->client->last_name . ' account ' . $account->iban . '!');
        }
    }


    public function delete(Account $account)
    {

        return view('accounts.delete', [
            'account' => $account
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()
            ->route('accounts-index')
            ->with('success', 'Account has been deleted!');
    }


    public function transfare(Account $account, )
    {
        $accounts = Account::all();

        return view(
            'accounts.transfare',
            [
                'accounts' => $accounts
            ]
        );
    }


    public function execute(Account $account, Account $account2, Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            ],
            [
                'amount.required' => '??',
                'amount.regex' => 'Check amount'
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        if ($account->balance >= $request->amount) {
            $account->balance -= $request->amount;
            $account2->balance += $request->amount;
            $account->save();
            $account2->save();
            return redirect()->back()->with('success', 'Funds where transfared!');
        }
        return redirect()->back()->withErrors('Balance is not sufficient');
    }





}