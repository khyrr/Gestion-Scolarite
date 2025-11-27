<?php

namespace App\Services;

use App\Models\EtudePaiement;
use App\Models\EnseignPaiement;
use App\Models\Etudiant;
use App\Models\Enseignant;

class PaymentService
{
    /**
     * Create a student payment
     */
    public function createStudentPayment(array $data)
    {
        return EtudePaiement::create($data);
    }

    /**
     * Update a student payment
     */
    public function updateStudentPayment($id, array $data)
    {
        $payment = EtudePaiement::find($id);
        if ($payment) {
            $payment->update($data);
        }
        return $payment;
    }

    /**
     * Create a teacher payment
     */
    public function createTeacherPayment(array $data)
    {
        return EnseignPaiement::create($data);
    }

    /**
     * Update a teacher payment
     */
    public function updateTeacherPayment($id, array $data)
    {
        $payment = EnseignPaiement::find($id);
        if ($payment) {
            $payment->update($data);
        }
        return $payment;
    }
}
