<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('hits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('librarian_id')->nullable();
            $table->unsignedBigInteger('reader_id')->nullable();
            $table->enum('hit_type', ['best_librarian', 'best_reader']);
            $table->string('month');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('hits');
    }
}
