function adicionaElementos() {
        console.log("funfa");
        var tableRef = document.getElementById('tabelaAparelhos').getElementsByTagName('tbody')[0];
        var arcondicionado = tableRef.insertRow(tableRef.rows.lenght);
        
        var nomeAparelho = arcondicionado.insertCell(0);
        var nomeAparelhoTexto = document.createTextNode('TV LG');
        
        var estadoAparelho = arcondicionado.insertCell(1);
        estadoAparelho.innerHTML = '<span class="mif-checkmark fg-green"></span>';
        
        var botaoSwitch = arcondicionado.insertCell(2);
        botaoSwitch.innerHTML = '<label class="switch-original"><input type="checkbox" checked><span class="check"></span></label>';
        
        var botoesGerenciarAparelho = arcondicionado.insertCell(3);
        botoesGerenciarAparelho.innerHTML = '<button class="button warning" onclick="location.href=\'atualizar.html\'"><span class="mif-loop2"></span> Atualizar Cadastro</button><button class="button alert"onclick="location.href=\'index.html\'"><span class="mif-minus"></span> Remover Aparelho</button>';
        
        nomeAparelho.appendChild(nomeAparelhoTexto);
        
    }
    window.onload = adicionaElementos;