<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Condicion;
use App\Models\Distrito;
use App\Models\Gerente;
use App\Models\Hospital;
use App\Models\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class HospitalController extends Controller
{
    public function mostrarOpciones()
    {
        $dataHospital = Hospital::all();
        $dataDistritos = Distrito::all();
        $dataGerentes = Gerente::all();
        $dataCondicions = Condicion::all();
        $dataSedes = Sede::all();
        return response()->json([
            'hospitals' => $dataHospital,
            'distritos' => $dataDistritos,
            'gerentes' => $dataGerentes,
            'condicions' => $dataCondicions,
            'sedes' => $dataSedes,

        ]);
    }
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
            'area' => 'required|string|max:255',
            'date_register' => 'required|date',
            'distrito_id' => 'required|integer',
            'gerente_id' => 'required|integer',
            'condicion_id' => 'required|integer',
            'sede_id' => 'required|integer',
        ]);

        try {
            $now = now();
            DB::statement('CALL hospital_registrar(?, ?, ?, ?, ?,?, ?, ?, ?, ?)', [
                $validated['age'],
                $validated['name'],
                $validated['area'],
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
        $data = Hospital::find($id);
        if (!$data) {
            return response()->json(['message' => 'Registro no encontrado'], 404);
        }
        return response()->json($data);
    }
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'age' => 'required|integer',
            'name' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'date_register' => 'required|date',
            'distrito_id' => 'required|integer',
            'gerente_id' => 'required|integer',
            'condicion_id' => 'required|integer',
            'sede_id' => 'required|integer',
        ]);

        try {
            DB::statement('CALL hospital_actualizar(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $id,
                $validated['age'],
                $validated['name'],
                $validated['area'],
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
