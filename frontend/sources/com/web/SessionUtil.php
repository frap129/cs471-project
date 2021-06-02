<?php

namespace com\web;

/**
 * Utility for sessions.
 *
 * @author Andy Gabler
 */
class SessionUtil {

    const AUTHENTICATED_PROPERTY = "authenticated";
    const ROLE_PROPERTY = "role";
    const INFO_PROPERTY = "userInfo";
    const NAME_PROPERTY = "name";
    const USER_ID_PROPERTY = "userId";

    private const FORWARD_MAP = array(
        "BANKOFFICER" => "/banker/",
        "LOANOFFICER" => "/banker/",
        "REGISTRAR" => "/registrar/",
        "STUDENT" => "/student/"
    );

    /**
     * Step to run when loading a page based on current session.
     *
     * @param array|null $allowedRoles The roles allowed. Null if this page requires no authentication.
     */
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

                header("Location: /");
                exit;
            } else {
                self::forwardAuthenticatedSession();
            }
        } else {
            // Okay, we're not authenticated. This the current screen better not require authentication!
            if ($roleNeeded) {
                // User is in a location they can't be in. Send them to home page.
                header("Location: /");
                exit;
            }
        }
    }

    /**
     * Forward user to proper page.
     */
    public static function forwardAuthenticatedSession() {
        // So user is logged in but went to home page, forward them elsewhere
        $userRole = $_SESSION[self::ROLE_PROPERTY];
        header("Location: " . self::FORWARD_MAP[$userRole]);
        exit;
    }
}
