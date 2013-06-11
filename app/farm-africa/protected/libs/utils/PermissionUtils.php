<?php
/**
 * PermissionUtils contains utility functions & constants related to 
 * Permissions in the FarmAfrica System
 *
 * @author muya
 */
class PermissionUtils {
    const SUPER_USER_ID = 1;
    /**
     * function to check if user has permissions to perform the specified action
     * on the specified module
     * @param String $moduleName
     * @param int | String $action
     * @return boolean
     */
    public static function checkModuleActionPermission($moduleName, $action = null){
        return true;
    }
}

?>
