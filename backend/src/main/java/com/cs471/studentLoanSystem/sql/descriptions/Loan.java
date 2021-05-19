package com.cs471.studentLoanSystem.sql.descriptions;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;

@SuppressWarnings("unused")
@Entity
public class Loan {
    public enum LoanStatus {
        PENDING,
        APPROVED,
        DENIED,
        PAID
    }

    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Integer id;

    private int bankId;
    private int studentId;
    private float loanAmount;
    private Float loanInterest;
    private String loanTerms;
    private LoanStatus loanStatus;

    public Loan() {}

    public Loan(
            Integer id,
            int bankId,
            int studentId,
            float loanAmount,
            Float loanInterest,
            String loanTerms,
            LoanStatus loanStatus) {
        this.id = id;
        this.bankId = bankId;
        this.studentId = studentId;
        this.loanAmount = loanAmount;
        this.loanInterest = loanInterest;
        this.loanTerms = loanTerms;
        this.loanStatus = loanStatus;
    }

    public Loan(int bankId, Float loanInterest, String loanTerms) {
        this.bankId = bankId;
        this.loanInterest = loanInterest;
        this.loanTerms = loanTerms;
        this.loanStatus = LoanStatus.PENDING;
    }

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public int getBankId() {
        return bankId;
    }

    public void setBankId(int bankId) {
        this.bankId = bankId;
    }

    public float getLoanAmount() {
        return loanAmount;
    }

    public void setLoanAmount(float loanAmount) {
        this.loanAmount = loanAmount;
    }

    public Float getLoanInterest() {
        return loanInterest;
    }

    public void setLoanInterest(Float loanInterest) {
        this.loanInterest = loanInterest;
    }

    public String getLoanTerms() {
        return loanTerms;
    }

    public void setLoanTerms(String loanTerms) {
        this.loanTerms = loanTerms;
    }

    public LoanStatus getLoanStatus() {
        return loanStatus;
    }

    public void setLoanStatus(LoanStatus loanStatus) {
        this.loanStatus = loanStatus;
    }

    public int getStudentId() {
        return studentId;
    }

    public void setStudentId(int studentId) {
        this.studentId = studentId;
    }
}
