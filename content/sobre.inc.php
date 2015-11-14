<?php
    include ("head.inc.php");
    include ("../functions.php");
escreve("<h2>Sobre o Projeto</h2>","<h2>About the Project</h2>");
?>

<?php

escreve("
<center>
<iframe title='YouTube video player' width='480' height='390' src='http://www.youtube.com/embed/5blGma1CIVk' frameborder='0' allowfullscreen></iframe>
</center>

<h3 class='subtitulo'>Objetivo</h3>
O objetivo do projeto é fornecer um novo data set com informações de políticos brasileiros coletadas de diferentes fontes utilizando as práticas de Dados Ligados e Dados Governamentais Abertos, contribuindo assim com a nova Web de dados. O projeto implementado tem como objetivo fornecer dados úteis, abertos, padronizados, reutilizáveis e ligados a dados de outras fontes.

<h3 class='subtitulo'>Motivação</h3>
Atualmente, muitos dados governamentais estão disponíveis na Web, mas estas informações na maioria das vezes são oferecidas sem a utilização de padrões, em formatos proprietários ou apenas para a visualização, especialmente no Brasil, dificultando a reutilização e sua utilização por máquinas. Para bem aproveitar o potencial representado pelo acervo de informações do governo, essas informações precisam ser disponibilizadas em formato padronizado, aberto e acessível. Existem diversas maneiras de publicar Dados Governamentais Abertos, mas segundo Tim Berners-Lee os objetivos esperados ao publicar dados governamentais são melhores alcançadas usando Dados Ligados. Segundo o relatório United Nations E-Government Survey 2010, que apresenta a situação mundial no setor de Governo Eletrônico, o Brasil ocupa a posição de número 61, acumulando uma perda de 16 posições desde 2008. Diversos fatores são responsáveis pelo declínio brasileiro, tais como a insuficiência de serviços online e a deficiente infra-estrutura de telecomunicações. O relatório destaca ainda iniciativas brasileiras de dados abertos que devem ser seguidas. 

<h3 class='subtitulo'>Importância</h3>
Dados governamentais publicados na Web aumentam a consciência dos cidadãos das funções do governo permitindo uma maior responsabilidade, contribuem com informações valiosas sobre o mundo e permitem que o governo, o país e o mundo funcionem com mais eficiência. A disponibilização dessas informações em formatos abertos e acessíveis permite que elas sejam reutilizadas e misturadas com informações de outras fontes para produzir novos significados sobre o desempenho do governo. Aliar a publicação de Dados Governamentais Abertos às práticas de Dados Ligados é ainda mais importante, pois proporciona um mecanismo de acesso único e padronizado.

<h3 class='subtitulo'>Funcionamento</h3>
Como fontes de dados foram utilizados o site do Tribunal Superior Eleitoral (TSE), o site do Senado Federal, o Portal da Câmara dos Deputados, o site da ONG (Organização Não Governamental) Políticos Brasileiros, o site Ficha Limpa e o projeto Excelências do site Transparência Brasil. Foram coletados dados pessoais, dados da eleição, divulgação de bens, dados parlamentares, lideranças, missões, mandatos, afastamentos, pronunciamentos, comissões, proposições e ocorrências. Foi necessário extrair os dados de uma forma metódica e automatizada e inseri-los em uma base de dados única. Após obtermos todos os dados estruturados, a informação foi representada utilizando os princípios e práticas de Dados Ligados e usando o modelo RDF. Foi criada também uma representação HTML para a visualização e consulta dos dados.

<h3 class='subtitulo'>Ferramentas</h3>
A página principal oferece mecanismos de busca para o usuário encontrar os políticos desejados de acordo com diferentes critérios, como nome, situação, cargo, estado, partido e sexo. O usuário pode utilizar mais de um critério para realizar a busca. Após realizada a busca são exibidos os políticos encontrados. Ao selecionar o político, seus dados são apresentados. Para aprimorar a navegabilidade do site, é possível selecionar certos dados apresentados para buscar políticos que possuem as mesmas características. Para melhorar a experiência dos usuários e conferir novos valores aos dados, diferentes gráficos são apresentados.  Para facilitar a reutilização dos dados, eles também são fornecidos em seu formato bruto.

<h3 class='subtitulo'>Trabalhos Futuros</h3>
É importante garantir que os dados publicados sejam úteis e atuais. Para isso, o plano é atualizar os dados constantemente, aumentar a quantidade de políticos cadastrados e coletar mais dados. É preciso aprimorar a representação dos dados e gerar novos gráficos sobre os dados coletados. É preciso também definir mais ligações para relacionar os recursos do projeto com outras fontes de dados. Além disso, trabalhos futuros devem ser realizados para adequar o projeto a todas as práticas de Dados Governamentais Abertos e Dados Ligados.
",
"
<center>
<iframe title='YouTube video player' width='480' height='390' src='http://www.youtube.com/embed/e2fTAuqSQYs' frameborder='0' allowfullscreen></iframe>
</center>
<h3 class='subtitulo'>Purpose</h3>
The aim of the project is to provide a new data set with information from Brazilian politicians gathered from different sources using the Linked Data and Open Government Data practices, therefore contributing to the new Web data. The implemented project aims to provide useful, open, standardized, reusable, and linked data for both human and machine. 

<h3 class='subtitulo'>Motivation</h3>
Nowadays, many government data are available on the Web, but this information is most often offered without the use of standards, in proprietary formats or only for viewing, especially in Brazil, making it difficult to reuse and their use by machines. For better exploiting the potential represented by the government information, the data must be available in standard, open and accessible formats. There are several ways for publishing Open Government Data on the Web, but according to Tim Berners-Lee the purposes expected on publishing government data are best served by using Linked Data techniques. According to the United Nations E-Government Survey 2010, which provides a global assessment in the field of Electronic Government, Brazil ranks 61st, losing 16 positions since 2008. Several factors are responsible for the decline, such as the lack of online services and poor telecommunications infrastructure. The report also highlights Brazilian initiatives on Open Government Data that must be followed.

<h3 class='subtitulo'>Importance</h3>
Government data published on the Web, by itself, have a great value, because they contribute to greater information transparency. Providing this information in accessible and open formats allows them to be reused and mixed with information from other sources to produce new conclusions about government performance. Allying the publication of Open Government Data to Linked Data Practices is even more important, because it provides a single and standardized access mechanism.

<h3 class='subtitulo'>Operation</h3>
The data sources used were the Supreme Electoral Court (TSE) website, the Senate website, the House of Representatives portal, the Non Governmental Organization (NGO) website Brazilian Politicians, the Clean Sheet website and the Excellencies project from the Transparency Brazil website. Personal data, election data, disclosure of assets, parliamentary data, leaderships, missions, mandates, clearances, speeches, commissions, proposals and legal occurrences were collected. It was necessary to extract data in a methodical and automated way and inserting them into a unique relational database. After that, the information was represented using the principles and practices of Linked Data and using the RDF model. RDF links were generated with the data sets DBpedia, GeoNames, Freebase, World Factbook, UMBEL (Upper Mapping and Binding Exchange Layer) and YAGO. A representation for HTML viewing and searching data was also created.

<h3 class='subtitulo'>Tools</h3>
The home page provides a search engine for users to find the desired politician according to different criteria such as name, location, status, state, party and gender. The user can use one or more criterion to perform the search. After the search is performed, the politicians found are displayed. By selecting the politician, the data are displayed. To improve the navigability, certain data can be selected to search politicians with the same characteristics. To improve the users experience and give new meaning to the collected data, different graphs are generated. The data are also provided in its raw format to facilitate its reuse.

<h3 class='subtitulo'>Future Work</h3>
The published data needs to be useful and current. For this, the data must be constantly updated. In addition, more data can be collected. The amount of politicians registered can also be increased by using data from candidates, senators and deputies from other years. It is also necessary to improve the HTML representation. More RDF links related to other data sources should also be defined. New knowledge about the data collected can be generated through new graphics and individual charts for the registered politicians. Moreover, future work should be done to adapt the project to all the practices related to Linked Data and Open Government Data.


");

?>
<br /><br />
