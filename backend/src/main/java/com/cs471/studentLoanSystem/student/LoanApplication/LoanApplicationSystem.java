package com.cs471.studentLoanSystem.student.LoanApplication;

import com.cs471.studentLoanSystem.common.login.response.LoginResponse;
import com.cs471.studentLoanSystem.sql.LoanRepository;
import com.cs471.studentLoanSystem.sql.descriptions.*;
import org.jetbrains.annotations.NotNull;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;

public class LoanApplicationSystem {
    public static final String TERMS_UNSUBSIDIZED = "Unsubsidized";
    public static final String TERMS_SUBSIDIZED = "Subsidized";
    public static final String TERMS_COMPLEX =
            "Unsubsidized, barring exceptional circumstance, only given to lowerclassmen.";

    private static final Loan template1 = new Loan(1, 0.07f, TERMS_UNSUBSIDIZED);
    private static final Loan template2 = new Loan(1, 0.05f, TERMS_UNSUBSIDIZED);
    private static final Loan template3 = new Loan(1, 0.02f, TERMS_SUBSIDIZED);
    private static final Loan template4 = new Loan(2, 0.089f, TERMS_UNSUBSIDIZED);
    private static final Loan template5 = new Loan(2, 0.06f, TERMS_SUBSIDIZED);
    private static final Loan template6 = new Loan(2, 0.01f, TERMS_COMPLEX);

    @Autowired private LoanRepository loanRepo;

    @PostMapping("/loan-application")
    public ResponseEntity<LoginResponse> applyForLoan(
            @RequestBody ApplicationInformation information, @NotNull Model model) {
        model.addAttribute("LoanApplication", information);

        if (information.getAmount() != null
                && information.getTemplateId() != null
                && information.getStudentId() != null) {
            Loan application;
            switch (information.getTemplateId()) {
                case 1:
                    application = template1.clone();
                    break;
                case 2:
                    application = template2.clone();
                    break;
                case 3:
                    application = template3.clone();
                    break;
                case 4:
                    application = template4.clone();
                    break;
                case 5:
                    application = template5.clone();
                    break;
                default:
                    application = template6.clone();
            }
            application.setStudentId(information.getStudentId());
            application.setLoanAmount(information.getAmount());
            loanRepo.save(application);
            return ResponseEntity.ok().header("result", "SUCCESS").build();
        }

        return ResponseEntity.badRequest()
                .header("result", "ERRED")
                .header("error", "Something went wrong when filling out information")
                .build();
    }
}
