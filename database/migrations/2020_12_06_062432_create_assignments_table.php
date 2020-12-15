<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('classroom_id')->constrained();
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users');
            $table->longText('detail');
            $table->enum('type', ['INDIVIDUAL', 'GROUP'])->default('INDIVIDUAL');
            $table->dateTime('start')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
}
