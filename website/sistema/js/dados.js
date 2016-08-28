// Define o valor de KwH
var valorKwh = 0.55;

// gffgd
var links;
d3.json("sys_kwh.php", function(error, $json_data) {
	links = $json_data;

	console.log(links);

});

// Exibe o valor definido em KwH
function exibirValorKwh(kwh){
	document.getElementById("custo").innerHTML = "Custo kW/h: R$ "+valorKwh;
}

// Listener para modificar valor quando a pagica carregar completamente
window.onload = exibirValorKwh();