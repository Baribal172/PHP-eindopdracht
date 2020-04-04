<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMD-Buddy</title>
</head>

<body>
<form action= <?php include_once(__DIR__ . "./../PHP-eindopdracht/feature6/zoeken.php") ?> method="post">
      <th>Filteren:</th>
      <th><input type="text" name="zoekterm" id="zoekterm"  value="<?php echo $_POST['zoekterm'];?>" /></th>
      <th ><div>in:</div></th>
      <th >
        <div>
          <select name="zoekin"  id="zoekin">
            <option value="designer">Designer</option>
            <option value="developper">Developper</option>
  
          </select>
          </div>           </th>
      <th ><div>Sorteer op:</div></th>
      <th><div >
        <select name="sorteerop" id="sorteerop">
        <option value="alles">Alles</option>
            <option value="name">Naam</option>
            <option value="gaming">Gaming</option>
            <option value="technology">Technology</option>
            <option value="food">Food</option>
            <option value="fashion">Fashion</option>
            <option value="animals">Animals</option>
            <option value="art">Art</option>
            <option value="nature">Nature</option>
            <option value="travel">Travel</option>
            <option value="dancing">Dancing</option>
            <option value="cosplay">Cosplay</option>
            <option value="photography">Photography</option>
            <option value="gadgest">Gadgest</option>
            <option value="cars">Cars</option>
            <option value="programming">Programming</option>
            <option value="singing">Singing</option>
            <option value="languages">Languages</option>
            <option value="parties">Parties</option>
            <option value="fitness">Fitness</option>
            <option value="writing">Writing</option>
        </select>
      </div></th>
      <th><input type="submit" name="zoek" value="Zoek!" /></th>
    </form>
</body>

</html>