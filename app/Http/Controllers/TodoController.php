<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function login()
    {
        return view('login');
    }

    
    public function register()
    {
        return view('register');
    }

    public function about()
    {
        return view('about');
    }


    public function index()
    {
        //menampilkan hamanan awal dan semua data
        // return view
        // ('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
        //manampilkan halaman form untuk 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required|min:3',
        'date' => 'required',
        'description' => 'required|min:8',
        ]);

        // yg ' ' = nama column
        // yg $reques-> = value name di input 
        //  kenapa kirim 5 data padahal di input ada 3 inputan? kalau dicek di table todos itu kan ada 6 column yg harus diisi, salah satunya column done_date yg nullable, kalau nullabel itu ngak usah diisi dulu
        //user_id ngambil id dari fitur auth (history login), supaya tau itu todo punya siapa
        // column status kan boolean, jd klo status si todo blm dikerjain = 0

        Todo::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'status' => 0,
        ]);
        // kalau berhasil tambah ke db, bakal diarahin ke halaman dashboard dengan menampilkan pemberitahuan
        return redirect('/dashboard')->with('addTodo', 'Berhasil menambahkan data Todo!');
    }


    public function data() {
        // ambil data dari table todos
        $todos = Todo::all();
        // compact untuk mengirim data ke bladenya
        return view('data', compact('todos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //menampilkan satu data spesifik
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //menampilkan halaman input edit
        // parameter $id mengambil data path dinamis {id}
        // ambil satu baris data yang memiliki volume column id sama dengan data path dinamis id yang dikirim ke route
        $todo = Todo::where('id', $id)->first();
        // kemudian arahkan/tampilan file view yang bernama edit.blade.php dan kirim data dari $todo
        return view ('edit', compact('todo'));
        // compact untuk mengambil data yang ada di todo
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, $id)
    {
        //mengupdate data yang di database
        // validasi
        $request->validate([
        'title' => 'required|min:3',
        'date' => 'required',
        'description' => 'required|min:8',
        ]);

        Todo::where('id', $id)->update([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'status' => 0,
        ]);

        return redirect('/data')->with('SuccessUpdate', 'Berhasil mengubah data');
        // jika kita masuk ke /data ini dan berhasil masuk dia akan menampilkan ''Berhasil mengubah data'
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //menghapus data di database
        // cari data yang mau dihapus, kalo ketemu langsung hapus datanya
        Todo::where('id', $id)->delete();
        // kalau berhasil arahin balik ke halaman data dengan pemberitahuan
        return redirect('/data')->with('SuccessDelete', 'Berhasil menghapus data Todo');
    }

    public function updateToComplated(Request $request, $id)
    {
        // cari data yang akan diupdates
        // baru setelah data di update ke database melalui model
        // status tipenya boolean (0/1) : 0 (on-process) $ 1 (complated)
        // carbon : package laraavel yang mengelola segala hal yang berhubungan dengan  date
        // now () : mengambil tenggal hari ini
        Todo::where('id', '=', $id)->update([
            'status' => 1,
            'done_time' => \carbon\Carbon::now(),
        ]);
        // jika berhasil, akan dikembalikan ke hamalan awal (halaman tempat button complated berada), kembalikan dengan pemberitahuan
        return redirect()->back()->with('done', 'Todo telah selesai dikerjakan!');
    }
}