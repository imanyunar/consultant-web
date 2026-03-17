<?php

namespace App\Http\Controllers\Generic;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Psychologist;
use App\Models\User;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    /** GET /{model}/{id} */
    public function show(Request $request, string $model, $id)
    {
        return match ($model) {
            'users'         => $this->showUser($id),
            'psychologists' => $this->showPsychologist($id),
            'patients'      => $this->showPatient($id),
            'appointments'  => $this->showAppointment($id),
            'payments'      => $this->showPayment($id),
            default         => response()->json(['message' => 'Model tidak ditemukan'], 404),
        };
    }

    private function showUser($id)
    {
        $user = User::find($id);

        return $user
            ? response()->json(['success' => true, 'data' => $user])
            : response()->json(['message' => 'User tidak ditemukan'], 404);
    }

    private function showPatient($id)
    {
        $user = auth()->user();
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['message' => 'Patient tidak ditemukan'], 404);
        }

        // Jika role adalah patient, pastikan user_id cocok
        if ($user && $user->role === 'patient' && $patient->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized: Anda hanya dapat melihat data Anda sendiri.'], 403);
        }

        // Jika role adalah psychologist, pastikan pasien punya appointment dengan mereka
        if ($user && $user->role === 'psychologist') {
            $psychologist = $user->psychologist;
            if (!$psychologist) {
                return response()->json(['message' => 'Unauthorized: Profil psikolog tidak ditemukan.'], 403);
            }
            
            $hasAppointment = $patient->appointments()->where('psychologist_id', $psychologist->id)->exists();
            if (!$hasAppointment) {
                return response()->json(['message' => 'Unauthorized: Anda hanya dapat melihat data pasien yang memiliki janji temu dengan Anda.'], 403);
            }
        }

        return response()->json(['success' => true, 'data' => $patient]);
    }

    private function showAppointment($id)
    {
        $user = auth()->user();
        $appointment = Appointment::with(['patient', 'psychologist'])->find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Janji temu tidak ditemukan'], 404);
        }

        // Scoping berdasarkan role
        if ($user && $user->role === 'patient') {
            $patient = $user->patient;
            if (!$patient || $appointment->patient_id !== $patient->id) {
                return response()->json(['message' => 'Unauthorized: Anda hanya dapat melihat janji temu Anda sendiri.'], 403);
            }
        } elseif ($user && $user->role === 'psychologist') {
            $psychologist = $user->psychologist;
            if (!$psychologist || $appointment->psychologist_id !== $psychologist->id) {
                return response()->json(['message' => 'Unauthorized: Anda hanya dapat melihat janji temu milik Anda sendiri.'], 403);
            }
        }

        return response()->json(['success' => true, 'data' => $appointment]);
    }

    private function showPsychologist($id)
    {
        $psychologist = Psychologist::find($id);

        return $psychologist
            ? response()->json(['success' => true, 'data' => $psychologist])
            : response()->json(['message' => 'Psychologist tidak ditemukan'], 404);
    }

    private function showPayment($id)
    {
        $payment = Payment::with('appointment.patient')->find($id);

        return $payment
            ? response()->json(['success' => true, 'data' => $payment])
            : response()->json(['message' => 'Payment tidak ditemukan'], 404);
    }
}
