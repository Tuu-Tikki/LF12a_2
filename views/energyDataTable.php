<div class="data">
    <h4>Energiedaten</h4>
    <p>Es gibt <?php echo $rowCount; ?> Einträge in Datenbank</p>
    <p>In der Tabelle werden die Daten für den letzten Tag in der Datenbank gezeigt </p>
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

