# Sistema de Login (com JWT) - Back-end

🚀 _Criado para fins de estudo_

Projeto criado para consolidar os conhecimentos em Laravel na questão da _autenticação via JWT (JSON Web Token)_. 
<br /> <br />
Veja o [Front-End do projeto](https://github.com/Francisco-Fetapi/sistema-login-front-end) para mais informações.

# Pré-requisitos para rodar o sistema localmente
Por ser um projeto de estudo não me preocupei em hospedá-lo, mas caso queiras ver o projeto rodando, eis abaixo alguns elementos que precisas ter instalado em sua máquina.

1. Servidor APACHE e MySQL (para instalar podes usar o XAMPP ou aplicativos similares)
2. Composer
3. Algum Navegador (Óbvio😅)

# Passos para rodar o projeto localmente

Com essas ferramentas instaladas o próximo passo é clonar o repositório:
```
git clone https://github.com/Francisco-Fetapi/sistema-login-jwt-back-end.git
```

Depois de clonar o repositório, acessar a pasta do projeto via terminal e instalar todas as dependencias do projeto:
```
composer install
```

Após todas as dependencias serem instaladas deve-se criar o banco de dados do projeto. Acesse algum SGBD e crie um banco de dados com o nome **"autenticacao_jwt"** como se vê na imagem abaixo (com PHPMyAdmin):

![#1](https://user-images.githubusercontent.com/74926014/176718192-a70b816b-e747-41ca-90cd-21a3b51817e4.PNG)

Com o banco de dados criado só nos resta executar as _migrations_ para criar as tabelas. Execute o comando abaixo na raiz do projeto:

```
php artisan migrate
```

O processo de criação das tabelas vai levar alguns segundos, depois de terminado, basta rodar o projeto com o comando:
```
php artisan serve
```
##

`NOTA:` Esta é apenas a API, para ver o projeto rodando acesse o front-end [clicando aqui](https://github.com/Francisco-Fetapi/sistema-login-front-end)
