@extends('frontoffice.main')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')
    <div class="container">
        <h1>Consommations d'énergie</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('energyconso.create') }}" class="btn btn-primary">Ajouter une consommation d'énergie</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Électricité (kWh)</th>
                    <th>Gaz (m³)</th>
                    <th>Huile de chauffage (litres)</th>
                    <th>Énergie solaire (kWh)</th>
                    <th>Période</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consumptions as $consumption)
                    <tr>
                        <td>{{ $consumption->electricity_consumption }}</td>
                        <td>{{ $consumption->gas_consumption }}</td>
                        <td>{{ $consumption->heating_oil_consumption }}</td>
                        <td>{{ $consumption->solar_energy_generated }}</td>
                        <td>{{ $consumption->period }}</td>
                        <td>
                            <a href="{{ route('energyconso.edit', $consumption->id) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="delete-form-{{ $consumption->id }}"
                                action="{{ route('energyconso.destroy', $consumption->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-outline-danger"
                                    onclick="confirmDelete({{ $consumption->id }})">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                data-bs-target="#carbonModal{{ $consumption->id }}">
                                <i class="fas fa-leaf"></i>
                            </button>
                            <!-- Carbon Footprint Modal -->
                            <div class="modal fade" id="carbonModal{{ $consumption->id }}" tabindex="-1"
                                aria-labelledby="carbonModalLabel{{ $consumption->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="carbonModalLabel{{ $consumption->id }}">Calculer
                                                l'Empreinte Carbone</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('carbonfootprint.store', $consumption->id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="energy_consumption_id"
                                                    value="{{ $consumption->id }}">
                                                <div class="mb-3">
                                                    <label for="electricity" class="form-label">Électricité (kWh)</label>
                                                    <input type="text" class="form-control" id="electricity"
                                                        value="{{ $consumption->electricity_consumption }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="gas" class="form-label">Gaz (m³)</label>
                                                    <input type="text" class="form-control" id="gas"
                                                        value="{{ $consumption->gas_consumption }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="oil" class="form-label">Huile de chauffage
                                                        (litres)
                                                    </label>
                                                    <input type="text" class="form-control" id="oil"
                                                        value="{{ $consumption->heating_oil_consumption }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="additional_info" class="form-label">Informations
                                                        supplémentaires</label>
                                                    <textarea name="additional_info" class="form-control" id="additional_info"
                                                        placeholder="Entrez des détails si nécessaire"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Calculer Empreinte
                                                    Carbone</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $consumptions->links() }} <!-- This will render the pagination links -->
        </div>
    </div>
@endsection

<script>
    function confirmDelete(consumptionId) {
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Vous ne pourrez pas annuler cette action !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + consumptionId).submit();
            }
        });
    }
</script>
