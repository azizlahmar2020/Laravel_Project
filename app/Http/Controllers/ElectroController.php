<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Electro;

class ElectroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retourner tous les électros
        $electros = Electro::all();
        return view('electros.indexElectro', compact('electros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('electros.createElectro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'puissance' => 'required|numeric|min:0',
            'duree' => 'required|numeric|min:0',
            'consomation' => 'required|numeric|min:0',
        ]);

        // Création d'un nouvel electro après validation
      $Electro=  Electro::create($validated);

        // Redirection après succès
      //  return redirect()->route('electros.indexElectro')->with('success', 'Electro créé avec succès!');
      session()->flash('success', 'ElectroMenager added Electro!');
session()->flash('highlight', $Electro->id_electro);
        return redirect('/Electros');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $electro = Electro::findOrFail($id);
        return view('electros.show', compact('electro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_electro
     * @return \Illuminate\Http\Response
     */
    public function edit($id_electro)
    {
        $electro = Electro::findOrFail($id_electro); // Utilisez la colonne id_electro
        return view('electros.editElectro', compact('electro'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_electro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_electro)
{
    // Validation des données
    $validated = $request->validate([
        'type' => 'required|string|max:255',
        'puissance' => 'required|numeric|min:0',
        'duree' => 'required|numeric|min:0',
        'consomation' => 'required|numeric|min:0',
    ]);

    // Mettre à jour l'electro après validation
    $electro = Electro::findOrFail($id_electro); // Utilisez la colonne id_electro
    $electro->update($validated);

    // Redirection après succès
   // return redirect()->route('electros.indexElectro')->with('success', 'Electro mis à jour avec succès!');

session()->flash('success', 'Electro updated successfully!');
session()->flash('highlight', $id_electro);
        return redirect()->route('electros.indexElectro');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Supprimer l'electro
        Electro::findOrFail($id)->delete();

//        return redirect()->route('electros.indexElectro')->with('success', 'Electro supprimé avec succès!');
session(['highlight' => $id]); // Ajoutez cette ligne

       return redirect()->route('electros.indexElectro')->with('danger', 'Electro deleted successfully');
}
}
