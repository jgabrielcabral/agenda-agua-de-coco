## Sobre o Sistema de Agendamento de Auditório do Centro de Eventos

O teste consiste no desenvolvimento de pequeno sistema para agendamento de auditório em um centro de eventos. Devido ao tempo limitado será compreensível a simplificação e ausência de funcionalidades. O objetivo principal do teste é a construção de um CRUD utilizando algum framework PHP.

## Requisitos de Sistema

- Framework Laravel 7.x
- PHP >= 7.2.5
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Servidor de Banco de Dados MySQL/MariaDB
- Navegador Chrome

## Configuração Local Inicial

* Executar o comando para clonar o repositório: 
    * ```git clone https://github.com/jgabrielcabral/agenda-agua-de-coco.git```
* Criar o arquivo .env no diretório raiz do projeto
* Copiar o conteúdo do arquivo .env.example para o arquivo .env
* Configurar o arquivo .env com as variáveis de ambiente para o carregamento do banco de dados
* Executar o comando de geração de chaves do Laravel: 
    * ```php artisan key:generate```
* Executar o comando de instalação das dependências do projeto:
    * ```composer install```
* Executar o comando de reconhecimento das classes:
    * ```composer dump-autoload```
* Executar o comando de construção e preenchimento do banco de dados:
    * ```php artisan migrate --seed```
* Executar o comando de instalação das dependências do front:
    * ```npm install```
* Executar o comando para rodar o ambiente de front local:
    * ```npm run dev```
* Executar o comando para rodar o ambiente de teste local:
    * ```php artisan serve```
* Acesse o sistema no navegador clicando [aqui](http://127.0.0.1:8000/)
* Utilizar a funcionalidade de resgistrar para criar um novo usuário
