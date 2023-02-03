<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ShowComponent;

class CreateShowComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('show_components', function (Blueprint $table) {
            $table->id();
            $table->string('component_name');
            $table->boolean('is_show');
            $table->timestamps();
        });
        ShowComponent::create(['component_name' => 'mobile-block', 'is_show' => 0]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('show_components');
    }
}
