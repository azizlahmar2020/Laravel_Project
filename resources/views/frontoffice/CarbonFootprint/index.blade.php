@extends('frontoffice.main')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Carbon Footprint</h1>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Electricite Carbon Footprint </th>
                            <th>gas Carbon Footprint </th>
                            <th>oil Carbon Footprint </th>
                            <th>Total Carbon Footprint </th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carbonemisions as $carbon_footprint)
                            <tr>
                                <td>{{ $carbon_footprint->electricity_carbon_emission }}</td>
                                <td>{{ $carbon_footprint->gas_carbon_emission }}</td>
                                <td>{{ $carbon_footprint->heating_oil_carbon_emission }}</td>
                                <td>{{ $carbon_footprint->total_carbon_footprint }}</td>

                                <td>
                                    <a href="" class="btn btn-outline-secondary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form id="delete-form-{{ $carbon_footprint->id }}" action="" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-outline-danger" onclick="">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function deleteCarbonFootprint(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/carbon_footprint/destroy/" + id;
                }
            })
        }
    </script>
@endsection
