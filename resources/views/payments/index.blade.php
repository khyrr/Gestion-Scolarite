@extends('layouts.layout')

@section('title', 'Paiement')

@section('content2')
    <div class="container">
        <h1 class="title">Paiement</h1>

        <div class="payment-options">
            <a href="{{ url('/paiement/enseignpaiement') }}" class="payment-option">
                <i class="bi bi-person-fill"></i>
                <span class="payment-option-label">Paiement des Salaires des Enseignants</span>
            </a>
            <a href="{{ url('/paiement/etudepaiement') }}" class="payment-option">
                <i class="bi bi-credit-card-fill"></i>
                <span class="payment-option-label">Reception des Frais d'Étudiants</span>
            </a>
        </div>
    </div>
    <style>
        .container {
            

            text-align: center;
        }

        .title {
            font-size: 36px;
            margin-bottom: 30px;
            color: #333;
        }

        .payment-options {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-color: #f2f2f2;
            color: #333;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .payment-option i {
            font-size: 24px;
            margin-right: 10px;
        }

        .payment-option-label {
            font-size: 18px;
        }

        .payment-option:hover {
            background-color: #ebebeb;
        }
    </style>
@endsection