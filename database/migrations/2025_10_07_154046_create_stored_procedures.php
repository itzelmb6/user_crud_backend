<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Procedimiento para obtener todos los usuarios
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_get_all_users;
            CREATE PROCEDURE sp_get_all_users()
            BEGIN
                SELECT id, name, email, phone, rol, created_at, updated_at 
                FROM users 
                ORDER BY id DESC;
            END
        ");

        // Procedimiento para crear usuario 
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_create_user;

            CREATE PROCEDURE sp_create_user(
                IN p_name VARCHAR(255),
                IN p_email VARCHAR(255),
                IN p_phone VARCHAR(255),
                IN p_rol VARCHAR(50),  
                IN p_password VARCHAR(255)
            )
            BEGIN
                -- Insertar usuario
                INSERT INTO users (name, email, phone, rol, password, created_at, updated_at)
                VALUES (p_name, p_email, p_phone, p_rol, p_password, NOW(), NOW());
                
                -- Devolver usuario creado (sin password)
                SELECT 
                    id,
                    name,
                    email,
                    phone,
                    rol,
                    created_at,
                    updated_at
                FROM users 
                WHERE id = LAST_INSERT_ID();
            END 
        ");

        // Procedimiento para actualizar usuario
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_update_user;
            CREATE PROCEDURE sp_update_user(
                IN p_id BIGINT,
                IN p_name VARCHAR(255),
                IN p_email VARCHAR(255),
                IN p_phone VARCHAR(255),
                IN p_rol VARCHAR(255)
            )
            BEGIN
                UPDATE users 
                SET name = p_name, email = p_email, phone = p_phone, 
                    rol = p_rol, updated_at = NOW()
                WHERE id = p_id;
                
                SELECT id, name, email, phone, rol, created_at, updated_at 
                FROM users 
                WHERE id = p_id;
            END
        ");

        // Procedimiento para actualizar contraseña
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_update_password;
            CREATE PROCEDURE sp_update_password(
                IN p_id BIGINT,
                IN p_password VARCHAR(255)
            )
            BEGIN
                UPDATE users 
                SET password = p_password, updated_at = NOW()
                WHERE id = p_id;
            END
        ");

        // Procedimiento para eliminar usuario
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_delete_user;
            CREATE PROCEDURE sp_delete_user(IN p_id BIGINT)
            BEGIN
                DELETE FROM users WHERE id = p_id;
            END
        ");

        // Procedimiento para obtener usuario por ID
        DB::unprepared("
            DROP PROCEDURE IF EXISTS sp_get_user_by_id;
            CREATE PROCEDURE sp_get_user_by_id(IN p_id BIGINT)
            BEGIN
                SELECT id, name, email, phone, rol, created_at, updated_at 
                FROM users 
                WHERE id = p_id;
            END
        ");
    }

    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_all_users");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_create_user");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_update_user");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_update_password");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_delete_user");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_user_by_id");
    }
};