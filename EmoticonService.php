<?php
require_once dirname(__FILE__) . '/functions.php';

class EmoticonService {
    public static $conn = 0;

    static $ascii = array(
        ":-)",
        ":-(", 
        ";-)", 
        ":'-(",
  
        "8D", 
        ">-)", 
        ">-("
     );    

    public static function init() {
        self::$conn = new SQLite3(dirname(__FILE__) . '/emotichat.db3') or die("no conn");
    }

    public static function createDB() {
        $stmt = self::$conn->prepare("CREATE TABLE mensajes(id INTEGER PRIMARY KEY , ts TEXT, remitente TEXT, texto TEXT;");    
        $res =  $stmt->execute();
    }    
        
    public static function truncateDB() {
        $stmt = self::$conn->prepare("DELETE FROM mensajes;");    
        $res =  $stmt->execute();
    }

    public static function getAll() {
        $stmt = self::$conn->prepare("SELECT * FROM mensajes ORDER BY ts");    
        $res =  $stmt->execute();
        $result = array();
        while ($record = $res->fetchArray(SQLITE3_ASSOC) ) {
           $result[] = $record;
        }
        return $result;
    }

    public static function create($remitente, $texto) {
        $insertStmt = self::$conn->prepare("INSERT INTO mensajes (ts,remitente,texto) values (:ts, :remitente, :texto);") or die("no prepare"); 
        $insertStmt->bindValue(':ts', now()    ,SQLITE3_TEXT);
        $insertStmt->bindValue(':remitente',$remitente,SQLITE3_TEXT);
        $insertStmt->bindValue(':texto',    $texto,    SQLITE3_TEXT);
        $insertStmt->execute();
    }

    static public function parseLine($line) {
        // mientras la linea no este vacia
        //   para cada emoticon
        //     si coincide con el comienzo de la linea
        //       consumir la longitud del emoticon
        //       si habia texto pendiente agregar a la respuesta
        //       agregar a la respuesta
        //       vaciar texto pendiente
        //   si no hubo coincidencia
        //    agregar primera letra al texto pendiente
        //    consumir una letra
        //si habia texto pendiente agregar a la respuesta
        $idx = 0;
        $pending = '';
        $result = array();
        while (strlen($line) > 0 ) {
           $found = false;
           for ($emoIdx = 0; $emoIdx < sizeof(self::$ascii); $emoIdx++) {
               if (strpos($line,self::$ascii[$emoIdx]) === 0 ) {
                    if ($pending != '') {
                        $result[] = array('text',$pending);
                        $pending = '';
                    }
                    $emoIdx++;
                    $result[] = array('emoticon',"e$emoIdx");
                    $line = substr($line, strlen(self::$ascii[$emoIdx]));
                    $found = true;
                    break;
               }
           }
           if (! $found) {
                $pending .= substr($line,0,1);
                $line = substr($line,1);
           }
        }
        if ($pending != '') {
            $result[] = array('text',$pending);
        }
        return $result;
      }
   
      static public function renderMachete() {
         return '            :-) <div class="canvas"><img id="e1" class="emoticon" src="emoticones.jpg" alt=""></div>
         :-( <div class="canvas"><img id="e2" class="emoticon" src="emoticones.jpg" alt=""></div>
         ;-) <div class="canvas"><img id="e3" class="emoticon" src="emoticones.jpg" alt=""></div>
         :\'-( <div class="canvas"><img id="e4" class="emoticon" src="emoticones.jpg" alt=""></div>
   
         8D <div class="canvas"><img id="e5" class="emoticon" src="emoticones.jpg" alt=""></div>
         >-) <div class="canvas"><img id="e6" class="emoticon" src="emoticones.jpg" alt=""></div>
         >-( <div class="canvas"><img id="e7" class="emoticon" src="emoticones.jpg" alt=""></div>';
      } 
   
      static public function renderStyle() {
        return "       .canvas {
                height: 30px;
                width: 30px;
                overflow: hidden;
                display: inline-block;
            }
            .emoticon {
                position:relative;
            }
            #e1 {
                left:-7px;
                top:-3px;
            }
            #e2 {
                left:-50px;
                top:-3px;
            }
            #e3 {
                left:-97px;
                top:-3px;
            }
            #e4 {
                left:-143px;
                top:-3px;
            }
        
            #e5 {
                left:-7px;
                top:-35px;
            }
            #e6 {
                left:-50px;
                top:-35px;
            }
            #e7 {
                left:-97px;
                top:-35px;
            }
            #e8 {
                left:-143px;
                top:-35px;
            }       
        
        ";
      }    
}

EmoticonService::init();