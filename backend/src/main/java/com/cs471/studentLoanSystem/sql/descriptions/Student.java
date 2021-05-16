package com.cs471.studentLoanSystem.sql.descriptions;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;

@SuppressWarnings("unused")
@Entity
public class Student {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Integer id;

    private String student_name;
    private String student_address;
    private String student_school;
    private Integer student_credit_score;
    private Double student_family_income;
    private Double student_tuition;
    private Integer student_id;

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public String getStudent_name() {
        return student_name;
    }

    public void setStudent_name(String student_name) {
        this.student_name = student_name;
    }

    public String getStudent_address() {
        return student_address;
    }

    public void setStudent_address(String student_address) {
        this.student_address = student_address;
    }

    public String getStudent_school() {
        return student_school;
    }

    public void setStudent_school(String student_school) {
        this.student_school = student_school;
    }

    public Integer getStudent_credit_score() {
        return student_credit_score;
    }

    public void setStudent_credit_score(Integer student_credit_score) {
        this.student_credit_score = student_credit_score;
    }

    public Double getStudent_family_income() {
        return student_family_income;
    }

    public void setStudent_family_income(Double student_family_income) {
        this.student_family_income = student_family_income;
    }

    public Double getStudent_tuition() {
        return student_tuition;
    }

    public void setStudent_tuition(Double student_tuition) {
        this.student_tuition = student_tuition;
    }

    public Integer getStudent_id() {
        return student_id;
    }

    public void setStudent_id(Integer student_id) {
        this.student_id = student_id;
    }
}
