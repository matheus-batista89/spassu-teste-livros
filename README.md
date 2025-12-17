# 📚 Sistema de Cadastro de Livros

Sistema web desenvolvido para a gestão de livros, autores e assuntos, com foco em organização, usabilidade e separação clara de responsabilidades. O projeto utiliza PHP 8.3 e Laravel 12, adotando boas práticas de arquitetura, relacionamentos muitos-para-muitos e testes automatizados.

A aplicação permite o cadastro completo de livros, associação com múltiplos autores e assuntos, além da geração de relatórios em PDF, oferecendo uma interface moderna e responsiva baseada em Bootstrap.

---

## ⚙️ Tecnologias Utilizadas

- **PHP 8.3**
- **Laravel 12**
- **MySQL 8.0**
- **Vite** (gerenciamento de assets frontend)
- **Bootstrap 5**
- **DataTables**
- **Composer**
- **Node.js / npm**
---

## 🚀 Funcionalidades

- **Cadastro de Livros**
  - Título
  - Editora
  - Edição
  - Ano de Publicação
  - Valor (R$)
  - Associação com múltiplos autores
  - Associação com múltiplos assuntos

- **Gerenciamento de Autores**
  - Cadastro, edição, listagem e exclusão (CRUD completo)

- **Gerenciamento de Assuntos**
  - Cadastro, edição, listagem e exclusão (CRUD completo)

- **Relatórios**
  - Geração de relatórios em PDF agrupados por autor

- **Interface Web**
  - Layout responsivo
  - Navegação intuitiva
  - Integração com DataTables (paginação, ordenação e busca)

- **Qualidade e Manutenibilidade**
  - Camada de Services para centralização das regras de negócio
  - Testes automatizados com PHPUnit

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
O projeto conta com testes automatizados para garantir a integridade das regras de negócio e o correto funcionamento das operações principais.

Para executar os testes, utilize o comando:
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


