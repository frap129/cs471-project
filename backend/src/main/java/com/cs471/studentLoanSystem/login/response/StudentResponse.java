package com.cs471.studentLoanSystem.login.response;

import com.cs471.studentLoanSystem.roles.StudentInfo;

public class StudentResponse extends LoginResponse {
    private StudentInfo studentInfo;
    private String name;

    public StudentInfo getStudentInfo() {
        return studentInfo;
    }

    public void setStudentInfo(StudentInfo studentInfo) {
        this.studentInfo = studentInfo;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }
}
