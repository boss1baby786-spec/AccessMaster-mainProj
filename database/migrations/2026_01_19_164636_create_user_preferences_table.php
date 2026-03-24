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
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); 
            $table->string('layout')->default('vertical'); 
            $table->string('theme')->default('default'); 
            $table->string('color_scheme')->default('light'); 
            $table->string('sidebar_size')->default('lg'); 
            $table->string('sidebar_visibility')->default('show'); 
            $table->string('layout_width')->default('fluid'); 
            $table->string('layout_position')->default('fixed'); 
            $table->string('topbar_color')->default('light'); 
            $table->string('sidebar_color')->default('light');
            $table->string('sidebar_view')->default('default');
            $table->string('sidebar_image')->default('default');
            $table->string('primary_color')->default('default');
            $table->string('preloader')->default('disabled');
             $table->string('sidebarUserProfile')->default('hide');
       
             
            $table->timestamps();

            
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};
