<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTransactionsTable extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedInteger('asset_id')->nullable();
            $table->foreign('asset_id')
                ->references('id')->on('assets')
                ->onDelete('cascade'); // Tindakan kaskade
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id')->references('id')->on('teams');
            $table->unsignedInteger('disposable_id')->nullable();
            $table->foreign('disposable_id')
                ->references('id')->on('disposables')
                ->onDelete('cascade'); // Tindakan kaskade
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });

    }
}
