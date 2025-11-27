{{--
Example Usage of Custom Datalist Component

This file demonstrates how to use the custom datalist in your views.
Copy these examples to your actual views.
--}}

@extends('layouts.dashboard')

@section('title', 'Custom Datalist Examples')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Custom Datalist Examples</h3>
                    </div>
                    <div class="card-body">

                        {{-- Example 1: Classes Selector --}}
                        <div class="mb-4">
                            <h5>1. Classes Selector</h5>
                            <form method="GET" action="#">
                                <x-custom-datalist name="classe_id" :options="$classes ?? []" option-value="id_classe"
                                    option-label="nom_classe" placeholder="Sélectionner une classe"
                                    :selected="request('classe_id')" />
                                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                            </form>
                        </div>

                        <hr>

                        {{-- Example 2: Students Selector (Required) --}}
                        <div class="mb-4">
                            <h5>2. Students Selector (Required)</h5>
                            <form method="POST" action="#">
                                @csrf
                                <x-custom-datalist name="etudiant_id" :options="$etudiants ?? []" option-value="id_etudiant"
                                    option-label="nom" placeholder="Sélectionner un étudiant *" :required="true" />
                                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                            </form>
                        </div>

                        <hr>

                        {{-- Example 3: Non-Searchable Dropdown --}}
                        <div class="mb-4">
                            <h5>3. Status Selector (Non-Searchable)</h5>
                            <x-custom-datalist name="status" :options="[
            ['id' => 'active', 'name' => 'Actif'],
            ['id' => 'inactive', 'name' => 'Inactif'],
            ['id' => 'pending', 'name' => 'En attente'],
        ]"
                                option-value="id" option-label="name" placeholder="Sélectionner un statut"
                                :searchable="false" />
                        </div>

                        <hr>

                        {{-- Example 4: With Change Event Listener --}}
                        <div class="mb-4">
                            <h5>4. With JavaScript Event Listener</h5>
                            <x-custom-datalist name="teacher_id" :options="$enseignants ?? []" option-value="id_enseignant"
                                option-label="nom" placeholder="Sélectionner un enseignant" id="teacherSelect" />
                            <div id="selectedTeacher" class="mt-2 text-muted"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Example: Listen to change event
        document.getElementById('teacherSelect')?.addEventListener('change', function (e) {
            const selectedValue = e.detail.value;
            const selectedOption = e.detail.option;

            const display = document.getElementById('selectedTeacher');
            if (selectedValue) {
                display.textContent = `Selected: ${selectedOption.nom} (ID: ${selectedValue})`;
            } else {
                display.textContent = 'No selection';
            }
        });
    </script>
@endpush