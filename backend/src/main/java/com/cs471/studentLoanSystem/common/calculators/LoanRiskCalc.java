package com.cs471.studentLoanSystem.common.calculators;

public class LoanRiskCalc {
    public static double loanRiskCalculator(double income, int score){
        double checkIncome = 0;
        int checkScore = 0;
        double risk = 1;
        while (income > 0){
            risk = risk - 0.05;
            income = income - 10000;
        }
        while(score > 0){
            risk = risk - 0.06;
            score = score - 100;
        }
        return risk;
    }
}
