<?php

namespace App\Http\Controllers;

use App\Models\InertiaTest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InertiaTestController extends Controller
{
    public function index()
    {
        return Inertia::render('Inertia/index');
    }

    public function show($id)
    {
        // dd($id);
        return Inertia::render('Inertia/show',['id'=> $id]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $inertiaTest = new InertiaTest;
        $inertiaTest->title = $request->title;
        $inertiaTest->content = $request->content;
        $inertiaTest->save();
        return to_route('inertia.index');
    }
}
