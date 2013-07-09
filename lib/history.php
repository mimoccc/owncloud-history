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

class History
{
    public static function getUidAndFilename($filename)
    {
        $uid = \OC\Files\Filesystem::getOwner($filename);
        \OC\Files\Filesystem::initMountPoints($uid);
        if ($uid != \OCP\User::getUser()) {
            $info = \OC\Files\Filesystem::getFileInfo($filename);
            $ownerView = new \OC\Files\View('/' . $uid . '/files');
            $filename = $ownerView->getPath($info['fileid']);
        }
        return array($uid, $filename);
    }

    public static function userDeleted($uid)
    {
        $query = \OC_DB::prepare('DELETE FROM `*PREFIX*files_history` WHERE `uid`=?');
        $query->execute(array($uid));
    }

    public static function fileCreated($path)
    {
        $uid = \OCP\User::getUser();
        $query = \OCP\DB::prepare('INSERT INTO `*PREFIX*files_history` (`uid`, `action`, `timestamp`, `path`) VALUES (?, ?, ?, ?)');
        $query->execute(array($uid, 'create', time(), $path));
    }

    public static function fileUpdated($path)
    {
        $uid = \OCP\User::getUser();
        $query = \OCP\DB::prepare('INSERT INTO `*PREFIX*files_history` (`uid`, `action`, `timestamp`, `path`) VALUES (?, ?, ?, ?)');
        $query->execute(array($uid, 'write', time(), $path));
    }

    public static function fileDeleted($path)
    {
        $uid = \OCP\User::getUser();
        $query = \OCP\DB::prepare('INSERT INTO `*PREFIX*files_history` (`uid`, `action`, `timestamp`, `path`) VALUES (?, ?, ?, ?)');
        $query->execute(array($uid, 'delete', time(), $path));
    }

    public static function fileRenamed($oldpath, $newpath)
    {
        $uid = \OCP\User::getUser();
        $query = \OCP\DB::prepare('INSERT INTO `*PREFIX*files_history` (`uid`, `action`, `timestamp`, `path`, `newpath`) VALUES (?, ?, ?, ?, ?)');
        $query->execute(array($uid, 'rename', time(), $oldpath, $newpath));
    }
}
