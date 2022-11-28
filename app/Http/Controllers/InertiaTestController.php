<?php

namespace App\Http\Controllers;

use App\Models\InertiaTest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InertiaTestController extends Controller
{
    public function index()
    {
        $blogs = InertiaTest::all();
        return Inertia::render('Inertia/index',['blogs'=> $blogs]);
    }

    public function show($id)
    {
        // dd($id);
        return Inertia::render('Inertia/show',['id'=> $id]);
    }

    public function create()
    {
        return Inertia::render('Inertia/create');
    }

    public function store(Request $request)
    {

        $request->validate([
            "title" => ['required','max:25'],
            "content" => ['required']
        ]);
        // dd($request);
        $inertiaTest = new InertiaTest;
        $inertiaTest->title = $request->title;
        $inertiaTest->content = $request->content;
        $inertiaTest->save();
        return to_route('inertia.index')->with([
            'message' => '登録完了しました'
        ]);
    }
}
