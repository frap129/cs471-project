package com.cs471.studentLoanSystem.common.loan.response;

@SuppressWarnings("unused")
public class LoanResponse {
    String name;
    String address;
    String school;
    double tuition;
    double familyIncome;
    int creditScore;
    double loanAmount;
    double interest;
    String terms;
    String status;

    public LoanResponse(
            String name,
            String address,
            String school,
            double tuition,
            double familyIncome,
            int creditScore,
            double loanAmount,
            double interest,
            String terms,
            String status) {
        this.name = name;
        this.address = address;
        this.school = school;
        this.tuition = tuition;
        this.familyIncome = familyIncome;
        this.creditScore = creditScore;
        this.loanAmount = loanAmount;
        this.interest = interest;
        this.terms = terms;
        this.status = status;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getSchool() {
        return school;
    }

    public void setSchool(String school) {
        this.school = school;
    }

    public double getTuition() {
        return tuition;
    }

    public void setTuition(double tuition) {
        this.tuition = tuition;
    }

    public double getFamilyIncome() {
        return familyIncome;
    }

    public void setFamilyIncome(double familyIncome) {
        this.familyIncome = familyIncome;
    }

    public int getCreditScore() {
        return creditScore;
    }

    public void setCreditScore(int creditScore) {
        this.creditScore = creditScore;
    }

    public double getLoanAmount() {
        return loanAmount;
    }

    public void setLoanAmount(double loanAmount) {
        this.loanAmount = loanAmount;
    }

    public double getInterest() {
        return interest;
    }

    public void setInterest(double interest) {
        this.interest = interest;
    }

    public String getTerms() {
        return terms;
    }

    public void setTerms(String terms) {
        this.terms = terms;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }
}
