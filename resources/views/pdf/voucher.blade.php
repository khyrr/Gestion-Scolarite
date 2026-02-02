<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Voucher</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
            color: #2c3e50;
        }
        
        .voucher-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border: 1px solid #bdc3c7;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .school-logo {
            font-size: 36px;
            margin-bottom: 10px;
        }
        
        .school-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .voucher-title {
            font-size: 18px;
            font-weight: 300;
            opacity: 0.9;
        }
        
        .voucher-body {
            padding: 40px;
        }
        
        .voucher-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #ecf0f1;
        }
        
        .voucher-number {
            font-size: 16px;
            font-weight: bold;
            color: #27ae60;
        }
        
        .voucher-date {
            font-size: 14px;
            color: #7f8c8d;
            text-align: right;
        }
        
        .employee-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 5px solid #27ae60;
        }
        
        .employee-name {
            font-size: 20px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .employee-details {
            color: #7f8c8d;
            font-size: 14px;
            line-height: 1.8;
        }
        
        .payment-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            border: 1px solid #ecf0f1;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .payment-table th {
            background: #34495e;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: bold;
        }
        
        .payment-table td {
            padding: 15px;
            border-bottom: 1px solid #ecf0f1;
        }
        
        .payment-table tr:last-child td {
            border-bottom: none;
        }
        
        .payment-table tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        .amount-cell {
            font-weight: bold;
            font-size: 16px;
            color: #27ae60;
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-paid {
            background: #d5f4e6;
            color: #27ae60;
        }
        
        .status-pending {
            background: #fef3c7;
            color: #d97706;
        }
        
        .status-partial {
            background: #dbeafe;
            color: #2563eb;
        }
        
        .status-cancelled {
            background: #fecaca;
            color: #dc2626;
        }
        
        .total-section {
            background: #27ae60;
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .total-amount {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .total-label {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }
        
        .signature-box {
            width: 45%;
            text-align: center;
            padding-top: 40px;
        }
        
        .signature-line {
            border-top: 2px solid #34495e;
            margin-bottom: 10px;
        }
        
        .signature-label {
            color: #7f8c8d;
            font-size: 12px;
            font-weight: bold;
        }
        
        .footer {
            background: #ecf0f1;
            padding: 20px;
            text-align: center;
            color: #7f8c8d;
            font-size: 12px;
        }
        
        .notes-section {
            background: #fff3cd;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #ffc107;
        }
        
        .notes-title {
            font-weight: bold;
            color: #856404;
            margin-bottom: 10px;
        }
        
        .notes-content {
            color: #664d03;
            font-size: 13px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="voucher-container">
        <div class="header">
            <div class="school-logo">💼</div>
            <div class="school-name">École de Gestion</div>
            <div class="voucher-title">Payment Voucher</div>
        </div>
        
        <div class="voucher-body">
            <div class="voucher-info">
                <div>
                    <div class="voucher-number">
                        Voucher No: {{ $payment->voucher_number }}
                    </div>
                </div>
                <div class="voucher-date">
                    <strong>Payment Date:</strong> {{ $payment->date_paiement->format('d/m/Y') }}<br>
                    <strong>Generated:</strong> {{ now()->format('d/m/Y H:i') }}
                </div>
            </div>
            
            <div class="employee-section">
                <div class="employee-name">
                    {{ $payment->enseignant->name }}
                </div>
                <div class="employee-details">
                    <strong>Employee ID:</strong> {{ $payment->enseignant->id }}<br>
                    <strong>Email:</strong> {{ $payment->enseignant->email }}<br>
                    <strong>Position:</strong> Teacher
                </div>
            </div>
            
            <table class="payment-table">
                <thead>
                    <tr>
                        <th>Payment Type</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>{{ $payment->getTypeLabel() }}</strong></td>
                        <td>
                            Payment for {{ $payment->date_paiement->format('F Y') }}
                            @if($payment->typepaiement === 'salaire')
                                <br><small>Monthly salary payment</small>
                            @elseif($payment->typepaiement === 'prime')
                                <br><small>Performance bonus</small>
                            @elseif($payment->typepaiement === 'heures_supp')
                                <br><small>Overtime compensation</small>
                            @endif
                        </td>
                        <td>
                            <span class="status-badge status-{{ $payment->statut === 'paye' ? 'paid' : ($payment->statut === 'non_paye' ? 'pending' : 'partial') }}">
                                {{ $payment->statut === 'paye' ? 'Paid' : ($payment->statut === 'non_paye' ? 'Pending' : 'Partial') }}
                            </span>
                        </td>
                        <td class="amount-cell">
                            ${{ number_format($payment->montant, 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <div class="total-section">
                <div class="total-amount">${{ number_format($payment->montant, 2) }}</div>
                <div class="total-label">Total Payment Amount</div>
            </div>
            
            @if($payment->statut === 'paye')
            <div class="notes-section">
                <div class="notes-title">Payment Confirmation</div>
                <div class="notes-content">
                    This voucher confirms that the above payment has been processed successfully on {{ $payment->date_paiement->format('F j, Y') }}. 
                    The amount has been transferred to the employee's designated account.
                </div>
            </div>
            @elseif($payment->statut === 'non_paye')
            <div class="notes-section">
                <div class="notes-title">Payment Pending</div>
                <div class="notes-content">
                    This payment is currently being processed. Expected completion date is within 2-3 business days.
                    Please retain this voucher for your records.
                </div>
            </div>
            @endif
            
            <div class="signature-section">
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <div class="signature-label">EMPLOYEE SIGNATURE</div>
                </div>
                <div class="signature-box">
                    <div class="signature-line"></div>
                    <div class="signature-label">AUTHORIZED BY</div>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p><strong>École de Gestion</strong> - Human Resources Department</p>
            <p>This is a computer-generated voucher. For any discrepancies, please contact HR immediately.</p>
            <p>Tel: +222 XX XXX XXX | Email: hr@ecole-gestion.com</p>
        </div>
    </div>
</body>
</html>