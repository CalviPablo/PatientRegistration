<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationEmail;
use App\Models\Patient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\isNull;

class PatientController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return Patient::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
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

            // La direccion donde se guarda la imagen
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
    public function show($id) {
        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json(['success' => false, 'errorMessages' => 'Patient not found'], 404);
        }
        return response()->json(['success' => true, 'patient' => $patient], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient) {
        try {
            $patient = Patient::find($patient->id);

            if (!$patient) {
                return response()->json(['success' => false, 'message' => 'Patient not found'], 404);
            }

            $request->validate([
                'name' => 'sometimes|string',
                'phone_number' => 'sometimes|string',
            ]);

            if (!empty($request->input('name'))) {
                $patient->name = $request->input('name');
            }
            if (!empty($request->input('phone_number'))) {
                $patient->phone_number = $request->input('phone_number');
            }

            if ($request->hasFile('image') && $request->file('image')->isValid()) {

                Storage::disk('public')->delete($patient->image);

                $imagePath = $request->file('image')->store('images', 'public');
                $patient->image = $imagePath;
            }
            $patient->save();

            return response()->json(['success' => true, 'message' => 'Patient updated successfully', 'patient' => $patient], 200);
        } catch (ValidationException $th) {
            return response()->json(['success' => false, 'errorMessages' => $th->errors()], 400);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'errorMessages' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        try {
            $patient = Patient::find($id);

            if (!$patient) {
                return response()->json(['success' => false, 'message' => 'Patient not found'], 404);
            }

            $imagePath = $patient->image;

            $patient->delete();

            if ($patient->image) {
                Storage::disk('public')->delete($patient->image);
            }

            return response()->json([
                'success' => true,
                'message' => 'Patient deleted successfully',
                'deleted_image_path' => $imagePath,
            ], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'errorMessages' => $e->getMessage()], 500);
        }
    }
}
