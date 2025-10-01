<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Busca com Resultados</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="search-container">
    <h2>Buscar</h2>
    <form action="index.php" method="GET"> <!-- 3. Usando GET -->
        <input type="text" name="tema" placeholder="Digite sua busca...">
        <input type="submit" value="Buscar">
    </form>
</div>

<div class="result-container">
    <h3>Resultados:</h3>

<?php 
$tema = ''; // captura o valor do campo de busca
$itens = []; // array para armazenar os itens correspondentes ao tema e exibir os resultados
$erro = ''; // variável para armazenar mensagens de erro que serao exibidas ao usuario caso caia nas condicoes de erro

if (isset($_GET['tema'])){
    $tema = trim($_GET['tema']); // Remove espaços em branco extras

    // 1. Validação da Entrada (vai verificar se o campo não está vazio e se contém apenas letras e espaços)
    //preg_match verifica se o usuario digitou apenas letras, se tiver apenas letras retorna true e segue a operação, se tiver qualquer outro caractere retorna false e cai na condição do else

    if (!empty($tema) && preg_match('/^[a-zA-Z\s]+$/', $tema)) {
    // strtolower converte o tema para minúsculas para facilitar a comparação

        switch(strtolower($tema)){
        case 'livros':
            $itens = ['Sapiens', 'Exodus', 'O cortiço', 'Percy Jackson', 'Habitos atômicos'];
            break;
        case 'jogos':
            $itens = ['kingdom come deliverance', 'the witcher 3', 'cyberpunk 2077', 'final fantasy 7', 'call of duty'];
            break;
        case 'filmes':
            $itens = ['Hora do rush', 'Uma noite no museu', 'Vingadores', 'Velozes e furiosos', 'Homem de ferro'];
            break;       
        default:
            $erro = 'Tema inválido. Por favor, escolha entre "livros", "jogos" ou "filmes".';
            break;     
    }        
    }else {
        $erro = 'Entrada inválida. Por favor, use apenas letras e espaços.'; // Só vai cair nessa condicao se o campo estiver vazio ou tiver caracteres inválidos
    }
}
// 2. Formato de exibição dos resultados
if (!empty($erro)){
    echo "<p class='error'>$erro</p>";
}
// Caso a validação seja bem-sucedida e existam itens para exibir
if (!empty($itens)){
    echo "<p> Resultados para '<strong>" . htmlspecialchars($tema) . "</strong>':</p>";
    // tag <ol> usada para criar uma lista ordenada
    // tag <li> usada para definir cada item da lista
    echo "<ol>";

// laço de repetição para exibir cada item do lista, onde, enquanto o contador $i for menor que a quantidade de itens no array, ele vai continuar executando o bloco de código dentro do laço
    for($i = 0; $i < count($itens); $i++){
        echo "<li>" . htmlspecialchars($itens[$i]) . "</li>";
    }

    echo "</ol>";
}

?>
</div>
</body>
</html>

