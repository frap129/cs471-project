package com.cs471.studentLoanSystem.student.LoanApplication;

public class ApplicationResponse {
    public final String errMsg = "Something went wrong when filling out information";

    enum Result {
        ok("SUCCESS"),
        err("ERRED");

        public final String val;

        Result(String val) {
            this.val = val;
        }
    }

    private Result result;

    private String error;

    public Result getResult() {
        return result;
    }

    public void setResult(Result result) {
        this.result = result;
    }

    public String getError() {
        return error;
    }

    public void setError() {
        this.error = errMsg;
    }
}
