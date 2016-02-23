<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_basedeconhecimento extends CI_Model {
	function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
    	  $this->db2 = $this->load->database('oracle', TRUE);  
    }

   
   public function busca_base_com_tombo($termo = "", $equipamento = ""){
   		$sql = "SELECT * FROM(
       SELECT DISTINCT(c.id), l.nome, c.numero
      FROM
         chamados c,
         andamentos a,
         lotacao l,
         chamado_tombo ct,
         tombos t
      WHERE
         contains (a.texto,'$termo',1) > 0 AND   
         UPPER(t.descricao) like '%$equipamento%' AND
         c.lotacaodestino in(187, 192, 631, 632, 633, 634, 635, 636, 637, 638, 639, 640, 641, 642, 643, 644, 645, 646, 647, 1302, 904, 971, 898, 1308, 1309, 1317, 1319) AND
         ct.tombo = t.id AND
         c.lotacaosolicitante = l.id AND
         c.id = ct.chamado AND
         c.id = a.chamado   
     
      ORDER BY c.id DESC) WHERE ROWNUM <= 5";
   		$res = $this->db2->query($sql);
   		return $res->result_array();
   }

   public function busca_base_sem_tombo($termo = ""){
      $sql = "SELECT DISTINCT(c.id), l.nome, c.numero
      FROM
         chamados c,
         andamentos a,
         lotacao l
      WHERE
        contains (a.texto,'$termo',1) > 0  AND
         c.lotacaodestino in(187, 192, 631, 632, 633, 634, 635, 636, 637, 638, 639, 640, 641, 642, 643, 644, 645, 646, 647, 1302, 904, 971, 898, 1308, 1309, 1317, 1319) AND
         c.lotacaosolicitante = l.id AND 
         c.id = a.chamado       
        
      ORDER BY c.id DESC
     ";
      $res = $this->db2->query($sql);
      return $res->result_array();
   }

   public function busca_chamado($id = 0){
      $sql = "SELECT c.id, c.numero, to_char(a.dt_andamento,'YYYY') as ano, to_char(a.dt_andamento,'DD/MM/YYYY HH24:MM:SS') as dt_andamento from chamados c, andamentos a  where c.id = a.chamado and c.id = '$id' and a.classificacao='ABE'";
      $res = $this->db2->query($sql);
      return $res->row_array();
   }

   public function info_chamado($id = 0){
    $sql = " SELECT c.numero, to_char(a.dt_andamento,'YYYY') as ano, to_char(a.dt_andamento,'DD/MM/YYYY HH24:MM:SS') as dt_andamento,
       l.nome, to_char(a.texto) as texto
      FROM
         chamados c,
         andamentos a,
         lotacao l
      WHERE
         c.id = a.chamado AND 
         a.classificacao='ABE' AND
         c.lotacaosolicitante = l.id AND
         c.id = $id ";
      $res = $this->db2->query($sql);
      return $res->row_array();
   }

   public function tombos_chamado($id = 0){
      $sql = "SELECT t.NRO_TOMBO, t.serie, to_char(t.dt_garantia,'DD/MM/YYYY') as dt_garantia, t.descricao
                from chamados c, chamado_tombo ct, tombos t  where c.id = $id and c.id = ct.chamado and ct.tombo = t.id";
      $res = $this->db2->query($sql);
      return $res->result_array();
   }

   public function andamentos_chamado($id = 0){
      $sql = "SELECT to_char(a.dt_andamento,'DD/MM/YYYY HH24:MM:SS') as dt_andamento, a.classificacao, s.nome, to_char(a.texto) as texto
          from chamados c, andamentos a, portal p, servidores s
          where 
          c.id = $id and
          c.id = a.chamado and
          a.usuario = p.id and
          substr(p.codigo,1,length(p.codigo)-2) = s.codiserv  ORDER BY a.dt_andamento DESC";
      $res = $this->db2->query($sql);
      return $res->result_array(); 
   }

   public function busca_geral($termo = ""){
    $sql = "SELECT * FROM (SELECT distinct(c.id), l.nome, c.numero
      FROM
      chamados c,
      chamado_tombo ct,
      tombos t,
      lotacao l
      WHERE
            (
      ";

       if(is_numeric($termo))
        $sql .= " t.NRO_TOMBO = $termo OR ";

    

      $sql .=" upper(t.descricao) like upper('%$termo%') OR upper(t.serie) like upper('%$termo%'))
            
           AND
           c.lotacaodestino in(187, 192, 631, 632, 633, 634, 635, 636, 637, 638, 639, 640, 641, 642, 643, 644, 645, 646, 647, 1302, 904, 971, 898, 1308, 1309, 1317, 1319) AND
           c.id = ct.chamado AND
           ct.tombo = t.id AND
           c.lotacaosolicitante = l.id
          UNION ALL 
           -- Andamentos --
           
           SELECT 
        distinct(c.id),l.nome, c.numero
      FROM
      chamados c,
      andamentos a, 
      lotacao l
      WHERE
           CONTAINS(to_char(a.texto),'$termo',1) > 0  AND
           c.lotacaodestino in(187, 192, 631, 632, 633, 634, 635, 636, 637, 638, 639, 640, 641, 642, 643, 644, 645, 646, 647, 1302, 904, 971, 898, 1308, 1309, 1317, 1319) AND
           c.id = a.chamado AND
           c.lotacaosolicitante = l.id
           
           UNION ALL
            SELECT 
        distinct(c.id),l.nome, c.numero
      FROM
      chamados c,
      lotacao l
      WHERE
           (
            upper(l.nome) like upper('%$termo%') ";
            if(is_numeric($termo))

                $sql .= " OR c.numero = $termo ";

          $sql .= " ) AND
           c.lotacaodestino in(187, 192, 631, 632, 633, 634, 635, 636, 637, 638, 639, 640, 641, 642, 643, 644, 645, 646, 647, 1302, 904, 971, 898, 1308, 1309, 1317, 1319) AND
           c.lotacaosolicitante = l.id) ORDER BY id DESC";
      $res = $this->db2->query($sql);
      //echo $this->db2->last_query(); die();
      //var_dump($res); die();
      return $res->result_array();
   }
}
