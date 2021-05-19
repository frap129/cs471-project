package com.cs471.studentLoanSystem.common.login.response;

@SuppressWarnings("unused")
public class LoginResponse {
    private boolean authenticated;
    private String role;

    public boolean isAuthenticated() {
        return authenticated;
    }

    public void setAuthenticated(boolean authenticated) {
        this.authenticated = authenticated;
    }

    public String getRole() {
        return role;
    }

    public void setRole(String role) {
        this.role = role;
    }
}
