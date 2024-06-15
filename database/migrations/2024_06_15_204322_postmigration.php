<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // had to uninstall php commong
    // then install php mysql , cli.
    // Had to grant all priviliges to localhost@root in mysql. had to 
    // uncomment the mysqli and pdo mysql. 
    // had to cache the config, then clear  the config. 
    // then run php artisan migrate again.
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table){
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('tags');
            $table->string('author');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // just delete the newly created table
        Schema::dropIfExists('posts');
    }
};
