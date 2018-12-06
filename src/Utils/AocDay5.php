<?php

namespace Console\Utils;

class AocDay5
{

    private $code; 
    private $countPartI  = Array(); 
    private $countPartII = Array(); 
    private $abc;

    /*
    * Alapértékek beállítása
    *
    */

    public function __construct( $filename ) {
        
        $this->abc  = range( 'a', 'z' );
        $this->code = file( "public/".$filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

    }

    /*
    * PART I Megoldás kiszámítása
    *
    */

    public function setPartI() {

        $array1 = Array();
        $array2 = Array();      
        $array3 = Array();    

        foreach ( $this->code as $v ) {

            /*
            * Minimum 3 db magánhangzó (aeiou) van benne
            */
    
            preg_match_all('/[aeiou]/i',$v, $vowels_matches);

            if ( count( $vowels_matches[0] ) >= 3  ) {

                $array1[] = $v;

            }

            /*
            * 2 egyforma egymás mellett
            */

            foreach ( $this->abc as $ak => $av ) {

                $pattern1 = "/".$av."{2}/";

                if ( preg_match( $pattern1, $v ) ) { $array2[] = $v; }

            } // foreach ( $this->abc as $ak => $av ) end


            /*
            * Nem lehet benne a következő karaktersorozat: (ab, cd, pq, xy)
            */
            
            if ( !preg_match("#(.*?)(ab|cd|pq|xy)(.*?)#", $v) ) { $array3[] = $v; }

        } // foreach ( $this->code as $v ) end

        $this->countPartI = array_intersect( $array1, $array2, $array3 );

    } // public function setPartI() end


    /*
    * PART II Megoldás kiszámítása
    *
    */

    public function setPartII() {

        foreach ( $this->code as $v ) {

            $letters         = str_split($v);
            $has2LetterPair  = false;
            $hasRepeatLetter = false;

            foreach ( $letters as $key => $value ) {

                if ( !$has2LetterPair && $key > 0 ) {

                    $has2LetterPair = strpos( $v, $letters[$key - 1] . $value, $key + 1 ) !== false;

                } // if ( !$has2LetterPair && $key > 0 ) end

                if ( !$hasRepeatLetter && $key > 1 ) {

                    $hasRepeatLetter = $value === $letters[$key - 2];

                } // if ( !$hasRepeatLetter && $key > 1 ) end

                if ( $has2LetterPair && $hasRepeatLetter ) {

                    $this->countPartII[] = $hasRepeatLetter;
                    break;

                } // if ( $has2LetterPair && $hasRepeatLetter ) end

            } // foreach ( $letters as $key => $value ) end

        } // foreach ( $this->code as $v ) end

    } // public function setPartII() end


    /*
    * PART I Megoldás kinyerése
    *
    */

    public function getPartI() {

        $this->setPartI();
        
        return count($this->countPartI);

    } // public function getPartI() end



    /*
    * PART II Megoldás kinyerése
    *
    */

    public function getPartII() {

        $this->setPartII();
        
        return count($this->countPartII);

    } // public function getPartII() end

}
