<?php

namespace Database\Seeders;

use App\Models\EnseignPaiement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EnseignPaiementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all teachers (users with teacher role)
        $teachers = User::whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        })->get();
        
        if ($teachers->isEmpty()) {
            $this->command->warn('No teachers found. Please run RolesAndPermissionsSeeder first.');
            return;
        }

        $paymentTypes = [
            'salaire' => [
                'montant_range' => [800, 2500],
                'frequency' => 1.0, // All teachers get salary
            ],
            'prime' => [
                'montant_range' => [100, 500],
                'frequency' => 0.6, // 60% get bonuses
            ],
            'heures_supp' => [
                'montant_range' => [50, 300],
                'frequency' => 0.4, // 40% get overtime pay
            ],
            'formation' => [
                'montant_range' => [200, 800],
                'frequency' => 0.2, // 20% get training allowances
            ],
            'transport' => [
                'montant_range' => [100, 400],
                'frequency' => 0.3, // 30% get transport allowance
            ],
            'autre' => [
                'montant_range' => [50, 600],
                'frequency' => 0.15, // 15% have other payments
            ],
        ];

        $statuses = ['paye', 'non_paye', 'partiel'];
        $statusWeights = [0.75, 0.17, 0.08]; // Most teacher payments are paid

        $this->command->info('Creating teacher payment records...');
        
        foreach ($teachers as $teacher) {
            // Generate monthly salary payments for last 6 months
            for ($month = 0; $month < 6; $month++) {
                $paymentDate = Carbon::now()->subMonths($month)->startOfMonth()->addDays(rand(25, 30));
                
                $montant = rand($paymentTypes['salaire']['montant_range'][0], $paymentTypes['salaire']['montant_range'][1]);
                $statut = $this->selectWeightedStatus($statuses, $statusWeights);

                EnseignPaiement::create([
                    'user_id' => $teacher->id,
                    'typepaiement' => 'salaire',
                    'montant' => $montant,
                    'statut' => $statut,
                    'date_paiement' => $paymentDate,
                ]);
            }
            
            // Generate additional payment types based on frequency
            foreach ($paymentTypes as $type => $config) {
                if ($type === 'salaire') continue; // Already handled above
                
                if (mt_rand() / mt_getrandmax() < $config['frequency']) {
                    // Generate 1-3 payments of this type
                    $numPayments = rand(1, 3);
                    
                    for ($i = 0; $i < $numPayments; $i++) {
                        $paymentDate = Carbon::now()->subDays(rand(1, 180));
                        $montant = rand($config['montant_range'][0], $config['montant_range'][1]);
                        $statut = $this->selectWeightedStatus($statuses, $statusWeights);
                        
                        // Adjust partial payments
                        if ($statut === 'partiel') {
                            $montant = $montant * 0.6; // Partial payment is 60% of full amount
                        }

                        EnseignPaiement::create([
                            'user_id' => $teacher->id,
                            'typepaiement' => $type,
                            'montant' => $montant,
                            'statut' => $statut,
                            'date_paiement' => $paymentDate,
                        ]);
                    }
                }
            }
        }

        $totalPayments = EnseignPaiement::count();
        $this->command->info("Created {$totalPayments} teacher payment records.");
        
        // Display summary
        $this->displayPaymentSummary();
    }

    private function selectWeightedStatus(array $statuses, array $weights): string
    {
        $rand = mt_rand() / mt_getrandmax();
        $cumulative = 0;
        
        foreach ($weights as $index => $weight) {
            $cumulative += $weight;
            if ($rand < $cumulative) {
                return $statuses[$index];
            }
        }
        
        return $statuses[0]; // Fallback
    }

    private function displayPaymentSummary(): void
    {
        $this->command->info("\n=== Teacher Payment Summary ===");
        
        $summaryByType = EnseignPaiement::selectRaw('typepaiement, COUNT(*) as count, SUM(montant) as total')
            ->groupBy('typepaiement')
            ->orderBy('count', 'desc')
            ->get();

        foreach ($summaryByType as $summary) {
            $this->command->line(sprintf(
                "%-15s: %3d payments, $%8.2f total",
                ucfirst($summary->typepaiement),
                $summary->count,
                $summary->total
            ));
        }

        $summaryByStatus = EnseignPaiement::selectRaw('statut, COUNT(*) as count')
            ->groupBy('statut')
            ->orderBy('count', 'desc')
            ->get();

        $this->command->info("\n=== Payment Status Summary ===");
        foreach ($summaryByStatus as $summary) {
            $this->command->line(sprintf(
                "%-10s: %3d payments",
                ucfirst($summary->statut),
                $summary->count
            ));
        }

        $grandTotal = EnseignPaiement::sum('montant');
        $this->command->info("\nTeacher Payments Grand Total: $" . number_format($grandTotal, 2));
    }
}