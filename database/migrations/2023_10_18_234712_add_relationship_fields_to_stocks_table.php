<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStocksTable extends Migration
{
    public function up()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->unsignedInteger('asset_id')->nullable();
            $table->foreign('asset_id')
                ->references('id')->on('assets')
                ->onDelete('cascade'); // Tindakan kaskade
            $table->unsignedInteger('disposable_id')->nullable();
            $table->foreign('disposable_id')
                ->references('id')->on('disposables')
                ->onDelete('cascade'); // Tindakan kaskade
            $table->unsignedInteger('alat_id')->nullable();
            $table->foreign('alat_id')
                ->references('id')->on('alats')
                ->onDelete('cascade'); // Tindakan kaskade
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_1230970')->references('id')->on('teams');
        });

    }
}
