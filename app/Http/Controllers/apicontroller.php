<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class apicontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        echo "Hola bienvenido a mi API rest";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        echo "Hola Bienvenido a mi API";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        echo "Esta es mi API rest";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        echo "Bienvenido a mi metodo put";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        echo "Bienvenido a mi metodo delete";
    }
}
