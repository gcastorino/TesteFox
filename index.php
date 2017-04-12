<?php require_once('includes/session.php');?>
<html lang="en">
	<head>
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"   integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>

		<!-- Última versão CSS compilada e minificada -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <link rel="stylesheet" href="includes/css/style.css" >

		<!-- Última versão JavaScript compilada e minificada -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <script src="http://bootboxjs.com/bootbox.js"></script>
        		
	</head>
	<body>
		
		<div class="jumbotron">
		  <h1>OMDb</h1>
		  <h2>A Base de Dados de Filme Aberto</h2> 
		</div>
		<div class="container">
            
			<div class="row bs-component">
                <div id="exibeFavorito" style="<?php if(isset($_SESSION["favorito"])){ ?>display: none<?php } ?>">             
                    <pre class="alert alert-danger"><a href="#" class="exibirFavoritos" onclick="exibeFavoritos()" data-toggle="modal" data-target="#myModal"><span class='glyphicon glyphicon-heart' aria-hidden='true' data-toggle='tooltip' title='Exibe aos favoritos'></span> Veja os favoritos</a></pre>                    
                </div>   
                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Favoritos</h4>
                      </div>
                      <div class="modal-body"> <div class="row resultadoFavorito"></div> </div>                     
                    </div>

                  </div>
                </div>
    	        <form class="well form-search" id="search-form" onsubmit="return false;">
    	            <fieldset>
    	            	<legend>Pesquise</legend>
    	            </fieldset>        	
    			    <div class="row">
    					<div class="col-md-6 form-group">
                            <input type="hidden" id="page" name="page" class="form-control" value='1'>
                            <input type="hidden" id="pagenext" name="pagenext" class="form-control" >
    					    <input type="text" id="s" name="s" class="input-small form-control" placeholder="Titulo">
    					</div>
    					<div class="col-md-2 form-group">
    					    <input type="text" id="y" name="y" maxlength="4" onkeyup="somenteNumeros(this);" class="input-small form-control" placeholder="Ano">
    					</div>
    					<div class="col-md-2 form-group">
    					    <select name="type" class="input-small form-control">
    					    	<option value="" selected="">Categoria</option>
    					        <option value="movie">Filmes</option>
    					        <option value="series">S&eacute;ries</option>
                                <option value="episode">Epis&oacute;dio</option>
    					    </select>
    					</div>
    					<div class="col-md-1 form-group ">
    						<button id="search" type="button" class="btn-sm btn-primary wight100" data-toggle='tooltip' title='Buscar'><span class="glyphicon glyphicon-search" aria-hidden="true" ></span></button>		        
    					</div>
    					<div class="col-md-1 form-group ">
    					    <button id="reset" type="reset" class="btn-sm btn-danger wight100" data-toggle='tooltip' title='Cancelar'><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></button>
    					</div>					  				  	
    			  	</div>
    			</form>	
                <div id="request"  style="display: none">             
                    <pre class="alert alert-box"></pre>
                </div>
    			<div id="progress" style="display: none" class="progress progress-info progress-striped active">
                                <div class="progress-bar" style="width: 100%;"> Carregando</div>
                            </div>                   
    	        <div id="response" style="display: none">
    	            <h3>Foram encontrados <b></b> resultados</h3>
    	            <pre></pre>
    	        </div>	
                <div id="next" style="display: none">
                </div> 
            </div>
        </div>
	</body>
    <script src="includes/js/script.js" type="text/javascript"></script>
</html>