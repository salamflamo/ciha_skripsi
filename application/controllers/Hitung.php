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
    }

    var $target = [
      'passing' => 4,
      'servis' => 5,
      'block' => 5,
      'smash' => 5,
      'receive' => 2,
      'kekuatan' => 4,
      'kelincahan' => 5,
      'daya_lentur' => 5,
      'daya_ledak_otot' => 5,
      'daya_tahan' => 4,
      'kecepatan' => 4,
    ];

    var $matriks = [
      [
        'nama' => 'Jonas',
        'passing' => 4,
        'servis' => 4,
        'block' => 4,
        'smash' => 5,
        'receive' => 3,
        'kekuatan' => 5,
        'kelincahan' => 4,
        'daya_lentur' => 4,
        'daya_ledak_otot' => 4,
        'daya_tahan' => 4,
        'kecepatan' => 4,
      ],
      [
        'nama' => 'Sofi',
        'passing' => 4,
        'servis' => 4,
        'block' => 4,
        'smash' => 5,
        'receive' => 4,
        'kekuatan' => 5,
        'kelincahan' => 4,
        'daya_lentur' => 5,
        'daya_ledak_otot' => 4,
        'daya_tahan' => 4,
        'kecepatan' => 4,
      ],
      [
        'nama' => 'Dino',
        'passing' => 4,
        'servis' => 4,
        'block' => 5,
        'smash' => 5,
        'receive' => 4,
        'kekuatan' => 4,
        'kelincahan' => 4,
        'daya_lentur' => 4,
        'daya_ledak_otot' => 4,
        'daya_tahan' => 4,
        'kecepatan' => 4,
      ],
      [
        'nama' => 'Hadi',
        'passing' => 4,
        'servis' => 4,
        'block' => 5,
        'smash' => 5,
        'receive' => 5,
        'kekuatan' => 4,
        'kelincahan' => 4,
        'daya_lentur' => 4,
        'daya_ledak_otot' => 4,
        'daya_tahan' => 4,
        'kecepatan' => 4,
      ],
    ];

    var $h_kuadrat = [];
    var $jum_kuadrat = [];
    var $a_kuadrat = [];
    var $h_normalisasi = [];
    var $m_keputusan = [];
    var $k_positif = [];
    var $k_negatif = [];
    var $j_alternatif = [];
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
    }
    private function alternatif()
    {
        $arr_name = [];
        foreach ($this->m_keputusan[0] as $key => $value) {
            $arr_name [] = $key;
        }
        for ($j=0; $j < count($arr_name); $j++) {
          $tot = 0;
          $arr = [];
          for ($i=0; $i < count($this->m_keputusan); $i++) {
            $arr[] = $this->m_keputusan[$i][$arr_name[$j]];
          }
        }
    }
    private function createTableMatriks()
    {
        $table = "";
        $table .= "<h3>Langkah 1 : Tabel Matriks</h3>";
        $table .= "<table border='1px black'>";
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
        $table .= "=============================================";
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

    public function main()
    {
        // NOTE: untuk logika
        $this->kuadrat();
        $this->akarKuadrat();
        $this->normalisasi();
        $this->keputusan();
        $this->solusiIdealPlusMinus();
        // NOTE: untuk menampilkan data
        $this->createTableMatriks();
        $this->createTableKuadrat();
        $this->createTableAkar();
        $this->createTableNormalisasi();
        $this->createTableKeputusan();
        $this->createTableSolusiIdeal();
        // var_dump($this->h_kuadrat);
    }

    public function anu($value='')
    {
      $object = new StdClass;
      $object->foo = 1;
      $object->bar = 2;
      var_dump((array)$object );
    }
}
