<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Source; 
use App\Models\User; 

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sources = Source::with('owner')->get(); // Eager load the owner relationship
    return view('Source.indexSource', compact('sources'));
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all(); 
        return view('Source.createSource', compact('users')); // Passer les utilisateurs à la vue
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
            'nom_renouv' => 'required|string|max:255',
            'desc_renouv' => 'required|string',
            'puissMax_renouv' => 'required|numeric|min:0',  // Require a non-negative number
            'date_renouv' => 'required|date',               // Require a valid date
            'typeE_renouv' => 'required|string',            // Ensure type is a string
            'prodEstime_renouv' => 'required|numeric|min:0', // Require a non-negative number
            'coutInstall_renouv' => 'required|numeric|min:0', // Require a non-negative number
            'impactCO2_renouv' => 'required|numeric|min:0', // Require a non-negative number
            'proprio_renouv' => 'required|exists:users,id', // Ensure the owner is a valid user ID
        ]);
    
        // Create a new Source instance with validated data
        $source = Source::create($validate_data);
    
        // Redirect to the sources index page with a success message
        return redirect('/source/')->with('success', 'Source crée avec succès!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $source = Source::with('owner')->findOrFail($id);
        return view('Source.showSource', compact('source'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $source  = Source::findOrfail($id);
        return view('Source.editSource',compact('source'));
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
            'nom_renouv' => 'required|string|max:255',
            'desc_renouv' => 'required|string',
            'puissMax_renouv' => 'required|numeric|min:0',  // Require a non-negative number
            'date_renouv' => 'required|date',               // Require a valid date
            'typeE_renouv' => 'required|string',            // Ensure type is a string
            'prodEstime_renouv' => 'required|numeric|min:0', // Require a non-negative number
            'coutInstall_renouv' => 'required|numeric|min:0', // Require a non-negative number
            'impactCO2_renouv' => 'required|numeric|min:0', // Require a non-negative number
            'proprio_renouv' => 'required|string|max:255',   // Ensure propietario is a string
        ]);
        Source::whereId($id)->update($validate_data);
        return redirect('/source/')->with('success','Source modifiée avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $source= Source::findOrFail($id);
        $source->delete();
        return redirect('/source/')->with('success','Source supprimée avec succès!');
    }
}
