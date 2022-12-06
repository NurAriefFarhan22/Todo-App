@extends ('layout')


@section('content')
    @if (session('SuccessUpdate'))
        <div class="alert alert-success">
            {{Session('SuccessUpdate')}}
        </div>
    @endif
<div class="container">
    <table class="table table-striped">
        <tr>
            <td>No</td>
            <td>Kegiatan</td>
            <td>Deskripsi</td>
            <td>Batas Waktu</td>
            <td>Status</td>
            <td>Aksi</td>
        </tr> 
        @php
            $no = 1;
        @endphp
        @foreach ($todos as $todo)
        <tr>
            {{-- tiap di looping, $no bakal ditambah 1 --}}
            <td>{{ $no++ }}</td>
            <td>{{ $todo ['title'] }}</td>
            <td>{{ $todo ['description'] }}</td>
            {{-- carbon : package date pada laravel, nantinya si date yg  2022-11-22 formatnya jadi 22 november, 2022 --}}
            <td>{{ \Carbon\Carbon::parse($todo['date'])->format('j F, Y') }}</td>
            {{-- konsep ternary, if statusnya 1 nemapilin text complate kalo 0 nampilin text on-process . status tuh boolean kan? cmn antara 1 atau 0 --}}
            <td>{{ $todo ['status'] ? 'Complate' : 'On-process' }}</td>
            <td class="d-flex">
                {{-- <div class="button-edit"> --}}
                    {{--karena path {id} merupakan path dinamis, --}}
                    <a class="btn btn-primary"href="/edit/{{ $todo['id'] }}">Edit</a> 
                    <form action="/destroy/{{ $todo['id'] }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary mx-2" type="submit">Hapus</button>
                    </form>
                    @if ($todo['status'] == 0)
                        <form action="/complated/{{ $todo['id'] }}" method="POST">
                                @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Complated</button>
                        </form>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </table>
</div>
       
@endsection