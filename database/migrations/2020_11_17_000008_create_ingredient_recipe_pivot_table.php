<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientRecipePivotTable extends Migration
{
    public function up()
    {
        Schema::create('ingredient_recipe', function (Blueprint $table) {
            $table->unsignedBigInteger('recipe_id');
            $table->foreign('recipe_id', 'recipe_id_fk_2608791')->references('id')->on('recipes')->onDelete('cascade');
            $table->unsignedBigInteger('ingredient_id');
            $table->foreign('ingredient_id', 'ingredient_id_fk_2608791')->references('id')->on('ingredients')->onDelete('cascade');
        });
    }
}
