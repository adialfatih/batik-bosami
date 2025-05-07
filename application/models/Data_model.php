<?php
class Data_model extends CI_Model{
 
  function delete($table,$key,$id){
    $this->db->where($key, $id);
    $this->db->delete($table);
  }
  function del_multi($table,$where){
    $this->db->where($where);
    $this->db->delete($table);
  }

  function saved($table, $datalist){
      //$this->db->insert($table,$datalist);
      if ($this->db->insert($table, $datalist)) {
        return true;
      } else {
          log_message('error', 'Insert failed: ' . $this->db->last_query());
          return false;
      }
  }

  public function get_harga_by_penjahit($kode_penjahit) {
    return $this->db->get_where('master_jahiten', ['kode_penjahit' => $kode_penjahit])->result();
  }
  function get_record($table){
     $result = $this->db->get($table);
     return $result;
  }
  
  function sort_record($key, $table){
     $this->db->order_by($key, 'DESC');
     $result = $this->db->get($table);
     return $result;
  }

  function get_view($table, $key, $limit){
    $this->db->limit($limit);
    $this->db->order_by($key, 'DESC');
    $result = $this->db->get($table);
    return $result;
  }
  
  function get_byid($table,$where){      
        return $this->db->get_where($table,$where);
  }

  function updatedata($key, $id, $table, $data){
    $this->db->where($key, $id);
    $this->db->update($table, $data);
  }

  function get_sum($field, $table){
    $this->db->select_sum($field);
    $result = $this->db->get($table);
    return $result;
  }
  function kosongke($table){
    $this->db->truncate($table);
  }
  
  function get_spesifik($key, $id, $sort,$table){
    $this->db->where($key, $id);
    $this->db->order_by($sort, 'DESC');
    $result = $this->db->get($table);
    return $result;
  }
  function get_jml($key){
    $this->db->where('jnslog', $key);
    $result = $this->db->get('log');
    return $result->num_rows();
  }
    
  function filter($data){
        $str_in = strip_tags(htmlspecialchars($data));
        $arrrays = array('~', "`", '!', '#', '$', '%', '^', '&', '*', '(', ')', '+', '=', '{', '[', ']', '}', '|', '\\', "'", '"', ':', ';', '<', '>', '?', "‘", '“',);
        $str = str_replace($arrrays, '', $str_in);
        return $str;
  }
  function clean($data){
        $str_in = strip_tags(htmlspecialchars($data));
        $arrrays = array('~', "`", '!', '#', '$', '%', '^', '&', '*', '(', ')', '-', '+', '=', '{', '[', ']', '}', '|', '\\', "'", '"', ':', ';', '<', ',', '>', '?', '/', "‘", '“', '.', '_', '@');
        $str = str_replace($arrrays, '', $str_in);
        return $str;
  }
//   function getTanggal($tgl){
//       $ex = explode(" ", $tgl);
//         $bln = array(
//           'Januari' => '01', 'January' => '01', 'Jan' => '01',
//           'Februari' => '02', 'February' => '02', 'Feb' => '02',
//           'Maret' => '03', 'March' => '03', 'Mar' => '03',
//           'April' => '04', 'Apr' => '04',
//           'Mei' => '05', 'May' => '05', 'May' => '05',
//           'Juni' => '06', 'June' => '06', 'Jun' => '06',
//           'Juli' => '07', 'July' => '07', 'Jul' => '07',
//           'Agustus' => '08', 'August' => '08', 'Aug' => '08',
//           'September' => '09', 'Sep' => '09',
//           'Oktober' => '10', 'October' => '10', 'Oct' => '10',
//           'Nopember' => '11', 'November' => '11', 'Nov' => '11',
//           'Desember' => '12', 'December' => '12', 'Dec' => '12'
//         );
//         $in_tgl = $ex[1]."/".$bln[$ex[2]]."/".$ex[3];
//         return $in_tgl;
//   }

//   function getDate($tgl){
//       $ex = explode(" ", $tgl);
//         $bln = array(
//           'Januari' => '01', 'January' => '01', 'Jan' => '01',
//           'Februari' => '02', 'February' => '02', 'Feb' => '02',
//           'Maret' => '03', 'March' => '03', 'Mar' => '03',
//           'April' => '04', 'Apr' => '04',
//           'Mei' => '05', 'May' => '05', 'May' => '05',
//           'Juni' => '06', 'June' => '06', 'Jun' => '06',
//           'Juli' => '07', 'July' => '07', 'Jul' => '07',
//           'Agustus' => '08', 'August' => '08', 'Aug' => '08',
//           'September' => '09', 'Sep' => '09',
//           'Oktober' => '10', 'October' => '10', 'Oct' => '10',
//           'Nopember' => '11', 'November' => '11', 'Nov' => '11',
//           'Desember' => '12', 'December' => '12', 'Dec' => '12'
//         );
//         $in_tgl = $ex[3]."-".$bln[$ex[2]]."-".$ex[1];
//         return $in_tgl;
//   }
  // function acakKode($jml){
  //       $karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
  //       $string = '';
  //           for ($i = 0; $i < $jml; $i++) {
  //               $pos = rand(0, strlen($karakter)-1);
  //               $string .= $karakter{$pos};
  //           }
  //       return $string;
  // }
  function acakKode($jml){
    return substr(str_shuffle(str_repeat($x='1234567890QWERTYUIOPLKJHGFDSAZXCVBNMqwertyuiopasdfghjklzxcvbnm', ceil($jml/strlen($x)) )),1,$jml);
  } //end
  
}
?>