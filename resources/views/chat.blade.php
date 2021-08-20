@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-4 mb-4">
                <ul class="list-group">
                    <li class="list-group-item text-white py-3 lead" style="background:#128C7E;"><i class="bi bi-person-lines-fill float-left d-flex m-1"></i>Utenti</li>
                    @foreach(DB::table('users')->get() as $user)
                        <li class="list-group-item">{{$user->name}} </li>
                    @endforeach
                </ul>
            </div>
            <chat :current_user="{{auth()->user()->id}}" />
        </div>
    </div>
@endsection


