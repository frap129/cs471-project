package com.cs471.studentLoanSystem.common.calculators;

import java.text.NumberFormat;

public class MonthlyPaymentCalc {
    public static double monthlyPaymentCalc(double loanAmount, int termInYears, double interestRate) {
        double monthlyRate = interestRate / 12.0;
        int termInMonths = termInYears * 12;
        double monthlyPayment =
                (loanAmount * monthlyRate) /
                        (1 - Math.pow(1 + monthlyRate, -termInMonths));
        return monthlyPayment;

    }
}
