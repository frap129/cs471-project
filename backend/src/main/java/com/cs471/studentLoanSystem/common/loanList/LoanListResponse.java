package com.cs471.studentLoanSystem.common.loanList;

import com.cs471.studentLoanSystem.sql.descriptions.Loan;
import java.util.List;

public class LoanListResponse {

    private List<Loan> loanList;

    public List<Loan> getLoanList() {
        return loanList;
    }

    public void setLoanList(List<Loan> loanList) {
        this.loanList = loanList;
    }
}
