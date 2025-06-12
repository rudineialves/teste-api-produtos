<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Produtos</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body class="m-3">
    <div class="card mx-auto" style="max-width:3020px;"">
        <div class="card-header">
            <div class="form-group col-lg-4 col-md-6 col-sm-8">
                <label>Informe o código SKU</label>
                <div class="input-group">
                    <input id="sku" class="form-control" type="text">
                    <span class="input-group-append">
                        <button id="btn-src-send" class="btn btn-primary" type="button">Buscar</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul id="data-holder" class="list-group">

            </ul>
        </div>
    </div>
</body>
<script src="js/lista_produtos.js"></script>
</html>