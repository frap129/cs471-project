package com.cs471.studentLoanSystem.login;


import javax.persistence.Entity;
import javax.persistence.Id;

@SuppressWarnings("unused")
@Entity
public class LoginInformation {

    @Id
    private String username;
    private String password;

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }
}
