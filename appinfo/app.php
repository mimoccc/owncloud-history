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

OC::$CLASSPATH['OCA\Files_History\History'] = 'files_history/lib/history.php';
OC::$CLASSPATH['OCA\Files_History\Hooks'] = 'files_history/lib/hooks.php';

$l = OC_L10N::get('files_history');

/*
OCP\App::addNavigationEntry(array(
        'id' => 'files_history',
        'order' => 90,
        'href' => OCP\Util::linkTo('files_history', 'index.php'),
        'icon' => OCP\Util::imagePath('core', 'places/files.svg'),
        'name' => $l->t('History')
));
*/

\OCP\Util::connectHook('OC_User', 'post_deleteUser', 'OCA\Files_History\Hooks', 'postDeleteUser');

\OCP\Util::connectHook('OC_Filesystem', 'post_create', 'OCA\Files_History\Hooks', 'postCreate');
\OCP\Util::connectHook('OC_Filesystem', 'post_write', 'OCA\Files_History\Hooks', 'postWrite');
\OCP\Util::connectHook('OC_Filesystem', 'post_delete', 'OCA\Files_History\Hooks', 'postDelete');
\OCP\Util::connectHook('OC_Filesystem', 'post_rename', 'OCA\Files_History\Hooks', 'postRename');

\OCP\Util::connectHook('OCP\Share', 'post_shared', 'OCA\Files_History\Hooks', 'postShared');
\OCP\Util::connectHook('OCP\Share', 'post_unshare', 'OCA\Files_History\Hooks', 'postUnshare');
