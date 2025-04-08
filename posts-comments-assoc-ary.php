<?php
// Datu bāzes savienojuma parametri
$host = 'localhost';           // Serveris, parasti localhost
$dbname = 'php27032025';       // Datu bāzes nosaukums
$username = 'emaneelsk';       // Datu bāzes lietotājvārds
$password = 'password';        // Datu bāzes parole

try {
    // Izveido savienojumu ar PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Iestatām PDO režīmu, lai parādītu kļūdas, ja tās rodas
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Savienojums veiksmīgi izveidots!";

    // SQL vaicājums, lai atlasītu rakstus un komentārus
    $sql = "SELECT p.post_id, p.title, p.content, c.comment, c.author as comment_author
    FROM posts p
    LEFT JOIN comments c ON p.post_id = c.post_id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();


} 



catch (PDOException $e) {
    // Ja rodas kļūda, izvada kļūdas ziņu
    echo "Kļūda savienojumā: " . $e->getMessage();
}


?>
