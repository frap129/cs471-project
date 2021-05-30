package com.cs471.studentLoanSystem.common.loanList;

import com.cs471.studentLoanSystem.sql.BankRepository;
import com.cs471.studentLoanSystem.sql.LoanRepository;
import com.cs471.studentLoanSystem.sql.StudentRepository;
import com.cs471.studentLoanSystem.sql.descriptions.Loan;
import com.cs471.studentLoanSystem.sql.descriptions.Student;
import java.util.ArrayList;
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
    @Autowired private BankRepository bankRepository;
    @Autowired private StudentRepository studentRepository;
    @Autowired private LoanRepository loanRepo;
    @Autowired private Function<List<Loan>, LoanListResponse> loanListToLoanListResponseTransformer;

    public static Predicate<Loan> wrongStudentId(int id) {
        return p -> p.getStudent().getStudentId() != id;
    }

    public static Predicate<Loan> wrongBankId(int id) {
        return p -> p.getBankId() != id;
    }

    @PostMapping("/loan-list")
    public ResponseEntity<LoanListResponse> loanList(
            @RequestBody LoanListInformation info, @NotNull Model model) {
        model.addAttribute("LoanFilters", info);

        Integer bankPid = null;
        if (info.getBankId() != null) {
            bankPid = bankRepository.findByBankId(info.getBankId()).getId();
        }

        // Get the list of loans
        List<Loan> loans = null;
        if (info.getSchoolName() != null) {
            loans = new ArrayList<>(Arrays.asList(loanRepo.findAllBySchoolName(info.getSchoolName())));
            if (bankPid != null) {
                loans.removeIf(wrongBankId(bankPid));
            }
            if (info.getStudentId() != null) {
                loans.removeIf(wrongStudentId(info.getStudentId()));
            }
        } else if (info.getStudentId() != null) {
            Student student = studentRepository.findByStudentId(info.getStudentId());
            loans = new ArrayList<>(Arrays.asList(loanRepo.findAllByStudent(student)));
            if (bankPid != null) {
                loans.removeIf(wrongBankId(bankPid));
            }
        } else if (bankPid != null) {
            loans = Arrays.asList(loanRepo.findAllByBankId(bankPid));
        } else {
            loans = new ArrayList<>();
            for (Loan loan : loanRepo.findAll()) {
                loans.add(loan);
            }
        }

        LoanListResponse response = loanListToLoanListResponseTransformer.apply(loans);

        return ResponseEntity.ok().body(response);
    }
}
