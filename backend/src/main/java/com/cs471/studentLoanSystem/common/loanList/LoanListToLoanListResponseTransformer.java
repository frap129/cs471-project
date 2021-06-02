package com.cs471.studentLoanSystem.common.loanList;

import com.cs471.studentLoanSystem.sql.BankRepository;
import com.cs471.studentLoanSystem.sql.descriptions.Bank;
import com.cs471.studentLoanSystem.sql.descriptions.Loan;
import java.util.ArrayList;
import java.util.List;
import java.util.function.Function;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;

@Component
public class LoanListToLoanListResponseTransformer
        implements Function<List<Loan>, LoanListResponse> {
    @Autowired private BankRepository bankRepository;

    @Override
    public LoanListResponse apply(List<Loan> loans) {
        LoanListResponse response = new LoanListResponse(new ArrayList<>());

        loans.forEach(
                loan -> {
                    Bank bank = bankRepository.findById(loan.getBankId());
                    LoanView view =
                            new LoanView(
                                    loan.getLoanAmount(),
                                    loan.getStudent().getStudent_tuition(),
                                    loan.getStudent().getStudentId(),
                                    loan.getStudent().getStudent_name(),
                                    loan.getStudent().getStudent_school(),
                                    loan.getLoanInterest().toString(),
                                    loan.getId(),
                                    bank.getBank_name(),
                                    loan.getBankId());

                    String interest = loan.getLoanInterest() * 100 + "%";
                    view.setInterest(interest);
                    response.getLoanList().add(view);
                });

        return response;
    }
}
