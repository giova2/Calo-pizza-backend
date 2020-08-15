@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Orders</div>
                <div class="card-body">
                    <div class="col-12 text-right">
                        <a name="" id="" class="btn btn-secondary btn-lg mb-1" href="/orders/create" role="button">Create</a>
                    </div>
                    <div class="col-12">
                        <table class="table table-striped table-inverse edit">
                            <thead class="thead-inverse text-center">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th>Total</th>
                                    <th>Currency</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr data-id="{{ $order->id }}">
                                        <td scope="row" >{{ $order->id }}</td>
                                        <td >{{ $order->name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->contact }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td>{{ $order->currency }}</td>
                                        <td>
                                        <select class="order-status" id="selectedOrder{{$order->id}}" v-model="selectedOrder{{$order->id}}" @change.prevent="changeOrderStatus({{$order->id}}, selectedOrder{{$order->id}})">
                                            @foreach($status_orders as $status)
                                                <option value="{{$status}}" @if ($order->status == $status) 
                                                selected="selected"
                                                @endif
                                                > {{ ucfirst($status) }}</option>
                                            @endforeach
                                        </select>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="no-data text-center">
                                        <td colspan="8">No Orders</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 custom-pagination">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>            
@endsection