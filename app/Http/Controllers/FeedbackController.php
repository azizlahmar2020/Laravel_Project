<?php

namespace App\Http\Controllers;
use App\Models\Feedback;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = Feedback::paginate(10);// Fetch all feedback records
        return view('Feedback.AllFeedbacks', compact('feedbacks')); // Pass feedbacks to the view
    }
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Feedback.CreateFeedback');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'comment' => 'required|string|max:255', // Ensure comment is a string with a max length
            'email' => 'required|email', // Ensure a valid email address
            'date' => 'required|date', // Ensure a valid date format
            'rating' => 'required|integer|between:1,5', // Ensure rating is an integer between 1 and 5
        ]);
    
        // Create a new Feedback record using the validated data
        Feedback::create($validatedData);
    
        // Redirect to the feedback page with a success message
        return redirect('/Feedbacks/All')->with('success', 'Feedback submitted successfully!');
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
        $feedback = Feedback::findOrFail($id);
        return view('Feedback.EditFeedback', compact('feedback'));
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
        $validatedData = $request->validate([
            'comment' => 'required|string|max:255',
            'email' => 'required|email',
            'date' => 'required|date',
            'rating' => 'required|integer|between:1,5',
        ]);
    
        $feedback = Feedback::findOrFail($id);
        $feedback->update($validatedData);
    
        return redirect('/Feedbacks/All')->with('success', 'Feedback updated successfully!');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
    
        return redirect('/Feedbacks/All')->with('success', 'Feedback deleted successfully!');
    }
    }
