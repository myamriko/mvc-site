<?php


class Salt

{
    /**
     * @return string
     * Случайная соль она же пароль
     */
    public function rnd()
    {
        $simv = ["q", "w", "e", "r", "t", "y", "u", "i", "o", "p", "a", "s", "d", "f", "g", "h", "j", "k", "l", "z", "x", "c", "v",
            "b", "n", "m", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "A", "S",
            "D", "F", "G", "H", "J", "K", "L", "Z", "X", "C", "V", "B", "N", "M"];
        $sault = '';
        for ($k = 0; $k < 16; $k++) {
            shuffle($simv);
            $sault = $sault . $simv[1];
        }
        return $sault;
    }

    public function restorePassRnd()
    {
        $simv1 = ["Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "A", "S",
            "D", "F", "G", "H", "J", "K", "L", "Z", "X", "C", "V", "B", "N", "M"];
        $simv2 = ["q", "w", "e", "r", "t", "y", "u", "i", "o", "p", "a", "s", "d", "f", "g", "h", "j", "k", "l", "z", "x", "c", "v",
            "b", "n", "m"];
        $simv3 = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];
        $simv4 = [".", ",", ";", ":"];
        $pass = '';
        for ($k = 0; $k < 2; $k++) {
            shuffle($simv1);
            shuffle($simv2);
            shuffle($simv3);
            shuffle($simv4);
            $pass = $pass . $simv1[1] . $simv2[1] . $simv3[1] . $simv4[1];
        }
        return $pass;


    }

}