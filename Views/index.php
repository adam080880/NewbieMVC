    <table border=1 cellspacing=0 cellpadding=10>

        <tr>
            <th>No</th>
            <th>Nama</th>
        </tr>

        <?php foreach($mapel as $field => $res): ?>
            <tr>

                <td><?= $no++ ?></td>
                <td><?= $res->nama ?></td>

            </tr>
        <?php endforeach; ?>
    </table>
