<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
{
    DB::unprepared('
        CREATE TRIGGER revert_role_on_application_delete
        AFTER DELETE ON wil_applications
        FOR EACH ROW
        BEGIN
            UPDATE users
            SET role = "customer"
            WHERE id = OLD.user_id
            AND role = "student";
        END
    ');
}

public function down()
{
    DB::unprepared('DROP TRIGGER IF EXISTS revert_role_on_application_delete');
}
};
