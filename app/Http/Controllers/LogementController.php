<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logement;

class LogementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logements = Logement::all(); ; // Retrieve all Logement records
        return view('Logement.indexLogement', compact('logements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view ('Logement.CreateLogement');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate_data = $request->validate([
            'address' => 'required',
            'type' => 'required',
            'superficie' => 'required|integer|min:0',
            'nbr_habitant' => 'required|integer|min:0',  // Require a positive integer
        ]);

        $logement = Logement::create($validate_data);
        // Dans votre contrôleur après l'ajout ou la modification
//session(['highlight' => $logement->id]); // Ajoutez cette ligne
session()->flash('success', 'Logement added successfully!');
session()->flash('highlight', $logement->id);
        return redirect('/Logement');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $logement  = Logement::findOrfail($id);
        return view('Logement.edit',compact('logement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate_data = $request->validate([
            'address' => 'required',
            'type' => 'required',
            'superficie' => 'required|integer|min:0',
            'nbr_habitant' => 'required|integer|min:0',  // Require a positive integer
        ]);

        Logement::whereId($id)->update($validate_data);
        // Dans votre contrôleur après l'ajout ou la modification
//session(['highlight' => $id]); // Ajoutez cette ligne
session()->flash('success', 'Logement updated successfully!');
session()->flash('highlight', $id);
        return redirect()->route('Logement.index');//->with('status', 'Logement updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $logement= Logement::findOrFail($id);
       $logement->delete();
       session(['highlight' => $id]); // Ajoutez cette ligne

       return redirect()->route('Logement.index')->with('danger', 'Logement deleted successfully');
    }
}
