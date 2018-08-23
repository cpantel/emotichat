<?php
require_once dirname(__FILE__) . '/EmoticonService.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Emotichat</title>
    <!-- generador por EmoticonService::renderStyle -->
    <style>
        <?php
            print(EmoticonService::renderStyle());
        ?>
    </style>
    <!-- generador por EmoticonService::renderStyle -->
</head>
<body>
    <h1>Mensajes</h1>
    <div class="mensajes">


    </div>
    <div class="machete">
        <!-- generador por EmoticonService::renderMachete -->
        <?php
           print(EmoticonService::renderMachete());
        ?>
        <!-- generador por EmoticonService::renderMachete -->            
    </div>
    <div>
    <form action="newPost.php" method="post">
        <div><label for="remitente">Remitente</label><input type="email" name="remitente" id="remitente"></div>
        <div><label for="mensaje">Mensaje</label><textarea name="mensaje" id="mensaje" cols="30" rows="10"></textarea></div>
        <div><input type="submit" value="Enviar"></div>
    </form>
    </div>


     <div class="conversacion">
        <?php
           foreach (EmoticonService::getAll() as $record  ) {
                $record['texto'] = implode('',array_map( function($elem) {
                    if ($elem[0]=="text") { return $elem[1];}
                    return '<div class="canvas"><img id="'.$elem[1].'" class="emoticon" src="emoticones.jpg" alt=""></div>';
                }, EmoticonService::parseLine($record['texto']) ))   ;
                print ( implode(' | ', $record) . "</br>\n");
            }
        ?>
     </div>
   <div><a href="reset.php">reset</a></div>
   <div><a href="create.php">create</a></div>
</body>
</html>
