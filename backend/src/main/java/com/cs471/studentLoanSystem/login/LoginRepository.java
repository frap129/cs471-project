package com.cs471.studentLoanSystem.login;

import org.jetbrains.annotations.NotNull;
import org.springframework.data.repository.CrudRepository;

import java.util.Optional;

public interface LoginRepository extends CrudRepository<LoginInformation, String> {

    Optional<LoginInformation> findById(@NotNull String username);
}
