<?php
use Client\Entity\ClientEntity;
use Client\Helper\ClientHelper;

$client = new ClientEntity(get_the_ID());
$clientTerm = $client->getTermList(ClientHelper::CLIENT_TAXONOMY_NAME)[0];

header('Location: '.$clientTerm->getPermalink());
