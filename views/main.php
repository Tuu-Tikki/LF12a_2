<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Energiedaten</title>
        <style>
            <?php require_once 'styles.css'; ?>
        </style>
    </head>
    
    <body>
        <?php if($message != "") : ?>
            <div class="message">
                <p id="message"><?php echo $message ?></p>
            </div>
        <?php endif ?>
        <?php require_once 'requestForm.html'; ?>        
        <?php require_once 'energyDataTable.php'; ?> 
        <footer><p>LF12. Das Forschungsprojekt. ©2023</p></footer>
    </body>
</html>



