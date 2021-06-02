package com.cs471.studentLoanSystem.common.login.response;

public class RegistrarResponse extends LoginResponse {
    public RegistrarResponse(boolean authenticated, String role, int userId) {
        super(authenticated, role, userId);
    }
}
