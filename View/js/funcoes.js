let selectCategoria = document.getElementById('categoria');


selectCategoria.onchange = function(){
    let selectSubCategoria = document.getElementById('subcategoria');
    let valor = selectCategoria.value
    fetch("select.php?categoria="+ valor)
    .then (response=>{
        return response.text()
    })
   .then(texto=>{
    selectSubCategoria.innerHTML = texto
   })
}