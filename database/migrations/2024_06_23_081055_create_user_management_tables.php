<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }

        Schema::create($tableNames['permission'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug'); 
            $table->integer('groupby'); 
            $table->datetimes();
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->datetimes();
        });

        Schema::create($tableNames['role_has_permission'], function (Blueprint $table){
            $table->increments('id');
            $table->integer('role_id');
            $table->integer('permission_id');
            $table->datetimes();

        });

        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::drop($tableNames['role_has_permission']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permission']);
    }
};