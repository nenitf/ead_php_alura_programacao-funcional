# ead_php_alura_programacao-funcional

> Projeto referente a [este](https://cursos.alura.com.br/course/php-programacao-funcional) curso.

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

- Anotações são do tipo `callable`
- Closure (no PHP é uma classe que é instanciada a cada função anônima) é uma função que tem acesso ao **escopo externo** (no PHP precisar usar `use ($varExterna1, $varExterna2)`)
    > O termo "bonitinho" é escopo léxico. Uma closure, quando falamos de programação funcional, possui escopo léxico, ou seja, tem acesso ao escopo de onde ela foi definida.
