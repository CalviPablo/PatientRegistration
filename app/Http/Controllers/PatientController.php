<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationEmail;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\isNull;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Patient::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:patients,email',
                'phone_number' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png'
            ]);

            if (!$request->hasFile('image') || !$request->file('image')->isValid()) {
                return response()->json(['error' => 'Invalid image upload'], 400);
            }
            
    
            $patient = new Patient();
            $patient->name = $request->input('name');
            $patient->email = $request->input('email');
            $patient->phone_number = $request->input('phone_number');
    
            // Lo guarda en storage/app/public/images/download
            $imagePath = $request->file('image')->store('images', 'public');

            $patient->image = $imagePath;

            // Envia un mail usando MailTrap
            Mail::to($patient->email)->send(new ConfirmationEmail($patient));
            $patient->save();
    
            return response()->json(['success' => true, 'message' => 'Patient created successfully', 'patient' => $patient], 201);
        } catch (ValidationException $th) {
            return response()->json(['success' => false, 'errorMessages' => $th->errors()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json(['success' => false, 'errorMessages' => 'Patient not found'], 404);
        }
        return response()->json(['success' => true, 'patient' => $patient], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:patients,email,' . $patient->id,
            'phone_number' => 'required|string',
            'image' => 'image|mimes:jpeg,png'
        ]);

        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Borrar imagen anterior de la carpeta
            if ($patient->image) {
            }

            $image = $request->file('image')->store('public/images/documents');
            $patient->image = $image;
        }
        $patient->save();

        return response()->json(['message' => 'Patient updated successfully', 'patient' => $patient], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        if ($this->NotFactoryImg($patient->image)) {
            Storage::delete($patient->image);
        }
        $patient->delete();
        return $patient;
    }
}
