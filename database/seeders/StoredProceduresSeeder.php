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
                IN p_area VARCHAR(255),
                IN p_date_register DATE,
                IN p_distrito_id INT,
                IN p_gerente_id INT,
                IN p_condicion_id INT,
                IN p_sede_id INT,
                IN p_created_at DATETIME,
                IN p_updated_at DATETIME
            )
            BEGIN
                INSERT INTO hospitals(age, name, area, date_register, distrito_id, gerente_id, condicion_id, sede_id,created_at, updated_at)
                VALUES (p_age, p_name, p_area, p_date_register, p_distrito_id, p_gerente_id, p_condicion_id, p_sede_id, p_created_at, p_updated_at);
            END;",

            "DROP PROCEDURE IF EXISTS hospital_actualizar;",
            "CREATE PROCEDURE hospital_actualizar(
                IN p_id INT,
                IN p_age INT,
                IN p_name VARCHAR(255),
                IN p_area VARCHAR(255),
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
                    area = p_area,
                    date_register = p_date_register,
                    distrito_id = p_distrito_id,
                    gerente_id = p_gerente_id,
                    condicion_id = p_condicion_id,
                    sede_id = p_sede_id,
                    updated_at = NOW()
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
               SELECT ho.id, ho.name, ho.age, di.name as distrito, se.name as sede, ge.name as gerente, co.name as condicion, ho.date_register FROM hospitals as ho join
                gerentes as ge on ho.gerente_id = ge.id join
                distritos as di on ho.distrito_id = di.id join
                condicions as co on ho.condicion_id = co.id join
                sedes as se on ho.sede_id = se.id;
            END;"
        ];

        foreach ($procedures as $procedure) {
            DB::unprepared($procedure);
        }

        $this->command->info('Procedimientos almacenados creados correctamente.');
    }
}
