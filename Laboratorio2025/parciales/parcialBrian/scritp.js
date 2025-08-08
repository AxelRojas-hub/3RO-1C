const select = document.getElementById("idubicaciones");  
const productoSuggesterInput = document.getElementById("idproductoSuggester");
const tabla = document.getElementById("tbody");
const detallep=document.getElementById("tbody2");
// function get_productos(){
//     const select=document.getElementById("idubicaciones");    
//     const sucursal = select.value;
//     const tabla=document.getElementById("tbody");
//     tabla.innerHTML = "";
//     // console.log(tabla)
//     const mensajeroProductos = new XMLHttpRequest()
//     mensajeroProductos.open('POST', 'producto.php', true)
//     mensajeroProductos.onreadystatechange = ()=> {
//         if (mensajeroProductos.status === 200 && mensajeroProductos.readyState ===4) {
//                 const respuesta = JSON.parse(mensajeroProductos.responseText)
//                 const productos = respuesta
//                 for(const producto of productos){
//                     const tr=document.createElement('tr')
//                     tr.innerHTML =` 
//                     <td>${producto.nombreproducto}</td>
//                     <td>$${parseFloat(producto.precio).toFixed(2)}</td>
//                     <td>${producto.nombre}</td>
//                     <td>${producto.ubicacion}</td>
//                     `
//                     ;
//                     tabla.appendChild(tr);
//                 }
//         }
//     }
//     mensajeroProductos.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//     mensajeroProductos.send('sucursal=' + encodeURIComponent(sucursal));
// }

        
//     function busco_producto(){
//     const productoSuggesterInput = document.getElementById("idproductoSuggester");
//     const searchTerm = productoSuggesterInput.value;
//     if(searchTerm == ""){
//         return;
//     }
//     const tabla = document.getElementById("tbody");
//     tabla.innerHTML="";
//     var mensajeroSugerencias = new XMLHttpRequest();
//     // Abrimos la petición al nuevo PHP de sugerencias
//     mensajeroSugerencias.open('GET', 'comportamiento2.php?term=' + encodeURIComponent(searchTerm), true);

//     mensajeroSugerencias.onreadystatechange = function () {
//         if (mensajeroSugerencias.readyState == 4 && mensajeroSugerencias.status == 200) {
//             var suggestions = JSON.parse(mensajeroSugerencias.responseText);
//             // console.log(suggestions)
//             if (suggestions.length > 0) {
//                 // Si hay sugerencias, las mostramos
//                 for (const producto of suggestions){
//                     const tr = document.createElement('tr')
//                     tr.innerHTML = ` 
//                     <td>${producto.nombreproducto}</td>
//                     <td>$${parseFloat(producto.precio).toFixed(2)}</td>
//                     <td>${producto.nombre}</td>
//                     <td>${producto.ubicacion}</td>
//                     `
//                         ;
//                     tabla.appendChild(tr);
//                     }
                
//             }
            
//         }

//     };
//     mensajeroSugerencias.send(null);
// };

    function doble_filtrado(){
        const mensajerofiltros=new XMLHttpRequest();
        console.log(productoSuggesterInput.value);
        mensajerofiltros.open('GET','probando.php?term='+productoSuggesterInput.value+'&sucursal='+select.value,true);
        mensajerofiltros.onreadystatechange=function(){
            
            if(mensajerofiltros.readyState==4 && mensajerofiltros.status==200){
                tabla.innerHTML = "";
                const productos= JSON.parse(mensajerofiltros.responseText);
                console.log(productos);
                console.log(select.value)
                for (const producto of productos.supermercados) {
                    const tr = document.createElement('tr')
                    
                    tr.addEventListener('click',()=>{
                        detalle(producto.nombreProducto);    
                    })
                    tr.innerHTML = ` 
                    <td>${producto.nombreProducto}</td>
                    <td>$${parseFloat(producto.precio).toFixed(2)}</td>
                    <td>${producto.nombre}</td>
                    <td>${producto.ubicacion}</td>
                    `
                        ;
                    tabla.appendChild(tr);
                    
                }
            }
        }
        mensajerofiltros.send(null);


    }

    function detalle(nombre){
        const mensajeroDetalle=new XMLHttpRequest();
        console.log(nombre)
        mensajeroDetalle.open('GET',"detalle.php?nombre="+nombre,true);
        mensajeroDetalle.onreadystatechange = function () {
        if (mensajeroDetalle.readyState == 4 && mensajeroDetalle.status == 200) {
            const productos = JSON.parse(mensajeroDetalle.responseText);
            console.log(productos)
            const [elemMasBarato, elemMasCaro] = calculo(productos);
            document.getElementById('priceDiff').textContent = elemMasCaro.precio - elemMasBarato.precio;
            document.getElementById('masCaro').textContent = elemMasCaro.nombreSucursal;
            document.getElementById('masBarato').textContent = elemMasBarato.nombreSucursal;
            for (const producto of productos) {
            const tr = document.createElement('tr');
            tr.innerHTML = `
            <td>${producto.nombreSucursal}</td>
            <td>$${parseFloat(producto.precio).toFixed(2)}</td>
            <td>${producto.ubicacion}</td>
            `
            detallep.appendChild(tr);
            }
            }
        }
        mensajeroDetalle.send(null);
        
    }
    function calculo(productos){
        //sort mecanizar su uso
        // const array = Array.from(productos);
        const arrOrdenado = productos.sort((a, b) => parseFloat(a.precio) - parseFloat(b.precio))
        const primerElemento = arrOrdenado[0];
        //Vuelvo a meter el elemento al final con .push
        const ultimoElemento = arrOrdenado.pop();
        //volvemos a meterlo porq modificamos el array
        arrOrdenado.push(ultimoElemento);
        //devuelvo segun este orden
        return [primerElemento, ultimoElemento];
    }

        

        
    
    
    




// producto.addEventListener('input',function(){
//         const searchTerm=$this.value;
//         if (searchTerm.length === 0) {
//             return; // No hacer nada si el campo está vacío
//         }
//         var mensajeroSugerencias = new XMLHttpRequest();
//         mensajeroSugerencias.open('GET', 'comportamiento.php?term=' + encodeURIComponent(searchTerm), true);
//         mensajeroSugerencias.onreadystatechange=function(){
//             if(mensajeroSugerencias.readyState == 4 && mensajeroSugerencias.status == 200) {
//                 var suggestions = JSON.parse(mensajeroSugerencias.responseText);
//                 let tableHTML = '<table>';
//                     tableHTML += '<thead><tr><th>Producto</th><th>Precio</th><th>Supermercado</th><th>Ubicacion</th></tr></thead>';
//                     tableHTML += '<tbody>';
//                 if (suggestions.length > 0) {
//                     suggestions.forEach(producto => {
//                     tableHTML += `
//                     <tr>
//                         <td>${producto.nombre}</td>
//                         <td>${producto.precio}</td>
//                         <td>$${producto.supermercado}</td>
                        
//                     </tr>
//                 `;

//                 })
//                 tableHTML += '</tbody></table>';
//                 tabla.innerHTML = tableHTML;
        
//             }}}
//         mensajeroProductos.send('producto=' + encodeURIComponent(producto));
//     });
