<?php

namespace com\web;

class SessionUtil {

    const AUTHENTICATED_PROPERTY = "authenticated";
    const ROLE_PROPERTY = "role";
    const INFO_PROPERTY = "userInfo";
    const NAME_PROPERTY = "name";

    private const FORWARD_MAP = array(
        "BANKOFFICER" => "/banker/index.php",
        "LOANOFFICER" => "/banker/index.php",
        "REGISTRAR" => "/registrar/index.php",
        "STUDENT" => "/student/index.php"
    );

    public static function commonPageLoadSessionStep(?array $allowedRoles) {
        session_start(); // Ensure session exists.
        if (!isset($_SESSION[self::AUTHENTICATED_PROPERTY])) {
            $_SESSION[self::AUTHENTICATED_PROPERTY] = false;
        }

        $authenticated = $_SESSION[self::AUTHENTICATED_PROPERTY];
        $roleNeeded = $allowedRoles != null && sizeof($allowedRoles) > 0;

        if ($authenticated) {
            $userRole = $_SESSION[self::ROLE_PROPERTY];

            if ($roleNeeded) {
                foreach ($allowedRoles as $allowedRole) {
                    if (strcmp($allowedRole, $userRole) == 0) {
                        return;
                    }
                }

                header("Location: index.php");
                exit;
            } else {
                self::forwardAuthenticatedSession();
            }
        } else {
            // Okay, we're not authenticated. This the current screen better not require authentication!
            if ($roleNeeded) {
                // User is in a location they can't be in. Send them to home page.
                header("Location: index.php");
                exit;
            }
        }
    }

    public static function forwardAuthenticatedSession() {
        // So user is logged in but went to home page, forward them elsewhere
        $userRole = $_SESSION[self::ROLE_PROPERTY];
        header("Location: " . self::FORWARD_MAP[$userRole]);
        exit;
    }
}
