<?php
require_once '../../classes/Archive.php';  // Adjust path if needed

$archive = new Archive();
$archivedRecords = $archive->getArchivedRecords();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archived Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Archived Records</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Archive ID</th>
                    <th>Table Name</th>
                    <th>Record ID</th>
                    <th>Data</th>
                    <th>Archived At</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($archivedRecords)): ?>
                    <?php foreach ($archivedRecords as $record): ?>
                        <tr>
                            <td><?= $record['archive_id'] ?></td>
                            <td><?= $record['table_name'] ?></td>
                            <td><?= $record['record_id'] ?></td>
                            <td><?= htmlspecialchars($record['data']) ?></td>
                            <td><?= $record['archived_at'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No archived records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
