<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('hires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('librarian_id');
            $table->unsignedBigInteger('reader_id');
            $table->timestamp('due_date')->nullable();
            $table->timestamp('return_date')->nullable();
            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('librarian_id')->references('id')->on('librarians');
            $table->foreign('reader_id')->references('id')->on('readers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('hires');
    }
}
