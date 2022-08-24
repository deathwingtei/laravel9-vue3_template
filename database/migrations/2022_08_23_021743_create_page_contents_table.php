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
            $table->longText("body")->nullable()->default(null);
            $table->longText('image')->nullable()->default(null);
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
                    'body' => 'Start Bootstrap can help you build better websites using the Bootstrap framework! Just download a theme and start customizing, no strings attached!',
                    'image' => null,
                    'page_id' => '6',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'We have got what you need!',
                    'body' => 'Start Bootstrap has everything you need to get your new website up and running in no time! Choose one of our open source, free to download, and easy to use themes! No strings attached!',
                    'image' => null,
                    'page_id' => '7',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'Sturdy Themes',
                    'body' => 'Our themes are updated regularly to keep them bug free!',
                    'image' => 'img/flaticon_book.png',
                    'page_id' => '8',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'Up to Date',
                    'body' => 'All dependencies are kept current to keep things fresh.',
                    'image' => 'img/flaticon_computer.png',
                    'page_id' => '8',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'Ready to Publish',
                    'body' => 'You can use this design as is, or you can make changes!',
                    'image' => 'img/flaticon_world.png',
                    'page_id' => '8',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'Made with Love',
                    'body' => 'Is it really open source if it is not made with love?',
                    'image' => 'img/flaticon_heart.png',
                    'page_id' => '8',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'Item1',
                    'body' => null,
                    'image' => 'img/portfolio/fullsize/1.jpg',
                    'page_id' => '9',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'Item2',
                    'body' => null,
                    'image' => 'img/portfolio/fullsize/2.jpg',
                    'page_id' => '9',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'Item3',
                    'body' => null,
                    'image' => 'img/portfolio/fullsize/3.jpg',
                    'page_id' => '9',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'Item4',
                    'body' => null,
                    'image' => 'img/portfolio/fullsize/4.jpg',
                    'page_id' => '9',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'Item5',
                    'body' => null,
                    'image' => 'img/portfolio/fullsize/5.jpg',
                    'page_id' => '9',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'Item6',
                    'body' => null,
                    'image' => 'img/portfolio/fullsize/6.jpg',
                    'page_id' => '9',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ],
                [
                    'title' => 'Get In Touch!',
                    'body' => 'Ready to start your next project with us? Send us a messages and we will get back to you as soon as possible!',
                    'image' => null,
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
