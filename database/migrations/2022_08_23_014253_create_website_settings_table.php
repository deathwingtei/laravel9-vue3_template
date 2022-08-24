<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->enum('type', ['page', 'favicon', 'site_name', 'company_name', 'tel', 'email'])->default('page');
            $table->enum('content_size', ['no', 'one', 'many'])->default('no');
            $table->set('editable_data', ['title', 'body', 'image'])->nullable()->default(null);
            $table->longText('image')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('website_settings')->insert(
            array(
                [
                    'title' => 'Template',
                    'type' => 'site_name',
                    'content_size' => 'no',
                    'editable_data' => null,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => '',
                    'type' => 'favicon',
                    'content_size' => 'no',
                    'editable_data' => null,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'Template Company',
                    'type' => 'company_name',
                    'content_size' => 'no',
                    'editable_data' => null,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => '0987654321',
                    'type' => 'tel',
                    'content_size' => 'no',
                    'editable_data' => null,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'templatecompany@templatecompany.com',
                    'type' => 'email',
                    'content_size' => 'no',
                    'editable_data' => null,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'home',
                    'type' => 'page',
                    'content_size' => 'one',
                    'editable_data' => 'title,body',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'about',
                    'type' => 'page',
                    'content_size' => 'one',
                    'editable_data' => 'title,body',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'services',
                    'type' => 'page',
                    'content_size' => 'many',
                    'editable_data' => 'title,body,image',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'portfolio',
                    'type' => 'page',
                    'content_size' => 'many',
                    'editable_data' => 'title,image',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'contact',
                    'type' => 'page',
                    'content_size' => 'one',
                    'editable_data' => 'title,body',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
            ),
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_settings');
    }
};
