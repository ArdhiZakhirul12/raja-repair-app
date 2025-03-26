<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\cabang;
use App\Models\sparepart;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cabangs = User::role('cabang')->get();

        return view('admin.sparepart.index', compact('cabangs'));
    }
    public function getSpareparts(Request $request)
    {
        $query = sparepart::with('user');
        if ($request->has('cabang') && !empty($request->cabang)) {
            $query->where('user_id', $request->cabang);
        }

        $spareparts = $query->get()->unique('code');
        return DataTables::of($spareparts)
            ->addColumn('action', function ($sparepart) {
                return '<a href="/sparepart/edit/'.$sparepart->id.'" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cabangs = cabang::all();
        return view('admin.sparepart.create', compact('cabangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
