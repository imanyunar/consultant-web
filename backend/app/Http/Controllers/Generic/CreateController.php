<?php
 
namespace App\Http\Controllers\Generic;
 
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Psychologist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CreateController extends Controller
{
    public function store(Request $request, string $model)
    {
       return match ($model){
            'psychologists' => $this->psychologistStore($request),
            'patients' => $this->patientStore($request),
            'appointments' => $this->appointmentStore($request),
            'schedules' => $this->scheduleStore($request),
            'payments' => $this->paymentStore($request),
            default => response()->json(['message' => 'Model not found'], 404), 

       };
    }


    private function psychologistStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:psychologists',
            'phone' => 'required|string|max:20',
            'specialization' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'consultation_fee' => 'required|numeric|min:0',
        ]);

    ;

        return response()->json([
            'message' => 'Psichologist created successfully',
            'data' => Psychologist::create($request->all()),
            
        ]);
    }

    private function patientStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:patients',
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date',
        ]);
        
      
        return response()->json([
            'message' => 'Patient created successfully',
            'data' => Patient::create($request->all()),
        ]);
    }

    private function appointmentStore(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'psychologist_id' => 'required|exists:psychologists,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'status' => 'required|string|in:scheduled,completed,canceled',
            'notes' => 'nullable|string',
        ]);

        return response()->json([
            'message' => 'Appointment created successfully',
            'data' => Appointment::create($request->all()),
        ]);
    }

    private function paymentStore(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:255',
            'status' => 'required|string|in:pending,completed,failed',
        ]);

        return response()->json([
            'message' => 'Payment created successfully',
            'data' => Payment::create($request->all()),
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
        public function register(Request $request){ 
        
            $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
 
        $user  = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
 
        $token = $user->createToken('auth_token')->plainTextToken;
 
        return response()->json([
            'message'      => 'Register successful',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => $user,
        ], 201);
    
    }

}
