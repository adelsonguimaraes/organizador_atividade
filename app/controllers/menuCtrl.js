document.addEventListener("DOMContentLoaded", function(event) {
    let api = "./../../api/src/rest";
    let menu = document.querySelector('menu');

    fetch(`${api}/menu.php`, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        mode: 'cors',
        cache: 'default',
        body: JSON.stringify({
            metodo: "listar"
        })
    }).then((response)=>{
        if (response.ok) return response.json();
    }).then((data)=>{
        if (data.success) {
            let html = '';
            data.data.forEach(e => {
                let active = '';
                if (window.location.href.toLowerCase().indexOf(e.menu.toLowerCase()+'.html')!==-1) {
                    active = 'active';
                }
                html += `
                    <a class="${active}" href="${e.link}" title="${e.menu}">
                        <i class="${e.icon}"></i> 
                        ${e.menu}
                    </a>
                `;
                menu.innerHTML = html;
            });
        }else{
            alert(data.msg);
        }
    });
});