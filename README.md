# ead_php_alura_programacao-funcional

> Projeto referente a [este](https://cursos.alura.com.br/course/php-programacao-funcional) curso.

> [Repo de conhecimento](https://github.com/marcelgsantos/getting-started-with-fp-in-php) sobre fp em PHP

1. Crie o ambiente
```sh
docker-compose up -d
```
> Caso queira, ao final da configuração, pare o Docker com ``docker-compose down``

2. Baixe as dependências do composer
```sh
docker-compose exec app composer install
```

> Para criar autoload sem instalar as dependências ``docker-compose exec app composer du``

## Execução

- Caso recém tenha feito a **configuração inicial** e o ambiente continue rodando, tudo certo. Pode acessar ``localhost:8989/arquivo-script.php``
- Do contrário, suba o ambiente novamente:
```sh
docker-compose up
```
> Pare com <kbd>Ctrl</kbd><kbd>C</kbd>

> Caso modifique Dockerfile, rebuilde com ``docker-compose up --build``

> Para acessar o container use ``docker-compose exec app bash`` ou execute os scripts diretamente pelo Docker ``docker-compose exec app php public/arquivo-script.php``

## Anotações

- `<=>` [Space Ship](https://www.php.net/manual/pt_BR/migration70.new-features.php#migration70.new-features.spaceship-op) retorna 1 se o primeiro argumento for maior que o segundo, 0 se forem iguais e -1 se for menor. 
    ```php
    <?php

    echo 1 <=> 1; // 0
    echo 1 <=> 2; // -1
    echo 2 <=> 1; // 1
    ```
- `fn($x, $y) => $x + $y;` [Arrow Function/Short Closure](https://www.php.net/manual/pt_BR/functions.arrow.php) é igual ao javascript, porém deve ser em 1 linha e não aceita bloco `{}`

---

- Paradigma **funcional** é declarativo (programa **o que** deve ser feito) e o **procedural** é imperativo (programa **como** deve ser feito)
- Funções do PHP são **first-class functions** do tipo `callable` (quando usadas como parâmetro de outras funções são chamadas de **callback**)
- **Função pura** é uma função que dada a mesma entrada, sempre retornará a mesma saída e não tem efeitos colaterais
- Closure (no PHP é uma classe que é instanciada a cada função anônima) é uma função que tem acesso ao **escopo externo** (no PHP precisar usar `use ($varExterna1, $varExterna2)`)
    > O termo "bonitinho" é escopo léxico. Uma closure, quando falamos de programação funcional, possui escopo léxico, ou seja, tem acesso ao escopo de onde ela foi definida.
- É muito importante saber utilizar as funções corretas para tornar o código mais "semântico". Quer mapear um array? `map`. Reduzir? `reduce`. Filtrar? `filter` e etc, evite gambiarra, favoreça a legibilidade futura do algoritmo.
    > Evite pregar parafuso
- **High Order Function** (HOF) é uma função que opera sobre outras funções, ou seja, função que recebe outras por parâmetro, ou que retorna uma nova função
- **Currying** é o processo de "segmentar"/"preparar" a execução de uma função. Suas funções "filhas" são chamadas de **curried functions**
    - Técnica **partial application**: currying feito com uma função que possui múltiplos parâmetros por outras com quantidade menor (simplificando, pois um dos parametros foi "fixado"). Quando faz sentido usar? Quando o mesmo parâmetro é usado várias vezes em uma chamada de função.
- Composição de funções serve para facilitar a leitura de chamada de funções (ao invés de por uma dentro da outra por parâmetro). **Pipe** é esquerda -> direita, cima -> baixo. **Compose** é direita -> esquerda, baixo -> cima
    ```php
    <?php

    // ...

    $nomeDePaisesEmMaiusculo = fn($dados) => array_map('convertePaisParaLetraMaisucula', $dados);
    $filtraPaisesSemEspacoNoNome = array_filter($dados, $verificaSePaisTemEspacoNoNome);

    // ruim
    $dados = $nomeDePaisesEmMaiusculo($dados);
    $dados = $filtraPaisesSemEspacoNoNome($dados);

    // pior ainda (leitura de dentro para fora)
    $dados = $filtraPaisesSemEspacoNoNome($nomeDePaisesEmMaiusculo($dados));


    // solução sem lib de pipe:
    function pipe(callable ...$funcoes): callable
    {
        return fn ($firstParam) => array_reduce(
            $funcoes,
            fn ($currentParam, callable $funcaoAtual) => $funcaoAtual($currentParam),
            $firstParam
        );
    }

    $operacoes = pipe(
        $nomeDePaisesEmMaiusculo,       // primeiro este
        $filtraPaisesSemEspacoNoNome,   // depois este
        // ... mais extensível
    );
    $operacoes($dados);
    ```
- **Functors** é o tipo de dado que pode ser realizado um `map`. Em linguagens funcionais são dados que podem ser usados com `map` e linguagens *oo* são classes que possuam o método `map`
- **Mônada** tipo de dado que encapsula outro tipo
    - Importante em composição de funções para evitar *ifs* pouco legíveis. Esses *ifs* servem para dar continuidade na composição
    - As mais comuns são *Maybe* e *Optional*
