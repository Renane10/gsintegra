# gsintegra

**gsintegra** é um software desenvolvido para a centralização de integrações de sistemas.

## Pré-requisitos

Antes de começar, você precisa ter o [Composer](https://getcomposer.org/) instalado em seu ambiente. O Composer é uma ferramenta de gerenciamento de dependências para PHP.

## Instalação

1. Arrume o arquivo .env com suas configurações de banco

2. Clone o repositório:

   ```bash
   git clone https://github.com/Renane10/gsintegra.git
3. Navegue até o diretório do projeto:
    ```bash
    cd gsintegra
4. Instale as dependências do projeto usando o Composer. Isso criará a pasta vendor e instalará todas as bibliotecas necessárias:
    ```bash
    composer install
5. Execução de Migrations<br>
Para rodar as migrations e criar ou atualizar as tabelas no banco de dados, execute o seguinte comando:
     ```bash
   vendor/bin/phinx migrate
6. Execução de Seeds <br> Para popular o banco de dados com dados iniciais, execute o comando:
     ```bash
   vendor/bin/phinx seed:run
Agora você já pode logar usando o usuário e senha padrão<br>
Usuário: admin
Senha: 123
