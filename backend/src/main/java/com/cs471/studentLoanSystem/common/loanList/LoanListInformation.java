package com.cs471.studentLoanSystem.common.loanList;

public class LoanListInformation {

    private Integer studentId;
    private Integer bankId;
    private String schoolName;

    public LoanListInformation(Integer studentId, Integer bankId, String schoolName) {
        this.studentId = studentId;
        this.bankId = bankId;
        this.schoolName = schoolName;
    }

    public Integer getStudentId() {
        return studentId;
    }

    public void setStudentId(Integer studentId) {
        this.studentId = studentId;
    }

    public Integer getBankId() {
        return bankId;
    }

    public void setBankId(Integer bankId) {
        this.bankId = bankId;
    }

    public String getSchoolName() {
        return schoolName;
    }

    public void setSchoolName(String schoolName) {
        this.schoolName = schoolName;
    }
}
