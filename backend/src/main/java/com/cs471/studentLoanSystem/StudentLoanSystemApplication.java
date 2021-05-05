package com.cs471.studentLoanSystem;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@SpringBootApplication
@RestController
public class StudentLoanSystemApplication {

    public static void main(String[] args) {
        SpringApplication.run(StudentLoanSystemApplication.class, args);
    }

    @RequestMapping("/")
    public String index() {
        return "Hello World!";
    }

    /**
    * close_this_application mapping This function is used only to ensure the bootRun gradle task
    * finishes. This will be disabled on production runs so that nobody can close the web
    * application, but it's nice to close the application when doing bootRun tests.
    */
    @RequestMapping("/close_this_application")
    public void quit() {
        System.exit(0);
    }
}
