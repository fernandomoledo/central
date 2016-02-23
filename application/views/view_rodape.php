<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <hr>

    <footer class="text-center">
      <p>Copyright &copy; 2015 - <?php echo date('Y'); ?> - Tribunal Regional do Trabalho 15ª Região. Todos os direitos reservados.</p>
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo base_url().'resources/js/datatables.js'; ?>"></script>    
    <script type="text/javascript" charset="utf-8">
      $(document).ready(function() {
        $('#example').DataTable();
      } );

      $( "#termo_categoria" ).focus(function() {
        
        $("#termo_helper").css("display", "block");
      });

      $( "#termo_categoria" ).blur(function() {
        
        $("#termo_helper").css("display", "none");
      });      
    </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url().'resources/js/bootstrap.min.js'; ?>"></script>
 	  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script src="<?php echo base_url().'resources/js/main.js'; ?>"></script>
    <script>
       $(document).ready(function() {
          $('#tbl_chamados').DataTable();
      });
    </script>
  </body>
</html>