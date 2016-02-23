<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_painel extends CI_Model {
	function __construct()
    {
        parent::__construct();
        $CI = &get_instance();
    	  $this->db2 = $this->load->database('oracle', TRUE);  
    }

   
  public function get_lotacao($username = ""){
      $sql = "SELECT l.id, l.nome as lotacao, s.nome as usuario FROM portal p, lotacao l, servidores s WHERE
           p.login = '$username' AND p.lotacao = l.id AND substr(p.codigo,1,length(p.codigo)-2) = s.codiserv";
      $res = $this->db2->query($sql);
      return $res->row_array();
   }

   public function get_todo($username = ""){
      $sql = "SELECT distinct(c.numero), c.id, to_char(a.dt_andamento,'YYYY') as ano, ls.nome, to_char(a.texto) as texto
                  from chamados c, andamentos a, portal ps, portal pd, lotacao ld, lotacao ls
                where c.lotacaosolicitante = ps.lotacao and c.lotacaodestino = pd.lotacao and
           pd.login = '$username' and a.classificacao = 'ABE' and a.chamado = c.id and c.responsavel is null 
           and pd.lotacao = ld.id and ps.lotacao = ls.id ORDER BY c.id ";
      $res = $this->db2->query($sql);
      return $res->result_array();
   }

   public function get_doing($secao = 0){
      $sql = "SELECT CH.ID, CH.NUMERO, CH.LOTACAODESTINO, to_char(an.dt_andamento,'YYYY') as ano, AST.DESCRICAO, to_char(AN.TEXTO) as texto, SV.NOME, CH.STATUS, LT.NOME, CH.LOTACAOSOLICITANTE  
      FROM CHAMADOS CH, ASSUNTOS AST, ANDAMENTOS AN, PORTAL PT, SERVIDORES SV, LOTACAO LT 
      WHERE 
        CH.ASSUNTO = AST.ID AND 
       LT.ID = CH.LOTACAOSOLICITANTE AND 
       CH.ID = AN.CHAMADO AND 
        AN.CLASSIFICACAO = 'ABE' AND 
        PT.ID(+) = CH.RESPONSAVEL AND 
        SV.CODISERV(+) = SUBSTR(PT.CODIGO, 1, LENGTH(PT.CODIGO) - 2) AND 
        CH.STATUS = 'AN' AND 
        CH.LOTACAODESTINO = $secao
      ORDER BY CH.ID, CH.LOTACAODESTINO, SV.NOME, AN.DT_ANDAMENTO ";

       $res = $this->db2->query($sql);
      return $res->result_array();

   }

   public function get_done($secao = 0){
      $sql = "SELECT CH.ID, CH.NUMERO, CH.LOTACAODESTINO, to_char(an.dt_andamento,'YYYY') as ano, AST.DESCRICAO, to_char(AN.TEXTO) as texto, SV.NOME, CH.STATUS, LT.NOME, CH.LOTACAOSOLICITANTE  
      FROM CHAMADOS CH, ASSUNTOS AST, ANDAMENTOS AN, PORTAL PT, SERVIDORES SV, LOTACAO LT 
      WHERE 
        CH.ASSUNTO = AST.ID AND 
       LT.ID = CH.LOTACAOSOLICITANTE AND 
       CH.ID = AN.CHAMADO AND 
        AN.CLASSIFICACAO = 'CON' AND 
        trunc(AN.DT_ANDAMENTO) = TRUNC(sysdate) and
        PT.ID(+) = CH.RESPONSAVEL AND 
        SV.CODISERV(+) = SUBSTR(PT.CODIGO, 1, LENGTH(PT.CODIGO) - 2) AND 
        CH.STATUS = 'CO' AND 
        CH.LOTACAODESTINO = $secao
      ORDER BY CH.ID, CH.LOTACAODESTINO, SV.NOME, AN.DT_ANDAMENTO";

      $res = $this->db2->query($sql);
      if($res)
        return $res->result_array();
      return null;

   }

   public function add_aviso($dados = null){
      $sql = "INSERT INTO chat (texto_chat, usuario_chat, data_chat)  VALUES(?, ?, now())";
      $res = $this->db->query($sql, $dados);
      if($res) return true; return false;
   }

   public function lista_avisos_recentes(){
      $sql = "SELECT * FROM chat ORDER BY data_chat DESC LIMIT 5 ";
      $res = $this->db->query($sql);
      return $res->result_array();
   }

     public function lista_avisos_full(){
      $sql = "SELECT * FROM chat ORDER BY data_chat DESC";
      $res = $this->db->query($sql);
      return $res->result_array();
   }
}
