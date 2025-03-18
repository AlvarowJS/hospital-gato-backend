<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoredProceduresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $procedures = [
            "DROP PROCEDURE IF EXISTS hospital_registrar;",
            "CREATE PROCEDURE hospital_registrar(
                IN p_age INT,
                IN p_name VARCHAR(255),
                IN p_date_register DATE,
                IN p_distrito_id INT,
                IN p_gerente_id INT,
                IN p_condicion_id INT,
                IN p_sede_id INT
            )
            BEGIN
                INSERT INTO hospitals(age, name, date_register, distrito_id, gerente_id, condicion_id, sede_id)
                VALUES (p_age, p_name, p_date_register, p_distrito_id, p_gerente_id, p_condicion_id, p_sede_id);
            END;",

            "DROP PROCEDURE IF EXISTS hospital_actualizar;",
            "CREATE PROCEDURE hospital_actualizar(
                IN p_id INT,
                IN p_age INT,
                IN p_name VARCHAR(255),
                IN p_date_register DATE,
                IN p_distrito_id INT,
                IN p_gerente_id INT,
                IN p_condicion_id INT,
                IN p_sede_id INT
            )
            BEGIN
                UPDATE hospitals
                SET
                    age = p_age,
                    name = p_name,
                    date_register = p_date_register,
                    distrito_id = p_distrito_id,
                    gerente_id = p_gerente_id,
                    condicion_id = p_condicion_id,
                    sede_id = p_sede_id
                WHERE id = p_id;
            END;",

            "DROP PROCEDURE IF EXISTS hospital_eliminar;",
            "CREATE PROCEDURE hospital_eliminar(IN p_id INT)
            BEGIN
                DELETE FROM hospitals WHERE id = p_id;
            END;",

            "DROP PROCEDURE IF EXISTS hospital_listar;",
            "CREATE PROCEDURE hospital_listar()
            BEGIN
                SELECT * FROM hospitals;
            END;"
        ];

        foreach ($procedures as $procedure) {
            DB::unprepared($procedure);
        }

        $this->command->info('Procedimientos almacenados creados correctamente.');
    }
}
