<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
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
        
        $sortBy = $request->sort_by ?? '';
        $orderBy = $request->order_by ?? '';
        if ($orderBy && !in_array($orderBy, ['asc', 'desc'])) {
            $orderBy = '';
        }
        
        
        $perPage = (int) 5;

        if ($request->s) {

            $clients = Client::where('client', 'like', '%'.$request->s.'%')->paginate(5)->withQueryString();

        } else {

            $clients = Client::select('clients.*');

            
            $clients = match($sortBy) {
                'client' => $clients->orderBy('client', $orderBy),
                'last_name' => $clients->orderBy('last_name', $orderBy),
                'name' => $clients->orderBy('name', $orderBy),              
                default => $clients
            };

            $clients = $clients->paginate($perPage)->withQueryString();
        }

        return view('clients.index', [
            'clients' => $clients,
            'sortBy' => $sortBy,
            'orderBy' => $orderBy,
            'perPage' => $perPage,
        ]);

       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:50|min:3|alpha',
                'last_name' => 'required|max:50|min:3|alpha',
                'personal_id' => 'required|integer|digits:11'
            ],
            [
                'name.reqiured' => 'Please enter name!',
                'name.max' => 'Name is too long!',
                'name.min' => 'Name is too short!',
                'name.alpha' => 'Name must contain only letters!',

                'last_name.reqiured' => 'Please enter last name!',
                'last_name.max' => 'Last name is too long!',
                'last_name.min' => 'Last name is too short!',
                'last_name.alpha' => 'Last name must contain only letters!',

                'personal_id.reqired' => 'Please enter id!',
                'personal_id.integer' => 'Id must be a number!',

            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $client = new Client;
        $client->name = $request->name;
        $client->last_name = $request->last_name;
        $client->personal_id = $request->personal_id;
        $client->save();
        return redirect()
            ->route('clients-index')
            ->with('success', 'New client has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', [
            'client' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:50|min:3|alpha',
                'last_name' => 'required|max:50|min:3|alpha',
                'personal_id' => 'required|integer|digits:11'
            ],
            [
                'name.reqiured' => 'Please enter name!',
                'name.max' => 'Name is too long!',
                'name.min' => 'Name is too short!',
                'name.alpha' => 'Name must contain only letters!',

                'last_name.reqiured' => 'Please enter last name!',
                'last_name.max' => 'Last name is too long!',
                'last_name.min' => 'Last name is too short!',
                'last_name.alpha' => 'Last name must contain only letters!',

                'personal_id.reqired' => 'Please enter id!',
                'personal_id.integer' => 'Id must be a number!',

            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $client->name = $request->name;
        $client->last_name = $request->last_name;
        $client->personal_id = $request->personal_id;
        $client->save();
        return redirect()
            ->route('clients-index')
            ->with('success', 'Client has been updated!');
    }

    public function delete(Client $client)
    {
        if ($client->accounts()->count()) {
            return redirect()->back()->with('info', 'Can not delete ' . $client->name . ' ' . $client->last_name . ', because it has accounts!');
        }

        return view('clients.delete', [
            'client' => $client
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()
            ->route('clients-index')
            ->with('success',   $client->name . ' ' . $client->last_name . ' has been deleted!');
    }
}