document.addEventListener("DOMContentLoaded", () => {
    fetch('get_pedidos.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('tbody');
            data.forEach(pedido => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${pedido.id}</td>
                    <td>${pedido.cliente}</td>
                    <td>${pedido.data}</td>
                    <td>${pedido.status}</td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => console.error('Erro ao buscar pedidos:', error));
});
