@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Api users</div>
                <div class="card-body">
                    <div class="col-12">
                        <table class="table table-striped table-inverse edit">
                            <thead class="thead-inverse text-center">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Lastname</th>
                                    <th>E-mail</th>
                                    <th>Avatar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($api_users as $api_user)
                                    <tr class="no-data text-center" data-id="{{ $api_user->id }}">
                                        <td scope="row" >{{ $api_user->id }}</td>
                                        <td >{{ $api_user->name }}</td>
                                        <td >{{ $api_user->lastname }}</td>
                                        <td>{{ $api_user->email }}</td>
                                        <td><img src="{{ $api_user->avatar }}" width="40px"/></td>
                                    </tr>
                                @empty
                                    <tr class="no-data text-center">
                                        <td colspan="4">No Api Users</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 custom-pagination">
                        {{ $api_users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>            
@endsection