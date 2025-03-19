<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class HospitalController extends Controller
{
    public function index()
    {
        $data = DB::select('CALL hospital_listar()');
        return response()->json([
            'data' => $data
        ], Response::HTTP_OK);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'age' => 'required|integer',
            'name' => 'required|string|max:255',
            'date_register' => 'required|date',
            'distrito_id' => 'required|integer',
            'gerente_id' => 'required|integer',
            'condicion_id' => 'required|integer',
            'sede_id' => 'required|integer',
        ]);

        try {
            $now = now();
            DB::statement('CALL hospital_registrar(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $validated['age'],
                $validated['name'],
                $validated['date_register'],
                $validated['distrito_id'],
                $validated['gerente_id'],
                $validated['condicion_id'],
                $validated['sede_id'],
                $now,
                $now
            ]);

            return response()->json(['message' => 'Hospital registrado correctamente'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al registrar hospital',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function show(string $id)
    {
        //
    }
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'age' => 'required|integer',
            'name' => 'required|string|max:255',
            'date_register' => 'required|date',
            'distrito_id' => 'required|integer',
            'gerente_id' => 'required|integer',
            'condicion_id' => 'required|integer',
            'sede_id' => 'required|integer',
        ]);

        try {
            DB::statement('CALL hospital_actualizar(?, ?, ?, ?, ?, ?, ?, ?)', [
                $id,
                $validated['age'],
                $validated['name'],
                $validated['date_register'],
                $validated['distrito_id'],
                $validated['gerente_id'],
                $validated['condicion_id'],
                $validated['sede_id']
            ]);

            return response()->json(['message' => 'Hospital actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al actualizar hospital',
                'details' => $e->getMessage()
            ], 500);
        }
    }



    public function destroy(string $id)
    {
        try {
            DB::statement('CALL hospital_eliminar(?)', [$id]);

            return response()->json(['message' => 'Hospital eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al eliminar hospital',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
