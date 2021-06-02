package com.cs471.studentLoanSystem.common.login.response;

import com.cs471.studentLoanSystem.student.StudentInfo;

public class StudentResponse extends LoginResponse {
    private StudentInfo studentInfo;
    private String name;

    public StudentResponse(
            String name, boolean authenticated, String role, int userId, StudentInfo studentInfo) {
        super(authenticated, role, userId);
        this.studentInfo = studentInfo;
        this.name = name;
    }

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
