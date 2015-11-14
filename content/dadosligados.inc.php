<?php
    include ("head.inc.php");
    include ("../functions.php");
escreve("

<h2>Dados Ligados</h2>

<h3 class='subtitulo'>Definição</h3>
O termo Dados Ligados se refere a um conjunto de práticas para a publicação e conexão de dados estruturados na Web de modo que eles sejam legíveis por máquina, os seus significados sejam explicitamente definidos, eles estejam ligados a outros conjuntos de dados e, por sua vez possam ser ligados a partir de conjuntos de dados externos.

<h3 class='subtitulo'>Principios</h3>
A idéia básica de dados ligados foi elaborada por Tim Berners-Lee, considerado o inventor da Web, que definiu os quatro princípios que caracterizam os dados ligados e que devem ser aplicados para fazer a Web crescer: 
<ul>
  <li>Usar URIs para nomes de “coisas”;</li>
  <li>Usar URIs HTTP para que as pessoas possam procurar esses nomes; </li>
  <li>Fornecer informações úteis quando alguém acessar um URI, utilizando padrões;</li>
  <li>Incluir links para outros URIs para que as pessoas possam encontrar mais “coisas”.</li>
</ul>

<h3 class='subtitulo'>Benefícios</h3>
Os benefícios gerais de Dados Ligados são: 
<ul>
  <li>Eles são acessíveis através de uma variedade ilimitada de aplicações e aplicativos porque são expressos em formatos abertos e não-proprietários; </li>
  <li>Podem ser combinados através de mashups com qualquer outro conjunto de Dados Ligados, sendo que nenhum planejamento antecipado é necessário para integrar essas fontes de dados desde que ambos utilizem os padrões de Dados Ligados; </li>
  <li>É fácil acrescentar mais Dados Ligados aos que já existem, mesmo quando os termos e definições usadas mudam ao longo do tempo.</li>
</ul>

<h3 class='subtitulo'>Tecnologias</h3>
As principais tecnologias utilizadas para disponibilizar dados ligados são:
<ul>
  <li><b>URIs:</b> que identificam todos os itens de interesse na Web, chamados de recursos.</li>
  <li><b>RDF:</b> um framework para representar informações na Web através de uma série de triplas com sujeito, predicado e objeto.</li>
  <li><b>HTTP:</b> protocolo utilizado para acessar um URI na Web a fim de obter as informações sobre o recurso referenciado.</li>
</ul>
Além dessas, outras tecnologias da Web Semântica são utilizadas para fornecer diferentes tipos de suporte, como:
<ul>
  <li><b>SPARQL:</b> linguagem para a consulta de dados RDF;</li>
  <li><b>RDFS e OWL:</b> linguagens para a definição de vocabulários; </li>
  <li><b>RDFa:</b> linguagem para a publicação de dados com significado. </li>
</ul>

<h3 class='subtitulo'>Projeto Linking Open Data</h3>
O exemplo mais visível da adoção e aplicação dos princípios de Dados Ligados é o projeto Linking Open Data, um esforço aberto e colaborativo apoiado pelo grupo W3C SWEO (Semantic Web Education and Outreach Group). O objetivo do projeto é identificar data sets existentes que estão disponíveis sob licenças abertas, convertê-los para RDF de acordo com os princípios de dados ligados, publicá-los na Web e interligá-los uns com os outros, formando uma nuvem de Dados Ligados

<h3 class='subtitulo'>Aplicações</h3>
Com um volume significativo de dados ligados sendo publicados na Web, inúmeras pesquisas e esforços estão sendo realizados para construir aplicações que exploram esta Web de dados: aplicações específicas através do mashup de dados de diferentes data sets, como o Reyvu e o DBPedia Mobile; motores de busca como o Falcons e indexadores como o Swoogle que navegam a Web de dados; e navegadores de dados ligados que permitem navegar entre fontes de dados seguindo links RDF, como o The Tabulator e o Disco Hyperdata Browser.

<h3 class='subtitulo'>Publicação</h3>
Diversas práticas devem ser levadas em consideração ao publicar dados ligados. Existem várias maneiras de publicar Dados Ligados na Web dependendo de vários fatores, tais como a do tipo da informação, a quantidade de dados, a forma de armazenamento e a quantidade de vezes que os dados mudam. Várias ferramentas de publicação foram desenvolvidas para ajudar os editores a lidarem com detalhes técnicos e garantir que os dados sejam publicados de acordo com os princípios e práticas de Dados Ligados. 

<h3 class='subtitulo'>No mundo</h3>
A utilização de Dados Ligados vem crescendo muito nos últimos anos, sendo fortemente apoiada pelo W3C (World Wide Web Consortium) e por Tim Berners-Lee. Porém, vários desafios ainda devem ser superados para que a Web seja utilizada como um grande banco de dados global.
<br /><br />
",
"

<h2>Linked Data</h2>


<h3 class='subtitulo'>Definition</h3>
Linked Data refers to data published on the Web in a way that they are machine readable, their meanings are explicitly defined, they are linked to other data sets, and in turn can be linked from external data sets.

<h3 class='subtitulo'>Principles</h3>
The basic idea was developed by Tim Berners-Lee, considered the inventor of the Web. He defined the four principles that characterize Linked Data and should be applied to make the Web grow: 
<ul>
  <li>Using URIs for naming “things”; </li>
  <li>Use HTTP URIs so that people can look up these names; </li>
  <li>Provide useful information when someone looks up a URI, using patterns; </li>
  <li>Include links to other URIs so that people can find more related “things”.</li>
</ul>

<h3 class='subtitulo'>Benefits</h3>
The overall benefits of Linked Data are: 
<ul>
  <li>They are accessible by an unlimited variety of applications because they are expressed in open formats; </li>
  <li>They can be combined through mashups with any other set of Linked Data, and no advance planning is necessary to integrate these data sources as long as they both use Linked Data standards;</li>
  <li>It is easy to add more Linked Data to the existing ones, even when the terms and definitions change over time.</li>
</ul>

<h3 class='subtitulo'>Technologies</h3>
The key technologies that support Linked Data are:
<ul>
  <li><b>URIs:</b> identify all items of interest on the Web, often called resources;</li>
  <li><b>HTTP:</b> protocol used to access a URI to so that the information about a referenced resource can be obtained;</li>
  <li><b>RDF:</b> a framework for representing information in the Web as a series of triples with a subject, a predicate and an object.</li>
</ul>
In addition to these, other Semantic Web technologies are used to provide different types of support, such as:
<ul>
  <li><b>SPARQL:</b> language to query RDF data;</li>
  <li><b>RDFS and OWL:</b> languages to define vocabularies;</li>
  <li><b>RDFa:</b> language for publishing data with meaning.</li>
</ul>

<h3 class='subtitulo'>Linking Open Data project</h3>
The most visible example of the adoption and application of the Linked Data principles is the Linking Open Data project, an open and collaborative effort supported by the W3C SWEO (Semantic Web Education and Outreach) Group. Its goal is to identify existing data sets that are available under open licenses, convert them to RDF according to the principles of Linked Data, publish them on the Web and link them with each other, generating the so called LOD Cloud (Linking Open Data Cloud).

<h3 class='subtitulo'>Applications</h3>
With a significant volume of Linked Data being published on the Web, numerous studies and efforts are being made to build applications that explores this Web of data, for example, domain-specific applications through the mashup of data from different data sets, such as Revyu and DBPedia Mobile; search engines, like Falcons and indexes like Swoogle crawling Linked Data from the Web and providing query capabilities over aggregated data; and Linked Data browsers that allows the navigation between different data sources by following RDF links, such as The Tabulator and Disco Hyperdata Browser.

<h3 class='subtitulo'>Publication</h3>
Many practices must be taken into account when publishing linked data. There are several ways for publishing Linked Data on the Web depending on different factors, such as the type of information, the amount of data, and how often the data changes. Several publishing tools were developed to help publishers deal with technical details and ensure that data are published in accordance with the principles and practices of Linked Data, such as D2Rserver, Triplify, Pubby, RDFizers, among others.

<h3 class='subtitulo'>Around the World</h3>
The use of Linked Data has been increasing in recent years, strongly supported by the W3C (World Wide Web Consortium) and Tim Berners-Lee. However, several challenges must be overcome so that the Web can be used as a global database.
<br /><br />
");

?>