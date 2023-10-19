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
            $table->foreign('asset_id', 'asset_fk_1230965')->references('id')->on('assets');
            $table->unsignedInteger('disposable_id')->nullable();
            $table->foreign('disposable_id', 'disposable_fk_1230966')->references('id')->on('disposables');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_1230970')->references('id')->on('teams');
        });

    }
}
