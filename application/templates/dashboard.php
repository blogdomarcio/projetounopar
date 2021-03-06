
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Painel Administrativo</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">

	 <link href="<?php echo base_url('assets/css/dash_boot.css')?>" rel="stylesheet">
         
         <script src="<?php echo base_url('assets/js/util.js')?>"></script>
	

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script type="text/javascript" src="http://gc.kis.scr.kaspersky-labs.com/1B74BD89-2A22-4B93-B451-1C9E1052A0EC/main.js" charset="UTF-8"></script><script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Sistema de Controle de Associados</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo site_url('painel/usuario')?>" title="Usuários">Usuários</a></li>
             
            
          </ul>
           
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            
            <li class="active"><a href="<?php echo site_url('painel/usuario')?>" title="Usuários"><span class="glyphicon glyphicon-user"> </span> Usuários</a></li>
            <li class="divider linha"></li>
             <li><a href="<?php echo site_url('painel/cidade')?>" title="Cidades"> <span class="glyphicon glyphicon-globe"></span> Cidades</a></li>
              <li><a href="<?php echo site_url('painel/bairro')?>" title="Bairros"> <span class="glyphicon glyphicon-road"></span> Bairros</a></li>
               <li><a href="<?php echo site_url('painel/tipodp')?>" title="Tipo de Dependentes"><span class="glyphicon glyphicon-search"></span> Tipo de Dependentes</a></li>
                <li><a href="<?php echo site_url('painel/plano')?>" title="Planos"><span class="glyphicon glyphicon-search"></span> Planos</a></li>
               
               <li class="divider linha"></li>
               <li><a href="<?php echo site_url('painel/cliente')?>" title="Clientes"><span class="glyphicon glyphicon-user"></span> Clientes</a></li>
               
               <li><a href="<?php echo site_url('painel/dependente')?>" title="Dependentes"><span class="glyphicon glyphicon-search"></span> Dependentes</a></li>
             
          </ul>
           
           
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          
          
          {MENSAGEM_SISTEMA_ERRO}
          {MENSAGEM_SISTEMA_SUCESSO}
          {CONTEUDO}

        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/jquery.min.js"><\/script>')</script>
    
    <script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
    
    <script src="<?php echo base_url('assets/js/util.js')?>"></script>
    
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/jquery.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
