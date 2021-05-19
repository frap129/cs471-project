package com.cs471.studentLoanSystem.common;

public enum UserRole {
    BankOfficer("BANKOFFICER"),
    Student("STUDENT"),
    Registrar("REGISTRAR"),
    LoanOfficer("LOANOFFICER");

    private final String label;

    UserRole(String label) {
        this.label = label;
    }
}
