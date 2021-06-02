package com.cs471.studentLoanSystem.student;

@SuppressWarnings("unused")
public class StudentInfo {
    private int studentId;
    private String address;
    private String school;

    public StudentInfo(int studentId, String address, String school) {
        this.studentId = studentId;
        this.address = address;
        this.school = school;
    }

    public int getStudentId() {
        return studentId;
    }

    public void setStudentId(int studentId) {
        this.studentId = studentId;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getSchool() {
        return school;
    }

    public void setSchool(String school) {
        this.school = school;
    }
}
