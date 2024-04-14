<?php
    $rows = 5;

    /*
    * *
    * * *
    * * * *
    * * * * */
    for($i=1; $i<=$rows; $i++) {
        for($j=1; $j<=$i; $j++) {
            echo "* ";
        }
        echo "<br>";
    }

    echo "<br>";
    echo "<br>";
    
              /*
            * *
          * * *
        * * * *
      * * * * */

    for($i=1; $i<=$rows; $i++) {
        for($k=$rows; $k>$i; $k--) {
            echo "&nbsp;&nbsp;&nbsp;";
        }
        for($j=1; $j<=$i; $j++) {
            echo "* ";
        }
        echo "<br>";
    }

    echo "<br>";

    /* * * * *
    * * * *
    * * *
    * *
    */

    for($i=$rows; $i>=0; $i--) {
        for($j=1; $j<=$i; $j++) {
            echo "* ";
        }
        echo "<br>";
    }

    echo "<br>";
    
         /*
         * *
        * * *
       * * * *
      * * * * */

    for($i=1; $i<=$rows; $i++) {
        for($k=$rows; $k>$i+1; $k--) {
            echo "&nbsp;";
        }
        for($j=1; $j<=$i; $j++) {
            echo "* ";
        }
        echo "<br>";
    }

    echo "<br>";

            /*
            * *
           * * *
          * * * *
         * * * * *
          * * * *
           * * *
            * *
             */

    for($i=1; $i<=$rows; $i++) {
        for($k=$rows; $k>$i+1; $k--) {
            echo "&nbsp;";
        }
        for($j=1; $j<=$i; $j++) {
            echo "* ";
        }
        echo "<br>";
    }
    for($i=$rows-1; $i>0; $i--) {
        for($k=$rows-1; $k>=$i; $k--) {
            echo "&nbsp;";
        }
        for($j=1; $j<=$i; $j++) {
            echo "* ";
        }
        echo "<br>";
    }

    echo "<br>";

        /*1
        2 2
        3 3 3
        4 4 4 4
        5 5 5 5 5*/

    for($i=1; $i<=$rows; $i++) {
        for($j=1; $j<=$i; $j++) {
            echo $i." ";
        }
        echo "<br>";
    }

    echo "<br>";

        /*1
        1 2
        1 2 3
        1 2 3 4
        1 2 3 4 5*/

    for($i=1; $i<=$rows; $i++) {
        for($j=1; $j<=$i; $j++) {
            echo $j." ";
        }
        echo "<br>";
    }

    echo "<br>";

        /*1
        2 3
        4 5 6
        7 8 9 10
        11 12 13 14 15*/

    $num = 1;
    for($i=1; $i<=$rows; $i++) {
        for($j=1; $j<=$i; $j++) {
            echo $num." ";
            $num++;
        }
        echo "<br>";
    }

    echo "<br>";

         /*A
          A B
         A B C
        A B C D
       A B C D E*/

    for($i=1; $i<=$rows; $i++) {
        for($k=$rows; $k>$i+1; $k--) {
            echo "&nbsp;&nbsp;";
        }
        for($j=1; $j<=$i; $j++) {
            echo chr(64+$j)." ";
        }
        echo "<br>";
    }

    echo "<br>";
?>