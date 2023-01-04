<div>
    <h4>Energiedaten</h4>
    <h5>Es gibt <?php echo $rowCount; ?> Einträge in Datenbank</h5>
    <table>
        <tr>
            <th>Datum und Zeit</th>
            <th>Kennwert</th>
            <th>Wert</th>
            <th>Einheit</th>
        </tr>
        <?php foreach ($dataList as $entry) : ?>
        <tr>
            <?php foreach ($entry as $columnValue) : ?>
            <td><?php echo $columnValue ?></td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

