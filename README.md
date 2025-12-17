# 📚 Sistema de Cadastro de Livros

Projeto desenvolvido com **PHP 8.3**, **Laravel 12**, **Vite** e **Bootstrap**, com o objetivo de gerenciar o cadastro de **livros**, **autores** e **assuntos**.

---

## ⚙️ Tecnologias Utilizadas

- **PHP 8.3**
- **Laravel 12**
- **Vite** (para assets frontend)
- **Bootstrap 5**
- **MySQL 8.0**

---

## 🚀 Funcionalidades

- Cadastro de livros com:
  - Título, Editora, Edição, Ano de Publicação, Valor (R$)
  - Múltiplos Autores
  - Múltiplos Assuntos
- Gerenciamento de autores (CRUD completo)
- Gerenciamento de assuntos (CRUD completo)
- Interface amigável com Bootstrap 5
- Relatórios em PDF agrupados por autor
- DataTables para listagens com paginação e busca

---

## 🛠️ Requisitos

- PHP 8.3
- Composer
- Node.js e npm
- MySQL 8.0
- Make (opcional)

---

## 📦 Instalação

```bash
# Clone o repositório

# Instale as dependências do PHP
composer install

# Instale as dependências do frontend
npm install

# Gere a chave da aplicação
php artisan key:generate

# Configure o banco de dados no arquivo .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=livros
# DB_USERNAME=laravel_user
# DB_PASSWORD=root

# Rode as migrações
php artisan migrate --seed

# Compile os assets
npm run build

# Inicie o projeto
make start
# ou
php artisan serve
```

---

## 🧪 Testes

```bash
php artisan test
```

---

## 📝 Estrutura do Projeto

```
spassu-teste-livros/
├── app/
│   ├── Http/Controllers/    # Controllers
│   ├── Models/               # Models Eloquent
│   └── Services/             # Lógica de negócio
├── database/
│   ├── migrations/           # Migrations do banco
│   └── seeders/              # Seeders
├── resources/
│   ├── views/                # Views Blade
│   ├── sass/                 # Estilos SCSS
│   └── js/                   # JavaScript
└── public/                   # Arquivos públicos
```

---

## 🎨 Melhorias Visuais

- Menu moderno com ícones Bootstrap Icons
- Destaque visual para página ativa
- Animações suaves em hover
- Design responsivo


