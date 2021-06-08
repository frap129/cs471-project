package com.cs471.studentLoanSystem.common.login.response;

import com.cs471.studentLoanSystem.bank.BankInfo;

public class BankOfficerResponse extends LoginResponse {
    private String name;

    private BankInfo bankInfo;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public BankInfo getBankInfo() {
        return bankInfo;
    }

    public void setBankInfo(BankInfo bankInfo) {
        this.bankInfo = bankInfo;
    }
}
