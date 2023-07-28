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
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string("name", 50);
            $table->string("url", 2083)->unique();
            $table->timestamps();
        });

        Schema::table("project", function (Blueprint $table) {
            $table->unsignedBigInteger("category_id")->after("id")->nullable();

            $table->foreignId("category_id")
                    ->references("id")
                    ->on("category")
                    ->onUpdate("cascade")
                    ->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("project", function (Blueprint $table) {
            // $table->dropConstrainedForeignId("category_id");
            $table->dropForeign(["category_id"]);
            $table->dropColumn("category_id");
        });

        Schema::dropIfExists('category');
    }
};
