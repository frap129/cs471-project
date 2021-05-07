package com.cs471.studentLoanSystem.login;

import com.cs471.studentLoanSystem.roles.StudentInfo;
import org.jetbrains.annotations.NotNull;
import org.springframework.http.ResponseEntity;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class LoginSystem {

    @PostMapping("/login")
    public ResponseEntity<LoginResponse> loginForm(
            @ModelAttribute LoginInformation information, @NotNull Model model) {
        model.addAttribute("LoginInfo", information);
        LoginResponse response = new LoginResponse();
        /* Fill out the response with data from the database */
        response.setName(information.getUsername()); /* Just to prove out we are receiving data */
        response.setAuthenticated(true); /* As requested by Andy */
        response.setRole("Student");
        StudentInfo info = new StudentInfo();
        info.setAddress("1160 Dupont St");
        info.setSchool("Kettering");
        info.setStudentId(2);
        response.setStudentInfo(info);
        /*****************************************************/

        return ResponseEntity.ok().body(response);
    }
}
