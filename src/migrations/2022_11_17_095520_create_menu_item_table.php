<?php

use Hrm\MenuBuilder\Models\Menu;
use Hrm\MenuBuilder\Models\MenuItem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('link');
            $table->foreignIdFor(Menu::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(MenuItem::class)->nullable()->constrained()->cascadeOnDelete();
            $table->integer('depth')->default(0);
            $table->integer('sort')->default(0);
            $table->string('class')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_item');
    }
};
