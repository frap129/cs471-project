package com.cs471.studentLoanSystem.student.LoanApplication;

import com.cs471.studentLoanSystem.common.LoanBuilder;
import com.cs471.studentLoanSystem.sql.LoanRepository;
import com.cs471.studentLoanSystem.sql.descriptions.*;
import org.jetbrains.annotations.NotNull;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;

public class LoanApplicationSystem {
    @Autowired private LoanRepository loanRepo;

    @PostMapping("/loan-application")
    public ResponseEntity<ApplicationResponse> applyForLoan(
            @RequestBody ApplicationInformation information, @NotNull Model model) {
        model.addAttribute("LoanApplication", information);

        if (information.getAmount() != null
                && information.getTemplateId() != null
                && information.getStudentId() != null) {
            try {
                // Build Loan
                Loan application = LoanBuilder.setTemplate(information.getTemplateId())
                        .setStudentId(information.getStudentId())
                        .setLoanAmount(information.getAmount())
                        .build();
                loanRepo.save(application);

                // Respond with success
                ApplicationResponse ret = new ApplicationResponse();
                ret.setResult(ApplicationResponse.Result.ok);
                return ResponseEntity.ok().body(ret);
            } catch (Exception e) {
                // Skip handling here, we'll just send an error below
            }
        }
        ApplicationResponse ret = new ApplicationResponse();
        ret.setResult(ApplicationResponse.Result.err);
        ret.setError();
        return ResponseEntity.badRequest().body(ret);
    }
}
