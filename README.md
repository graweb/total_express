## Configuração do Projeto

Verifique se o Docker está instalado em sua máquina

1. [Docker](https://www.docker.com/).
2. Crie o arquivo .env com o comando ```.env (cp .env.example .env)``` e adicione as configurações do banco de dados
3. Rode os comandos ```composer install``` (fora do container)
4. Rode o comando ```php artisan key:generate```
5. Na pasta do projeto, rode o comando ```./vendor/bin/sail up -d```
6. Acesse o container onde está o projeto ```docker exec -it container-name sh``` e rode os comandos ```php artisan migrate``` e ```php artisan db:seed```
7. Dê permissão na pasta storage (opcional)

## Testes
1. Acesse o container onde está o projeto ```docker exec -it container-name sh```
2. Rode o comando ```php artisan test``` para executar todos os testes

## Executando o Job
1. Acesse o container onde está o projeto ```docker exec -it container-name sh```
2. Rode o comando ```php artisan schedule:run``` para gerar na tabela jobs
3. Rode o comando ```php artisan queue:work``` para disparar o job

# Rotas
- http://localhost/api/login (POST - parâmetros: email e senha)
- http://localhost/api/logout (POST - precisa do bearer token)
- http://localhost/api/pedido (GET - precisa do bearer token - parâmetros: id e usuario_id)
- http://localhost/api/pedido (POST - precisa do bearer token - enviar um array)
- http://localhost/api/pedido/1 (PUT - precisa do bearer token - enviar o id para atualizar na rota)

## Extra
- Instalei um plugin chamado APIDOC que desenvolvi para documentar a API. Para acessar basta colocar a seguinte url ```localhost/apidoc```
- Anexei o arquivo (TOTAL EXPRESS.postman_collection) do postman para facilitar os testes

## Usuários de teste

- ```user@totalexpress.com.br / senha```
