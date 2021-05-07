package com.cs471.studentLoanSystem.login;

import org.springframework.data.jpa.repository.JpaRepository;

public interface LoginRepository extends JpaRepository<LoginInformation, Integer> {

    LoginInformation findById(int id);

    LoginInformation findFirstByUsername(String username);
}
