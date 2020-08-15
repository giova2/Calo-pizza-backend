@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Items</div>
                <div class="card-body">
                    <div class="col-12 text-right">
                        <a name="" id="" class="btn btn-secondary btn-lg mb-1" href="/items/create" role="button">Create</a>
                    </div>
                    <div class="col-12">
                        <table class="table table-striped table-inverse edit">
                            <thead class="thead-inverse text-center">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Ingredients</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Currency</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr data-id="{{ $item->id }}">
                                        <td scope="row" >{{ $item->id }}</td>
                                        <td >{{ $item->name }}</td>
                                        <td>{{ $item->ingredients }}</td>
                                        <td>{{ $item->size }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->currency }}</td>
                                        <td>
                                        <select class="item-status" id="selectedItem{{$item->id}}" v-model="selectedItem{{$item->id}}" @change.prevent="changeItemStatus({{$item->id}}, selectedItem{{$item->id}})">
                                            @foreach($status_items as $status)
                                                <option value="{{$status}}" @if ($item->status == $status) 
                                                selected="selected"
                                                @endif
                                                > {{ ucfirst($status) }}</option>
                                            @endforeach
                                        </select></td>
                                    </tr>
                                @empty
                                    <tr class="no-data text-center">
                                        <td colspan="7">No Items</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 custom-pagination">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>            
@endsection