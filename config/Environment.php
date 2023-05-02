<?php
    class Environment{



        public function getBooleanFromBooleanText($string){
            if($string == "false" || $string == "False" || $string == "FALSE"){
                return false;
            }
            else if($string == "true" || $string == "True" || $string == "TRUE"){
                return true;
            }
            else{
                return false;
            }
        }




    }

?>