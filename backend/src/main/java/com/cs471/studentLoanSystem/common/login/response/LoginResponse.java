package com.cs471.studentLoanSystem.common.login.response;

@SuppressWarnings("unused")
public class LoginResponse {
    private boolean authenticated;
    private String role;
    private int userId;

    public LoginResponse(boolean authenticated, String role, int userId) {
        this.authenticated = authenticated;
        this.role = role;
        this.userId = userId;
    }

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

    public int getUserId() {
        return userId;
    }

    public void setUserId(int userId) {
        this.userId = userId;
    }
}
