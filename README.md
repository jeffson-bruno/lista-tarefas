# 📋 Lista de Tarefas (To-Do List) em PHP

Uma aplicação simples e funcional de **Lista de Tarefas**, desenvolvida com foco em organização, CRUD completo, boas práticas em PHP e interface moderna com Bootstrap.

---

## 🚀 Tecnologias Utilizadas

| Tecnologia | Finalidade |
|------------|------------|
| PHP        | Lógica backend e conexão com banco de dados |
| MySQL      | Armazenamento das tarefas |
| Bootstrap  | Estilização moderna e responsiva |
| jQuery     | Manipulação de eventos e interatividade |
| JavaScript | Complemento visual e comportamental |
| HTML/CSS   | Estruturação e layout das páginas |

---

## 📌 Funcionalidades

✔ Login simples (admin)  
✔ Adicionar tarefas  
✔ Listar tarefas  
✔ Separação automática entre **Pendentes** e **Concluídas**  
✔ Atualização de status das tarefas  
✔ Edição (modal Bootstrap)  
✔ Exclusão de tarefas  
✔ Interface responsiva e organizada  

---

## 🎯 Estrutura Visual

### 🔐 Tela de Login
https://github.com/jeffson-bruno/lista-tarefas/issues/1#issue-3655268667

---

### 📄 Dashboard Inicial
![Dashboard](./Captura%20de%20tela%202025-11-22%20210046.png)

---

### 📝 Tarefas Pendentes
![Tarefas Pendentes](./Captura%20de%20tela%202025-11-22%20210223.png)

---

### ✏ Modal de Edição
![Modal de Edição](./Captura%20de%20tela%202025-11-22%20210248.png)

---

### 🟢 Tarefas Concluídas
![Tarefas Concluídas](./Captura%20de%20tela%202025-11-22%20210313.png)

---

## ⚙️ Como Rodar a Aplicação Localmente

### 📁 1. Clonar o repositório

```bash
git clone https://github.com/seu-usuario/lista-de-tarefas-php.git
cd lista-de-tarefas-php

### 2. Criar o Banco de Dados MySQL

Acesse o PhpMyAdmin ou similar e execute:

CREATE DATABASE lista_tarefas CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE lista_tarefas;

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    status ENUM('pendente', 'concluida') DEFAULT 'pendente',
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
);


### 3. Ajustar credenciais no arquivo de conexão

No arquivo: config/db.php
Defina seu usuário e senha do MySQL:

$host = 'localhost';
$dbname = 'lista_tarefas';
$user = 'root'; 
$password = '';

### 4. Rodar no navegador

 php -S localhost:8000

### Estrutura de Pastas

lista-de-tarefas-php/
    ├─ config/
    │  └─ db.php
    ├─ assets/
    │  ├─ css/
    │  │  └─ style.css
    │  └─ js/
    │     └─ app.js
    ├─ index.php
    ├─ login.php
    ├─ logout.php
    ├─ salvar_tarefa.php
    ├─ concluir_tarefa.php
    ├─ excluir_tarefa.php
    ├─ atualizar_tarefa.php
    ├─ README.md
    └─ .gitignore
