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
        Schema::create('Branches', function (Blueprint $table) {
            $table->id();
            $table->string('Branch_name')->nullable();
        });

        Schema::create('feecategory', function (Blueprint $table) {
            $table->id();
            $table->string('fee_category')->nullable();
            $table->integer('br_id')->nullable();
        });

        Schema::create('feecollectiontype', function (Blueprint $table) {
            $table->id();
            $table->string('collectionhead')->nullable();
            $table->string('collectiondesc')->nullable();
            $table->integer('br_id')->nullable();
        });

        Schema::create('feetypes', function (Blueprint $table) {
            $table->id();
            $table->integer('fee_category')->nullable();
            $table->string('f_name')->nullable();
            $table->integer('Collection_id')->nullable();
            $table->integer('br_id')->nullable();
            $table->integer('Seq_id')->nullable();
            $table->string('Fee_type_ledger')->nullable();
            $table->integer('Fee_headtype')->nullable();
        });

        Schema::create('entrymode', function (Blueprint $table) {
            $table->id();
            $table->string('Entry_modename')->nullable();
            $table->string('crdr')->nullable();
            $table->integer('entrymodeno')->nullable();
        });

        Schema::create('Financial_trans', function (Blueprint $table) {
            $table->bigInteger('Id')->nullable();
            $table->bigInteger('moduleid')->nullable();
            $table->bigInteger('tranid')->nullable();
            $table->string('admno')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->string('crdr')->nullable();
            $table->timestamp('tranDate')->nullable();
            $table->string('acadYear')->nullable();
            $table->string('Entrymode')->nullable();
            $table->bigInteger('voucherno')->nullable();
            $table->integer('brid')->nullable();
            $table->text('Type_of_concession')->nullable();
        });

        Schema::create('Financial_transdetail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('financialTranId')->nullable();
            $table->integer('moduledId')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->integer('headId')->nullable();
            $table->string('crdr')->nullable();
            $table->integer('brid')->nullable();
            $table->string('head_name')->nullable();
        });

        Schema::create('Common_fee_collection', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('financialTranId')->nullable();
            $table->integer('moduledId')->nullable();
            $table->bigInteger('tranid')->nullable();
            $table->string('admno')->nullable();
            $table->string('rollno')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->integer('brid')->nullable();
            $table->string('acadYear')->nullable();
            $table->string('financialYear')->nullable();
            $table->string('displayReceiptNo')->nullable();
            $table->string('Entrymode')->nullable();
            $table->string('Paid_Date')->nullable();
            $table->integer('headId')->nullable();
            $table->integer('inactive')->nullable();
        });

        Schema::create('Common_fee_collection_headwise', function (Blueprint $table) {
            $table->id();
            $table->integer('moduledId')->nullable();
            $table->bigInteger('receiptId')->nullable();
            $table->integer('headId')->nullable();
            $table->string('head_name')->nullable();
            $table->integer('brid')->nullable();
            $table->bigInteger('amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
