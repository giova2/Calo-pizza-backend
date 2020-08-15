@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
        @if (isset($item))
            <form  action="{{ route('items.update', ['id'=> $item->id]) }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="item's name" aria-describedby="helpId" value="{{ $item->name }}">
                    <small id="helpId" class="text-muted">Name of your item</small>
                    @error('name')
                    <div class="alert {{ $errors->first('name', 'alert-danger') }} " role="alert">
                      {{  $errors->first('name', ':message') }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Ingredients</label>
                    <textarea placeholder="Enumerate briefly the Ingredients" class="form-control" name="ingredients" id="ingredients" rows="3" aria-describedby="helpId">{{ $item->ingredients }}</textarea>
                    @error('ingredients')
                    <div class="alert {{ $errors->first('ingredients', 'alert-danger') }} " role="alert">
                      {{  $errors->first('ingredients', ':message') }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="">Size</label>
                  <select class="form-control" name="size" id="size">
                    <option value="small" @if($item->size == 'small') selected="selected" @endif >Small</option>
                    <option value="medium" @if($item->size == 'medium') selected="selected" @endif >Medium</option>
                    <option value="large" @if($item->size == 'large') selected="selected" @endif >Large</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">image</label>
                  <input type="file" class="form-control-file" name="image" id="image" aria-describedby="fileHelpId">
                  <small id="fileHelpId" class="form-text text-muted">Upload an image for your item</small>
                  @if ($item->image_url)
                    <img src="{{ $item->image_url }}" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                  @endif
                </div>
                <div class="form-group">
                  <label for="">Price (in Euros)</label>
                  <input type="number" placeholder="Price" class="form-control" name="price" id="price" value="{{ $item->price }}" />
                  @error('price')
                  <div class="alert {{ $errors->first('price', 'alert-danger') }} " role="alert">
                      {{  $errors->first('price', ':message') }}
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
                    <option value="available" @if($item->status == 'available') selected="selected" @endif >Available</option>
                    <option value="unavailable" @if($item->status == 'unavailable') selected="selected" @endif >Unavailable</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Accept</button>
                <a href="/items" class="btn btn-secondary">Cancel</a>
            </form>
        @else
            <form action="{{ route('items.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="item's name" aria-describedby="helpId" value="{{ old('name') }}" >
                    <small id="helpId" class="text-muted">Name of your item</small>
                    @error('name')
                    <div class="alert {{ $errors->first('name', 'alert-danger') }} " role="alert">
                      {{  $errors->first('name', ':message') }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Ingredients</label>
                    <textarea placeholder="Enumerate briefly the Ingredients" class="form-control" name="ingredients" id="ingredients" rows="3" aria-describedby="helpId">{{ old('ingredients') }}</textarea>
                    @error('ingredients')
                    <div class="alert {{ $errors->first('ingredients', 'alert-danger') }} " role="alert">
                      {{  $errors->first('ingredients', ':message') }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="">Size</label>
                  <select class="form-control" name="size" id="size">
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">image</label>
                  <input type="file" class="form-control-file" name="image" id="image" aria-describedby="fileHelpId">
                  <small id="fileHelpId" class="form-text text-muted">Upload an image for your item</small>
                </div>
                <div class="form-group">
                  <label for="">Price (in Euros)</label>
                  <input type="number" placeholder="Price" class="form-control" name="price" id="price" value="{{ old('price') }}" />
                  @error('price')
                  <div class="alert {{ $errors->first('price', 'alert-danger') }} " role="alert">
                      {{  $errors->first('price', ':message') }}
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="">Currency</label>
                  <select class="form-control" name="currency" id="currency" readonly="readonly" value="{{ old('currency') }}">
                    <option value="EUR">EUROS</option>
                    <!-- <option value="USD">DOLLARS</option> -->
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Status</label>
                  <select class="form-control" name="status" id="status">
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Accept</button>
                <a href="/items" class="btn btn-secondary">Cancel</a>
            </form>
        <!-- TODO: This is for server side, there is another version for browser defaults -->
        @endif      
        </div>
    </div>
</div>
@endsection