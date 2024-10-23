<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConseilE;
use App\Models\Fournisseur;


class ConseilEController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // Utiliser la méthode paginate pour récupérer les conseils
    $conseils = ConseilE::with('fournisseur')->paginate(10); // 10 par page
    return view('ConseilE.indexConseilE', compact('conseils'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fournisseurs = Fournisseur::all();

        return view('ConseilE.createConseilE', compact('fournisseurs'));
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
            'description' => 'required|string|max:255', // Valider la description
            'economies' => 'required|numeric', // Valider l'économie potentielle
             'fournisseur_id' => 'required|exists:fournisseurs,id', // Ensure fournisseur_id is valid

        ]);

        ConseilE::create($validate_data);
        return redirect('/conseils')->with('success', 'Conseil créé avec succès !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showConseils ($id)
    {
        $fournisseur = Fournisseur::with('conseils')->findOrFail($id); // Load the fournisseur with conseils
        return view('ConseilE.conseilsByFournisseur', compact('fournisseur')); // Pass it to a new view
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fournisseurs = Fournisseur::all();
        $conseils = ConseilE::findOrFail($id);
        return view('ConseilE.edit', compact('conseils'), compact('fournisseurs'));
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
            'description' => 'required|string|max:255', // Valider la description
            'economies' => 'required|numeric', // Valider l'économie potentielle
        ]);

        ConseilE::whereId($id)->update($validate_data);
        return redirect('/conseils')->with('success', 'Conseil mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $conseil = ConseilE::findOrFail($id);
        $conseil->delete();
        return redirect('/conseils')->with('success', 'Conseil supprimé avec succès');
    }
}
