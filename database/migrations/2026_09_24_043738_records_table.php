<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('records',function(Blueprint $table){
            $table->id();
            $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();
            $table->date('study_date');
            $table->string('category');
            $table->integer('test_time');
            $table->integer('minutes');
            $table->text('memo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       //
    }
};
