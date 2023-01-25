<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Energiedaten</title>
        
        <style>
            table, th, td {
               border: 1px solid;
               border-collapse: collapse;
            }
            th {
               width: 200px;
            }
            td {
               text-align: center;
            }
        </style>
    </head>
    
    <body>
        <div>
            <p><?php echo $message ?></p>
        </div>
        <?php require_once 'requestForm.html'; ?>        
        <?php require_once 'energyDataTable.php'; ?>                      
    </body>
</html>



