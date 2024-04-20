<?php

declare(strict_types=1);

use Bavix\Wallet\Models\Transaction;
use Bavix\Wallet\Models\Transfer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create($this->table(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('from');
            $table->morphs('to');
            $table
                ->enum('status', ['exchange', 'transfer', 'paid', 'refund', 'gift'])
                ->default('transfer')
            ;
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table
                ->enum('status_last', ['exchange', 'transfer', 'paid', 'refund', 'gift'])
                ->nullable()
            ;

            $table->unsignedBigInteger('deposit_id')->nullable();
            $table->unsignedBigInteger('withdraw_id')->nullable();

            $table->decimal('discount', 64, 0)
                ->default(0)
            ;

            $table->decimal('fee', 64, 0)
                ->default(0)
            ;

            $table->uuid('uuid')
                ->unique()->nullable()
            ;
            $table->timestamps();

            $table->foreign('deposit_id')
                ->references('id')
                ->on($this->transactionTable())
                ->onDelete('cascade')
            ;

            $table->foreign('withdraw_id')
                ->references('id')
                ->on($this->transactionTable())
                ->onDelete('cascade')
            ;
        });
    }

    public function down(): void
    {
        Schema::drop($this->table());
    }

    private function table(): string
    {
        return (new Transfer())->getTable();
    }

    private function transactionTable(): string
    {
        return (new Transaction())->getTable();
    }
};
