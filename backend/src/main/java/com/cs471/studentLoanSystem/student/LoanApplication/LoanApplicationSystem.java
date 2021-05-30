package com.cs471.studentLoanSystem.student.LoanApplication;

import com.cs471.studentLoanSystem.common.LoanBuilder;
import com.cs471.studentLoanSystem.sql.LoanRepository;
import com.cs471.studentLoanSystem.sql.StudentRepository;
import com.cs471.studentLoanSystem.sql.descriptions.*;
import org.jetbrains.annotations.NotNull;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class LoanApplicationSystem {
    @Autowired private LoanRepository loanRepo;
    @Autowired private StudentRepository studentRepo;

    @PostMapping("/loan-application")
    public ResponseEntity<ApplicationResponse> applyForLoan(
            @RequestBody ApplicationInformation information, @NotNull Model model) {
        model.addAttribute("LoanApplication", information);

        if (information.getAmount() != null
                && information.getTemplateId() != null
                && information.getStudentId() != null) {
            try {
                Student student = studentRepo.findByStudentId(information.getStudentId());
                // Build Loan
                Loan application =
                        LoanBuilder.setTemplate(information.getTemplateId())
                                .setStudent(student)
                                .setLoanAmount(information.getAmount())
                                .build();
                loanRepo.save(application);

                // Respond with success
                ApplicationResponse ret = new ApplicationResponse();
                ret.setResult(ApplicationResponse.Result.ok);
                return ResponseEntity.ok().body(ret);
            } catch (Exception e) {
                // Skip handling here, we'll just send an error below
                e.printStackTrace();
            }
        }
        ApplicationResponse ret = new ApplicationResponse();
        ret.setResult(ApplicationResponse.Result.err);
        ret.setError();
        return ResponseEntity.badRequest().body(ret);
    }
}
