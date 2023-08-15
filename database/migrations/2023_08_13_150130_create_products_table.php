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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('pid')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('domain')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('url')->nullable();
            $table->string('image')->nullable();
            $table->string('billing')->default('monthly')->comment('daily,weekly,monthly,yearly,lifetime');
            $table->decimal('price', 10, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
