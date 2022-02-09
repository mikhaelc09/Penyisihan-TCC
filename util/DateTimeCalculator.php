<?php
    $tz = new DateTimeZone('Asia/Jakarta');

    function getDateFormatted($dt, $format){
        return date_format(new DateTime($dt,$GLOBALS["tz"]), $format);
    }

    function getTimeFormatted($dt, $format){
        return date_format(new DateTime($dt,new DateTimeZone('Asia/Jakarta')), $format);
    }

    function getCurrentDateDifference($dt){
        return date_diff(new DateTime($dt, new DateTimeZone('Asia/Jakarta')), new DateTime('now', new DateTimeZone('Asia/Jakarta')));
    }

    function getSecondsInterval(DateInterval $dd){
        $intv = $dd->s + $dd->i*60 + $dd->h*60*60 + $dd->d*60*60*24;
        if($dd->format("%R") == '-'){
            $intv *=-1;
        }
        return $intv;
    }

    function getMicroSecondsInterval(DateInterval $dd){
        $intv = $dd->f + $dd->s*1000 + $dd->i*60*1000 + $dd->h*60*60*1000 + $dd->d*60*60*24*1000;
        if($dd->format("%R") == '-'){
            $intv *=-1;
        }
        return $intv;
    }

    function getDuration($d1, $d2){
        $dd = date_diff(new DateTime($d1, new DateTimeZone('Asia/Jakarta')), new DateTime($d2, new DateTimeZone('Asia/Jakarta')));
        return $dd->i + $dd->h*60 + $dd->d*60*24;
    }
?>