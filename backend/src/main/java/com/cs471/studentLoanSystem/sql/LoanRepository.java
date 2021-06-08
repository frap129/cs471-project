package com.cs471.studentLoanSystem.sql;

import com.cs471.studentLoanSystem.sql.descriptions.Loan;
import com.cs471.studentLoanSystem.sql.descriptions.Student;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;

public interface LoanRepository extends CrudRepository<Loan, Integer> {
    Loan[] findAllByLoanStatus(Loan.LoanStatus status);

    Loan[] findAllByStudent(Student student);

    Loan[] findAllByBankId(Integer bankId);

    Loan[] findAllByLoanStatus(String status);

    @Query("SELECT u FROM loan u JOIN u.student as s WHERE s.student_school = ?1")
    Loan[] findAllBySchoolName(String schoolName);
}
