package com.cs471.studentLoanSystem.common.loanList;

import com.cs471.studentLoanSystem.sql.LoanRepository;
import com.cs471.studentLoanSystem.sql.descriptions.Loan;
import java.util.Arrays;
import java.util.List;
import java.util.function.Function;
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
    @Autowired private Function<List<Loan>, LoanListResponse> loanListToLoanListResponseTransformer;

    public static Predicate<Loan> wrongStudentId(int id) {
        return p -> p.getStudent().getId() != id;
    }

    public static Predicate<Loan> wrongBankId(int id) {
        return p -> p.getBankId() != id;
    }

    @PostMapping("/loan-list")
    public ResponseEntity<LoanListResponse> loanList(
            @RequestBody LoanListInformation info, @NotNull Model model) {
        model.addAttribute("LoanFilters", info);

        // Get the list of loans
        List<Loan> loans = null;
        if (info.getSchoolName() != null) {
            loans = Arrays.asList(loanRepo.findAllBySchoolName(info.getSchoolName()));
            if (info.getBankId() != null) {
                loans.removeIf(wrongBankId(info.getBankId()));
            }
            if (info.getStudentId() != null) {
                loans.removeIf(wrongStudentId(info.getStudentId()));
            }
        } else if (info.getStudentId() != null) {
            loans = Arrays.asList(loanRepo.findAllByStudentId(info.getStudentId()));
            if (info.getBankId() != null) {
                loans.removeIf(wrongBankId(info.getBankId()));
            }
        } else if (info.getBankId() != null) {
            loans = Arrays.asList(loanRepo.findAllByBankId(info.getBankId()));
        }

        LoanListResponse response = loanListToLoanListResponseTransformer.apply(loans);

        return ResponseEntity.ok().body(response);
    }
}
