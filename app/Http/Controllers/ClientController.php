<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Project;

use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderby('id','desc')->paginate(15);

        return view('clients.index')->with([
            'clients' => $clients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = Client::create([
            ...$request->all(),
            'addedby' => Auth::id(),
        ]);

        // Mail::to($request->email)->send(new welcomemail($client));

        return redirect()->route('clients.view', [
            'id' => $client->id
        ])->with([
            'success' => 'New Client Added',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $projects = $client->projects()->orderBy('id', 'desc')->paginate(15);
        $invoices = Invoice::forClient( $client )->where('type',2)->orderby('id','desc')->paginate(10);
        $quotes = Invoice::forClient( $client )->where('type',1)->orderby('id','desc')->paginate(10);

        return view('clients.show')->with([
            'client' => $client,
            'invoices' => $invoices,
            'projects' => $projects,
            'quotes' => $quotes,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit')->with([
            'client' => $client,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $client->update([
            ...$request->all(),
        ]);

        return redirect()->route('clients.view', [
            'id' => $client->id,
        ])->with([
            'success' => 'Client Profile Updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        Invoice::forClient( $client )->delete();
        $client->projects()->delete();
        $client->delete();

        return redirect()->route('clients.index')->with([
            'success' => 'Client Profile Deleted',
        ]);
    }
}
