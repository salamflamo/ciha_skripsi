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
        $this->load->model('Auth_model');
    }

    private $target = [
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

    private $matriks = [
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

    private $h_kuadrat = [];
    private $jum_kuadrat = [];
    private $a_kuadrat = [];
    private $h_normalisasi = [];
    private $m_keputusan = [];
    private $k_positif = [];
    private $k_negatif = [];
    private $d_value =[];
    private $sum_d = [];
    private $sqrt_d = [];
    private $d_value_n =[];
    private $sum_d_n = [];
    private $sqrt_d_n = [];
    private $preferensi = [];

    private $table_besar = [];
    private $flag_untuk = null;

    private function setVariable($flag)
    {
        $this->matriks = [];
        $this->target = [];
        $this->flag_untuk = $flag;
        $data = $this->db->query("SELECT id,nama,passing,servis,block,smash,receive,kekuatan,
          kelincahan,daya_lentur,daya_ledak_otot,daya_tahan,kecepatan FROM tb_nilai ")->result_array();
        $this->matriks = (!empty($data)) ? $data : [];
        $target = $this->db->query("SELECT id,passing,servis,block,smash,receive,kekuatan,
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
            } elseif ($key == 'id') {
              $hasil[$key] = $value;
            } else {
              $hasil[$key] = pow($value,2);
            }
          }
          $this->h_kuadrat[] = $hasil;
        }
        // echo "Langkah 0<br><br>";
        // print_r($this->h_kuadrat);
    }
    private function akarKuadrat()
    {
        $arr_name = [];
        foreach ($this->h_kuadrat[0] as $key => $value) {
          if ($key == 'nama') {
            continue;
          } elseif ($key == 'id') {
            $hasil[$key] = $value;
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
        // echo "Langkah 1<br><br>";
        // print_r($this->jum_kuadrat);
        // print_r($this->a_kuadrat);
    }
    private function normalisasi()
    {
      for ($i=0; $i < count($this->matriks); $i++) {
        foreach ($this->matriks[$i] as $key => $value) {
          if ($key == 'nama') {
            $hasil[$key] = $value;
          } elseif ($key == 'id') {
            $hasil[$key] = $value;
          } else {
            $hasil[$key] = $value/$this->a_kuadrat[$key];
          }
        }
        $this->h_normalisasi[] = $hasil;
      }
      // echo "Langkah 2<br><br>";
      // print_r($this->h_normalisasi);
    }
    private function keputusan()
    {
      for ($i=0; $i < count($this->h_normalisasi); $i++) {
        foreach ($this->h_normalisasi[$i] as $key => $value) {
          if ($key == 'nama') {
            $hasil[$key] = $value;
          } elseif ($key == 'id') {
            $hasil[$key] = $value;
          } else {
            $hasil[$key] = $value*$this->target[$key];
          }
        }
        $this->m_keputusan[] = $hasil;
      }
      // echo "Langkah 3<br><br>";
      // print_r($this->m_keputusan);
    }
    private function solusiIdealPlusMinus()
    {
        $arr_name = [];
        foreach ($this->m_keputusan[0] as $key => $value) {
          if ($key == 'nama') {
            continue;
          }  elseif ($key == 'id') {
            $hasil[$key] = $value;
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
        // echo "Langkah 4<br><br>";
        // print_r($this->k_positif);
        // print_r($this->k_negatif);
    }
    private function hitungDValue()
    {
      for ($i=0; $i < count($this->m_keputusan); $i++) {
        $arr = [];
        foreach ($this->m_keputusan[$i] as $key => $value) {
          if ($key == 'nama') {
            $arr[$key] = $value;
          }  elseif ($key == 'id') {
            $arr[$key] = $value;
          } else {
            $hasil = $this->k_positif[$key] - $value;
            $arr[$key] = pow($hasil,2);
          }
        }
        $this->d_value[] = $arr;
      }
      // echo "Langkah 5<br><br>";
      // print_r($this->d_value);
    }
    private function hitungDValueNegatif()
    {
      for ($i=0; $i < count($this->m_keputusan); $i++) {
        $arr = [];
        foreach ($this->m_keputusan[$i] as $key => $value) {
          if ($key == 'nama') {
            $arr[$key] = $value;
          }  elseif ($key == 'id') {
            $arr[$key] = $value;
          } else {
            $hasil = $this->k_negatif[$key] - $value;
            $arr[$key] = pow($hasil,2);
          }
        }
        $this->d_value_n[] = $arr;
      }
      // echo "Langkah 6<br><br>";
      // print_r($this->d_value_n);
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
          }  elseif ($key == 'id') {
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
      // echo "Langkah 7<br><br>";
      // print_r($this->sum_d);
      // print_r($this->sqrt_d);
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
          } elseif ($key == 'id') {
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
      // echo "Langkah 8<br><br>";
      // print_r($this->sum_d_n);
      // print_r($this->sqrt_d_n);
    }
    private function hitungPrefrensi()
    {
        for ($i=0; $i < count($this->sqrt_d_n); $i++) {
          $this->preferensi[] = $this->sqrt_d_n[$i] / ($this->sqrt_d_n[$i]+$this->sqrt_d[$i]);
        }
        // echo "Langkah 9<br><br>";
        // print_r($this->preferensi);
        $this->simpanPrefrensi();
    }
    private function simpanPrefrensi()
    {
      for ($i=0; $i < count($this->d_value); $i++) {
        $this->simpan($this->preferensi[$i],$this->d_value[$i]['id']);
      }
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
    private function createTableMatriks()
    {
        // $this->call();
        $table = "<h4>Tabel Penilaian</h4>";
        $table .= "<table class='table table-stripped table-hover'>";
        $table .= "<thead>";
        foreach ($this->matriks[0] as $key => $value) {
          if ($key=='id') {
            continue;
          }
          $table .= "<th>".$key."</th>";
        }
        $table .= "<th>##</th>";
        $table .= "</thead>";
        $table .= "<tbody>";
        for ($i=0; $i < count($this->matriks); $i++) {
          $table .= "<tr>";
          $id = null;
          foreach ($this->matriks[$i] as $key => $value) {
            if ($key=='id') {
              $id = $value;
            } else {
              if ($key=='nama') {
                $width = '120px';
                $class = '';
              } else {
                $width = '35px';
                $class = 'penilaian';
              }
              $table .= "<td><input required class='form-control $class' style='height: 27px;width:$width' name='penilaian[$i][$key]' value='$value'</td>";
            }
          }
          $table .= "<td><button type='button' onclick='hapus($id)' class='btn btn-xs btn-danger'>Hapus</button></td>";
          $table .= "</tr>";
        }
        $table .= "</tbody>";
        $table .= "</table>";
        return $table;
    }
    // NOTE: ini sudah tidak dipakai, jika dipakai hilangkan saja tanda comment
    /*
    private function createTableKuadrat()
    {
        $table = "<h3>Langkah 2</h3>";
        $table .= "<table class='table table-stripped table-hover'>";
        $table .= "<thead>";
        foreach ($this->h_kuadrat[0] as $key => $value) {
          if ($key=='id') {
            continue;
          }
          $table .= "<td>".$key."</td>";
        }
        $table .= "</thead>";
        $table .= "<tbody>";
        for ($i=0; $i < count($this->h_kuadrat); $i++) {
          $table .= "<tr>";
          foreach ($this->h_kuadrat[$i] as $key => $value) {
            if ($key=='id') {
              continue;
            }
            $table .= "<td>".$value."</td>";
          }
          $table .= "</tr>";
        }
        $table .= "</tbody>";
        $table .= "</table>";
        return $table;
    }
    private function createTableAkar()
    {
        $table = "";
        $table = "<h3>Langkah 3</h3>";
        $table .= "<table class='table table-stripped table-hover'>";
        $table .= "<thead>";
        $table .= "<td>Faktor</td>";
        $table .= "<td>Total</td>";
        $table .= "<td>Akar</td>";
        $table .= "</thead>";
        foreach ($this->jum_kuadrat as $key => $value) {
          if ($key=='id') {
            continue;
          }
          $table .= "<tr>";
          $table .= "<td>".$key."</td>";
          $table .= "<td>".$value."</td>";
          $table .= "<td>".sqrt($value)."</td>";
          $table .= "</tr>";
        }
        $table .= "</table>";
        return $table;
    }
    private function createTableNormalisasi()
    {
        $table = "";
        $table = "<h3>Langkah 4</h3>";
        $table .= "<table class='table table-stripped table-hover'>";
        $table .= "<thead>";
        foreach ($this->h_normalisasi[0] as $key => $value) {
          if ($key=='id') {
            continue;
          }
          $table .= "<td>".$key."</td>";
        }
        $table .= "</thead>";
        $table .= "<tbody>";
        for ($i=0; $i < count($this->h_kuadrat); $i++) {
          $table .= "<tr>";
          foreach ($this->h_normalisasi[$i] as $key => $value) {
            if ($key=='id') {
              continue;
            }
            $table .= "<td>".$value."</td>";
          }
          $table .= "</tr>";
        }
        $table .= "</tbody>";
        $table .= "</table>";
        return $table;
    }
    private function createTableKeputusan()
    {
        $table = "";
        $table = "<h3>Langkah 5</h3>";
        $table .= "<table class='table table-stripped table-hover'>";
        $table .= "<thead>";
        foreach ($this->m_keputusan[0] as $key => $value) {
          if ($key=='id') {
            continue;
          }
          $table .= "<td>".$key."</td>";
        }
        $table .= "</thead>";
        $table .= "<tbody>";
        for ($i=0; $i < count($this->m_keputusan); $i++) {
          $table .= "<tr>";
          foreach ($this->m_keputusan[$i] as $key => $value) {
            if ($key=='id') {
              continue;
            }
            $table .= "<td>".$value."</td>";
          }
          $table .= "</tr>";
        }
        $table .= "</tbody>";
        $table .= "</table>";
        return $table;
    }
    private function createTableSolusiIdeal()
    {
        $table = "";
        $table = "<h3>Langkah 6</h3>";
        $table .= "<table class='table table-stripped table-hover'>";
        $table .= "<thead>";
        $table .= "<td>nama</td>";
        foreach ($this->k_positif as $key => $value) {
          if ($key=='id') {
            continue;
          }
          $table .= "<td>".$key."</td>";
        }
        $table .= "</thead>";
        $table .= "<tbody>";
        $table .= "<tr><td>Y+</td>";
        foreach ($this->k_positif as $key => $value) {
          if ($key=='id') {
            continue;
          }
          $table .= "<td>".$value."</td>";
        }
        $table .= "</tr><tr><td>Y-</td>";
        foreach ($this->k_negatif as $key => $value) {
          if ($key=='id') {
            continue;
          }
          $table .= "<td>".$value."</td>";
        }
        $table .= "</tr></tbody></table>";
        return $table;
    }

    private function createTableDvalue()
    {

      $table = "<h3>Langkah 7</h3>";
      $table .= "<table class='table table-stripped table-hover'>";
      $table .= "<thead>";
      foreach ($this->d_value[0] as $key => $value) {
        if ($key=='id') {
          continue;
        }
        $table .= "<td>".$key."</td>";
      }
      $table .= "<td>D</td>";
      $table .= "<td>Sum</td>";
      $table .= "</thead>";

      $table .= "<tbody>";
      for ($i=0; $i < count($this->d_value); $i++) {
        $table .= "<tr>";
        foreach ($this->d_value[$i] as $key => $value) {
          if ($key=='id') {
            continue;
          }
          $table .= "<td>".$value."</td>";
        }
        $table .= "<td>D+</td>";
        $table .= "<td>".$this->sum_d[$i]."</td>";
        $table .= "</tr>";
      }

      for ($i=0; $i < count($this->d_value_n); $i++) {
        $table .= "<tr>";
        foreach ($this->d_value_n[$i] as $key => $value) {
          if ($key=='id') {
            continue;
          }
          $table .= "<td>".$value."</td>";
        }
        $table .= "<td>D-</td>";
        $table .= "<td>".$this->sum_d_n[$i]."</td>";
        $table .= "</tr>";
      }
      $table .= "</tbody>";
      $table .= "</table>";;
        // print_r($this->d_value);
        // print_r($this->sum_d);
        // print_r($this->d_value_n);
        // print_r($this->sum_d_n);
        return $table;
    }
    */

    private function createTablePreferensi()
    {
        $pref = $this->db->query("SELECT nama, hasil_pref FROM tb_prefrensi p
          JOIN tb_nilai n ON p.id_nilai = n.id
          WHERE p.flag_untuk = $this->flag_untuk
          ORDER BY hasil_pref DESC")->result();
        $table = "<h4>Table Prefrensi</h4>";
        $table .= "<table class='table table-stripped table-hover'>";
        $table .= "<thead><th>Ranking</th><th>Nama</th><th>Prefrensi</th>";
        $table .= "<tbody>";
        $i = 1;
        foreach ($pref as $v) {
          $table .= "<tr>";
          $table .= "<td>".$i++."</td>";
          $table .= "<td>".$v->nama."</td>";
          $table .= "<td>".$v->hasil_pref."</td>";
          $table .= "</tr>";
        }
        $table .= "</tbody></table>";
        return $table;
    }


    public function main($flag='')
    {
        $this->Auth_model->is_login();
        if (empty($flag)) {
          http_response_code(500);
          exit;
        }
        $this->call($flag);
        // NOTE: untuk menampilkan data
        $this->table_besar['penilaian'] = $this->createTableMatriks();
        // $this->table_besar[] = $this->createTableKuadrat();
        // $this->table_besar[] = $this->createTableAkar();
        // $this->table_besar[] = $this->createTableNormalisasi();
        // $this->table_besar[] = $this->createTableKeputusan();
        // $this->table_besar[] = $this->createTableSolusiIdeal();
        // $this->table_besar[] = $this->createTableDvalue();
        $this->table_besar['prefrensi'] = $this->createTablePreferensi();
        // $this->createTablePreferensi();
        // var_dump($this->h_kuadrat);
        // echo json_encode($this->table_besar);
        // $table = "";
        // foreach ($this->table_besar as $key => $value) {
        //   $table .= $value;
        // }
        echo json_encode($this->table_besar);
    }

    private function simpan($n_pref='',$id_nilai='')
    {
        $this->db->where(['id_nilai'=>$id_nilai,'flag_untuk'=>$this->flag_untuk]);
        $cek = $this->db->get('tb_prefrensi')->row();
        if (empty($cek)) {
          $this->db->insert('tb_prefrensi',['hasil_pref'=>$n_pref,'flag_untuk'=>$this->flag_untuk,'id_nilai'=>$id_nilai]);
        } else {
          $this->db->where(['id_nilai'=>$id_nilai,'flag_untuk'=>$this->flag_untuk]);
          $this->db->update('tb_prefrensi',['hasil_pref'=>$n_pref]);
        }
    }

}
