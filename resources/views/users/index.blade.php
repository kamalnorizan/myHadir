@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>Institut Latihan</td>
                                <td>Peranan</td>
                                <td>Tindakan</td>
                            </tr>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->iljtm->name}}</td>
                                <td>@foreach ($user->roles as $role)
                                    <span class="badge badge-primary">{{$role->name}}</span>
                                @endforeach</td>
                                <td><button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#assignrole" data-id="{{$user->id}}" data-roles="{{$user->roles}}">Penetapan
                                Tugas</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="assignrole" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Title</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['method' => 'POST', 'route' => 'users.assignrole']) !!}
            <div class="modal-body">
                {!! Form::hidden('user_id', 'value',['id'=>'user_id']) !!}
                <div class="form-group{{ $errors->has('roles[]') ? ' has-error' : '' }}">
                   {!! Form::label('roles[]', 'Tugas') !!}
                   {!! Form::select('roles[]', $roles, null, ['id' => 'roles', 'class' => 'form-control', 'required' => 'required', 'multiple']) !!}
                   <small class="text-danger">{{ $errors->first('roles[]') }}</small>
               </div>
           </div>
           <div class="modal-footer">
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
</div>
@endsection

@section('script')

<script>
    $(document).ready(function(){
        $('#assignrole').on('show.bs.modal', function (event) {
            // console.log( "ready!" );
            // alert('test');
            var button = $(event.relatedTarget);
            var id = button.data('id');

            var roles = button.data('roles');
            $.each(roles, function( intIndex, objValue){
                $('#roles option[value='+objValue.name+']').attr('selected',true);
            });

            $('#user_id').val(id);
        });

        $('#assignrole').on('hidden.bs.modal', function () {
            $.each($("#roles option:selected"), function(){
                $(this).removeAttr("selected");
            });
        });
    });


</script>
@endsection
