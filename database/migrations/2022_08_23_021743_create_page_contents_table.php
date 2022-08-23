<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->longText("body")->nullable();
            $table->longText('image')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('page_contents', function (Blueprint $table) {
            $table->unsignedBigInteger('page_id');
            $table->foreign('page_id')->references('id')->on('website_settings');
        });

        DB::table('page_contents')->insert(
            array(
                [
                    'title' => 'Your Favorite Place for Free Bootstrap Themes',
                    'body' => '<p class="text-white-75 mb-5">Start Bootstrap can help you build better websites using the Bootstrap framework! Just download a theme and start customizing, no strings attached!</p><a class="btn btn-primary btn-xl" href="#about">Find Out More</a>',
                    'page_id' => '6',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'We\'ve got what you need!',
                    'body' => '<p class="text-white-75 mb-4">Start Bootstrap has everything you need to get your new website up and running in no time! Choose one of our open source, free to download, and easy to use themes! No strings attached!</p> <a class="btn btn-light btn-xl" href="#services">Get Started!</a>',
                    'page_id' => '7',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'At Your Service',
                    'body' => '<div class="row gx-4 gx-lg-5"><div class="col-lg-3 col-md-6 text-center"><div class="mt-5"><div class="mb-2"><i class="bi-gem fs-1 text-primary"></i></div><h3 class="h4 mb-2">Sturdy Themes</h3><p class="text-muted mb-0">Our themes are updated regularly to keep them bug free!</p></div></div><div class="col-lg-3 col-md-6 text-center"><div class="mt-5"><div class="mb-2"><i class="bi-laptop fs-1 text-primary"></i></div><h3 class="h4 mb-2">Up to Date</h3><p class="text-muted mb-0">All dependencies are kept current to keep things fresh.</p></div></div><div class="col-lg-3 col-md-6 text-center"><div class="mt-5"><div class="mb-2"><i class="bi-globe fs-1 text-primary"></i></div><h3 class="h4 mb-2">Ready to Publish</h3><p class="text-muted mb-0">You can use this design as is, or you can make changes!</p></div></div><div class="col-lg-3 col-md-6 text-center"><div class="mt-5"><div class="mb-2"><i class="bi-heart fs-1 text-primary"></i></div><h3 class="h4 mb-2">Made with Love</h3><p class="text-muted mb-0">Is it really open source if it\'s not made with love?</p></div></div></div>',
                    'page_id' => '8',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'Let\'s Get In Touch!',
                    'body' => 'Ready to start your next project with us? Send us a messages and we will get back to you as soon as possible!',
                    'page_id' => '10',
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
        Schema::dropIfExists('page_contents');
    }
}
