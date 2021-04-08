let listaProjetos = [];
let api = "./../../api/src/rest";

function filtrar (el) {
    let filtrado = listaProjetos.filter((e)=>{
        if (e.nome.toLowerCase().indexOf(el.value.toLowerCase())>=0) {
            return true;
        }else{
            return false;
        }
    });
    addItensGrid (filtrado);
}

function listar () {
    fetch(`${api}/projeto.php`, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        mode: 'cors',
        cache: 'default',
        body: JSON.stringify({
            metodo: 'listar'
        })
    }).then((response)=>{
        if (response.ok) return response.json();
    }).then((data)=>{
        if (data.success) {
            listaProjetos = data.data

            // add itens em table
            addItensGrid(listaProjetos);
        }else{
            alert(data.msg);
        }
    });
}
listar();

function addItensGrid (lista) {
    let tbody = document.querySelector('tbody');
    tbody.innerHTML = "";

    lista.forEach((e)=>{
        let tr = document.createElement('tr');
        tr.innerHTML = `<td>${e.id}</td>`;
        tr.innerHTML += `<td>${e.nome}</td>`;
        tr.innerHTML += `<td>${e.descricao}</td>`;
        tr.innerHTML += `<td>${e.ativo}</td>`;
        tr.innerHTML += `<td>${formata_data_hora(e.data_cadastro)}</td>`;
        tr.innerHTML += `<td>${formata_data_hora(e.data_edicao)}</td>`;
        tr.innerHTML += `<td>
            <div class="group-btn">
            <button class="btn btb-default" onclick="edit(${e.id})">
                <i class="glyphicon glyphicon-edit"></i>
            </button>
            <button class="btn btb-default" onclick="remover(${e.id})">
                <i class="glyphicon glyphicon-remove-sign"></i>
            </button>
        </div>
        </td>`;

        tbody.appendChild(tr);
    });
}

function toggle (view) {
    if (view==='form') {
        document.querySelector("#form").style.display = 'block';
        document.querySelector("#grid").style.display = 'none';
    }else{
        document.querySelector("#form").style.display = 'none';
        document.querySelector("#grid").style.display = 'block';
    }
    // resetando form 
    document.forms[0].reset();
    document.forms[0].querySelector("input[name=id]").value = "";

    var inputs = document.querySelectorAll('input[number]');
    inputs.forEach((el)=>{el.parentElement.style.display = 'none'});
}

function edit (id) {
    let result = null;
    listaProjetos.forEach((e)=>{
        if (parseInt(e.id) === parseInt(id)) {
            result = e;
        }
    });

    // chamando o form
    toggle('form');

    // alimentando valores
    document.forms[0].querySelector("input[name=id]").value = result.id;
    document.forms[0].querySelector("input[name=nome]").value = result.nome;
    document.forms[0].querySelector("input[name=descricao]").value = result.descricao;
    document.forms[0].querySelector("select[name=ativo]").value = result.ativo;
}

function salvar () {

    // capturando o id do form
    let obj = {};
    obj.id = document.forms[0].querySelector("input[name=id]").value;

    // descobrindo o objeto por id no array
    listaProjetos.forEach((e)=>{
        if (Number(e.id) === Number(obj.id)) {
            obj = e;
        }
    });

    // resgata valores
    obj.nome = document.forms[0].querySelector("input[name=nome]").value;
    obj.descricao = document.forms[0].querySelector("input[name=descricao]").value;
    obj.ativo = document.forms[0].querySelector("select[name=ativo]").value;

    let metodo = 'cadastrar';
    if (obj.id>0) metodo = 'atualizar';

    fetch(`${api}/projeto.php`, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        mode: 'cors',
        cache: 'default',
        body: JSON.stringify({
            metodo: metodo,
            data: obj
        })
    }).then((response)=>{
        if (response.ok) return response.json();
    }).then((data)=>{
        if (data.success) {
            toggle();
            listar();
        }else{
            alert(data.msg);
        }
    });
}

function remover (id) {

    let r = confirm("Deseja remover este projeto da lista?");
    if (r) {
        fetch(`${api}/projeto.php`, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            mode: 'cors',
            cache: 'default',
            body: JSON.stringify({
                metodo: 'remover',
                id: id
            })
        }).then((response)=>{
            if (response.ok) return response.json();
        }).then((data)=>{
            if (data.success) {
                alert('projeto removido com sucesso!');
                listar();
            }else{
                alert(data.msg);
            }
        });
    }
}