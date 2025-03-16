@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Choisissez un abonnement</h2>

    <div class="row">
        @foreach($abonnements as $abonnement)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $abonnement->nom }}</h5>
                        <p class="card-text">Prix: {{ number_format($abonnement->prix, 0, ',', ' ') }} FCFA</p>
                        <form action="{{ route('paiement.initiate', $abonnement->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">S'abonner</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
