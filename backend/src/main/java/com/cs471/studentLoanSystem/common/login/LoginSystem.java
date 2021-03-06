package com.cs471.studentLoanSystem.common.login;

import com.cs471.studentLoanSystem.bank.BankInfo;
import com.cs471.studentLoanSystem.common.UserRole;
import com.cs471.studentLoanSystem.common.login.response.BankOfficerResponse;
import com.cs471.studentLoanSystem.common.login.response.LoginResponse;
import com.cs471.studentLoanSystem.common.login.response.RegistrarResponse;
import com.cs471.studentLoanSystem.common.login.response.StudentResponse;
import com.cs471.studentLoanSystem.sql.BankOfficerRepository;
import com.cs471.studentLoanSystem.sql.BankRepository;
import com.cs471.studentLoanSystem.sql.StudentRepository;
import com.cs471.studentLoanSystem.sql.UserRepository;
import com.cs471.studentLoanSystem.sql.descriptions.Bank;
import com.cs471.studentLoanSystem.sql.descriptions.BankOfficer;
import com.cs471.studentLoanSystem.sql.descriptions.Student;
import com.cs471.studentLoanSystem.sql.descriptions.User;
import com.cs471.studentLoanSystem.student.StudentInfo;
import java.util.Optional;
import org.jetbrains.annotations.NotNull;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class LoginSystem {
    @Autowired private UserRepository sqlUserRepository;
    @Autowired private StudentRepository sqlStudentRepository;
    @Autowired private BankOfficerRepository sqlBankOfficerRepository;
    @Autowired private BankRepository sqlBankRepository;

    @PostMapping("/login")
    public ResponseEntity<LoginResponse> loginForm(
            @RequestBody LoginInformation information, @NotNull Model model) {
        model.addAttribute("LoginInfo", information);

        /* Get the correct user from the database */
        User selectedUser = sqlUserRepository.findByUsername(information.getUsername());

        /* Fill out the response with data from the database */
        /* Could not find user, return 400 no such user */
        if (selectedUser == null) {
            return ResponseEntity.badRequest().header("error", "No such user").build();
        }
        /* Found user but password doesn't match. Return relevant data but do not authenticate */
        if (!selectedUser.getPassword().equals(information.getPassword())) {
            LoginResponse response = new LoginResponse();
            response.setAuthenticated(false);
            response.setRole(selectedUser.getRole());
            return ResponseEntity.ok().body(response);
        }
        /* Found user and password matches, return all data */

        /* Check what role they are and fill in the necessary things */
        switch (UserRole.valueOf(selectedUser.getRole())) {
            case BANKOFFICER:
            case LOANOFFICER:
                {
                    Optional<BankOfficer> officerResponse =
                            sqlBankOfficerRepository.findById(selectedUser.getPerson_id());
                    if (officerResponse.isEmpty()) {
                        return lookupFail();
                    }
                    BankOfficer officer = officerResponse.get();
                    Optional<Bank> bankResponse = sqlBankRepository.findById(officer.getBank_id());
                    if (bankResponse.isEmpty()) {
                        return lookupFail();
                    }
                    Bank bank = bankResponse.get();

                    /* Fill out the Bank Information */
                    BankInfo bankInfo = new BankInfo();
                    bankInfo.setBankId(bank.getBankId());
                    bankInfo.setBankName(bank.getBank_name());

                    /* Create and fill out a response */
                    BankOfficerResponse response = new BankOfficerResponse();
                    response.setUserId(selectedUser.getId());
                    response.setAuthenticated(true);
                    response.setRole(selectedUser.getRole());
                    response.setName(officer.getOfficer_name());
                    response.setBankInfo(bankInfo);

                    return ResponseEntity.ok().body(response);
                }
            case STUDENT:
                {
                    Optional<Student> studentResponse =
                            sqlStudentRepository.findById(selectedUser.getPerson_id());
                    if (studentResponse.isEmpty()) {
                        return lookupFail();
                    }
                    Student student = studentResponse.get();

                    /* Fill out the Student Information */
                    StudentInfo studentInfo = new StudentInfo();
                    studentInfo.setStudentId(student.getStudentId());
                    studentInfo.setSchool(student.getStudent_school());
                    studentInfo.setAddress(student.getStudent_address());

                    /* Create and fill out a response */
                    StudentResponse response = new StudentResponse();
                    response.setName(student.getStudent_name());
                    response.setRole(selectedUser.getRole());
                    response.setAuthenticated(true);
                    response.setStudentInfo(studentInfo);

                    return ResponseEntity.ok().body(response);
                }
            case REGISTRAR:
                {
                    RegistrarResponse response = new RegistrarResponse();
                    response.setAuthenticated(true);
                    response.setRole(selectedUser.getRole());

                    return ResponseEntity.ok().body(response);
                }
        }

        return ResponseEntity.badRequest()
                .header("error", "Something went wrong when filling out information")
                .build();
    }

    private ResponseEntity<LoginResponse> lookupFail() {
        // TODO: Add some logic to return an error code when this happens
        return ResponseEntity.badRequest()
                .header("error", "Something went wrong when filling out information")
                .build();
    }
}
