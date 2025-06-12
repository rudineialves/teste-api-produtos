
//encapsula o código em uma funçao jquery para evitar conflito de variaveis
//e de bibliotecas javascript quando utilizando outras além do jquery
(function($){

    let dataHolder;
    
    function loadProdutos()
    {
        dataHolder.html('<div class="alert alert-primary" role="alert"><span class="spinner-border" role="status"></span> Carregando...</div>');

        $.ajax({
            url: 'api/produtos/'+$('#sku').val(),           
			type: 'GET',
            headers: {
                'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxIiwibmFtZSI6IlVzZXIgVGVzdGUiLCJyb2xlIjoiMSJ9.mpFtMLGIEHYBWeGTk9aTc5RcuDGPNFP_Y9udaFuh3-8'
            },            
            dataType: 'json',
            success: function(result)
            {
                let content = '';
                content += '<li class="bg-primary text-center text-white list-group-item">';
                content +=    '<div class="row">';
                content +=    '<div class="col-lg-2 col-sm-6">SKU</div>';            
                content +=    '<div class="col-lg-6 col-sm-6">NOME</div>';           
                content +=    '<div class="col-lg-2 col-sm-6">PREÇO</div>';           
                content +=    '<div class="col-lg-2 col-sm-6">QUANTIDADE</div>';
                content += '</div>';
                content += '</li>';

                $.each(result, function(i, item)
                {   
                    content += '<li class="list-group-item">';
                    content +=    '<div class="row">';
                    content +=      '<div class="col-lg-2 col-sm-6">'+item.sku+'</div>';            
                    content +=      '<div class="col-lg-6 col-sm-6">'+item.nome+'</div>';           
                    content +=      '<div class="col-lg-2 col-sm-6">'+item.preco+'</div>';           
                    content +=      '<div class="col-lg-2 col-sm-6">'+item.quantidade+'</div>';
                    content +=    '</div>';
                    content += '</li>';
                });

                dataHolder.html(content);   
            }
        });
    }


    //INIT - inicia as funções no onload
    $(function(){
        dataHolder = $('#data-holder');
        $('#btn-src-send').click(loadProdutos);
    });

})(jQuery);