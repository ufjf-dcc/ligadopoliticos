<?php

header ("content-type: application/rdf+xml");

echo '
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" 
	     xmlns:rdfs="http://www.w3.org/2000/01-rdf-schema#" >     
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/governmentalName"> 
        <rdfs:label xml:lang="en">governmentalName</rdfs:label>
        <rdfs:comment xml:lang="en">The governmental name of a person</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/situation"> 
        <rdfs:label xml:lang="en">situation</rdfs:label>
        <rdfs:comment xml:lang="en">The current situation of a politician</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/officeState"> 
        <rdfs:label xml:lang="en">officeState</rdfs:label>
        <rdfs:comment xml:lang="en">The State where the politician performs his or her Office</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/maritalStatus"> 
        <rdfs:label xml:lang="en">maritalStatus</rdfs:label>
        <rdfs:comment xml:lang="en">The marital status of a person</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/state-of-birth"> 
        <rdfs:label xml:lang="en">state-of-birth</rdfs:label>
        <rdfs:comment xml:lang="en">The state where a person was born</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/place-of-vote"> 
        <rdfs:label xml:lang="en">place-of-vote</rdfs:label>
        <rdfs:comment xml:lang="en">The place where a person votes</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/election"> 
        <rdfs:label xml:lang="en">election</rdfs:label>
        <rdfs:comment xml:lang="en">Regards the election of a politician</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/unionParties"> 
        <rdfs:label xml:lang="en">unionParties</rdfs:label>
        <rdfs:comment xml:lang="en">The parties of a political union</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/protocolNumber"> 
        <rdfs:label xml:lang="en">protocolNumber</rdfs:label>
        <rdfs:comment xml:lang="en">The protocol number of a document</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/processNumber"> 
        <rdfs:label xml:lang="en">processNumber</rdfs:label>
        <rdfs:comment xml:lang="en">The process number of a document</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/CNPJ"> 
        <rdfs:label xml:lang="en">CNPJ</rdfs:label>
        <rdfs:comment xml:lang="en">The CNPJ number of an entity</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/absence"> 
        <rdfs:label xml:lang="en">absence</rdfs:label>
        <rdfs:comment xml:lang="en">Regards the absence of a politician to his or her Office</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/committee"> 
        <rdfs:label xml:lang="en">committee</rdfs:label>
        <rdfs:comment xml:lang="en">Regards the political commitees</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/committee"> 
        <rdfs:label xml:lang="en">committee</rdfs:label>
        <rdfs:comment xml:lang="en">Regards the political commitees</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/annex"> 
        <rdfs:label xml:lang="en">annex</rdfs:label>
        <rdfs:comment xml:lang="en">The annex of a building</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/wing"> 
        <rdfs:label xml:lang="en">wing</rdfs:label>
        <rdfs:comment xml:lang="en">The wing of a building</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/cabinet"> 
        <rdfs:label xml:lang="en">cabinet</rdfs:label>
        <rdfs:comment xml:lang="en">The cabinet of a floor</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/district"> 
        <rdfs:label xml:lang="en">district</rdfs:label>
        <rdfs:comment xml:lang="en">The district of an address</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/leadership"> 
        <rdfs:label xml:lang="en">leadership</rdfs:label>
        <rdfs:comment xml:lang="en">Regards a leadership of a person</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/mission"> 
        <rdfs:label xml:lang="en">mission</rdfs:label>
        <rdfs:comment xml:lang="en">Regards a mission participated by a person</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/proposition"> 
        <rdfs:label xml:lang="en">proposition</rdfs:label>
        <rdfs:comment xml:lang="en">Regards a proposition made by a person</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
    <rdf:Description 
        rdf:about="http://ligadonospoliticos.com.br/politicobr/declarationOfAssets"> 
        <rdfs:label xml:lang="en">declarationOfAssets</rdfs:label>
        <rdfs:comment xml:lang="en">Regards the declaration of assets made by a person</rdfs:comment>
        <rdfs:isDefinedBy rdf:resource="http://ligadonospoliticos.com.br/politicobr"/>
    </rdf:Description>
</rdf:RDF>


';





?>