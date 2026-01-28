# Projeto de TCC PUCRS - Lucas dos Santos Andrade
  - Projeto desenvolvido em Laravel v12 [https://laravel.com/]

# Dependências / Bibliotecas
  
  - tailwindcss@^3 [https://tailwindcss.com/]
  - alpinejs [https://alpinejs.dev/]
  - quilljs [https://quilljs.com/]
  - knuckleswtf/scribe [https://scribe.knuckles.wtf/laravel/]

# Banco de dados
  - MariaDB v11.6.2

# Instruções para instalação / configuração do projeto
- Faça um clone o repositório
- Copie o arquivo .env.example para .env na raiz do projeto e defina os valores das variáveis
- Instale as bibliotecas e dependências via composer e npm através dos comandos
`npm install`
`composer install`
- Compile os estilos
`npm run build` 
- Crie um banco de dados e insira o nome no arquivo .env
- Execute as migrate para criação das tabelas do banco de dados
`php artisan migrate:fresh`
Caso queira dados fictícios, utilize:
`php artisan migrate:fresh --seed` 
