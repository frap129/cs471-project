package com.cs471.studentLoanSystem.common.loanList;

import java.util.List;

public class LoanListResponse {

    private List<LoanView> loanList;

    public LoanListResponse(List<LoanView> loanList) {
        this.loanList = loanList;
    }

    public List<LoanView> getLoanList() {
        return loanList;
    }

    public void setLoanList(List<LoanView> loanList) {
        this.loanList = loanList;
    }
}
