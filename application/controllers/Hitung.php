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
        // print_r($this->matriks);
    }
    private function kuadrat()
    {
        // echo "Langkah 1 kuadrat";
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
        // echo "<br>";
        // echo "Langkah 1 kuadrat";
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
      // echo "<br>";
      // echo "Langkah 2 normalisasi";
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
      // echo "<br>";
      // echo "Langkah 3 matriks keputusan";
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
        // echo "<br>";
        // echo "Langkah 4 Solusi ideal";
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
        // echo "<br>";
        // echo "Positif";
        // print_r($this->k_positif);
        // echo "<br>";
        // echo "Negatif";
        // print_r($this->k_negatif);
    }
    private function hitungDValue()
    {
      // echo "<br>";
      // echo "Langkah 5 Jarak antara D+";
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
      // echo "Langkah 5 Jarak antara D-";
      for ($i=0; $i < count($this->m_keputusan); $i++) {
        $arr = [];
        foreach ($this->m_keputusan[$i] as $key => $value) {
          if ($key == 'nama') {
            $arr[$key] = $value;
          }  elseif ($key == 'id') {
            $arr[$key] = $value;
          } else {
            $hasil = $value - $this->k_negatif[$key];
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
      // echo "<br>";
      // echo "Sum dan sqrt D+ ";
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
      // echo "<br>";
      // echo "Sum dan sqrt D- ";
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
        // echo "<br>";
        // echo "Hasil preferensi";
        for ($i=0; $i < count($this->sqrt_d_n); $i++) {
          $this->preferensi[] = $this->sqrt_d_n[$i] / ($this->sqrt_d_n[$i]+$this->sqrt_d[$i]);
        }
        // echo "Langkah 9<br><br>";
        // print_r($this->preferensi);

        #######note
        // fungsi untuk menyimpan hasil preferensi ke database
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
      // Langkah membuat kuadrat
      $this->kuadrat();
      // Langkah membuat akar kuadrat
      $this->akarKuadrat();
      // membuat normalisasi
      $this->normalisasi();
      // hasil keputusan
      $this->keputusan();
      // menghitung solusi idean positif dan negatif
      $this->solusiIdealPlusMinus();
      // menghitung jarak antara positif
      $this->hitungDValue();
      // menghitung hasil penjumlahan jarak antara
      $this->sumSqrtD();
      // menghitung jarak antara negatif
      $this->hitungDValueNegatif();
      // menghitung hasil penjumlahan jarak antara
      $this->sumSqrtDNegatif();
      // hasil preferensi
      $this->hitungPrefrensi();

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
                $onclick = "onclick='detail($id,\"update\")'";
              } else {
                $width = '35px';
                $class = 'penilaian';
                $onclick = "";
              }
              $table .= "<td><input $onclick required class='form-control $class' style='height: 27px;width:$width' name='penilaian[$i][$key]' value='$value'</td>";
            }
          }
          $table .= "<td><button type='button' onclick='hapus($id)' class='btn btn-xs btn-danger'>Hapus</button></td>";
          $table .= "</tr>";
        }
        $table .= "</tbody>";
        $table .= "</table>";
        return $table;
    }
       private function createTablePreferensi()
    {
        $pref = $this->db->query("SELECT n.id, nama, hasil_pref FROM tb_prefrensi p
          JOIN tb_nilai n ON p.id_nilai = n.id
          WHERE p.flag_untuk = $this->flag_untuk
          ORDER BY hasil_pref DESC")->result();
        $table = "<h4>Tabel Preferensi dan Hasil Perankingan</h4>";
        $table .= "<table class='table table-stripped table-hover'>";
        $table .= "<thead><th>Ranking</th><th>Nama</th><th>Preferensi</th><th>###</th>";
        $table .= "<tbody>";
        $i = 1;
        foreach ($pref as $v) {
          $table .= "<tr>";
          $table .= "<td>".$i++."</td>";
          $table .= "<td>".$v->nama."</td>";
          $table .= "<td>".$v->hasil_pref."</td>";
          $table .= "<td><button onclick='detail(".$v->id.",\"detail\")' class='btn btn-sm btn-default'>Detail</button></td>";
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
        ##### NOTE :
        // menampilkan table matrik dengan data nama pemain dan nilainya
        $this->table_besar['penilaian'] = $this->createTableMatriks();
       // menampilkan table hasil preferensi per spesialisasi
        $this->table_besar['prefrensi'] = $this->createTablePreferensi();

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

    // prototype player auto formation
    // NOTE: this function was made as posible as well, it will run not very well
    public function ambil_formasi()
    {
        $this->simpan_nilai_formasi_pertama();
        $this->simpan_nilai_formasi_kedua();
        $this->simpan_nilai_formasi_ketiga();

        $get = $this->db->query("SELECT p.id ,nama_spesialis,nama,tinggi_bdn,berat_bdn FROM tb_formasi f
        JOIN tb_nilai n ON f.id_nilai = n.id JOIN tb_pengukuran p ON f.flag_untuk = p.id")->result_array();

        echo json_encode($get);
    }

    private function get_tertinggi($arr,$index = 0)
    {
        $id_nilai = $arr[$index]['id_nilai'];
        $ret_arr = [];
        for ($i=0; $i < count($arr); $i++) {
          $get = [];
          if ($id_nilai == $arr[$i]['id_nilai']) {
            $get['id'] = $arr[$i]['id'];
            $get['hasil_pref'] = $arr[$i]['hasil_pref'];
            $get['id_nilai'] = $arr[$i]['id_nilai'];
          } else {
            continue;
          }
          $ret_arr[] = $get;
        }
        // print_r($ret_arr);
        $max = 0;
        $arr_max = [];
        for ($j=0; $j < count($ret_arr); $j++) {
          if ($ret_arr[$j]['hasil_pref'] > $max) {
            $max = $ret_arr[$j]['hasil_pref'];
            $arr_max = $ret_arr[$j];
          }
        }
        return $arr_max;
    }

    private function simpan_nilai_tertinggi($arr)
    {
        // if ($arr['id'] == 2) {
        //   // $cek = $this->db->query("SELECT COUNT(*) AS jum FROM tb_formasi WHERE flag_untuk = 2")->result();
        //   // if ($cek < 2) {
        //   //   $id = $arr['id_nilai'];
        //   //   $cek = $this->db->query("SELECT id_nilai AS jum FROM tb_formasi WHERE id_nilai = $id")->result();
        //   //   if ($cek->id_nilai == $id) {
        //   //     $this->db->where(['id_nilai' => $id, 'flag_untuk' => $arr['id']]);
        //   //     // $this->db->update('tb_formasi',['id_nilai'=>$])
        //   //   }
        //   // }
        // } else {
        //   $flag_untuk = $arr['flag_untuk'];
        //   $cek = $this->db->query("SELECT COUNT(*) AS jum FROM tb_formasi WHERE flag_untuk = $flag_untuk")->result();
        //   if ($cek->jum < 1) {
        //     $this->db->insert('tb_formasi',['id_nilai'=>$arr['id_nilai'],'flag_untuk'=>$arr['id']]);
        //   }
        // }
        // menyimpan semua yang tertinggi
        $flag_untuk = $arr['id'];
        $id_nilai = $arr['id_nilai'];
        $cek = $this->db->query("SELECT COUNT(*) AS jum FROM tb_formasi WHERE id_nilai = $id_nilai")->result();
        // print_r($cek);
        if ($cek[0]->jum < 1) {
          $this->db->insert('tb_formasi',['id_nilai'=>$arr['id_nilai'],'flag_untuk'=>$arr['id']]);
        }
    }

    // NOTE: fungsi utama
    private function simpan_nilai_formasi_pertama()
    {
        $query = "SELECT * FROM tb_pengukuran peng JOIN (
        	SELECT p.id AS id_pref, hasil_pref,id_nilai, nama, p.flag_untuk FROM tb_prefrensi p
        	JOIN tb_nilai n ON p.id_nilai = n.id WHERE
        	hasil_pref = (SELECT MAX(hasil_pref) FROM tb_prefrensi ps WHERE ps.flag_untuk = p.flag_untuk)
        ) pn ON peng.id = pn.flag_untuk";
        $rows = $this->db->query($query)->result_array();
        $arr = [];
        for ($i=0; $i < count($rows); $i++) {
          $arr[] = $this->get_tertinggi($rows,$i);
        }
        // print_r($arr);
        // menghapus semua isi table tb_formasi
        $this->db->query("DELETE FROM tb_formasi");
        // menyimpan hasil_pref terbesar satu persatu
        for ($j=0; $j < count($arr); $j++) {
          $this->simpan_nilai_tertinggi($arr[$j]);
        }
        // menyimpan untuk hasil_pref terbesar kedua
        // $this->simpan_nilai_kedua();
    }

    private function simpan_nilai_formasi_kedua()
    {
        // $cek = $this->db->query("
        //   SELECT id FROM tb_pengukuran WHERE id NOT IN (SELECT flag_untuk AS id FROM tb_formasi)
        // ")->result();
        // foreach ($cek as $v) {
        //   $get = null;
        //   if ($v->id == 2) {
        //     $query = "SELECT flag_untuk, id_nilai FROM tb_prefrensi WHERE flag_untuk = 2 ORDER BY hasil_pref DESC LIMIT 2";
        //     $get = $this->db->query($query)->result();
        //   } else {
        //     $id = $v->id;
        //     $query = "SELECT flag_untuk, id_nilai FROM tb_prefrensi WHERE flag_untuk = $id ORDER BY hasil_pref DESC LIMIT 1,1";
        //     $get = $this->db->query($query)->result();
        //   }
        //   foreach ($get as $val) {
        //     $this->db->insert('tb_formasi',['id_nilai'=>$val->id_nilai,'flag_untuk'=>$val->flag_untuk]);
        //   }
        // }
        // $query = "SELECT id,flag_untuk, id_nilai FROM tb_prefrensi WHERE flag_untuk = $id ORDER BY hasil_pref DESC LIMIT 1,1";
        $query = "SELECT * FROM tb_pengukuran peng JOIN (
        	SELECT p.id AS id_pref, hasil_pref,id_nilai, nama, p.flag_untuk FROM tb_prefrensi p
        	JOIN tb_nilai n ON p.id_nilai = n.id WHERE
        	hasil_pref = (SELECT hasil_pref FROM tb_prefrensi ps WHERE ps.flag_untuk = p.flag_untuk
            ORDER BY hasil_pref DESC LIMIT 1,1)
        ) pn ON peng.id = pn.flag_untuk WHERE peng.id NOT IN (SELECT flag_untuk AS id FROM tb_formasi)";
        // $query = "SELECT id FROM tb_pengukuran WHERE id NOT IN (SELECT flag_untuk AS id FROM tb_formasi)"
        $rows = $this->db->query($query)->result_array();
        $arr = [];
        for ($i=0; $i < count($rows); $i++) {
          $arr[] = $this->get_tertinggi($rows,$i);
        }
        // print_r($arr);
        for ($j=0; $j < count($arr); $j++) {
          $this->simpan_nilai_tertinggi($arr[$j]);
        }
    }

    private function simpan_nilai_formasi_ketiga()
    {
        $cek_if_wing_not_exists = $this->db->query("SELECT COUNT(*) AS jum FROM tb_formasi WHERE flag_untuk = 2")->result();
        $query = "SELECT id_nilai, flag_untuk, hasil_pref FROM tb_prefrensi WHERE
        id_nilai NOT IN (SELECT id_nilai FROM tb_formasi)
        AND flag_untuk NOT IN (SELECT flag_untuk FROM tb_formasi)
        ORDER BY hasil_pref DESC LIMIT 2";
        $arr = $this->db->query($query)->result_array();
        if (count($arr)==0) {
          if ($cek_if_wing_not_exists[0]->jum==1) {
            $ambil = $this->db->query("SELECT id_nilai, flag_untuk, hasil_pref
            FROM tb_prefrensi WHERE
            id_nilai NOT IN (SELECT id_nilai FROM tb_formasi)
            AND flag_untuk = 2
            ORDER BY hasil_pref DESC LIMIT 1,1")->row();
            $this->db->insert('tb_formasi',['id_nilai'=>$ambil->id_nilai,'flag_untuk'=>$ambil->flag_untuk]);
          }
        } else {
          if ($arr[0]['flag_untuk'] == 2) {
            if ($cek_if_wing_not_exists[0]->jum == 0) {
              for ($i=0; $i < count($arr); $i++) {
                $this->db->insert('tb_formasi',['id_nilai'=>$arr[$i]['id_nilai'],'flag_untuk'=>$arr[$i]['flag_untuk']]);
              }
            }
          } else {
            $this->db->insert('tb_formasi',['id_nilai'=>$arr[0]['id_nilai'],'flag_untuk'=>$arr[0]['flag_untuk']]);
          }
        }
    }

}
