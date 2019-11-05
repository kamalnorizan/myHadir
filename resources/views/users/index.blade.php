@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                    <table class="table table-light">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>Institut Latihan</td>
                                <td>Role</td>
                                <td>Tindakan</td>
                            </tr>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->name}}</td>
                                <td>@foreach ($user->roles as $role)
                                        <span class="badge badge-primary">{{$role->name}}</span>
                                    @endforeach</td>
                                <td>Tindakan</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
