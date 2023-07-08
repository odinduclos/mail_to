<!doctype html>
<html lang="fr">
<head>
	<link rel="icon" type="image/png" href="img/gmail.png" />
	<meta charset="utf-8">
	<title>Pangolinette de mail</title>
	<link rel="stylesheet" href="css/foundation.css">
	<!-- This is how you would link your custom stylesheet -->
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<header>
		<h1>Pangolinette de mail</h1>
		<span style="color: grey;">Version Beta à utiliser sur Windows et uniquement via Gmail</span><br>
	</header>
	<table class='main_table'>
		<tr>
			<td>
				<table>
					<form method="post" action="mail.php" enctype="multipart/form-data">
						<tr>
							<td class='align_middle'><label for="boite">Boite Gmail</label></td>
							<td class='align_middle'><input type="email" id="boite" name="boite" size="79"></td>
						</tr>
						<tr>
							<td class='align_middle'><label for="password">Password Gmail</label></td>
							<td class='align_middle'><input type="password" id="password" name="password" size="79"></td>
						</tr>
						<tr>
							<td class='align_middle'><label for="boite">Introduction</label></td>
							<td class='align_middle'><textarea style="resize: none;" id="intro" name="intro" cols="80" rows="15"></textarea></td>
						</tr>
						<tr>
							<td class='align_middle'><label for="boite">Fichier XML</label></td>
							<td class='align_middle'>
								<input type="file" name="xml" id="xml" class="button"><br>
								<span style="color: grey;">Le fichier doit contenir une colonne nommée "to"</span><br>
								<span style="color: grey;">Le fichier doit contenir une colonne nommée "subject"</span><br>
								<span style="color: grey;">Le fichier peut contenir une colonne nommée "cc"</span><br>
							</td>
						</tr>
						<tr>
							<td class='align_middle'><label for="boite">Conclusion</label></td>
							<td class='align_middle'><textarea style="resize: none;" id="conclusion" name="conclusion" cols="80" rows="15"></textarea></td>
						</tr>
						<tr>
							<td class='align_middle'><label for="signature">Signature</label></td>
							<td class='align_middle'><textarea style="resize: none;" id="signature" name="signature" cols="80" rows="5"></textarea></td>
						</tr>
						<tr>
							<td class='align_middle'></td>
							<td class='align_middle'><input type="submit" id="launch" name="launch" value="Envoyer" class="button"></td>
						</tr>
					</form>
				</table>
			</td>
			<td class='align_top'>
				<h2>Fichier XML</h2>
				<table style="border-collapse: collapse;">
					<tr>
						<td style="border: 1px solid black;">to</td>
						<td style="border: 1px solid black;">subject</td>
						<td style="border: 1px solid black;">cc</td>
						<td style="border: 1px solid black;">Note:</td>
						<td style="border: 1px solid black;">Commentaire:</td>
						<td style="border: 1px solid black;" colspan="2">Absences</td>
					</tr>
					<tr>
						<td style="border: 1px solid black;"></td>
						<td style="border: 1px solid black;"></td>
						<td style="border: 1px solid black;"></td>
						<td style="border: 1px solid black;"></td>
						<td style="border: 1px solid black;"></td>
						<td style="border: 1px solid black;">Nombre</td>
						<td style="border: 1px solid black;">Dates</td>
					</tr>
					<tr>
						<td style="border: 1px solid black;">destinataire@mail.com</td>
						<td style="border: 1px solid black;">Sujet de test</td>
						<td style="border: 1px solid black;">autre_destinataire@mail.com, autre_destinataire2@mail.com</td>
						<td style="border: 1px solid black;">13</td>
						<td style="border: 1px solid black;">Très bon travail!</td>
						<td style="border: 1px solid black;">2</td>
						<td style="border: 1px solid black;">12/12/2014, 13/12/2014</td>
					</tr>
				</table>
				<h2>Mail généré dans "Mes brouillons"</h2>
				Mon introduction,<br>
				<br>
				<u>Note:</u><br>
				13<br>
				<br>
				<u>Commentaire:</u><br>
				Très bon travail!<br>
				<br>
				<u>Absences</u>
				<ul>
					<li><u>Nombre</u>: 2</li>
					<li><u>Dates</u>: 12/12/2014, 13/12/2014</li>
				</ul>
				<br>
				Ma conclusion.<br>
				<br>
				Ma signature.<br>
			</td>
		</tr>
	</table>
</body>
</html>