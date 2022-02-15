<?php

namespace DeployHuman\fortnox;

class Validation

{

    static function email($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }


    public static function base64(string $data): bool
    {
        return (bool) mb_ereg_match('^([A-Za-z0-9+/]{4})*([A-Za-z0-9+/]{3}=|[A-Za-z0-9+/]{2}==)?$', $data);
    }

    public static function imageMinDimensions(string $data, int $min_width = 1, int $min_height = 1): bool
    {
        $size = getimagesizefromstring($data);
        if (!$size) return false;
        if ($size[0] < $min_width  || $size[1] < $min_height) return false;
        return true;
    }

    /**
     * Validate Organisation number in the form of SE[xxxxxxxxxx]01
     *
     * @param string $vatnumber 10 digit
     * @return bool
     */
    public static function vatnumber($vatnumber): bool
    {
        if (!mb_ereg_match('^SE[0-9]{10}01$', $vatnumber)) return false;
        $orgnumber = mb_substr($vatnumber, 2, 10);
        $orgnumber = trim(strval($orgnumber));
        if (!mb_ereg_match("^[0-9]{10}$", $orgnumber)) return false;
        $presetchecknum = intval(mb_substr($orgnumber, mb_strlen($orgnumber) - 1));

        $cleaninput = mb_substr($orgnumber, 0, mb_strlen($orgnumber) - 1);
        $len = mb_strlen($cleaninput);
        $char = "";
        $returnstring = "";
        $weight = 0;
        $produkt = 0;
        $sumprodukt = 0;
        $fig = 0;

        for ($pos = $len - 1; $pos >= 0; $pos--) {
            $char = mb_substr($cleaninput, $pos, 1);
            if ($weight == 2) {
                $weight = 1;
            } else {
                $weight = 2;
            }
            $produkt = intval($weight) * intval($char);
            if ($produkt > 9) {
                $produkt -= 9;
            }
            $sumprodukt += $produkt;
            $returnstring .= $char;
        }

        $fig = (10 - ($sumprodukt % 10));
        if ($fig == 10) {
            $fig = 0;
        }
        if ($fig === $presetchecknum) return true;
        return false;
    }


    /**
     * Checks if Social Security Number is correct, even does the Control-number check
     * 
     * @param string $pnummer a 12 digit long number
     * @return boolean If its correct or not
     */
    public static function personnummer(string $pnummer): bool
    {
        $pnummer = mb_ereg_replace("%[^0-9]%", '', $pnummer);
        if (!preg_match("%^(19|20)?[0-9]{6}[- ]?[0-9]{4}$%", $pnummer)) {
            return false;
        }
        $cleaninput = mb_substr($pnummer, 2, mb_strlen($pnummer) - 3);
        $len = mb_strlen($cleaninput);
        $char = "";
        $weight = 0;
        $produkt = 0;
        $sumprodukt = 0;
        $fig = 0;
        for ($pos = 0; $pos < $len; $pos++) {
            $char = mb_substr($cleaninput, $pos, 1);
            if ($weight == 2) {
                $weight = 1;
            } else {
                $weight = 2;
            }
            $produkt = intval($weight) * intval($char);
            if ($produkt > 9) {
                $produkt -= 9;
            }
            $sumprodukt += $produkt;
        }
        $fig = (10 - ($sumprodukt % 10));
        if ($fig == 10) $fig = 0;

        $SentControlnumber = mb_substr($pnummer, mb_strlen($pnummer) - 1, 1);
        if ($fig  ==  $SentControlnumber) {
            return true;
        }
        return false;
    }
}
