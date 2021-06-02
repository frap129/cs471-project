package com.cs471.studentLoanSystem.common.loan;

@SuppressWarnings("unused")
public class LoanInformation {
    int loanId;
    int bankerId;

    public LoanInformation(int loanId, int bankerId) {
        this.loanId = loanId;
        this.bankerId = bankerId;
    }

    public int getLoanId() {
        return loanId;
    }

    public void setLoanId(int loanId) {
        this.loanId = loanId;
    }

    public int getBankerId() {
        return bankerId;
    }

    public void setBankerId(int bankerId) {
        this.bankerId = bankerId;
    }
}
