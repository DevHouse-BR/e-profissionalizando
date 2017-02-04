<?php
 
$links = array(); 

# Coloque abaixo os titulos e os links 

$links[1] = "UOL|http://www.uol.com.br"; 

$links[2] = "Terra|http://www.terra.com.br"; 

$links[3] = "BOL|http://www.bol.com.br"; 

# Você pode adicionar mais links. 
# Sempre seguindo a seqüencia. 
# Separando o titulo e o link com |. 

# Agora vamos fazer o PHP gerar o link randômico 
srand((double)microtime()*1000000); 
shuffle($links); 
$separa = explode("|", $links[0]); 
$titulo = $separa[0]; 
$link = $separa[1]; 

# Agora vamos printar a função Javascript para que 
# você possa colocar esse sistema em uma página htm. 

echo "document.write('<a href="$link">$titulo</a>');"; 

?>