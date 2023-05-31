<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("CREATE OR REPLACE VIEW v_w_user_details as
            SELECT
                    ud.id as user_details_id,
                    u.id as user_id,
                    first_name,
                    last_name,
                    CONCAT(first_name, ' ', last_name) as fullname,
                    id_number,
                    email,
                    phone,
                    user_type,
                    address,
                    emg_person,
                    emg_phone,
                    ud.created_at,
                    ud.updated_at
            FROM user_details ud, users u
            WHERE u.id = ud.user_id;"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS v_w_user_details');
    }
};
