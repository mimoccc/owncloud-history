<?php

/**
 * ownCloud - history plugin
 *
 * @author Nico Kaiser
 * @copyright 2013 Nico Kaiser nico@kaiser.me
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\Files_History;

class Hooks
{
    public static function preDeleteUser($params)
    {
        if (\OCP\App::isEnabled('files_history')) {
            $uid = $params['uid'];
            History::userDeleted($uid);
        }
    }

    public static function postCreate($params)
    {
        if (\OCP\App::isEnabled('files_history')) {
            $path = $params['path'];
            History::fileCreated($path);
        }
    }

    public static function postWrite($params)
    {
        if (\OCP\App::isEnabled('files_history')) {
            $path = $params['path'];
            History::fileUpdated($path);
        }
    }

    public static function postDelete($params)
    {
        if (\OCP\App::isEnabled('files_history')) {
            $path = $params['path'];
            History::fileDeleted($path);
        }
    }

    public static function postRename($params)
    {
        if (\OCP\App::isEnabled('files_history')) {
            $oldpath = $params['oldpath'];
            $newpath = $params['newpath'];
            History::fileRenamed($oldpath, $newpath);
        }
    }

    public static function postShared($params)
    {
        if (\OCP\App::isEnabled('files_history')) {
            // ...
        }
    }

    public static function postUnshare($params)
    {
        if (\OCP\App::isEnabled('files_history')) {
            // ...
        }
    }
}
