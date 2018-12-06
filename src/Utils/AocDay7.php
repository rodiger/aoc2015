<?php

namespace Console\Utils;

class AocDay7
{

    private $code; 
    public $wires         = Array();
    private $operator     = Array('AND' => '&', 'OR' => '|', 'NOT' => '~', 'RSHIFT' => '>>', 'LSHIFT' => '<<');

    /*
    * Alapértékek beállítása
    *
    */

    public function __construct( $filename ) {
        
        $this->code = file( "public/".$filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

        foreach ( $this->code as $line ) {
            
            list( $k, $v ) = explode(' -> ', $line );
            $this->wires[$v] = $k;

        } // foreach ( $this->code as $v ) end

    } // public function __construct( $filename ) end

    /*
    * PART I Megoldás kiszámítása
    *
    */

    public function setPartI( $sign = "a" ) {

        if ( !isset( $this->wires[$sign] ) ) return $sign;

        if ( strpos( $this->wires[$sign], ' ') !== false ) {

            eval('$this->wires[$sign] = (' . preg_replace_callback('#(([a-z0-9]+) )?([A-Z]+) ([a-z0-9]+)#', function ($p) {

                return $this->setPartI($p[2]) . $this->operator[$p[3]] . $this->setPartI($p[4]);

            }, $this->wires[$sign]) . ' & 65535);');

        } // if ( strpos( $this->wires[$sign], ' ') !== false ) end

        return $this->setPartI($this->wires[$sign]);

    } // public function setPartI() end


    /*
    * PART II Megoldás kiszámítása
    *
    */

    public function setPartII( $sign = "a" ) {

        return "Nem lett leprogramozva";

    } // public function setPartII() end


    /*
    * PART I Megoldás kinyerése
    *
    */

    public function getPartI( $sign ) {

        return $this->setPartI( $sign );

    } // public function getPartI() end



    /*
    * PART II Megoldás kinyerése
    *
    */

    public function getPartII( $sign ) {

        return $this->setPartII( $sign );

    } // public function getPartII() end

}
