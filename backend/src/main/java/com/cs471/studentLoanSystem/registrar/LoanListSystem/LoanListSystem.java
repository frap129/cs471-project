package com.cs471.studentLoanSystem.registrar.LoanListSystem;

import com.cs471.studentLoanSystem.sql.LoanRepository;
import com.cs471.studentLoanSystem.sql.descriptions.Loan;
import java.util.Arrays;
import java.util.List;
import java.util.function.Predicate;
import org.jetbrains.annotations.NotNull;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class LoanListSystem {
    @Autowired private LoanRepository loanRepo;

    public static Predicate<Loan> wrongStudentId(int id) {
        return p -> p.getStudentId() != id;
    }

    public static Predicate<Loan> wrongBankId(int id) {
        return p -> p.getBankId() != id;
    }

    @PostMapping("/registrar-loan-list")
    public ResponseEntity<LoanListResponse> loanList(
            @RequestBody LoanListInformation info, @NotNull Model model) {
        model.addAttribute("LoanFilters", info);

        // Get the list of loans
        List<Loan> loans = null;
        if (info.getStudentId() != null) {
            loans = Arrays.asList(loanRepo.findAllByBankId(info.getStudentId()));
            if (info.getBankId() != null) {
                loans.removeIf(wrongBankId(info.getBankId()));
            }
        } else if (info.getBankId() != null) {
            loans = Arrays.asList(loanRepo.findAllByBankId(info.getBankId()));
            if (info.getStudentId() != null) {
                loans.removeIf(wrongStudentId(info.getStudentId()));
            }
        }

        LoanListResponse response = new LoanListResponse();
        if (loans != null) {
            response.setLoanList((Loan[]) loans.toArray());
        }

        return ResponseEntity.ok().body(response);
    }
}
