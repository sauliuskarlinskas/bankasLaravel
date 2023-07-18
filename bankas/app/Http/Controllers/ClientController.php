<?php

namespace App\Http\Controllers;

use App\Models\Client;
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
       

        $perPage = (int) 5;

        $clients = Client::select('clients.*');
        $clients = $clients->paginate($perPage)->withQueryString();
        

        return view('clients.index', [
            'clients' => $clients,
            'perPage' => $perPage
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
        // if ($client->clients()->count()) {
        //     return redirect()->back()->with('info', 'Can not delete client, because it has acounts!');
        // }

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
            ->with('success', 'Client has been deleted!');
    }
}