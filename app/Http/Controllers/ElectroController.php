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


    public function index(Request $request)
    {
        $search = $request->get('search');

        // Requête de base pour obtenir tous les logements
        $electros = Electro::query();

        // Si un terme de recherche est présent, on filtre les résultats
        if ($search) {
            $electros->where('type', 'LIKE', "%{$search}%");
        }

        // Obtenir les résultats
        $electros = $electros->get();

        // Retourner la vue avec les résultats
        return view('electros.indexElectro', compact('electros','search'));
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
        'logement_id' => 'required|exists:logements,id', // Validate logement_id
    ]);

    // Calculer la consommation avant la création
    $consommation = ($validated['puissance'] / 1000) * $validated['duree'];

    // Ajouter la consommation aux données validées
    $validated['consomation'] = $consommation;

    // Création d'un nouvel electro après validation
    $electro = Electro::create($validated);

    // Redirection après succès
    session()->flash('success', 'Electro added successfully!');
    session()->flash('highlight', $electro->id_electro);
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
             'logement_id' => 'required|exists:logements,id', // Validate logement_id
         ]);

         // Mettre à jour l'electro après validation
         $electro = Electro::findOrFail($id_electro); // Utilise l'id_electro
         $electro->update($validated);

         // Calculer la consommation après la mise à jour des données
         $consommation = ($validated['puissance'] / 1000) * $validated['duree'];
         $electro->consomation = $consommation;

         // Sauvegarder l'électro avec la nouvelle consommation
         $electro->save();

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

public function statistics()
{
    try {
        // Compter le nombre total d'électros
        $totalElectros = Electro::count();

        // Somme de la consommation
        $totalConsommation = Electro::sum('consomation');

        // Moyenne de la puissance
        $averagePuissance = Electro::avg('puissance');

        // Consommation par adresse
        $consommationParAdresse = Electro::with('logement') // Assurez-vous que la relation est définie
            ->selectRaw('logement_id, SUM(consomation) as total_consumption')
            ->groupBy('logement_id')
            ->get();

        // Retourner la vue avec toutes les variables nécessaires
        return view('electros.statistics', compact('totalElectros', 'totalConsommation', 'averagePuissance', 'consommationParAdresse'));
    } catch (\Exception $e) {
        // Log l'erreur
        \Log::error('Erreur lors de la récupération des statistiques: ' . $e->getMessage());

        // Retourner une réponse d'erreur personnalisée
        return response()->view('errors.500', [], 500);
    }
}

public function exportPDF()
{
    $totalElectros = 100; // Exemple de données
    $totalConsommation = 2000; // Exemple de données
    $averagePuissance = 150; // Exemple de données
    $consommationParAdresse = [
        (object)['logement_id' => 1, 'total_consumption' => 500],
        (object)['logement_id' => 2, 'total_consumption' => 600]
    ]; // Exemple de données

    $pdf = PDF::loadView('electros.statistics', compact('totalElectros', 'totalConsommation', 'averagePuissance', 'consommationParAdresse'));
    return $pdf->download('statistiques.pdf');
}


}
