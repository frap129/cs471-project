package com.cs471.studentLoanSystem.sql;

import com.cs471.studentLoanSystem.sql.descriptions.Loan;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;

public interface LoanRepository extends CrudRepository<Loan, Integer> {
    Loan[] findAllByLoanStatus(Loan.LoanStatus status);

    Loan[] findAllByStudentId(Integer studentId);

    Loan[] findAllByBankId(Integer bankId);

    @Query("SELECT u FROM loan u JOIN u.student as s WHERE s.student_school = ?1")
    Loan[] findAllBySchoolName(String schoolName);
}
