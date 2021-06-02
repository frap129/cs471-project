package com.cs471.studentLoanSystem.bank;

@SuppressWarnings("unused")
public class BankInfo {
    private int bankId;
    private String bankName;

    public BankInfo(int bankId, String bankName) {
        this.bankId = bankId;
        this.bankName = bankName;
    }

    public int getBankId() {
        return bankId;
    }

    public void setBankId(int bankId) {
        this.bankId = bankId;
    }

    public String getBankName() {
        return bankName;
    }

    public void setBankName(String bankName) {
        this.bankName = bankName;
    }
}
