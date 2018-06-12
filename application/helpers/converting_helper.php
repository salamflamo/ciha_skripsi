<?php
defined('BASEPATH')or exit('No direct script access are allowed');



    /**
    * NOTE : untuk mengkonversi tanggal menjadi tanggal baca
    * @param tgl = date : tgl yang akan dikonversi default null
    * @param ke = date : menjadi format apa default tgl
    * @param dif = pemisah, misal '-' atau '/' default '-'
    */
    if (!function_exists('tgl_baca')) {
        function tgl_baca($tgl='', $ke='tgl', $dif='-')
        {
            $bulan = array(
             1 => 'Januari',
             2 => 'Februari',
             3 => 'Maret',
             4 => 'April',
             5 => 'Mei',
             6 => 'Juni',
             7 => 'Juli',
             8 => 'Agustus',
             9 => 'September',
             10 => 'Oktober',
             11 => 'November',
             12 => 'Desember',
           );
            // membuat variabel global untuk hari
            $newDay = array(
             'Monday' => 'Senin',
             'Tuesday' => 'Selasa',
             'Wednesday' => 'Rabu',
             'Thursday' => 'Kamis',
             'Friday' => 'Jumat',
             'Saturday' => 'Sabtu',
             'Sunday' => 'Minggu',
           );
            $newDate = '';
            if ($tgl == '' || $tgl == null) {
                return 'Tgl Kosong';
            } else {
                if ($ke=='tgl') {
                    $newTgl = date("d".$dif."m".$dif."Y", strtotime($tgl));
                    $jam = date_format(date_create($tgl), 'H:i:s');
                    $newJam = $jam == '00:00:00' ? '' : " ".$jam;
                    $newDate = $newTgl.$newJam;
                } elseif ($ke=='text') {
                    $day = date_format(date_create($tgl), 'l');
                    if (date_format(date_create($tgl), 'H:i:s') != '00:00:00') {
                        $newTime = date_format(date_create($tgl), 'H:i:s');
                    } else {
                        $newTime = ''.
                    $dif = '';
                    }
                    $newTgl = explode('-', date_format(date_create($tgl), 'd-m-Y'));
                    $newDate = $newTime." ".$dif." ".$newDay[$day].", ".$newTgl[0]." ".$bulan[(int)$newTgl[1]]." ".$newTgl[2];
                }
                return $newDate;
            }
        }
    }

    /**
    * NOTE : untuk mengkonversi tanggal menjadi tanggal database
    * @param tgl = date : tgl yang akan dikonversi default null
    */
    if (!function_exists('tgl_db')) {
        function tgl_db($tgl)
        {
            $newtgl = strpos($tgl, '/') > 0 ? str_replace('/', '-', $tgl) : $tgl;
            $jam = date_format(date_create($newtgl), 'H:i:s');
            $newJam = $jam == '00:00:00' ? '' : ' '.$jam;
            return date_format(date_create($newtgl), 'Y-m-d').$newJam;
        }
    }

    if (!function_exists('tambah_jam')) {
        function tambah_jam($time='', $adding=0)
        {
            $newtime = empty($time) ? date('Y-m-d H:i:s') : $time;
            $endTime = strtotime("+$adding hours", strtotime($newtime));
            return $added = date('Y-m-d H:i:s', $endTime);
        }
    }

    if (!function_exists('uang')) {
        function uang($nominal=0, $dif='.')
        {
            $newDuit = "".$nominal."";
            return reverse_str(sisipi(reverse_str($newDuit), $dif));
        }
    }

    if (!function_exists('reverse_str')) {
        function reverse_str($str='')
        {
            $i = strlen($str)-1;
            $out = "";
            while ($i > -1) {
                $out .= $str[$i];
                $i--;
            }
            return $out;
        }
    }

    if (!function_exists('sisipi')) {
        function sisipi($str='', $dif='.')
        {
            $batas = strlen($str);
            $out = "";
            $j = 0;
            for ($i=0; $i < $batas; $i++) {
                if ($j==2) {
                    $j=0;
                    $out .= $str[$i];
                    if ($i+1!=$batas) {
                        $out .= $dif;
                    }
                } else {
                    $out .= $str[$i];
                    $j++;
                }
            }
            return $out;
        }
    }

    if (!function_exists('bulan_text')) {
      function bulan_text($bln='')
      {
          $bulan = array(
           1 => 'Januari',
           2 => 'Februari',
           3 => 'Maret',
           4 => 'April',
           5 => 'Mei',
           6 => 'Juni',
           7 => 'Juli',
           8 => 'Agustus',
           9 => 'September',
           10 => 'Oktober',
           11 => 'November',
           12 => 'Desember',
         );
         return $bulan[$bln];
      }
    }
