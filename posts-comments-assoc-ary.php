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
    $sql = "SELECT p.id, p.title, p.content, c.comment
    FROM posts p
    LEFT JOIN comments c ON p.id = c.post_id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Izvada katru rindu no rezultātiem
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "Post ID: " . $row["id"] . "<br>";
            echo "Title: " . $row["title"] . "<br>";
            echo "Content: " . $row["content"] . "<br>";
            
            // Ja ir komentārs, izvada to
            if ($row["comment"]) {
                echo "Comment: " . $row["comment"] . "<br><br>";
                
            } else {
                echo "No comments available.<br><br>";
            }
        }
    } else {
        echo "Nav atrasti rezultāti.<br>";
    }
    
}


catch (PDOException $e) {
    // Ja rodas kļūda, izvada kļūdas ziņu
    echo "Kļūda savienojumā: " . $e->getMessage();
}
$pdo = null;

?>
