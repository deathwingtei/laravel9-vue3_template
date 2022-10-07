<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class AddColumnPermissionToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->enum('permission', ['god', 'admin', 'user'])->default('user');
            $table->softDeletes();
        });

        DB::table('users')->insert(
            array(
                'name' => 'god',
                'email' => 'god@god.com',
                'password' => Hash::make('god123'),
                'permission' => ('god'),
                'email_verified_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ),
            array(
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'permission' => ('admin'),
                'email_verified_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ),
            array(
                'name' => 'user',
                'email' => 'user@user.com',
                'password' => Hash::make('user123'),
                'permission' => ('user'),
                'email_verified_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('permission');
            $table->dropColumn('deleted_at');
        });
    }

    protected function create(array $data)
    {
        return User::create([
     
        ]);
    }
}
