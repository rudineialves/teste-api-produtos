
# 📦 API de Produtos com Autenticação JWT

Esta é uma API RESTful para gerenciamento de produtos, protegida com autenticação via **JSON Web Token (JWT)**.  
Ela permite **cadastrar produtos**, **listar todos**, **consultar por SKU** e **atualizar dados**.

---

## 🔐 Autenticação

Todas as rotas exigem um token JWT válido no cabeçalho da requisição:

```
Authorization: Bearer <seu_token_aqui>
```

---

## 🚀 Endpoints

### 🔸 Cadastrar Produto

**POST** `/api/produtos`

#### 📥 Requisição:

```json
{
  "sku": "00123",
  "nome": "Produto Teste",
  "preco": 199.99,
  "quantidade": 50
}
```

#### ✅ Respostas:
- `201 Created` – Produto cadastrado com sucesso.
- `400 Bad Request` – Dados inválidos ou SKU já existente.
- `401 Unauthorized` – Token JWT ausente ou inválido.

---

### 🔹 Listar Todos os Produtos

**GET** `/api/produtos`

#### 📥 Requisição:
Sem parâmetros adicionais.

#### ✅ Resposta (exemplo):

```json
[
  {
    "sku": "00123",
    "nome": "Produto Teste",
    "preco": 199.99,
    "quantidade": 50
  },
  {
    "sku": "00124",
    "nome": "Produto Exemplo",
    "preco": 299.90,
    "quantidade": 100
  }
]
```

- `200 OK`
- `401 Unauthorized`

---

### 🔍 Consultar Produto por SKU

**GET** `/api/produtos/{sku}`

#### 🔎 Exemplo:
```
GET /api/produtos/00123
```

#### ✅ Resposta (exemplo):

```json
{
  "sku": "00123",
  "nome": "Produto Teste",
  "preco": 199.99,
  "quantidade": 50
}
```

- `200 OK`
- `404 Not Found` – SKU não encontrado.
- `401 Unauthorized`

---

### ✏️ Atualizar Produto

**PATCH** `/api/produtos/{sku}`

#### 🔧 Exemplo:
```
PATCH /api/produtos/00123
```

#### 📥 Requisição:

```json
{
  "nome": "Novo nome do produto",
  "preco": 149.99,
  "quantidade": 30
}
```

> Só envie os campos que deseja atualizar.

#### ✅ Respostas:
- `200 OK` – Produto atualizado.
- `400 Bad Request` – Dados inválidos.
- `404 Not Found` – SKU não encontrado.
- `401 Unauthorized` – Token ausente ou inválido.

---

## 📌 Regras e Validações

- O campo **`sku`** deve ser **único**.
- O campo **`preco`** deve ser numérico e positivo.
- O campo **`quantidade`** deve ser um número inteiro positivo.
- Todas as rotas são protegidas e exigem **JWT**.

---

## 🔄 Fluxo de Autenticação com JWT

1. O usuário faz login e recebe um token JWT.
2. Esse token deve ser incluído no cabeçalho `Authorization` em todas as requisições seguintes.

---

## 🧪 Tecnologias Utilizadas

- **Node.js / Express** ou **PHP / Laravel** (dependendo da implementação)  
- **JWT (JSON Web Token)**  
- **RESTful API**  
- **Banco de Dados Relacional (MySQL / PostgreSQL)**  

---

## 📄 Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

---
