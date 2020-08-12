@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
        @if (isset($order))
            <form action="{{ route('orders.update', ['id'=> $order->id]) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Order's name" aria-describedby="helpId" value="{{ $order->name }}">
                    <small id="helpId" class="text-muted">Name of your Order</small>
                    @error('name')
                    <div class="alert {{ $errors->first('name', 'alert-danger') }} " role="alert">
                      {{  $errors->first('name', ':message') }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Contact</label>
                    <input type="text" placeholder="Contact Phone"
                    class="form-control" name="contact" id="contact" aria-describedby="helpId" value="{{ $order->contact }}">
                    <small id="helpId" class="text-muted">Contact phone number</small>
                    @error('contact')
                    <div class="alert {{ $errors->first('contact', 'alert-danger') }} " role="alert">
                      {{  $errors->first('contact', ':message') }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="">Address</label>
                  <input placeholder="Shipping address" class="form-control" name="address" id="address" value="{{ $order->address }}" />
                  <small id="helpId" class="text-muted">complete with your full address</small>
                  @error('address')
                  <div class="alert {{ $errors->first('address', 'alert-danger') }} " role="alert">
                      {{  $errors->first('address', ':message') }}
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="">Currency</label>
                  <select class="form-control" name="currency" id="currency" readonly="readonly" >
                    <option value="EUR">EUROS</option>
                    <!-- <option value="USD">DOLLARS</option> -->
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Status</label>
                  <select class="form-control" name="status" id="status">
                    <option value="approbed" @if($order->status == $status_orders[0]) selected="selected" @endif >Approbed</option>
                    <option value="pending" @if($order->status == $status_orders[1]) selected="selected" @endif >Pending</option>
                    <option value="rejected" @if($order->status == $status_orders[2]) selected="selected" @endif >Rejected</option>
                  </select>
                </div>
                <div class="form-group">
                    <label for="">Order's Items</label>
                    <table class="table table-striped table-inverse edit">
                        <thead class="thead-inverse text-center">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Ingredients</th>
                                <th>Price</th>
                                <th>Currency</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody style="max-height:300px; overflow:auto;">
                            @forelse ($order_items as $order_item)
                                <tr class="no-data text-center" data-id="{{ $order_item->id }}">
                                    <td scope="row" >{{ $order_item->id }}</td>
                                    <td>{{ $order_item->name }}</td>
                                    <td>{{ $order_item->ingredients }}</td>
                                    <td>{{ $order_item->price }}</td>
                                    <td>{{ $order_item->currency }}</td>
                                    <td>{{ $order_item->quantity }}</td>
                                </tr>
                            @empty
                                <tr class="no-data text-center">
                                    <td colspan="6" >No Items</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary">Accept</button>
                <a href="/orders" class="btn btn-secondary">Cancel</a>
            </form>
        @else
            <form action="{{ route('orders.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Order's name" aria-describedby="helpId" value="{{ old('name') }}">
                    <small id="helpId" class="text-muted">Name of your Order</small>
                    @error('name')
                    <div class="alert {{ $errors->first('name', 'alert-danger') }} " role="alert">
                      {{  $errors->first('name', ':message') }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Contact</label>
                    <input type="text" placeholder="Contact Phone" class="form-control" name="contact" id="contact" aria-describedby="helpId" value="{{ old('contact') }}">
                    <small id="helpId" class="text-muted">Contact phone number</small>
                    @error('contact')
                    <div class="alert {{ $errors->first('contact', 'alert-danger') }} " role="alert">
                      {{  $errors->first('contact', ':message') }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="">Address</label>
                  <input placeholder="Shipping address" class="form-control" name="address" id="address" value="{{ old('address') }}"/>
                  <small id="helpId" class="text-muted">complete with your full address</small>
                  @error('address')
                  <div class="alert {{ $errors->first('address', 'alert-danger') }} " role="alert">
                      {{  $errors->first('address', ':message') }}
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="">Currency</label>
                  <select class="form-control" name="currency" id="currency" readonly="readonly" >
                    <option  value="EUR">EUROS</option>
                    <!-- <option value="USD">DOLLARS</option> -->
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Status</label>
                  <select class="form-control" name="status" id="status">
                    <option value="approbed">Approbed</option>
                    <option value="pending">Pending</option>
                    <option value="rejected">Rejected</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Shipping fee (in Euros)</label>
                  <input type="number" placeholder="Shipping fee" class="form-control" name="fee" id="fee" value="{{ old('fee') }}"/>
                  <small id="helpId" class="text-muted">SHIPPING FEE IS UNMODIFICABLE ONCE IS SAVED AND WILL BE ADDED PERMANENTLY TO THE TOTAL</small>
                  @error('fee')
                  <div class="alert {{ $errors->first('fee', 'alert-danger') }} " role="alert">
                      {{  $errors->first('fee', ':message') }}
                  </div>
                  @enderror
                </div>
                
                <div class="form-group">
                    <label for="">Order's Items</label>
                    <hr />
                    <cite> To choose which item tou would like to add just set the quantity as a positive integer number, once you choose and saved the items, this ACTION is unmodificable so if you made a mistake, just set the status as rejected and charge another order.</cite>
                    <hr />
                    <table class="table table-striped table-inverse edit">
                        <thead class="thead-inverse text-center">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Ingredients</th>
                                <th>Price</th>
                                <th>Currency</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody style="max-height:300px; overflow:auto;">
                            @forelse ($items as $item)
                                <tr class="no-data text-center" data-id="{{ $item->id }}">
                                    <td scope="row" ><input name="item_id[]" class="form-control" readonly="readonly" value="{{ $item->id }}" /></td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->ingredients }}</td>
                                    <td><input name="price[]" class="form-control" readonly="readonly" value="{{ $item->price }}"/> </td>
                                    <td>{{ $item->currency }}</td>
                                    <td><input name="quantity[]" type="number" value="{{ old('quantity.'.$loop->index) }}" class="form-control" placeholder="Leave blank if you don't want this item"/>
                                        @error('quantity.'.$loop->index)
                                        <div class="alert {{ $errors->first('quantity.'.$loop->index, 'alert-danger') }} " role="alert">
                                            {{  $errors->first('quantity.'.$loop->index, ':message') }}
                                        </div>
                                        @enderror
                                    </td>
                                </tr>
                            @empty
                                <tr class="no-data text-center">
                                    <td colspan="6" >No Items</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary">Accept</button>
                <a href="/orders" class="btn btn-secondary">Cancel</a>
            </form>
        <!-- TODO: This is for server side, there is another version for browser defaults -->
        @endif      
        </div>
    </div>
</div>
@endsection