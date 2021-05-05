package com.cs471.studentLoanSystem.login;

import java.net.URI;

import com.cs471.studentLoanSystem.roles.StudentInfo;
import org.springframework.http.ResponseEntity;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.servlet.support.ServletUriComponentsBuilder;

@RestController
public class LoginSystem {

    @GetMapping("/login")
    public String loginForm(Model model) {
        model.addAttribute("LoginInfo", new LoginInformation());
        return "LoginInfo";
    }

    @PostMapping("/login")
    public ResponseEntity<LoginResponse> loginForm(
            @ModelAttribute LoginInformation information, Model model) {
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

        URI uri =
                ServletUriComponentsBuilder.fromCurrentRequest().path("/login").buildAndExpand().toUri();
        return ResponseEntity.ok().body(response);
    }
}
