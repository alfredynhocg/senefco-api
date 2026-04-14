<?php

namespace Database\Seeders\Concerns;

use Illuminate\Support\Facades\DB;

trait DisablesForeignKeys
{
    protected function disableForeignKeys(): void
    {
        match (DB::connection()->getDriverName()) {
            'pgsql'  => DB::statement("SET session_replication_role = 'replica'"),
            default  => DB::statement('SET FOREIGN_KEY_CHECKS=0'),
        };
    }

    protected function enableForeignKeys(): void
    {
        match (DB::connection()->getDriverName()) {
            'pgsql'  => DB::statement("SET session_replication_role = 'origin'"),
            default  => DB::statement('SET FOREIGN_KEY_CHECKS=1'),
        };
    }
}
