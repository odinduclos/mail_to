<?php
//die();
// GET POST
/*var_dump($_POST);
var_dump($_FILES);*/
if (empty($_POST)) {
	exit("<li><p style='color: red;'>Vous devez remplir les champs du formulaire de la page d'accueil</p></li>");
}
if (empty($_FILES)) {
	exit("<li><p style='color: red;'>Vous devez fournir un fichier XML</p></li>");
}
$boite = $_POST['boite'];
$password = $_POST['password'];
$intro = $_POST['intro'];
$conclusion = $_POST['conclusion'];
$signature = $_POST['signature'];
// die();

// UPLOAD FILE
$target_dir = "uploads/";
$filename = basename( $_FILES["xml"]["name"]);
$target_dir = $target_dir . $filename;
if (move_uploaded_file($_FILES["xml"]["tmp_name"], $target_dir)) {
    echo "<li><p style='color: green;'>Le fichier ". $filename . " a été uploadé avec succès</p></li>";
} else {
    exit("<li><p style='color: red;'>L'upload du fichier a échoué</p></li>");
}

// SEND MAIL
$rootMailBox = "{imap.gmail.com:993/imap/ssl/novalidate-cert}";
$draftsMailBox = $rootMailBox . '[Gmail]/Drafts';
$conn = imap_open ($rootMailBox, $boite, $password);
if ($conn) {
	echo "<li><p style='color: green;'>La connexion à la boite Gmail " . $boite . " s'est effectuée avec succès</p></li>";
} else {
	exit("<li><p style='color: red;'>La connexion à la boite Gmail " . $boite . " a echouée</p><td><p>" . imap_last_error() . "</p></li>");
}
$html = file_get_html($target_dir);
$mails = $html->find("Row");
array_shift($mails);
$instructions = $html->find("Row", 0)->find("Cell Data");
$instructions_params = $html->find("Row", 0)->find("Cell");
if (!empty($html->find("Row", 0)->find("Cell[ss:MergeAcross]"))) {
	$sub_instructions = $html->find("Row", 1)->find("Cell Data");
	array_shift($mails);
}
$column = array();
$k = 0;
foreach ($instructions_params as $key => $value) {
	$column[$key]['master'] = $instructions[$key]->plaintext;
	$column[$key]['slave'] = array();
	if ($value->hasAttribute("ss:mergeacross")) {
		$j = $value->getAttribute("ss:mergeacross") + 1;
		$l = $k;
		for ($k=$l; $k < $j + $l; $k++) { 
			array_push($column[$key]['slave'], $sub_instructions[$k]->plaintext);
		}
	}
}
echo '<table>';
foreach ($mails as $key => $value) {
	$mail = $value->find("Cell Data");
	$to = "";
	$from = $boite;
	$subject = "";
	$cc = "";
	// $intro = "Bonjour,";
	$message = "";
	// $conclusion = "Cordialement,<br>Odin Duclos<br>Responsable pédagogique à la Web@cadémie";
	for ($i=0, $j=0; $i < count($mail); $j++) {
		if (strpos($column[$j]['master'], "to") !== false) $to = $mail[$i++]->plaintext;
		else if (strpos($column[$j]['master'], "subject") !== false) $subject = $mail[$i++]->plaintext;
		else if (strpos($column[$j]['master'], "cc") !== false) $cc = $mail[$i++]->plaintext;
		else {
			if (!empty($column[$j]['slave'])) {
				$message .= "<u>" . $column[$j]['master'] . "</u><ul>";
				foreach ($column[$j]['slave'] as $key => $value) {
					$message .= "<li><u>" . $value . "</u>: " . $mail[$i++]->plaintext . "</li>";
				}
				$message .= "</ul>";
			}
			else $message .= "<u>" . $column[$j]['master'] . "</u><br>" . str_replace('&#10;', "<br>", $mail[$i++]->plaintext) . "<br><br>";
		}
	}
	$envelope["to"]  = $to;
	$envelope["cc"]  = $cc;
	$envelope["subject"]  = $subject;

	$part["type"] = TYPETEXT;
	$part["subtype"] = "html";
	$part["contents.data"] = str_replace("\r\n", '<br>', $intro) . "<br>" . $message . "<br>" . str_replace("\r\n", '<br>', $conclusion) . "<br>" . str_replace("\r\n", '<br>', $signature);

	$body[1] = $part;

	$msg = imap_mail_compose($envelope, $body);
	echo '<tr><td>';
	if (imap_append($conn, $draftsMailBox, $msg) === false) {
	    exit("<p style='color: red;'>L'ajout du mail pour le destinataire <u>" . $to . "</u> a echoué</p><p>" . imap_last_error() . "</p>");
	}
	echo "<p>L'ajout du mail pour le destinataire <u>" . $to . "</u> s'est effectué avec succès dans vos brouillons (Drafts)</p>";
	echo '</td></tr>';
	// die();
}
imap_close($conn);
echo '</table>';
echo "<li><p style='color: green;'>La connexion à la boite Gmail " . $boite . " a été fermée avec succès</p></li>";
?>