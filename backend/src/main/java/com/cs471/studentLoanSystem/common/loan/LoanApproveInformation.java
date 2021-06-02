package com.cs471.studentLoanSystem.common.loan;

@SuppressWarnings("unused")
public class LoanApproveInformation {
    private int userId;
    private int loanId;
    private boolean approved;

    public int getUserId() {
        return userId;
    }

    public void setUserId(int userId) {
        this.userId = userId;
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
