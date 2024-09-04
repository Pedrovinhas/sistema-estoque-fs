## 💡 Projeto
Projeto que visa simular um sistema de compras pelo cliente, permitindo o cadastro de estabelecimentos, produtos e categorias para ambos. Também é possível realizar pedidos comprando produtos de cada estabelecimento e visualizá-los em áreas específicas.

## Tecnologias

- [Laravel 10.x](https://laravel.com/docs/10.x/releases)
- [Vue 3](https://vuejs.org/guide/introduction.html)
- [Vuetify](https://vuetifyjs.com/en/)
- [PostgreSQL]()
- [Docker](https://www.docker.com/)

## Setup 

```sh
# Clone o repositório:
git clone https://github.com/Pedrovinhas/sistema-estoque-fs.git

# Navigate to the project directory:
cd sistema-estoque-fs
```

### Backend 
```sh
# Entre na pasta do backend
cd backend

# Copie o .env de exemplo e configure as variáveis
cp .env.example .env

# Build as imagens do container
docker-compose build

# Suba os containers da aplicação
docker-compose up -d

# Acesse o container
docker-compose exec sistema-estoque-back bash ou docker exec -it sistema-estoque-back bash

# No container do backend, instale as dependências
composer install

# Gere a chave da aplicação
php artisan key:generate

# Gere a chave JWT para a aplicação
php artisan jwt:secret

# Inicie a aplicação
php artisan serve --host 0.0.0.0
```

### Frontend
```sh
# Entre na pasta do frontend
cd frontend

# Construa o container
docker run --name sistema-estoque-front -it -d -v .:/application .

# Acesse o container
docker exec -it sistema-estoque-front bash

# No container do frontend, instale as dependências
npm install

# Copie o .env de exemplo e configure as variáveis
cp .env.example .env

# Inicie a aplicação
npm run dev
```

---
> Feito por [Pedro Henrique Vinhas 🪐](https://github.com/pedrovinhas)
