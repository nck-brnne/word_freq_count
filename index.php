<?php

function tokenizeText($text) {
    $words = preg_split('/\W+/', $text, -1, PREG_SPLIT_NO_EMPTY);
    return $words;
}

function calculateWordFrequencies($words) {
    
    $wordCounts = array_count_values($words);
    return $wordCounts;
}


function sortWords($wordCounts, $sortOrder) {
    if ($sortOrder == 'asc') {
        asort($wordCounts);
    } else {
        arsort($wordCounts);
    }
    return $wordCounts;
}


function displayWordFrequencies($wordCounts, $limit) {
    $count = 0;
    foreach ($wordCounts as $word => $frequency) {
        echo "$word: $frequency<br>";
        $count++;
        if ($count >= $limit) {
            break;
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST['text'];
    $sortOrder = $_POST['sort'];
    $limit = $_POST['limit'];

    $words = tokenizeText($text);


    $wordCounts = calculateWordFrequencies($words);

    $sortedWordCounts = sortWords($wordCounts, $sortOrder);

    displayWordFrequencies($sortedWordCounts, $limit);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Word Frequency Counter</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="https://fonts.cdnfonts.com/css/edo-sz" rel="stylesheet">
                

</head>
<body>
    <h1>Word Frequency Counter</h1>
    
    <form action="index.php" method="post">
        <label for="text">Paste your text here:</label><br>
        <textarea id="text" name="text" rows="10" cols="50" required></textarea><br><br>
        
        <label for="sort">Sort by frequency:</label>
        <select id="sort" name="sort">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select><br><br>
        
        <label for="limit">Number of words to display:</label>
        <input type="number" id="limit" name="limit" value="10" min="1"><br><br>
        
        <input type="submit" value="Calculate Word Frequency">
    </form>
</body>
</html>
