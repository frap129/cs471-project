package com.cs471.studentLoanSystem.login;

import javax.persistence.*;

@SuppressWarnings("unused")
@Entity
public class LoginInformation {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Column(name = "Id", updatable = false, unique = true)
    private Integer id;

    @Column(name = "Username", updatable = false, unique = true)
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
