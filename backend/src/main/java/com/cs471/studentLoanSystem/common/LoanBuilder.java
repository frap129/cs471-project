package com.cs471.studentLoanSystem.common;

import com.cs471.studentLoanSystem.sql.descriptions.Loan;
import com.cs471.studentLoanSystem.sql.descriptions.Student;

public class LoanBuilder {
    public static final String TERMS_UNSUBSIDIZED = "Unsubsidized";
    public static final String TERMS_SUBSIDIZED = "Subsidized";
    public static final String TERMS_COMPLEX =
            "Unsubsidized, barring exceptional circumstance, only given to lowerclassmen.";

    private int bankId;
    private Student student;
    private float loanAmount;
    private Float loanInterest;
    private String loanTerms;
    private Loan.LoanStatus loanStatus;

    private LoanBuilder() {
        // No-op private constructor
    }

    public static LoanBuilder setTemplate(int templateId) throws Exception {
        LoanBuilder builder = new LoanBuilder();
        builder.loanStatus = Loan.LoanStatus.PENDING;
        switch (templateId) {
            case 1:
                builder.bankId = 1;
                builder.loanTerms = TERMS_UNSUBSIDIZED;
                builder.loanInterest = 0.07f;
                break;
            case 2:
                builder.bankId = 1;
                builder.loanTerms = TERMS_UNSUBSIDIZED;
                builder.loanInterest = 0.05f;
                break;
            case 3:
                builder.bankId = 1;
                builder.loanTerms = TERMS_SUBSIDIZED;
                builder.loanInterest = 0.02f;
                break;
            case 4:
                builder.bankId = 2;
                builder.loanTerms = TERMS_UNSUBSIDIZED;
                builder.loanInterest = 0.089f;
                break;
            case 5:
                builder.bankId = 2;
                builder.loanTerms = TERMS_SUBSIDIZED;
                builder.loanInterest = 0.06f;
                break;
            case 6:
                builder.bankId = 2;
                builder.loanTerms = TERMS_COMPLEX;
                builder.loanInterest = 0.01f;
                break;
            default:
                throw new Exception("Invalid Template ID.");
        }
        return builder;
    }

    public LoanBuilder setStudent(Student student) {
        this.student = student;
        return this;
    }

    public LoanBuilder setLoanAmount(float loanAmount) {
        this.loanAmount = loanAmount;
        return this;
    }

    public Loan build() {
        Loan loan =
                new Loan(bankId, student, loanAmount, loanInterest, loanTerms, loanStatus.toString());
        return loan;
    }
}
