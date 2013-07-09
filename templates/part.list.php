
<?php foreach($_['history'] as $item):
    $relativeDate = OCP\relative_modified_date($item['timestamp']);
    switch ($item['action']) {
        case 'create':
            $icon = 'add';
            break;
        case 'write':
            $icon = 'edit';
            break;
        case 'delete':
            $icon = 'delete';
            break;
    }
    ?>
    <tr>
        <td class="history-action"
            <?php if ($item['action'] == 'create'): ?>
                style="background-image:url(/apps/files_history/img/add.png)"
            <?php elseif ($item['action'] == 'write'): ?>
                style="background-image:url(/apps/files_history/img/edit.png)"
            <?php elseif ($item['action'] == 'rename'): ?>
                style="background-image:url(/apps/files_history/img/edit.png)"
            <?php elseif ($item['action'] == 'delete'): ?>
                style="background-image:url(/apps/files_history/img/delete.png)"
            <?php endif; ?>
            >

            <?php if ($item['action'] == 'create'): ?>
                <?php printf($l->t('You have created %s.', 
                '<strong>' . htmlspecialchars($item['path']) . '</strong>')); ?>
            <?php elseif ($item['action'] == 'write'): ?>
                <?php printf($l->t('You have edited %s.', 
                '<strong>' . htmlspecialchars($item['path']) . '</strong>')); ?>
            <?php elseif ($item['action'] == 'rename'): ?>
                <?php printf($l->t('You have renamed %s to %s.', array(
                '<strong>' . htmlspecialchars($item['path']) . '</strong>',
                '<strong>' . htmlspecialchars($item['newpath']) . '</strong>'))); ?>
            <?php elseif ($item['action'] == 'delete'): ?>
                <?php printf($l->t('You have deleted %s.', 
                '<strong>' . htmlspecialchars($item['path']) . '</strong>')); ?>
            <?php endif; ?>
        </td>

        <td class="history-date">
            <span title="<?php p( \OCP\Util::formatDate((int)$item['timestamp'])); ?>">
                <?php p($relativeDate); ?>
            </span>
        </td>

    </tr>
<?php endforeach;

?>
