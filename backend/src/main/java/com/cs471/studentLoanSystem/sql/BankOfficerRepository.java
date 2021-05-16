package com.cs471.studentLoanSystem.sql;

import com.cs471.studentLoanSystem.sql.descriptions.BankOfficer;
import org.springframework.data.repository.CrudRepository;

public interface BankOfficerRepository extends CrudRepository<BankOfficer, Integer> {
    BankOfficer findById(int id);
}
