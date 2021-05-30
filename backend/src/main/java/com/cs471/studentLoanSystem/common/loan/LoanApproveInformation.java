package com.cs471.studentLoanSystem.common.loan;

@SuppressWarnings("unused")
public class LoanApproveInformation {
    private int bankerId;
    private int loanId;
    private boolean approved;

    public int getBankerId() {
        return bankerId;
    }

    public void setBankerId(int bankerId) {
        this.bankerId = bankerId;
    }

    public int getLoanId() {
        return loanId;
    }

    public void setLoanId(int loanId) {
        this.loanId = loanId;
    }

    public boolean isApproved() {
        return approved;
    }

    public void setApproved(boolean approved) {
        this.approved = approved;
    }
}
