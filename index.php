<?php
// Check Website Status
$id = 1;
$status = file_get_contents('https://hi.isaquecosta.com.br/webservices/getWebsiteStatus.php?id=' . $id);

switch ($status):
  case 'CLEARED':
    $page_to_mount = 'site';
    break;
  case 'MAINTENANCE':
    $page_to_mount = 'https://cdn.ideyou.com.br/_offline';
    break;
  case 'BLOCKED':
    $page_to_mount = 'https://isaquecosta.com.br/';
    break;

  default:
    $page_to_mount = '_site/index.php?page=home';
    break;
endswitch;

$url = 'http://cdn.ideyou.com.br/defaults/header.php';
$data = array(
  'title' => 'ICS Tech - Soluções em TI!',
  'keywords' => 'IdeYou, agência, tecnologia, marketing, marketingdigital, marketing, o, empreendedorismo, digitalmarketing, instagram, socialmedia, business, sucesso, branding, like, digital, socialmediamarketing, negocios, love, hotmart, empreender, dise, a, marketingonline, follow, marketingstrategy, brasil, emprendedores, advertising, rendaextra, design, dinheiro, photography, bhfyp, art, fashion, bhfyp, marketingdigitalbrasil, empreendedor, foco, vendasonline, mktdigital, seo, marketingdeconteudo, redessociales, motiva, m, vendas, entrepreneur, content, copywriting, emprendimiento, publicidad, onlinemarketing, instagood, tiktok, publicidade, copywriter, contentmarketing, print, yourself, original, copywritingtips, c'
);

// use key 'http' even if you send the request to https://...
$options = array(
  'http' => array(
    'header' => "Content-type: application/x-www-form-urlencoded",
    'method' => 'POST',
    'content' => http_build_query($data),
  ),
);
$context = stream_context_create($options);
$header = file_get_contents($url, false, $context);
?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">

<head>
  <?= $header; ?>
</head>
<frameset frameborder="0" framespacing="0">
  <frame src="<?= $page_to_mount; ?>">
    <noframes>

      <body>
      </body>
    </noframes>
</frameset>

</html>