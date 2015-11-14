<?php
    include ("head.inc.php");
    include ("../functions.php");
escreve("
<h2>Dados Governamentais Abertos</h2>

<h3 class='subtitulo'>Definição</h3>
O conceito de Dados Governamentais Abertos pode ser definido como a disponibilização de informações governamentais representadas em formato aberto e acessível de tal modo que possam ser reutilizadas, misturadas com informações de outras fontes, gerando novos significados.

<h3 class='subtitulo'>Princípios</h3>
Dados Governamentais Abertos devem ser:   
<ul>
  <li><b>Completos</b>: totalmente disponíveis e sem limitações;</li>
  <li><b>Primários</b>: coletados na fonte com o maior nível possível de granularidade, sem agregação ou modificação; </li>
  <li><b>Atuais</b>: publicados tão rapidamente quanto necessário para preservar o seu valor;</li>
  <li><b>Acessíveis</b>: disponibilizados para o maior número possível de usuários e finalidades; </li>
  <li><b>Processáveis por máquinas</b>: razoavelmente estruturados para permitir processamento automatizado; </li>
  <li><b>Não-discriminatórios</b>: disponíveis para todos sem necessidade de cadastro;</li>
  <li><b>Não-proprietários</b>: disponibilizados em um formato sobre o qual nenhuma entidade tem controle exclusivo; </li>
  <li><b>Licenças livres</b>: não sujeitos a nenhuma regulação de direitos autorais, patentes, propriedade intelectual ou segredo industrial.</li>
</ul>

<h3 class='subtitulo'>Benefícios</h3>
A disponibilização de Dados Governamentais Abertos permite que os usuários possam facilmente encontrar, acessar, entender e utilizar os dados públicos segundo foco e interesses próprios, trazendo diversos benefícios como a reutilização, inclusão, transparência, responsabilidade, melhoria nas buscas, integração, participação, colaboração, crescimento econômico, inovação e eficiência.

<h3 class='subtitulo'>Tecnologias</h3>
As principais tecnologias e formatos utilizados para a publicação de dados governamentais abertos são:
<ul>
  <li><b> Arquivos CSV</b>: que armazenam dados tabulares; </li>
  <li><b> Informações Atom e RSS</b>: que agregam conteúdo baseado em XML, usadas para compartilhar novidades ou textos completos através dos denominados feeds; </li>
  <li><b> Interfaces REST</b>: que associam um recurso a um URI usando HTTP, permitindo que um site possa ser enriquecido com aplicativos que expandam o valor de um recurso disponível; </li>
  <li><b> Tecnologias da Web Semântica</b>: que oferecem um arcabouço comum onde os dados podem ser compartilhados e reutilizados além dos limites de aplicativos, empreendimentos e comunidades.</li>
</ul>

<h3 class='subtitulo'>Publicação</h3>
Existe uma série de orientações para disponibilizar dados de modo aderente às características que definem os dados governamentais abertos. Dentre elas, podemos citar algumas como: 
<ul>
  <li>Publicar os dados em sua forma bruta de forma estruturada; </li>
  <li>Criar um catálogo online dos dados brutos com documentação para que as pessoas possam descobrir o que foi postado; </li>
  <li>Usar normas estabelecidas abertas e ferramentas que permitam uma produção e publicação fácil e eficiente; </li>
  <li>Tornar os dados legíveis para pessoas convertendo-os para (X)HTML; </li>
  <li>Deixar as páginas legíveis por máquinas incorporando informações semânticas, metadados e identificadores; </li>
  <li>Usar URIs permanentemente padronizados e/ou de fácil localização; </li>
  <li>Gerar links para outros URIs em seus dados para ajudar na descoberta de recursos relacionados; </li>
  <li>Garantir que os dados são de fácil recuperação e podem ser referenciados pelo tempo que for necessário; </li>
  <li>Não comprometer a integridade dos dados apenas para criar interfaces chamativas; </li>
  <li>Publicar todos os dados que já estão disponíveis com o público de outras maneiras; </li>
  <li>Entre outras.</li>
</ul>

<h3 class='subtitulo'>No Mundo</h3>
Há um movimento global de governos e autoridades locais disponibilizando  seus dados na web. Projetos de dados governamentais abertos surgiram em vários países do mundo, como Estados Unidos, Reino Unido, Austrália, Nova Zelândia, Noruega, Holanda, Suécia, Espanha, Estônia, Áustria, Grécia, Canadá e Dinamarca, existindo também um número crescente de iniciativas locais de estados e cidades. Alguns governos criaram catálogos ou portais para tornar a localização e a utilização desses dados mais fácil para o público, como o portal data.gov e data.gov.uk. Além disso, pessoas e organizações vêm publicando dados governamentais por conta própria em vários formatos.
Com tantos dados governamentais para trabalhar, desenvolvedores estão criando uma ampla variedade de aplicações, mashups e visualizações, especialmente nos Estados Unidos e no Reino Unido. Estas aplicações oferecem informações muito úteis aos cidadãos, mostrando o potencial da reutilização dos dados governamentais abertos, como por exemplo os projetos Where Does My Money Go?, ITO World, Visualizing Community Health Data, FixMyStreet, TheyWorkForYou, entre outros.

<h3 class='subtitulo'>No Brasil</h3>
O Brasil tem uma boa oferta e dados em todas as esferas e poderes oferecidos publica e gratuitamente, mas existem poucas iniciativas do governo que se propõem a dar acesso à base integral estruturada e em linguagem aberta. Exemplos dessas iniciativas são os projetos Governo Aberto SP e LeXML. Enquanto o governo não libera mais dados em formato aberto, estão surgindo no Brasil iniciativas no sentido de extrair os dados de sites e portais governamentais, reorganizá-los, torná-los abertos e/ou conferir novo valor a eles através de diferentes aplicações, como o Congresso Aberto, o Parlamento Aberto, o Legisdados, o Tr3s, o SACSP e o Xerifes do DF.
Devido a escassez de projetos de dados governamentais abertos no Brasil, ainda são poucos os projetos que agregam informações de diferentes fontes para criar serviços que ofereçam uma nova perspectiva sobre as diferentes esferas da administração pública. Dado o crescente interesse civil após exemplos bem sucedidos em outros países, espera-se que novas iniciativas sejam realizadas em esferas políticas brasileiras.

<br /><br />
",
"
<h2>Open Government Data</h2>

<h3 class='subtitulo'>Definition</h3>
The concept of Open Government Data can be defined as the availability of government information in open and accessible formats to enable reuse and interconnection between information from different sources, thus generating new knowledge.

<h3 class='subtitulo'>Principles</h3>
Open Government Data should be:
<ul>
  <li><b>Complete</b>: fully available without limitations; </li>
  <li><b>Primary</b>: collected at the source with the highest possible level of granularity, without aggregation or modification; </li>
  <li><b>Timely</b>: published as quickly as necessary to preserve its value; </li>
  <li><b>Accessible</b>: available to the largest possible number of users and purposes; </li>
  <li><b>Machine Processable</b>: reasonably structured to allow automated processing; </li>
  <li><b>Non-discriminatory</b>: available to anyone without registration; </li>
  <li><b>Non-proprietary</b>: available in a format over which no entity has exclusive control;</li>
  <li><b>License-free</b>: not subject to any copyrights, patents, intellectual property or trade secrets regulation.</li>
</ul>

<h3 class='subtitulo'>Benefits</h3>
The aim of Open Government Data is to allow users to easily find, access, understand and use public data, bringing many benefits such as reuse, inclusion, transparency, accountability, improved search, integration, participation, collaboration, economic growth, innovation and efficiency.

<h3 class='subtitulo'>Technologies</h3>
The main technologies and formats used to publish Open Government Data are: 
<ul>
  <li>CSV Files</b>: which store tabular data; </li>
  <li>Atom and RSS Information</b>: which aggregate content based on XML ; </li>
  <li>REST interfaces</b>: which link a resource to an URI using HTTP, allowing a site to be enriched with applications that extend the value of an available resource; </li>
  <li>Semantic Web technologies</b>: which offer a common framework where data can be shared and reused.</li>
</ul>

<h3 class='subtitulo'>Publication</h3>
There are a series of guidelines to provide Open Government Data. Among them we can mention some such as:
<ul>
  <li>Publish the data in its raw form in a structured way;</li>
  <li>Creating an online catalog of the data with documentation so that people can discover what has been posted; </li>
  <li>Using established standards and tools to allow an easy and efficient production and publication; make the data human-readable converting them to (X) HTML;</li>
  <li>Incorporate machine-readable semantic information, metadata and identifiers;</li>
  <li>Use permanently standard and or easy to find URIs; </li>
  <li>Generate links to other URIs to help in the discovery of related resources; </li>
  <li>Ensure that data are easy to recover and can be referenced as long as is necessary; </li>
  <li>Not compromise the integrity of the data only to create eye-catching interfaces; </li>
  <li>Publish all the data already available in other ways; </li>
  <li>Among others.</li>
</ul>

<h3 class='subtitulo'>Around the World</h3>
Open Government Data projects are emerging in different countries, such as the U.S., U.K., Australia, New Zealand, Norway, Holland, Sweden, Spain, Austria, Greece, Canada and Denmark. There are also a growing number of local initiatives from states and cities. Some governments have created catalogs or portals to facilitate the location and use of data for the public, like the portals data.gov and data.gov.uk. In addition, individuals and organizations are publishing government data on their own in various formats.
With so much government data to work with, developers are creating a wide variety of applications, mashups and visualizations, especially in the U.S. and the U.K, such as the projects Where Does My Money Go?, ITO World, Community Health Visualizing Data, FixMyStreet, TheyWorkForYou, among others. These applications offer useful information to citizens, showing the potential of reusing Open Government Data to create new knowledge.

<h3 class='subtitulo'>In Brazil</h3>
There are few government initiatives that give full access to the data in a structured and open language. Examples of these initiatives are the projects Governo Aberto SP and LeXML. While the government does not release more data in open format, initiatives are emerging in order to extract data from government sites and portals, rearrange them, make them open and/or provide new value to them through different applications, such as the projects Congresso Aberto, Parlamento Aberto, Legisdados, Tr3s, SACSP and Xerifes do DF.
Due to the few Open Government Data projects in Brazil, there are still not many projects that mix information from different sources to create new services and offer new insights about the government information. Given the growing civil interest after successful examples in other countries, more efforts should be developed.

<br /><br />
");

?>
