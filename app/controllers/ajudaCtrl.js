let listaComandos = [];
let api = "./../../api/src/rest";

function filtrar (el) {
    let filtrado = listaComandos.filter((e)=>{
        if (e.ajuda.toLowerCase().indexOf(el.value.toLowerCase())>=0) {
            return true;
        }else{
            return false;
        }
    });
    addItensGrid (filtrado);
}

function listar () {
    fetch(`${api}/ajuda.php`, {
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
            listaComandos = data.data

            // add itens em table
            addItensGrid(listaComandos);
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
        tr.innerHTML += `<td>${e.ajuda}</td>`;
        tr.innerHTML += `<td>${e.descricao}</td>`;
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
    listaComandos.forEach((e)=>{
        if (parseInt(e.id) === parseInt(id)) {
            result = e;
        }
    });

    // chamando o form
    toggle('form');

    // alimentando valores
    document.forms[0].querySelector("input[name=id]").value = result.id;
    document.forms[0].querySelector("input[name=ajuda]").value = result.ajuda;
    document.forms[0].querySelector("textarea[name=descricao]").value = result.descricao;
}

function salvar () {

    // resgata valores
    let obj = {};
    obj.id = document.forms[0].querySelector("input[name=id]").value;
    obj.ajuda = document.forms[0].querySelector("input[name=ajuda]").value;
    obj.descricao = document.forms[0].querySelector("textarea[name=descricao]").value;
    
    // verificando se o limite de carácteres foi respeitado
    if (obj.descricao.length>450) {
        return alert('Limite de 450 carácteres foi ultrapassado para a descrição.');
    }

    let metodo = 'cadastrar';
    if (obj.id>0) metodo = 'atualizar';

    fetch(`${api}/ajuda.php`, {
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
            // alert('ajuda atualizado com sucesso!');
            toggle();
            listar();
        }else{
            alert(data.msg);
        }
    });
}

function remover (id) {

    let r = confirm("Deseja remover este ajuda da lista?");
    if (r) {
        fetch(`${api}/ajuda.php`, {
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
                alert('ajuda removido com sucesso!');
                listar();
            }else{
                alert(data.msg);
            }
        });
    }
}