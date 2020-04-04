<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMD-Buddy</title>
</head>

<body>
<form action= <?php include_once(__DIR__ . "./../PHP-eindopdracht/feature6/zoeken.php") ?> method="post">
      <th>Zoek:</th>
      <th><input type="text" name="zoekterm" id="zoekterm" value="<?php echo $_POST['zoekterm'];   ?>" /></th>
      <th ><div>in:</div></th>
      <th >
        <div>
          <select name="zoekin" size="1" id="zoekin">
            <option value="alles">Alles</option>
            <option value="klant_naam">Klanten</option>
            <option value="opdracht">Opdracht</option>
            <option value="id">Opdracht-ID</option>
            <option value="personeelsnaam">Personeel</option>
            <option value="status">Status</option>
          </select>
          </div>           </th>
      <th ><div>Sorteer op:</div></th>
      <th><div >
        <select name="sorteerop" size="1" id="sorteerop">
          <option value="klant_naam" selected="selected">Klanten</option>
          <option value="opdracht">Opdracht</option>
          <option value="id">Opdracht-ID</option>
          <option value="personeelsnaam">Personeel</option>
          <option value="status">Status</option>
        </select>
      </div></th>
      <th><input type="submit" name="zoek" value="Zoek!" /></th>
    </form>
</body>

</html>