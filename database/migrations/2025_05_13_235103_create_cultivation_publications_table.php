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
        { 
            Schema::create('cultivation_publications', function (Blueprint $table) { 
            $table->id(); 
            $table->foreignId('idUser')->constrained('users'); 
            $table->foreignId('idCategory')->constrained('categories');
            $table->string('cropTitle'); 
            $table->text('cropContent'); 
            $table->timestamp('creationDate')->useCurrent(); 
            $table->timestamps(); 
            }); 
            } 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cultivation_publications');
    }
};
