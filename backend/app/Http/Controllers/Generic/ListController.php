<?php

namespace App\Http\Controllers\Generic;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Psychologist;
use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /** GET /{model} */
    public function index(Request $request, string $model)
    {
        return match ($model) {
            'psychologists' => $this->psychologistIndex($request),
            'patients'      => $this->patientIndex($request),
            'appointments'  => $this->appointmentIndex($request),
            'payments'      => $this->paymentIndex($request),
            'users'         => $this->userIndex($request),
            default         => response()->json(['message' => 'Model tidak ditemukan'], 404),
        };
    }

    /** GET /{model}/{id}/{action} */
    public function action(Request $request, string $model, $id, string $action)
    {
        return match (true) {
            $model === 'psychologists' && $action === 'appointments' => $this->appointmentsByPsychologist($id),
            $model === 'patients'      && $action === 'appointments' => $this->appointmentsByPatient($id),
            $model === 'appointments'  && $action === 'payment'      => $this->paymentByAppointment($id),
            default => response()->json(['message' => "Action [$action] tidak ditemukan untuk [$model]"], 404),
        };
    }

    private function psychologistIndex(Request $request)
    {
        $query = Psychologist::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('specialization', 'like', "%$search%");
            });
        }

        if ($request->filled('specialization')) {
            $query->where('specialization', $request->specialization);
        }

        return response()->json([
            'success' => true,
            'data'    => $query->orderBy('name')->paginate($request->get('per_page', 10)),
        ]);
    }

    private function patientIndex(Request $request)
    {
        $user = $request->user();
        $query = Patient::query();

        // Jika role adalah patient, hanya tampilkan data milik sendiri melalui user_id
        if ($user && $user->role === 'patient') {
            $query->where('user_id', $user->id);
        }

        // Jika role adalah psychologist, hanya tampilkan pasien yang memiliki appointment dengan mereka
        if ($user && $user->role === 'psychologist') {
            $psychologist = $user->psychologist;
            if ($psychologist) {
                $query->whereHas('appointments', function ($q) use ($psychologist) {
                    $q->where('psychologist_id', $psychologist->id);
                });
            } else {
                // Jika tidak ada profil psikolog, jangan tampilkan data
                $query->whereRaw('1 = 0');
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
            });
        }

        return response()->json([
            'success' => true,
            'data'    => $query->orderBy('name')->paginate($request->get('per_page', 10)),
        ]);
    }

    private function appointmentIndex(Request $request)
    {
        $user = $request->user();
        $query = Appointment::with(['patient', 'psychologist']);

        // Scoping berdasarkan role
        if ($user && $user->role === 'patient') {
            $patient = $user->patient;
            if ($patient) {
                $query->where('patient_id', $patient->id);
            } else {
                $query->whereRaw('1 = 0');
            }
        } elseif ($user && $user->role === 'psychologist') {
            $psychologist = $user->psychologist;
            if ($psychologist) {
                $query->where('psychologist_id', $psychologist->id);
            } else {
                $query->whereRaw('1 = 0');
            }
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('appointment_date', $request->date);
        }

        return response()->json([
            'success' => true,
            'data'    => $query->orderBy('appointment_date')->paginate($request->get('per_page', 10)),
        ]);
    }

    private function appointmentsByPsychologist($psychologistId)
    {
        $appointments = Appointment::with('patient')
            ->where('psychologist_id', $psychologistId)
            ->orderBy('appointment_date')
            ->get();

        return response()->json(['success' => true, 'data' => $appointments]);
    }

    private function appointmentsByPatient($patientId)
    {
        $appointments = Appointment::with('psychologist')
            ->where('patient_id', $patientId)
            ->orderBy('appointment_date', 'desc')
            ->get();

        return response()->json(['success' => true, 'data' => $appointments]);
    }

    private function paymentIndex(Request $request)
    {
        $query = Payment::with('appointment.patient');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return response()->json([
            'success' => true,
            'data'    => $query->latest()->paginate($request->get('per_page', 10)),
        ]);
    }

    private function paymentByAppointment($appointmentId)
    {
        $payment = Payment::where('appointment_id', $appointmentId)->first();

        if (!$payment) {
            return response()->json(['message' => 'Payment tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $payment]);
    }

    public function userIndex(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }

        return response()->json([
            'success' => true,
            'data'    => $query->orderBy('name')->paginate($request->get('per_page', 10)),
        ]);
    }
}
