<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facture; // Ensure the Source model is imported
use App\Models\Source; // Ensure the Source model is imported
use PDF;
use App\Models\User; 

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factures = Facture::with('owner')->get(); 
        return view('Facture.indexFacture', compact('factures'));
        }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all(); 
        return view ('Facture.createFacture',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validate_data = $request->validate([
            'consommateur' => 'required|exists:users,id',  // Validation correcte du consommateur
            'date_facture' => 'required|date', 
            'montant_totale' => 'required|numeric|min:0', 
            'periode_facture' => 'required|string|max:255', 
            'consommation_totale' => 'required|numeric|min:0', 
            'prix_unitaire' => 'required|numeric|min:0', 
            'type_energie' => 'required|string|max:255', 
            'emission_carbone' => 'required|numeric|min:0',
            'moyen_paiement' => 'required|string|max:255',
            'statut' => 'required|string|max:255',      
        ]);
    
        // Create a new Facture instance with validated data
        $facture = Facture::create($validate_data);
    
        // Redirect to the invoices (factures) index page with a success message
        return redirect('/facture/')->with('success', 'Facture crée avec succès!');
    }
    

 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facture  = Facture::findOrfail($id);
        return view('Facture.editFacture',compact('facture'));
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
        // Validate the incoming request data for facture fields
        $validatedData = $request->validate([
            'consommateur' => 'required|string|max:255',            // Consumer
            'date_facture' => 'required|date',                      // Invoice date
            'periode_facture' => 'required|string|max:255',        // Billing period
            'consommation_totale' => 'required|numeric|min:0',     // Total consumption
            'prix_unitaire' => 'required|numeric|min:0',           // Unit price
            'montant_totale' => 'required|numeric|min:0',          // Total amount
            'type_energie' => 'required|string|max:255',           // Energy type
            'emission_carbone' => 'required|numeric|min:0',        // Carbon emission (optional)
            'moyen_paiement' => 'required|string|max:255',         // Payment method
            'statut' => 'required|string|max:255',                  // Status
        ]);
    
        // Find the facture by ID and update it with validated data
        Facture::whereId($id)->update($validatedData);
    
        // Redirect to the 'facture' index with a success message
        return redirect('/facture/')->with('success', 'Facture modifiée avec succès!');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $facture= Facture::findOrFail($id);
        $facture->delete();
        return redirect('/facture/')->with('success','Facture supprimée avec succès!');
    }

    public function exportPdf($id)
    {
        // Récupérer la facture avec l'ID donné
        $facture = Facture::findOrFail($id);

        // Charger la vue pour le PDF avec les données de la facture
        $pdf = PDF::loadView('Facture.facturePdf', compact('facture'));

        // Télécharger le PDF avec un nom de fichier personnalisé
        return $pdf->download('facture-' . $facture->id . '.pdf');
    }

  /**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
public function show($id)
{
    $sources = Source::all();
    $facture = Facture::with('owner')->findOrFail($id); // Récupère la facture avec le propriétaire
    return view('Facture.showFacture', compact('facture','sources')); // Renvoie la vue avec les détails de la facture
}

public function addSource(Request $request, $factureId)
{
    $facture = Facture::findOrFail($factureId);
    $source = Source::findOrFail($request->input('source_id'));

    // Update facture with the renewable source data
    $facture->montant_totale += $source->coutInstall_renouv;
    $facture->emission_carbone -= $source->impactCO2_renouv;

    // Save changes to the facture
    $facture->save();

    // Redirect back to the facture details page with success message
    return redirect()->route('Facture.showFacture', $facture->id)
        ->with('success', 'Source renouvelable ajoutée avec succès, facture mise à jour.');
}
public function calculateSource(Request $request, $factureId)
{
    $facture = Facture::findOrFail($factureId);
    $source = Source::findOrFail($request->input('source_id'));

    // Calculer les nouveaux montants sans les sauvegarder
    $newMontant = $facture->montant_totale + $source->coutInstall_renouv;
    $newEmission = $facture->emission_carbone - $source->impactCO2_renouv;

    return response()->json([
        'new_montant' => $newMontant,
        'new_emission' => $newEmission
    ]);
}

}
