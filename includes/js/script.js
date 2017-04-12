        $('#s').keyup(function () {
            if (event.keyCode == 13) {
                $('#search').click();
            } else {
                return false
            }
        });
        function nextcenter() {
                console.log(1);
                var pg = $('#page').val();
                $('#page').val($('#pagenext').val());
                $('#search').click();
        };
        function somenteNumeros(num) {
            var er = /[^0-9.]/;            
            er.lastIndex = 0;
            var campo = num;
            if (er.test(campo.value)) {
              campo.value = "";
            }
        }
        function checkStatus(imageUrl) 
        {
           var http = jQuery.ajax(
           {
              type:"HEAD",
              url: imageUrl,
              async: false
            })
          return http.status;
        }
        function addFavoritos(variavel){              
            var url = "includes/favoritos.php";                                
            $.ajax({
                type: "POST",
                url: url,
                data: {   
                    tipo: "ADD",
                    id: $(variavel).data("id"),
                    img: $(variavel).data("img"),
                    title: $(variavel).data("title")                             
                },
                success: function(resp) {
                    if(resp == 1){
                        atualizaFavoritos('adicionado');
                    }else{
                        bootbox.alert({
                            message: "Não foi possível atualizar",
                            backdrop: true
                        });
                    }
                },
                dataType: 'text'
            });                 
        }
        function removeFavoritos(variavel){  
            var url = "includes/favoritos.php"; 
            bootbox.confirm("Deseja remover dos favoritos?", function(result) {
                if(result===true){                    
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {   
                            tipo: "REMOVE",
                            id: $(variavel).data("id")                                                             
                        },
                        success: function(resp) {
                            if(resp == 1){
                                atualizaFavoritos('excluido');
                            }else{
                                bootbox.alert({
                                    message: "Não foi possível atualizar",
                                    backdrop: true
                                });
                            }
                        },
                        dataType: 'text'
                    }); 
                }                  
            });   
        }
        function exibeFavoritos(){  
            var url = "includes/favoritos.php"; 
            $.ajax({
                type: "POST",
                url: url,
                data: {   
                    tipo: "EXIBE"                                                          
                },
                success: function(resp) {
                    $('.resultadoFavorito').html(resp);
                },
                dataType: 'text'
            }); 
                             
              
        }
        
        function atualizaFavoritos(tipo){
            $('#exibeFavorito').show('slow');
            bootbox.alert({
                message: "Registro "+tipo+" com sucesso",
                backdrop: true
            });
            exibeFavoritos();
        }
        
        $('#search').click(function () {
        	var f = $("#search-form :input").filter(function (index, element) {
                return $(element).val() != "";
            }).serialize();
            var f1 = $(".input-small").filter(function (index, element) {
                return $(element).val() != "";
            }).serialize();
            var a = $('#request');            
            var b = $('#progress');
            var c = $('#response');
            var d = $('#next');
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: 'http://www.omdbapi.com/?' + f,
                statusCode: {
                    403: function () {
                        c.find('pre').html('HTTP 403 Forbidden!')
                    }
                },
                success: function (data) { 
                    var result = f1.replace("s=", "").replace("type=", "").replace("y=", "").replace("&", "/");              	               	                              	
                	a.find('pre').html(result);
                    var pg = $('#page').val();
                    var resultadomais = data.totalResults-(pg*10);
                    if(pg==1){
                        c.find('pre').html('');
                    }
                	if(data.Response == 'True'){
                       
	                	var items = data.Search.map(function (item) {
                            var imagem = item.Poster;
                            var validaImagem = checkStatus(item.Poster);
                            if((validaImagem == 0)||(imagem == 'N/A')){
                                imagem = "imagens/inexistente.gif";
                            }
					        c.find('pre').append( "<div class='col-md-15 col-sm-3 "+item.imdbID+"'><div class='imagem'><span class='glyphicon glyphicon-heart add' onclick='addFavoritos(this)' data-id='"+item.imdbID+"' data-img='"+imagem+"' data-title='"+item.Title+"' aria-hidden='true' data-toggle='tooltip' title='Add aos favoritos'></span><img src='"+imagem+"' alt='"+item.Title+" - "+item.Year+"' class='wight100'></div><h5 class='center'>"+item.Title+"</h5><p>Ano: "+item.Year+"</p><p>Categoria:"+item.Type+"</p></div>" );					                                    
                        });

                        d.hide('slow');

                        if(resultadomais>0){
                            d.html( '<button id="nextcenter" type="submit" onclick="nextcenter()" class="btn-sm btn-primary wight100"><h3>Veja Mais</h3></button>' );    
                            d.show('slow');  
                            
                            pg ++;                 
                            $('#pagenext').val(pg);
                        }
				    }
				    c.find('b').html(data.totalResults);
                    $('#page').val(1);            
                },
                complete: function () {
                    a.show('slow');
                    b.hide('slow');
                    c.show('slow');
                }
            })
        });
        $('#reset').click(function () {
            var a = $('#request');
            a.hide('slow');
            a.find('pre').html('');
            var b = $('#progress');
            b.hide('slow');
            var c = $('#response');
            c.hide('slow');
            c.find('pre').html('');
            var d = $('#next');
            d.html('');
            d.hide('slow');
        });        
   