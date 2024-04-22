<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    public function loan_type()
    {

        return $this->belongsTo(LoanType::class, 'loan_type_id', 'id');
    }

    public function borrower()
    {

        return $this->belongsTo(Borrower::class, 'borrower_id', 'id');
    }

    public function user()
    {

        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getLoanDueDateAttribute($value)
    {
        return date('d,F Y', strtotime($value));
    }


    protected $casts = [
        'activate_loan_agreement_form' => 'boolean',
    ];

    /**
     * Get the loan type of the loan.
     */
    public function loanType()
    {
        return $this->belongsTo(LoanType::class);
    }


}
