<?php

namespace Console\Utils;

class AocDay8
{

    private $code; 
    private $stringSize;
    private $textSize;
    private $encodedChars;

    /*
    * Alapértékek beállítása
    *
    */

    public function __construct( $filename ) {
        
        $this->code = file( "public/".$filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

    } // public function __construct( $filename ) end


    /*
    * PART I Megoldás kiszámítása
    *
    */

    public function setPartI() {

        $this->stringSize = 0;
        $this->textSize   = 0;

        foreach ( $this->code as $line ) {

            $actLine           = trim( $line );
            $actStringSize     = strlen( $actLine );
                        
            preg_match_all("/\\\\x[0-9a-f]{2}/", $line, $matches);

            $actSpecSignSize = 0;

            if ( count( $matches[0] ) > 0 ) {

                foreach ( $matches[0] as $v ) {

                    $actLine = str_replace( $v, "_", $actLine );

                }

                $specSign = count( $matches[0] );

            } // if ( count( $matches[0] ) > 0 ) end
            

            $actLine = stripslashes( str_replace( '\\\\', '"', $actLine ) );
            
            $actTextSize = strlen( $actLine ) - 2;

            $this->stringSize += $actStringSize; 
            $this->textSize   += $actTextSize; 

        } // foreach ( $this->code as $v ) end

    } // public function setPartI() end


    /*
    * PART II Megoldás kiszámítása
    *
    */

    public function setPartII() {

        $this->stringSize    = 0;
        $this->textSize      = 0;
        $this->encodedChars  = 0;

        foreach ( $this->code as $line ) {

            $actLine           = trim( $line );
            $actStringSize     = strlen( $actLine );

            $this->encodedChars += strlen( '"'.addslashes( $actLine ).'"' ); // for part 2
                        
            preg_match_all("/\\\\x[0-9a-f]{2}/", $line, $matches);

            $actSpecSignSize = 0;

            if ( count( $matches[0] ) > 0 ) {

                foreach ( $matches[0] as $v ) {

                    $actLine = str_replace( $v, "_", $actLine );

                }

                $specSign = count( $matches[0] );

            } // if ( count( $matches[0] ) > 0 ) end
            

            $actLine = stripslashes( str_replace( '\\\\', '"', $actLine ) );
            
            $actTextSize = strlen( $actLine ) - 2;

            $this->stringSize += $actStringSize; 
            $this->textSize   += $actTextSize; 

        } // foreach ( $this->code as $v ) end

    } // public function setPartII() end


    /*
    * PART I Megoldás kinyerése
    *
    */

    public function getPartI() {

        $this->setPartI();
        
        return $this->stringSize - $this->textSize;

    } // public function getPartI() end



    /*
    * PART II Megoldás kinyerése
    *
    */

    public function getPartII() {

        $this->setPartII();
        
        return $this->encodedChars - $this->stringSize;

    } // public function getPartII() end

}
