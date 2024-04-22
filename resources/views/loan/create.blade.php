@include('layouts.header', ['location' => 'Create New Loan'])
@include('layouts.navigation')
@include('layouts.menu')
@extends('layouts.link', ['location' => 'Request Loan', 'locations' => [['name' => 'Loan', 'route' => 'loan.index', 'active' => false], ['name' => 'Loan Request', 'route' => 'loan.create', 'active' => true]]])


@section('content')


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="loanForm" method="post" action={{ route('loan.store') }} class="needs-validation" novalidate>
        @csrf
        <div class="input-group mb-3">
            <label class="input-group-text" for="borrower_id">Borrower ID:</label>
            <select class="form-control" id="borrower_id" name="borrower_id">
                @foreach ($borrowers as $borrower)
                    <option value="{{ $borrower->id }}">{{ ucfirst($borrower->first_name) }}
                        {{ ucfirst($borrower->last_name) }}</option>

                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Please provide a valid borrower ID.
            </div>
        </div>

        <div class="input-group mb-3">
            <label class="input-group-text" for="loan_type_id">Loan Type ID:</label>
            <select class="form-control" id="loan_type_id" name="loan_type_id">
                <option value="">Select Loan Type</option>
                @foreach ($loanTypes as $loanType)
                    <option value="{{ $loanType->id }}" data-interest_rate="{{ $loanType->interest_rate }}"
                        data-interest-cycle="{{ $loanType->interest_cycle }}">
                        {{ ucfirst($loanType->loan_name) }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Please provide a valid loan type ID.
            </div>
        </div>

        <div class="form-group">
            <label for="principal_amount"> Amount:</label>
            <span class="text-success font-bold">AED</span>
            <input type="number" minlength="1" disabled min="500" step="0.01" class="form-control"
                id="principal_amount" name="principal_amount" required>
            <div class="invalid-feedback">
                Please provide a valid principal amount.
            </div>
        </div>


        <div class="form-group">
            <label for="loan_duration">Loan Duration:</label>
            <input type="number" disabled min="1" minlength="1" class="form-control" id="loan_duration"
                name="loan_duration" required>
            <div class="invalid-feedback">
                Please provide a valid loan duration.
            </div>
        </div>

        <div class="form-group">
            <label for="duration_period">Duration Period:</label>
            <input class="form-control" readonly id="duration_period" name="duration_period" required>
            <div class="invalid-feedback">
                Please select a duration period.
            </div>
        </div>

        <div class="form-group">
            <label for="duration_period">Interest Amount:</label>
            <input class="form-control" readonly id="interest_amount" name="interest_amount" default required>
            <div class="invalid-feedback">
                Please select a interest amount.
            </div>
        </div>

        <div class="form-group">
            <label for="duration_period">Repayment Amount:</label>
            <input class="form-control" readonly id="repayment_amount" name="repayment_amount" default required>
            <div class="invalid-feedback">
                Please select a Repayment Amount.
            </div>
        </div>


        <div class="form-group">
            <label for=" loan_due_date"> Loan Due Date:</label>
            <input readonly value="" type="date" class="form-control" id="loan_due_date" name="loan_due_date"
                required>
            <div class="invalid-feedback">
                Please provide a valid loan due date duration.
            </div>
        </div>

        <div class="form-group">
            <label for="transaction_reference">Loan Description:</label>
            <textarea type="text" class="form-control" id="transaction_reference" name="transaction_reference"></textarea>
        </div>

        <div class="form-group">
            <label for="image">Upload Recent Statement:</label>
            <div class="file-drop">
                <div class="file-drop-area" id="fileDropArea">
                    <p>Drag &amp; Drop Image Here</p>
                    <input type="file" id="image" name="image" class="file-input" accept="image/*" required>
                </div>
                <img src="" alt="Preview" class="image-preview" id="imagePreview">
                <button type="button" class="btn btn-secondary btn-reset" id="resetButton">Reset</button>
            </div>
        </div>

        <style>
            .file-drop {
                position: relative;
                overflow: hidden;
            }

            .file-drop-area {
                border: 2px dashed #ccc;
                padding: 20px;
                text-align: center;
                cursor: pointer;
            }

            .image-preview {
                display: none;
                max-width: 100%;
                height: auto;
                margin-top: 10px;
            }

            .btn-reset {
                display: none;
                margin-top: 10px;
            }
        </style>

        <script>
            // JavaScript code for file input functionality
            const fileInput = document.getElementById('image');
            const fileDropArea = document.getElementById('fileDropArea');
            const imagePreview = document.getElementById('imagePreview');
            const resetButton = document.getElementById('resetButton');

            fileDropArea.addEventListener('dragover', (event) => {
                event.preventDefault();
                fileDropArea.classList.add('dragover');
            });

            fileDropArea.addEventListener('dragleave', () => {
                fileDropArea.classList.remove('dragover');
            });

            fileDropArea.addEventListener('drop', (event) => {
                event.preventDefault();
                fileDropArea.classList.remove('dragover');
                const file = event.dataTransfer.files[0];
                displayImage(file);
            });

            fileInput.addEventListener('change', () => {
                const file = fileInput.files[0];
                displayImage(file);
            });

            resetButton.addEventListener('click', () => {
                fileInput.value = ''; // Reset the file input value
                imagePreview.src = ''; // Clear the image preview
                imagePreview.style.display = 'none'; // Hide the image preview
                resetButton.style.display = 'none'; // Hide the reset button
            });

            function displayImage(file) {
                if (file) {
                    const reader = new FileReader();
                    reader.onload = () => {
                        imagePreview.src = reader.result;
                        imagePreview.style.display = 'block';
                        resetButton.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            }
        </script>

        <button type="submit" class="btn btn-primary mb-4">Submit</button>
    </form>
    <script>
        document.getElementById('loanForm').addEventListener('submit', function(event) {
            event.preventDefault();
            this.submit();
        });
        var durationPeriodInput = document.getElementById('duration_period');
        var interestAmountInput = document.getElementById('interest_amount');

        var repaymentInput = document.getElementById('repayment_amount');
        var amountInput = document.getElementById('principal_amount');
        var durationInput = document.getElementById('loan_duration');
        var loanDueDateInput = document.getElementById('loan_due_date');


        durationPeriodInput.value = null;
        interestAmountInput.value = 0;
        repaymentInput.value = 0

        function calLoan(amount, durationPeriod, interestRate, duration) {
            // Validate input parameters
            amount = parseInt(amount);
            interestRate = parseFloat(interestRate);
            duration = parseInt(duration);

            if (typeof amount !== 'number' || amount <= 0) {
                throw new Error('Invalid loan amount');
            }
            if (!['daily', 'weekly', 'monthly', 'yearly'].includes(durationPeriod)) {
                throw new Error('Invalid duration period');
            }
            if (typeof interestRate !== 'number' || interestRate <= 0) {
                throw new Error('Invalid interest rate');
            }
            if (typeof duration !== 'number') {
                throw new Error('Invalid loan duration');
            }

            // Calculate the interest amount
            const interestAmount = amount * interestRate * duration;

            // Calculate the total repayment amount
            const totalRepayment = amount + interestAmount;

            // Calculate the due date based on the duration period
            const today = new Date();
            let dueDate;

            if (durationPeriod === 'daily') {
                dueDate = new Date(today.setDate(today.getDate() + duration));
            } else if (durationPeriod === 'weekly') {
                dueDate = new Date(today.setDate(today.getDate() + (duration * 7)));
            } else if (durationPeriod === 'monthly') {
                dueDate = new Date(today.setMonth(today.getMonth() + duration));
            } else if (durationPeriod === 'yearly') {
                dueDate = new Date(today.setFullYear(today.getFullYear() + duration));
            }

            const dueYear = dueDate.getFullYear();
            const dueMonth = String(dueDate.getMonth() + 1).padStart(2, '0'); // Month is zero-based
            const dueDay = String(dueDate.getDate()).padStart(2, '0');
            const formattedDueDate = `${dueYear}-${dueMonth}-${dueDay}`;

            repaymentInput.value = totalRepayment;
            loanDueDateInput.value = formattedDueDate;
        }


        function padZero(num) {
            return num < 10 ? `0${num}` : num;
        }



        amountInput.addEventListener('input', function() {
            calLoan(amountInput.value, durationPeriodInput.value, interestAmountInput.value, durationInput
                .value)
        });
        durationInput.addEventListener('input', function() {
            calLoan(amountInput.value, durationPeriodInput.value, interestAmountInput.value, durationInput
                .value)
        });

        document.getElementById('loan_type_id').addEventListener('change', function() {
            //remove disabled
            amountInput.removeAttribute('disabled');
            durationInput.removeAttribute('disabled')


            var selectedOption = this.options[this.selectedIndex];
            var interestCycle = selectedOption.getAttribute('data-interest-cycle');
            var interestRate = selectedOption.getAttribute('data-interest_rate');

            durationPeriodInput.value = interestCycle || null;
            interestAmountInput.value = interestRate || 0;

        });
    </script>
@endsection
