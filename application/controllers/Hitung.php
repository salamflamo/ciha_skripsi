<?php
defined('BASEPATH')or exit('No direct script access are allowed');
/**
 *
 */
class Hitung extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    var $target = [
      'passing' => 1,
      'servis' => 1,
      'block' => 1,
      'smash' => 1,
      'receive' => 1,
      'kekuatan' => 1,
      'kelincahan' => 1,
      'daya_lentur' => 1,
      'daya_ledak_otot' => 1,
      'daya_tahan' => 1,
      'kecepatan' => 1,
    ];

    var $matriks = [
      [
        'nama' => 'Name',
        'passing' => 1,
        'servis' => 1,
        'block' => 1,
        'smash' => 1,
        'receive' => 1,
        'kekuatan' => 1,
        'kelincahan' => 1,
        'daya_lentur' => 1,
        'daya_ledak_otot' => 1,
        'daya_tahan' => 1,
        'kecepatan' => 1,
      ],
    ];

    var $h_kuadrat = [];
    var $jum_kuadrat = [];
    var $a_kuadrat = [];
    var $h_normalisasi = [];
    var $m_keputusan = [];
    var $k_positif = [];
    var $k_negatif = [];
    var $d_value =[];
    var $sum_d = [];
    var $sqrt_d = [];
    var $d_value_n =[];
    var $sum_d_n = [];
    var $sqrt_d_n = [];
    var $preferensi = [];
    private function setVariable($flag)
    {
        $data = $this->db->query("SELECT nama,passing,servis,block,smash,receive,kekuatan,
          kelincahan,daya_lentur,daya_ledak_otot,daya_tahan,kecepatan FROM tb_nilai")->result_array();
        $this->matriks = (!empty($data)) ? $data : [];
        $target = $this->db->query("SELECT passing,servis,block,smash,receive,kekuatan,
          kelincahan,daya_lentur,daya_ledak_otot,daya_tahan,kecepatan FROM ms_target WHERE flag_untuk=$flag")->row_array();
        $this->target = (!empty($target)) ? $target : [];
        // print_r($this->target);
    }
    private function kuadrat()
    {
        for ($i=0; $i < count($this->matriks); $i++) {
          foreach ($this->matriks[$i] as $key => $value) {
            if ($key == 'nama') {
              $hasil[$key] = $value;
            } else {
              $hasil[$key] = pow($value,2);
            }
          }
          $this->h_kuadrat[] = $hasil;
        }
        echo "Langkah 0<br><br>";
        print_r($this->h_kuadrat);
    }
    private function akarKuadrat()
    {
        $arr_name = [];
        foreach ($this->h_kuadrat[0] as $key => $value) {
          if ($key == 'nama') {
            continue;
          } else {
            $arr_name[] = $key;
          }
        }
        for ($j=0; $j < count($arr_name); $j++) {
          $tot = 0;
          for ($i=0; $i < count($this->h_kuadrat); $i++) {
            $tot += $this->h_kuadrat[$i][$arr_name[$j]];
          }
          $this->jum_kuadrat[$arr_name[$j]] = $tot;
          $this->a_kuadrat[$arr_name[$j]] = sqrt($tot);
        }
        echo "Langkah 1<br><br>";
        print_r($this->jum_kuadrat);
        print_r($this->a_kuadrat);
    }
    private function normalisasi()
    {
      for ($i=0; $i < count($this->matriks); $i++) {
        foreach ($this->matriks[$i] as $key => $value) {
          if ($key == 'nama') {
            $hasil[$key] = $value;
          } else {
            $hasil[$key] = $value/$this->a_kuadrat[$key];
          }
        }
        $this->h_normalisasi[] = $hasil;
      }
      echo "Langkah 2<br><br>";
      print_r($this->h_normalisasi);
    }
    private function keputusan()
    {
      for ($i=0; $i < count($this->h_normalisasi); $i++) {
        foreach ($this->h_normalisasi[$i] as $key => $value) {
          if ($key == 'nama') {
            $hasil[$key] = $value;
          } else {
            $hasil[$key] = $value*$this->target[$key];
          }
        }
        $this->m_keputusan[] = $hasil;
      }
      echo "Langkah 3<br><br>";
      print_r($this->m_keputusan);
    }
    private function solusiIdealPlusMinus()
    {
        $arr_name = [];
        foreach ($this->m_keputusan[0] as $key => $value) {
          if ($key == 'nama') {
            continue;
          } else {
            $arr_name[] = $key;
          }
        }
        for ($j=0; $j < count($arr_name); $j++) {
          $tot = 0;
          $arr = [];
          for ($i=0; $i < count($this->m_keputusan); $i++) {
            $arr[] = $this->m_keputusan[$i][$arr_name[$j]];
          }
          $this->k_positif[$arr_name[$j]] = max($arr);
          $this->k_negatif[$arr_name[$j]] = min($arr);
        }
        echo "Langkah 4<br><br>";
        print_r($this->k_positif);
        print_r($this->k_negatif);
    }
    private function hitungDValue()
    {
      for ($i=0; $i < count($this->m_keputusan); $i++) {
        $arr = [];
        foreach ($this->m_keputusan[$i] as $key => $value) {
          if ($key == 'nama') {
            $arr[$key] = $value;
          } else {
            $hasil = $this->k_positif[$key] - $value;
            $arr[$key] = pow($hasil,2);
          }
        }
        $this->d_value[] = $arr;
      }
      echo "Langkah 5<br><br>";
      print_r($this->d_value);
    }
    private function hitungDValueNegatif()
    {
      for ($i=0; $i < count($this->m_keputusan); $i++) {
        $arr = [];
        foreach ($this->m_keputusan[$i] as $key => $value) {
          if ($key == 'nama') {
            $arr[$key] = $value;
          } else {
            $hasil = $this->k_negatif[$key] - $value;
            $arr[$key] = pow($hasil,2);
          }
        }
        $this->d_value_n[] = $arr;
      }
      echo "Langkah 6<br><br>";
      print_r($this->d_value_n);
    }
    private function sumSqrtD()
    {
      $arr = [];
      $array = [];
      for ($i=0; $i < count($this->d_value); $i++) {
        $hasil = 0;
        foreach ($this->d_value[$i] as $key => $value) {
          if ($key == 'nama') {
            continue;
          } else {
            $hasil += $value;
          }
        }
        $arr[] = $hasil;
        $array[] = sqrt($hasil);
      }
      $this->sum_d = $arr;
      $this->sqrt_d = $array;
      echo "Langkah 7<br><br>";
      print_r($this->sum_d);
      print_r($this->sqrt_d);
    }
    private function sumSqrtDNegatif()
    {
      $arr = [];
      $array = [];
      for ($i=0; $i < count($this->d_value_n); $i++) {
        $hasil = 0;
        foreach ($this->d_value_n[$i] as $key => $value) {
          if ($key == 'nama') {
            continue;
          } else {
            $hasil += $value;
          }
        }
        $arr[] = $hasil;
        $array[] = sqrt($hasil);
      }
      $this->sum_d_n = $arr;
      $this->sqrt_d_n = $array;
      echo "Langkah 8<br><br>";
      print_r($this->sum_d_n);
      print_r($this->sqrt_d_n);
    }
    public function hitungPrefrensi()
    {
        for ($i=0; $i < count($this->sqrt_d_n); $i++) {
          $this->preferensi[] = $this->sqrt_d_n[$i] / ($this->sqrt_d_n[$i]+$this->sqrt_d[$i]);
        }
        echo "Langkah 9<br><br>";
        print_r($this->preferensi);
    }


    private function call($flag)
    {
      // NOTE: untuk memberikan nilai baru variabel global
      $this->setVariable($flag);
      // NOTE: untuk logika
      $this->kuadrat();
      $this->akarKuadrat();
      $this->normalisasi();
      $this->keputusan();
      $this->solusiIdealPlusMinus();
      $this->hitungDValue();
      $this->sumSqrtD();
      $this->hitungDValueNegatif();
      $this->sumSqrtDNegatif();
      $this->hitungPrefrensi();
      // for ($i=0; $i < count($this->preferensi); $i++) {
      //   $this->db->insert('tb_prefrensi',['hasil_pref'=>$this->preferensi[$i],'flag_untuk'=>$flag]);
      // }
    }
    public function createTableMatriks()
    {
        // $this->call();
        $table = "";
        $table .= "<h3>Langkah 1 : Tabel Matriks</h3>";
        $table .= "<table class='table table-stripped table-hover datatable'>";
        $table .= "<thead>";
        foreach ($this->matriks[0] as $key => $value) {
          $table .= "<td>".$key."</td>";
        }
        $table .= "</thead>";
        $table .= "<tbody>";
        for ($i=0; $i < count($this->matriks); $i++) {
          $table .= "<tr>";
          foreach ($this->matriks[$i] as $key => $value) {
            $table .= "<td>".$value."</td>";
          }
          $table .= "</tr>";
        }
        $table .= "</tbody>";
        $table .= "</table>";
        echo $table;
    }
    private function createTableKuadrat()
    {
        $table = "";
        $table .= "<h3>Langkah 2 : Tabel Matriks Kuadrat</h3>";
        $table .= "<table border='1px black'>";
        $table .= "<thead>";
        foreach ($this->h_kuadrat[0] as $key => $value) {
          $table .= "<td>".$key."</td>";
        }
        $table .= "</thead>";
        $table .= "<tbody>";
        for ($i=0; $i < count($this->h_kuadrat); $i++) {
          $table .= "<tr>";
          foreach ($this->h_kuadrat[$i] as $key => $value) {
            $table .= "<td>".$value."</td>";
          }
          $table .= "</tr>";
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "=============================================";
        echo $table;
    }
    private function createTableAkar()
    {
        $table = "";
        $table .= "<h3>Langkah 3 : Tabel Akar Kuadrat Total</h3>";
        $table .= "<table border='1px black'>";
        $table .= "<thead>";
        $table .= "<td>Faktor</td>";
        $table .= "<td>Total</td>";
        $table .= "<td>Akar</td>";
        $table .= "</thead>";
        foreach ($this->jum_kuadrat as $key => $value) {
          $table .= "<tr>";
          $table .= "<td>".$key."</td>";
          $table .= "<td>".$value."</td>";
          $table .= "<td>".sqrt($value)."</td>";
          $table .= "</tr>";
        }
        $table .= "</table>";
        $table .= "=============================================";
        echo $table;
    }
    private function createTableNormalisasi()
    {
        $table = "";
        $table .= "<h3>Langkah 4 : Tabel Hasil Normalisasi</h3>";
        $table .= "<table border='1px black'>";
        $table .= "<thead>";
        foreach ($this->h_normalisasi[0] as $key => $value) {
          $table .= "<td>".$key."</td>";
        }
        $table .= "</thead>";
        $table .= "<tbody>";
        for ($i=0; $i < count($this->h_kuadrat); $i++) {
          $table .= "<tr>";
          foreach ($this->h_normalisasi[$i] as $key => $value) {
            $table .= "<td>".$value."</td>";
          }
          $table .= "</tr>";
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "=============================================";
        echo $table;
    }
    private function createTableKeputusan()
    {
        $table = "";
        $table .= "<h3>Langkah 5 : Tabel Hasil Keputusan</h3>";
        $table .= "<table border='1px black'>";
        $table .= "<thead>";
        foreach ($this->m_keputusan[0] as $key => $value) {
          $table .= "<td>".$key."</td>";
        }
        $table .= "</thead>";
        $table .= "<tbody>";
        for ($i=0; $i < count($this->m_keputusan); $i++) {
          $table .= "<tr>";
          foreach ($this->m_keputusan[$i] as $key => $value) {
            $table .= "<td>".$value."</td>";
          }
          $table .= "</tr>";
        }
        $table .= "</tbody>";
        $table .= "</table>";
        $table .= "=============================================";
        echo $table;
    }
    private function createTableSolusiIdeal()
    {
        $table = "";
        $table .= "<h3>Langkah 6 : Tabel Hasil Solusi Ideal Positif Negatif</h3>";
        $table .= "<table border='1px black'>";
        $table .= "<thead>";
        $table .= "<td>nama</td>";
        foreach ($this->k_positif as $key => $value) {
          $table .= "<td>".$key."</td>";
        }
        $table .= "</thead>";
        $table .= "<tbody>";
        $table .= "<tr><td>Y+</td>";
        foreach ($this->k_positif as $key => $value) {
          $table .= "<td>".$value."</td>";
        }
        $table .= "</tr><tr><td>Y-</td>";
        foreach ($this->k_negatif as $key => $value) {
          $table .= "<td>".$value."</td>";
        }
        $table .= "</tr></tbody></table>";
        $table .= "=============================================";
        echo $table;
    }


    public function main($flag='')
    {
        if (empty($flag)) {
          http_response_code(500);
          exit;
        }
        $this->call($flag);
        // NOTE: untuk menampilkan data
        // $this->createTableMatriks();
        // $this->createTableKuadrat();
        // $this->createTableAkar();
        // $this->createTableNormalisasi();
        // $this->createTableKeputusan();
        // $this->createTableSolusiIdeal();
        // var_dump($this->h_kuadrat);
    }

}
