package com.cs471.studentLoanSystem.sql;

import com.cs471.studentLoanSystem.sql.descriptions.User;
import org.springframework.data.repository.CrudRepository;

public interface UserRepository extends CrudRepository<User, Integer> {
    User findByUsername(String username);
}
