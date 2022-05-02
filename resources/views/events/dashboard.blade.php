@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Eventos</h1>
</div>

<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($events)>0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Participantes</th>
                    <th scope="col">Data</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <th scropt="row">{{$loop->index +1}}</th>
                        <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                        <td>{{ count($event->users) }}</td>
                        <td>{{ date('d/m/Y', strtotime($event->date)) }}</td>
                        <td>
                            <a href="/events/edit/{{ $event->id }}" class="btn btn-info edit-btn">
                                <ion-icon name="create-outline"></ion-icon>
                                Editar
                            </a>
                            <form action="/events/{{ $event->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn">
                                    <ion-icon name="trash-outline"></ion-icon>
                                    Deletar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
        </tbody>
        </table>

    @else
        <p>Você ainda não tem eventos, <a href="/events/create">criar evento</a></p>
    @endif
</div>
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Eventos que estou particioando</h1>
</div>

<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($eventsAsParticipant)>0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Participantes</th>
                    <th scope="col">Data</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eventsAsParticipant as $eventAsP)
                    <tr>
                        <th scropt="row">{{$loop->index +1}}</th>
                        <td><a href="/events/{{ $eventAsP->id }}">{{ $eventAsP->title }}</a></td>
                        <td>{{ count($eventAsP->users) }}</td>
                        <td>{{ date('d/m/Y', strtotime($eventAsP->date)) }}</td>
                        <td>
                        <form action="/events/leave/{{ $eventAsP->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                    Sair do Evento
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
        </tbody>
        </table>

    @else
        <p>Você ainda não está participando de nenhum evento, <a href="/">veja todos os eventos</a></p>
    @endif
</div>

@endsection
