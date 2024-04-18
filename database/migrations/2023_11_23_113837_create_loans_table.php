<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('borrower_id');
            $table->unsignedBigInteger('loan_type_id');
            $table->enum('loan_status', ['requested', 'processing', 'approved', 'denied', 'default'])->default('requested');
            $table->decimal('principal_amount', 10, 2);
            $table->string('loan_release_date')->nullable();
            $table->string('imgpath')->nullable();
            $table->decimal('repayment_amount', 10, 2);
            $table->string('loan_number')->nullable()->unique();
            $table->string('loan_due_date');
            $table->string('loan_duration');
            $table->decimal('balance', 64, 0);
            $table->string('from_this_account')->nullable();
            $table->decimal('interest_amount', 10, 2);
            $table->string('interest_rate')->nullable();
            $table->string('duration_period');
            $table->string('loan_agreement_file_path')->nullable();
            $table->string('loan_settlement_file_path')->nullable();
            $table->integer('activate_loan_agreement_form');
            $table->string('transaction_reference')->nullable();
            $table->timestamps();
            $table->foreign('borrower_id')->references('id')->on('borrowers')->onDelete('cascade');
            $table->foreign('loan_type_id')->references('id')->on('loan_types')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
