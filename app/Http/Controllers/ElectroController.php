<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Electro;
use App\Models\Logement;

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
        $electros = Electro::paginate(10);
        return view('electros.indexElectro', compact('electros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $logements = Logement::all(); // Récupérer tous les logements
        return view('electros.createElectro', compact('logements')); // Passer $logements à la vue
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
            'logement_id' => 'required|exists:logements,id', // Validate logement_id
        ]);

        // Création d'un nouvel electro après validation
        $Electro = Electro::create($validated);

        // Redirection après succès
        session()->flash('success', 'Electro added successfully!');
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
    public function edit($id)
    {
        $electro = Electro::findOrFail($id); // Trouver l'électroménager par ID
        $logements = Logement::all(); // Récupérer tous les logements

        return view('electros.editElectro', compact('electro', 'logements')); // Passer les données à la vue
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
            'logement_id' => 'required|exists:logements,id', // Validate logement_id
        ]);

        // Mettre à jour l'electro après validation
        $electro = Electro::findOrFail($id_electro); // Use the id_electro
        $electro->update($validated);

        // Redirection après succès
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
