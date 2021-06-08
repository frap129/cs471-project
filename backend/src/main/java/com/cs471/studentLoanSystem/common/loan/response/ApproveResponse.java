package com.cs471.studentLoanSystem.common.loan.response;

@SuppressWarnings("Unused")
public class ApproveResponse {
    private String result;
    private String error;

    public String getResult() {
        return result;
    }

    public void setResult(String result) {
        this.result = result;
    }

    public String getError() {
        return error;
    }

    public void setError(String error) {
        this.error = error;
    }
}
