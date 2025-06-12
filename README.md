
# Teste API de Produtos

## Autenticação

Esta API utiliza autenticação JWT (JSON Web Token). Para acessar os endpoints, é necessário incluir o token no cabeçalho da requisição:

```
Authorization: Bearer <seu_token_aqui>
```

---

## ENDPOINTS

### Cadastrar Produto

**POST** `/api/produtos`

**Requisição:**

```json
{
  "sku": "00123",
  "nome": "Produto Teste",
  "preco": 199.99,
  "quantidade": 50
}
```

---

### Listar Todos os Produtos

**GET** `/api/produtos`

**Requisição:**

Sem parâmetros adicionais.

---

### Consultar Produto por SKU

**GET** `/api/produtos/{sku}`

**Exemplo:**

```
GET /api/produtos/00123
```

---

### Atualizar Produto

**PATCH** `/api/produtos/{sku}`

**Exemplo:**

```
PATCH /api/produtos/00123
```

**Requisição:**

```json
{
  "nome": "Novo nome do produto",
  "preco": 149.99,
  "quantidade": 30
}
```

*Só envie os campos que deseja atualizar.*
 
