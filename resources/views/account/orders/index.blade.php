@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Historique de mes commandes</h2>
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <table class="striped highlight responsive-table">
            <thead>
              <tr>
                <th>Référence</th>
                <th>Date</th>
                <th>Prix total</th>
                <th>Paiement</th>
                <th>État</th>
                <th></th>
              </tr>
            </thead>    
            <tbody>
              @foreach($orders as $order)
              <tr>
                <td>{{ $order->reference }}</td>
                <td>{{ $order->created_at->calendar() }}</td>
                <td>{{ number_format($order->total_order, 2, ',', ' ') }} DT</td>
                <td>{{ $order->payment_text }}</td>
                <td><span class="badge new {{ $order->state->color }}" data-badge-caption="{{ $order->state->name }}"></span></td>
                <td><a href="{{ route('commandes.show', $order->id) }}" class="waves-effect waves-light btn-small">Détails</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <a class="waves-effect waves-light btn" href="{{ route('account') }}"> <i class="material-icons left">chevron_left</i>Retour à mon compte</a>      
  </div> 
</div>
@endsection