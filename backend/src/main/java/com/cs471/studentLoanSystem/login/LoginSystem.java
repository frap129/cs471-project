package com.cs471.studentLoanSystem.login;

import com.cs471.studentLoanSystem.sql.UserRepository;
import com.cs471.studentLoanSystem.sql.descriptions.User;
import org.jetbrains.annotations.NotNull;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class LoginSystem {

    @Autowired private UserRepository sqlUserRepository;

    @PostMapping("/login")
    public ResponseEntity<LoginResponse> loginForm(
            @ModelAttribute LoginInformation information, @NotNull Model model) {
        model.addAttribute("LoginInfo", information);
        LoginResponse response = new LoginResponse();

        /* Get the correct user from the database */
        User selectedUser = sqlUserRepository.findByUsername(information.getUsername());

        /* Fill out the response with data from the database */
        /* Could not find user, return 404 no such user */
        if (selectedUser == null) {
            return ResponseEntity.notFound().header("error", "No such user").build();
        }
        /* Found user but password doesn't match. Return relevant data but do not authenticate */
        if (!selectedUser.getPassword().equals(information.getPassword())) {
            response.setAuthenticated(false);
            response.setRole(selectedUser.getRole());
            response.setName(selectedUser.getUsername());
            return ResponseEntity.ok().body(response);
        }
        /* Found user and password matches, return all data */
        response.setAuthenticated(true);
        response.setRole(selectedUser.getRole());
        response.setName(selectedUser.getUsername());
        // TODO: Add studentinfo/bankinfo to response
        response.setStudentInfo(null);
        response.setBankInfo(null);
        return ResponseEntity.ok().body(response);
    }
}
