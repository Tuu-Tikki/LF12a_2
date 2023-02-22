<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Energiedaten</title>
        
        <style>
            form, .data {
                max-width: 800px;
                margin: auto;
            }
            table, th, td {
               border: 1px solid;
               border-collapse: collapse;
            }
            th {
               width: 200px;
               background: lightblue;
            }
            td {
               text-align: center;
            }
            tr:nth-child(even) {
               background-color: #e6ffff;
            }
            
            .requestForm {
                border: 1px blueviolet dashed;
                background: #ffe6ff;
                width: 800px;
            }
             .inputForm {
                margin: 5px;
            }  
            .inputForm label {
                display: inline-block;
                width: 80px;
            }
            .button {
                margin: 20px;
            }
            .button input {
                background: blueviolet;
                color: white;
                font-style: bold;
                border: 1px violet solid;
                width: 150px;
                height: 40px;
            }
            .requestForm h4 {
                margin: 0 20px 20px 0;
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



