<?php
    class Cifrar{

        public function cifrarTexto($textoAcifrar){
            $hash = md5($textoAcifrar);
            return $hash;
        }

    }
