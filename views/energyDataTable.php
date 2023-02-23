<div class="data">
    <h4>Energiedaten</h4>
    <p>Es gibt <?php echo $rowCount; ?> Einträge in Datenbank</p>
    <p>Zeitrahmen:</p>
    <ul>
        <?php foreach ($dates as $date) : ?>
        <li><?php echo $date[0] . " - " . $date[1] ?></li>
        <?php endforeach; ?>
    </ul>
    <p>Die Tabelle zeigt die Daten aus der Datenbank für die 24 Stunden</p>
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

