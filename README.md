# Teste para Programador PHP

Autor: Gabriel Castorino

## Implantação

Não há conexão de banco de dados;
Utilizado o php 5.5;

## Levantamento de requisitos 

Desenvolver um software;
Integração com a API OMDB consumindo suas informações;
Criação de um formulario com os parametros extipulado pela API;
Exibição dos dados obtido;
Cadastro/Exclusão de itens favoritos;
Exibição quando solicitado dos itens favoritos.

## Resumo do desenvolvimento 

Apartir do levantamento de requisitos foi desenvolvido o seguinte sistema.
Criado um formulário, com seus respectivos tratamentos e validações, seguindo instruções da documentação da API, e que com seus parametros são enviados via json para a API da OMDB, sendo retornada os resultados obtidos, tratados e exibido na tela em grupo no maximo de 10. Caso haja mais resultados, o sistema identifica e habilita um botão que carrega as próximas 10, repetindo o processo até a exibição total dos itens.
Após o usuário efetuar a busca, o mesmo terá a possíbilidade de adicionar aos seus favoritos os itens desejados, através do click do icone de coração que fica em cima da imagem de cada item. 
Sendo positivo a inclusão de qualquer item nos favoritos, automaticamente habilita o botão para visualização de todos os itens favoritos.Ao clicar no mesmo exibe o modal com todos os item e com a opção de exclusão do mesmo.
