<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fournisseurs = Fournisseur::all(); // Récupérer tous les enregistrements Fournisseur
        return view('Fournisseur.indexFournisseur', compact('fournisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('Fournisseur.createFournisseur');
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
            'nom' => '',
            'type' => 'required',
            'tarif' => 'required|numeric', // Le tarif doit être un nombre
        ]);

        $fournisseur = Fournisseur::create($validate_data);
        return redirect('/fournisseurs')->with('success','Fournisseur créé avec succès !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Cette méthode peut être laissée vide si vous ne l'utilisez pas.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        return view('Fournisseur.edit', compact('fournisseur'));
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
            'nom' => 'required|string|max:255',
            'type' => 'required',
            'tarif' => 'required|numeric', // Le tarif doit être un nombre
        ]);

        Fournisseur::whereId($id)->update($validate_data);
        return redirect('/fournisseurs')->with('success','Fournisseur mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->delete();
        return redirect('/fournisseurs')->with('success','Fournisseur supprimé avec succès');
    }
}
