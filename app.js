
var fechaDigitada = document.querySelector("#fechaDigitada");

//corregir, usar onClick
document.querySelector(".consultar").addEventListener("click", consultar);

function consultar(){
    // alert(fechaDigitada.value)

    fetch("backend.php")
    .then(response => {
        if (!response.ok) {
            throw new Error("error al obtener los datos");
        }
        return response.json();
    })
    .then(data => {
        const divTipoCambio = document.getElementById("tablaContenidos");
        const unaFila = document.createElement("tr");
        
        // divTipoCambio.innerHTML = `
        //         <tr>
        //             <th scope="row">${data.fecha}</th>
        //             <td>${data.moneda}</td>
        //             <td>${data.precioCompra}</td>
        //             <td>${data.precioVenta}</td>
        //         </tr>
        // `;
        // console.log(data);
    })
    .catch(error => {
        console.error("Error:", error);
        document.getElementById("tipoCambio").innerText = "Error al cargar los datos.";
    });
}