package com.cs471.studentLoanSystem.common.loan;

import com.cs471.studentLoanSystem.common.loan.response.ApproveResponse;
import com.cs471.studentLoanSystem.common.loan.response.LoanResponse;
import com.cs471.studentLoanSystem.sql.LoanRepository;
import com.cs471.studentLoanSystem.sql.StudentRepository;
import com.cs471.studentLoanSystem.sql.descriptions.Loan;
import com.cs471.studentLoanSystem.sql.descriptions.Student;
import java.util.Optional;
import org.jetbrains.annotations.NotNull;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class LoanSystem {

    @Autowired private LoanRepository sqlLoanRepository;
    @Autowired private StudentRepository sqlStudentRepository;

    @PostMapping("/getLoan")
    public ResponseEntity<LoanResponse> getLoan(
            @RequestBody LoanInformation information, @NotNull Model model) {
        model.addAttribute("information", information);

        Optional<Loan> loanOptional = sqlLoanRepository.findById(information.loanId);
        if (loanOptional.isEmpty()) {
            return ResponseEntity.badRequest().header("error", "Cannot find loan by id").build();
        }
        Loan loan = loanOptional.get();

        Optional<Student> studentOptional = sqlStudentRepository.findById(loan.getStudentId());
        if (studentOptional.isEmpty()) {
            return ResponseEntity.badRequest()
                    .header("error", "Cannot find student associated with loan")
                    .build();
        }
        Student student = studentOptional.get();

        if (loan.getBankId() != information.getBankerId()) {
            return ResponseEntity.status(HttpStatus.FORBIDDEN)
                    .header("error", "Banker ID doesn't match loan's Bank ID")
                    .build();
        }

        LoanResponse ret = new LoanResponse();
        ret.setName(student.getStudent_name());
        ret.setAddress(student.getStudent_address());
        ret.setSchool(student.getStudent_school());
        ret.setTuition(student.getStudent_tuition());
        ret.setFamilyIncome(student.getStudent_family_income());
        ret.setCreditScore(student.getStudent_credit_score());
        ret.setLoanAmount(loan.getLoanAmount());
        ret.setInterest(loan.getLoanInterest());
        ret.setTerms(loan.getLoanTerms());
        ret.setStatus(loan.getLoanStatus());

        return ResponseEntity.ok().body(ret);
    }

    @PostMapping("/approveLoan")
    public ResponseEntity<ApproveResponse> approveLoan(
            @RequestBody LoanApproveInformation information, @NotNull Model model) {
        Optional<Loan> loanOptional = sqlLoanRepository.findById(information.getLoanId());
        if (loanOptional.isEmpty()) {
            return ResponseEntity.badRequest().header("error", "Cannot find loan by id").build();
        }
        Loan loan = loanOptional.get();
        if (!loan.getLoanStatus().equals(Loan.LoanStatus.PENDING.toString())) {
            ApproveResponse ret = new ApproveResponse();
            ret.setResult("FAILURE");
            ret.setError("Loan is not pending approval");
            return ResponseEntity.ok().body(ret);
        }

        if(loan.getBankId() != information.getBankerId()) {
            ApproveResponse ret = new ApproveResponse();
            ret.setResult("FAILURE");
            ret.setError("Banker ID does not match");
            return ResponseEntity.ok().body(ret);
        }

        loan.setLoanStatus(
                information.isApprove()
                        ? Loan.LoanStatus.APPROVED.toString()
                        : Loan.LoanStatus.DENIED.toString());
        sqlLoanRepository.save(loan);

        ApproveResponse ret = new ApproveResponse();
        ret.setResult("SUCCESS");

        return ResponseEntity.ok().body(ret);
    }
}
