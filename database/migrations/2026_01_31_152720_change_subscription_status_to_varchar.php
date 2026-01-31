<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        // Converte ENUM -> VARCHAR
        DB::statement("
            ALTER TABLE subscriptions
            MODIFY status VARCHAR(20) NOT NULL
        ");
    }

    public function down()
    {
        // Volta para ENUM (caso precise)
        DB::statement("
            ALTER TABLE subscriptions
            MODIFY status ENUM('active','expired','pending') NOT NULL
        ");
    }
};
