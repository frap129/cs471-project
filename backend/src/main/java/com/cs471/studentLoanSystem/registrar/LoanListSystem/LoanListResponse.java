package com.cs471.studentLoanSystem.registrar.LoanListSystem;

import com.cs471.studentLoanSystem.sql.descriptions.Loan;

public class LoanListResponse {

    private Loan[] loanList;

    public Loan[] getLoanList() {
        return loanList;
    }

    public void setLoanList(Loan[] loanList) {
        this.loanList = loanList;
    }
}
