let listaUsuarios = [];
let api = "./../../api/src/rest";

function filtrar (el) {
    let filtrado = listaUsuarios.filter((e)=>{
        if (e.nome.toLowerCase().indexOf(el.value.toLowerCase())>=0) {
            return true;
        }else{
            return false;
        }
    });
    addItensGrid (filtrado);
}

function listar () {
    fetch(`${api}/usuario.php`, {
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
            listaUsuarios = data.data

            // add itens em table
            addItensGrid(listaUsuarios);
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
        tr.innerHTML += `<td>${e.celular1}</td>`;
        tr.innerHTML += `<td>${e.celular2}</td>`;
        tr.innerHTML += `<td>${e.email}</td>`;
        tr.innerHTML += `<td>${e.ultimo_acesso}</td>`;
        tr.innerHTML += `<td>${e.data_cadastro}</td>`;
        tr.innerHTML += `<td>${e.data_edicao}</td>`;
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
    listaUsuarios.forEach((e)=>{
        if (parseInt(e.id) === parseInt(id)) {
            result = e;
        }
    });

    // chamando o form
    toggle('form');

    // alimentando valores
    document.forms[0].querySelector("input[name=id]").value = result.id;
    document.forms[0].querySelector("input[name=nome]").value = result.nome;
    document.forms[0].querySelector("input[name=celular1]").value = result.celular1;
    document.forms[0].querySelector("input[name=celular2]").value = result.celular2;
    document.forms[0].querySelector("input[name=email]").value = result.email;
}

function salvar () {

    // capturando o id do form
    let obj = {};
    obj.id = document.forms[0].querySelector("input[name=id]").value;

    // descobrindo o objeto por id no array
    listaUsuarios.forEach((e)=>{
        if (Number(e.id) === Number(obj.id)) {
            obj = e;
        }
    });

    console.log(obj);

    // resgata valores
    obj.nome = document.forms[0].querySelector("input[name=nome]").value;
    obj.celular1 = document.forms[0].querySelector("input[name=celular1]").value;
    obj.celular2 = document.forms[0].querySelector("input[name=celular2]").value;
    obj.email = document.forms[0].querySelector("input[name=email]").value;
    obj.senha = document.forms[0].querySelector("input[name=senha]").value;

    let metodo = 'cadastrar';
    if (obj.id>0) metodo = 'atualizar';

    fetch(`${api}/usuario.php`, {
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

    let r = confirm("Deseja remover este usuário da lista?");
    if (r) {
        fetch(`${api}/usuario.php`, {
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
                alert('usuário removido com sucesso!');
                listar();
            }else{
                alert(data.msg);
            }
        });
    }
}