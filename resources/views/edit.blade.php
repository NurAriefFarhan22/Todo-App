@extends ('layout')

@section('content')
    <form action="/update/{{$todo['id']}}" method="POST" style="max-width: 500px; margin:auto;">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @csrf
        @method('PATCH')
        <div class="d-flex flex-column">
            <label>Title</label>
            <input type="text" name="title" value="{{$todo['title']}}">
        </div>
        <div class="d-flex flex-column"></div>
            <label>date</label>
            <input type="date" name="date" value="{{$todo['date']}}">
        </div>
        <div class="d-flex flex-column">
            <label>Description</label>
            <textarea name="description" cols="30" rows="5" class="text-dark">{{$todo["description"]}}</textarea>
        </div>
        <button type="submit">Kirim</button>
    </form>

    
@endsection