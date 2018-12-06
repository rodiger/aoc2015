<?php

namespace Console\Utils;

class AocDay6
{

    private $code; 
    private $steps           = Array();
    private $lightsGridPart1 = Array(); 
    private $lightsGridPart2 = Array(); 
    private $lightsCounter   = 0; 
    private $brightness      = 0;
    private $x_coordinate    = 0;
    private $y_coordinate    = 0; 

    /*
    * Alapértékek beállítása
    *
    */

    public function __construct( $filename, $x_coordinate = 1000, $y_coordinate = 1000 ) {

        $this->x_coordinate = $x_coordinate;
        $this->y_coordinate = $y_coordinate;

        for ( $y = 0; $y < $y_coordinate; $y++ ) {

            $this->lightsGridPart1[$y] = Array();
            $this->lightsGridPart2[$y] = Array();

            for ( $x = 0; $x < $x_coordinate; $x++ ) {

                $this->lightsGridPart1[$y][$x] = 0;
                $this->lightsGridPart2[$y][$x] = 0;

            } // for ( $x = 0; $x < $x_coordinate; $x++ ) end

        } // for ( $y = 0; $y < $y_coordinate; $y++ ) end

        
        $this->code = file( "public/".$filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

        $i = 0;

        foreach ( $this->code as $v ) {

            $v             = preg_replace('/\s+/', '', $v);

            $first_n_index = strcspn( $v , '0123456789' );
            $event         = substr( $v, 0, $first_n_index );
            $coord_array   = explode( "through", substr( $v, $first_n_index ) );

            $coord1        = $coord_array[0];
            $coord2        = $coord_array[1];

            $this->steps[$i]['event'] = $event;
            $this->steps[$i]['start'] = explode( ",", $coord1 );
            $this->steps[$i]['end']   = explode( ",", $coord2 );

            $i++;

        } // foreach ( $this->code as $v ) end

    }

    /*
    * PART I Megoldás kiszámítása
    *
    */

    public function setPartI() {

        foreach ( $this->steps as $step ) {

            $value  = $step['event'] === "turnon" ? 1 : 0;
            $start  = $step['start'];
            $end    = $step['end'];

            for ( $y = $start[1]; $y <= $end[1]; $y++ ) {

                for ( $x = $start[0]; $x <= $end[0]; $x++ ) {

                    if ($step['event'] === "toggle") {

                        $value = abs( $this->lightsGridPart1[$y][$x] - 1 );

                    } // if ($step['event'] === "toggle") vége

                    $this->lightsGridPart1[$y][$x] = $value;

                } // for ( $x = $start[0]; $x <= $end[0]; $x++ ) vége

            } // for ( $y = $start[1]; $y <= $end[1]; $y++ ) vége

        } // foreach ( $this->steps as $step ) vége

    } // public function setPartI() end


    /*
    * PART II Megoldás kiszámítása
    *
    */

    public function setPartII() {

        foreach ( $this->steps as $step ) {

            $event  = $step['event'];
            $start  = $step['start'];
            $end    = $step['end'];

            for ( $y = $start[1]; $y <= $end[1]; $y++ ) {

                for ( $x = $start[0]; $x <= $end[0]; $x++ ) {

                    if ( $event === "toggle" ) {

                        $this->lightsGridPart2[$y][$x] += 2;

                    } elseif ( $event === "turnon" ) {

                        $this->lightsGridPart2[$y][$x]++;

                    } elseif ( $event === "turnoff" && $this->lightsGridPart2[$y][$x] > 0 ) {

                        $this->lightsGridPart2[$y][$x]--;

                    } // if ($event === "toggle") vége

                } // for ( $x = $start[0]; $x <= $end[0]; $x++ ) vége

            } // for ( $y = $start[1]; $y <= $end[1]; $y++ ) vége

        } // foreach ( $this->steps as $step ) vége

    } // public function setPartII() end


    /*
    * PART I Megoldás kinyerése
    *
    */

    public function getPartI() {

        $this->setPartI();
        
        for ( $y = 0; $y < 1000; $y++ ) {

            for ( $x = 0; $x < 1000; $x++ ) {

                if ( $this->lightsGridPart1[$y][$x] == 1 ) {

                    $this->lightsCounter++;

                } // if ( $this->lightsGridPart1[$y][$x] == 1 ) end

            } // for ( $x = 0; $x < 1000; $x++ ) end

        } // for ( $y = 0; $y < 1000; $y++ ) end

        return $this->lightsCounter;

    } // public function getPartI() end



    /*
    * PART II Megoldás kinyerése
    *
    */

    public function getPartII() {

        $this->setPartII();
        
        for ( $y = 0; $y < $this->y_coordinate; $y++ ) {

            for ( $x = 0; $x < $this->x_coordinate; $x++ ) {

                $this->brightness += $this->lightsGridPart2[$y][$x];

            } // for ( $x = 0; $x < $this->x_coordinate; $x++ ) end

        } // for ( $y = 0; $y < $this->y_coordinate; $y++ ) end

        return $this->brightness;

    } // public function getPartII() end

}