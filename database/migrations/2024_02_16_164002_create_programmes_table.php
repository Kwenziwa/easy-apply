<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('portfolio_id');
            $table->foreign('portfolio_id')
                ->references('id')->on('portfolios')->onDelete('cascade');
            $table->string('name');
            $table->string('code');
            $table->date('closing_date');
            $table->integer('min_points');
            $table->text('min_entry_requirements');
            $table->string('entry_term');
            $table->integer('course_duration');
            $table->string('application_url')->nullable();
            $table->string('access_route')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmes');
    }
};
