# Madatech Task Manager

![Logo do Projeto](public/icons/favicon.ico)

Um gerenciador de tarefas desenvolvido com CodeIgniter 4, que inclui frontend e API RESTful.

## Visão Geral

Sistema web para gerenciamento de tarefas, o frontend permite uma interação direta com a API Restful,
que pode também ser consumida de forma independente. Cheque o arquivo app/Config/Routes.php 
ou o final desse arquivo para mais informações sobre as rotas


### Pré-requisitos
- PHP 7.4 ou superior
- Composer
- MySQL/MariaDB
- Git (opcional)
- OBSERVAÇÃO: Vá até o seu arquivo php.ini, abra-o como documento de texto e ative a extensão "extension=intl" removendo o ";" no início da linha
### Instalação

1. Clone o repositório:
    - Abra um terminal e vá até a pasta que deseja armazenar o projeto
    - Execeute os comandos:
    - git clone https://github.com/Hendrixtrab/taskmanager
    - cd task-manager

2. Instale as dependências:
    - Execute o comando:
    - composer install

3. Crie um banco de dados mysql/mariadb para a aplicação

4. Renomeie o arquivo .env-base para:
    - .env

5. Configure o arquivo .env
    - Coloque o nome do banco recém-criado após o "=" na linha:
    - database.default.database =
    - Coloque as suas credenciais de conexão nas linhas:
    - database.default.username = 
    - database.default.password = 
    - Ajuste o port para corresponder ao utilizado na sua conexão (por padrão: 3306)
    - database.default.port = 3306

6. Crie as tabelas:
    - (Opção 1): Execute o seguinte comando no terminal:
    - php spark migrate

    - (Opção 2): Execute o arquivo app/Database/tasks.sql dentro do seu sgbd

7. Inicie o servidor:
    - Execute o seguinte comando no terminal:
    - php spark serve

8. Abra a aplicação:
    - Acesse o link exibido no terminal após o último passo (por padrão: http://localhost:8080)


### Possíveis Erros:
Problemas com o SSL: É possível que sua conexão bloqueie alguma instalação do composer, caso isso aconteça, tente desligar seu antivírus e execute o comando novamente.

Verifique atentamente os ports utilizados na aplicação e confira se batem com os utilizados em seu computador, o codeigniter 4 irá usar portas subsequentes (8081, 8082, ...) caso a 8080 já esteja sendo utilizada.

Erros de Extensão: Como mencionado ao começo, o codeigniter precisa da extensão intl para funcionar adequadamente, caso enfrente erros na execução dessa aplicação, tente acessar seu arquivo php.ini e procure pela linha: extension=intl, e certifique-se de que não há um ";" no começo da linha. Certifique-se também de que a extensão zip também está habilitada. 

### Rotas para consumo da API Rest:

- http://localhost:8080/api/listar -> Lista as tarefas 
- http://localhost:8080/api/cadastrar -> Cadastra uma tarefa
- http://localhost:8080/api/visualizar/(id da tarefa) -> Visualiza uma tarefa específica
- http://localhost:8080/api/editar/(id da tarefa) -> Edita uma tarefa específica
- http://localhost:8080/api/excluir/(id da tarefa) -> Deleta uma tarefa específica



Caso possua dúvidas, contate: hendrikguarneri1234@gmail.com ou hendrikprofissional@gmail.com