$(document).ready(function () {
    $(document).on("click",".btn-delete-panel", function(){
        var panel = $(this).val();
        $("#"+panel).remove();
    })


    $( "#lista-productos" ).sortable({
      stop: function() {
            var selectedData = new Array();
            $('#lista-productos>a').each(function() {
                selectedData.push($(this).attr("href"));
            });
            updateOrder(selectedData);

        }

    });


    function updateOrder(data) {
        console.log(data);
        $.ajax({
            url: base_url + "movimientos/ordenes/orderProductos",
            type:'post',
            data:{position:data},
            success:function(result){
                //console.log("se ordeno los productos");
             }
        })
    }

    $("#btn-add-categoria").on("click",function(){
        var infoCategoria = $("#categoria_asociada").val();
        if (infoCategoria=="") {
            swal("Error","Seleccione una categoria", "error");
        }else{
            var dataCategoria = infoCategoria.split("*");
            html = "<tr>";
            html += "<td><input type='hidden' name='categorias[]' value='"+dataCategoria[0]+"'>"+dataCategoria[1]+"</td>";
            html += "<td><input type='number' class='form-control input-sm' name='cant_categorias[]'></td>";
            html += "<td><button type='button' class='btn btn-danger btn-xs btn-remove-categoria'><span class='fa fa-times'></span></button></td>"
            html += "</tr>"
            $("#categorias_asociadas tbody").append(html);
        }
        
    });
    $(document).on("click", ".btn-remove-categoria", function(){
        $(this).closest("tr").remove();
    });
    $("#saveExtra").submit(function(e){
        e.preventDefault();
        var url = $(this).attr("action");
        var formData = $(this).serialize();
        $.ajax({
            url: url,
            data: formData,
            dataType: "json",
            type: "POST",
            success: function(data){
                if (data.status =="1") {
                    dataExtra = data.extra.id +"*"+data.extra.nombre +"*"+data.extra.precio;
                    html = '<div class="col-md-3 form-group">';
                    html += '<button class="btn btn-success btn-block check-extra" value="'+dataExtra+'">';
                    html += data.extra.nombre+' <br> Q. '+data.extra.precio;
                    html += '</button>';
                    html += '</div>';
                    $("#extras-registrados").append(html);

                    tr_id = $("#tr-id").val();
                    idProducto = $("#idProducto").val();
                    valueInput = data.extra.id + "*" + idProducto + "*" + tr_id;
                    html = "<input type='hidden' class='e"+data.extra.id+tr_id+"' name='extras[]' value='"+valueInput+"' ><p style='margin:0px;' class='e"+data.extra.id+tr_id+"'><i>"+data.extra.nombre+"</i></p>";
                    $("#"+tr_id).children("td:eq(0)").append(html);
                    sumaExtra();

                    alertify.success("La información del extra ha sido guardado y seleccionado al producto");
                }else{
                    alertify.error("No se pudo guardar la información del extra");
                }
            }
        });
    });
    $(document).on("click",".btn-delete-gasto", function(){
        var gasto_id = $(this).val();
        $("#idGasto").val(gasto_id); 
    });
    $("#form-delete-gasto").submit(function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: base_url + "caja/gastos/deleteGasto",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(resp){
                if (resp.status == "1") {
                    location.reload();
                }else{
                    swal("Error", resp.message, "error");
                }
            }

        });
    });
    $(document).on("click", ".btn-off", function(){
        if ($(this).hasClass("btn-default")) {
            var producto_id = $(this).val();
            var btn_off = $(this);
            var btn_on = $(this).siblings();
            $.ajax({
                url: base_url + "mantenimiento/productos/changeStatus",
                type: "POST",
                data: {producto_id: producto_id,status:0},
                success: function(resp){
                    if (resp == 1) {
                        alertify.error("El estado del producto paso Inactivo");
                        btn_off.removeClass("btn-default").addClass("btn-danger");
                        btn_on.removeClass("btn-success").addClass("btn-default");
                    }
                }
            });
        }
    });
    $(document).on("click", ".btn-on", function(){
        if ($(this).hasClass("btn-default")) {
            var producto_id = $(this).val();
            var btn_on = $(this);
            var btn_off = $(this).siblings();
            $.ajax({
                url: base_url + "mantenimiento/productos/changeStatus",
                type: "POST",
                data: {producto_id: producto_id,status:1},
                success: function(resp){
                    if (resp == 1) {
                        alertify.success("El estado del producto paso Activo");
                        btn_on.removeClass("btn-default").addClass("btn-success");
                        btn_off.removeClass("btn-danger").addClass("btn-default");
                    }
                }
            });
        }
    });
    if ( $("#nuevosPedidos").length ) {
        cargarPedidosNuevos();
        cargarPedidosPreparacion();
    }
    
    if ( $("#listado-ordenes").length ) {
        cargarListaPedidos(1);
        setInterval(function(){
            cargarListaPedidos(1)
        }, 15000);
    }

    $('.select2').select2({
        placeholder: "Seleccione una opcion",
        allowClear: true
    });

    $(document).on("change", "#tipo_consumo", function(){
        var tipo_consumo = $(this).val();
        if (tipo_consumo == 1) {
            $("#content-mesas").show();
            $("#mesas").attr("required","required");
        } else {
            $("#content-mesas").hide();
            $("#mesas").removeAttr("required");
            $("#mesas").val(null);
        }
    });

    $(document).on("keyup", "#search-orden", function(){
        cargarListaPedidos(1);
    });

    $(document).on("change", "#records_per_page", function(){
        cargarListaPedidos(1);
    });

    $(document).on("click", ".link", function(e){
        e.preventDefault();
        page = Number($(this).attr("href"));
        cargarListaPedidos(page);
    });

    $("#formCanjearCupon").submit(function(e){
        e.preventDefault();
        var dataForm = $(this).serialize();
        var url = $(this).attr("action");
        $.ajax({
            url: url,
            type: "POST",
            data: dataForm,
            dataType: "json",
            success: function(data){
                if (data == "0") {
                    swal("Error!", "El cupón no es válido", "error");
                }else{
                    $("#modal-cupon").modal("hide");
                    $("input[name=descuento]").val(data.valor);
                    $("p.descuento").text(data.valor);
                    sumar();
                    swal("Bien Hecho!", "El cupón es válido", "success");
                }
            }
        });
    });

    if ( $("#grafico-torta").length ) {
        i=0;
        datos = [];
        $("#tb-productos-vendidos tbody tr").each(function(){
            if (i>0) {
                nombre = $(this).children("td:eq(1)").text();
                valor = $(this).children("td:eq(1)").find("input").val();
                datos.push({"name":nombre,"y": Number(valor)});
            }
            i++;
        });
        graficoTorta(datos);
    }

    $(document).on("keyup mouseup", ".stocks_fisico", function(){
        stocks_fisico = Number($(this).val());
        stocks_bd = Number($(this).closest("tr").find("td:eq(1)").text());
        diferencia_stock = stocks_fisico-stocks_bd;
        $(this).closest("tr").find("td:eq(3)").children('input').val(diferencia_stock);
    });

    $(document).on("click", ".btn-view-corte-caja", function(){
        idCaja = $(this).val();
        $.ajax({
            url: base_url + "caja/apertura_cierre/viewCorte/" + idCaja,
            type: "POST",
            success: function(resp){
                $("#btn-print-caja").attr("href", base_url + "caja/apertura_cierre/printCaja/"+idCaja);
                $("#modal-corte .modal-body").html(resp);
            }
        });
    });
    $(document).on("click", ".btn-view-ajuste", function(){
        id = $(this).val();
        showAjuste(id);

    });

    $(document).on("keyup mouseup","#numero_inicial", function(){
        numero_inicial = $(this).val();
        $("#showNumeroInicial").val(zfill(numero_inicial,8));
    });

    $('#solicitar_nit').on('change',function(){
        if($(this).is(':checked')){
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });

    function zfill(number, width) {
        var numberOutput = Math.abs(number); /* Valor absoluto del número */
        var length = number.toString().length; /* Largo del número */ 
        var zero = "0"; /* String de cero */  
        if (width <= length) {
            if (number < 0) {
                 return ("-" + numberOutput.toString()); 
            } else {
                 return numberOutput.toString(); 
            }
        } else {
            if (number < 0) {
                return ("-" + (zero.repeat(width - length)) + numberOutput.toString()); 
            } else {
                return ((zero.repeat(width - length)) + numberOutput.toString()); 
            }
        }
    }

    $(document).on("click", ".btn-pagos", function(){
        idCuenta = $(this).attr("data-href");
        num_documento = $(this).closest("tr").find("td:eq(1)").text();
        texto = "<strong>Nro de Comprobante: </strong>"+num_documento;
        $("p.num_documento").html(texto);
        if ($("#modulo").val() == "cuentas_cobrar") {
            ruta = "cuentas_cobrar/creditos/pagosByCuenta/";
        }else{
            ruta = "backend/cuentas_pagar/pagosByCuenta/";
        }
        $.ajax({
            url: base_url + ruta +idCuenta,
            type: "POST",
            dataType: "json",
            success: function(data){
                html = "";
                $.each(data, function(key, value){
                    html += "<tr>";
                    html += "<td>"+value.monto+"</td>";
                    html += "<td>"+value.fecha+"</td>";
                    html += "</tr>";
                });
                $("#tbpagos tbody").html(html);
            }
        });
    });

    $(document).on("click", ".btn-abonar", function(){
        idCuenta = $(this).val();
        num_documento = $(this).closest("tr").children("td:eq(1)").text();
        monto = $(this).closest("tr").children("td:eq(4)").text();
        monto_abonado = $(this).closest("tr").children("td:eq(5)").text();
        saldo_pendiente = $(this).closest("tr").children("td:eq(6)").text();
        $("#idCuenta").val(idCuenta);
        $("#num_documento").val(num_documento);
        $("#monto_abonado").val(monto_abonado);
        $("#monto").val(monto);
        $("#saldo_pendiente").val(saldo_pendiente);
    });

    $(document).on("change",".checkInsumo", function(){
        if ($(this).is(":checked")) {
            input = '<input type="text" name="cantidades[]" class="form-control" required="required">';
            $(this).closest("tr").children("td:eq(3)").append(input);
        }else{
            $(this).closest("tr").children("td:eq(3)").find("input").remove();
        }
    });

    $(document).on("click", ".btn-edit-insumo", function(){
        dataInsumo = $(this).val();
        infoInsumo = dataInsumo.split("*");
        $("#idInsumo").val(infoInsumo[0]);
        $("#form-edit-insumo input[name=nombre]").val(infoInsumo[1]);
        $("#form-edit-insumo input[name=cantidad]").val(infoInsumo[2]);
        $("#form-edit-insumo select[name=unidad_medida_id]").val(infoInsumo[3]);

    });

    $(document).on("click", ".btn-edit-insumo-producto", function(){
        idProducto = $(this).val();
        nombre = $(this).closest("tr").find("td:eq(0)").text();
        $("#form-edit-insumo-producto input[name=idProducto]").val(idProducto);
        $("#form-edit-insumo-producto input[name=nombre]").val(nombre);
        $.ajax({
            url: base_url + "produccion/establecer_insumos/getInsumosByProducto",
            type: "POST",
            data: {idProducto:idProducto},
            dataType: "json",
            success: function(data){
                $.each(data, function(key, value){
                    $("tr#insumo"+value.insumo_id).children("td:eq(0)").find("input").attr("checked","checked");
                    input = '<input type="text" name="cantidades[]" class="form-control" required="required" value="'+value.cantidad+'">';
                    $("tr#insumo"+value.insumo_id).children("td:eq(3)").html(input);
                });
            }
        });
    });

    $(document).on("click", ".btn-change-medida", function(){
        idpum = $(this).val();
        cantidad = $(this).closest("tr").children("td:eq(1)").find("input").val();
        precio = $(this).closest("tr").children("td:eq(2)").find("input").val();
        $.ajax({
            url: base_url + "mantenimiento/productos/updateMedidaProducto",
            type: "POST",
            data: {cantidad:cantidad, precio: precio, idpum: idpum},
            success: function(resp){
                if (resp==1) {
                    swal("Bien Hecho!", "Se informacion se actualizo correctamente", "success");
                }else {
                    swal("Error!", "No se pudo actualizar la informacion", "error");
                }
            }
        });
    });

    $(document).on("click", ".btn-info-compra",function(){
        idCompra = $(this).val();
        $.ajax({
            url:base_url + "movimientos/compras/view",
            type: "POST",
            data: {id:idCompra},
            success:function(resp){
                $("#modal-compra .modal-body").html(resp);
            }
        });
    });

    $(document).on("change",".medida", function(){
        $(this).find("option:first").attr("disabled","disabled");
        valorOption = $(this).val();
        dataOption = valorOption.split("*");
        $(this).parent().children("input.cantidadesMedida").val(dataOption[3]);
        $(this).parent().children("input.idMedidas").val(dataOption[0]);
        $(this).closest("tr").find("td:eq(3)").children("input").val(dataOption[4]);
        $(this).closest("tr").find("td:eq(4)").children("input").val("1");
        $(this).closest("tr").find("td:eq(5)").children("input").val(dataOption[4]);
        sumarCompra();
    });

    $("#btn-add-medida").on("click", function(){
        html = "<tr>";
        html += "<td>";
        html += "<input type='text' name='nombres[]' class='form-control' placeholder='Nombre de Medida' required='required'>";
        html += "</td>";
        html += "<td>";
        html += "<input type='number' name='cantidades[]' class='form-control'  required='required'>";
        html += "</td>";
        html += "<td>";
        html += "<button type='button' class='btn btn-danger btn-sm btn-remove-medida'><i class='fa fa-times'></i></buton>";
        html += "</td>";
        html += "</tr>";
        $("#tbmedidas tbody").append(html);
    });

    $(document).on("click", ".btn-select-proveedor", function(){
        idproveedor = $(this).val();
        nombreProveedor = $(this).closest("tr").find("td:eq(1)").text();
        $("#proveedor").val(nombreProveedor);
        $("#idproveedor").val(idproveedor);
        $("#modal-proveedores").modal("hide");
    });
    $("#btn-guardar-compra").on("click", function(){
        if ($("#idproveedor").val() == '') {
            swal({title: "Error", text: "No se ha seleccionado un proveedor", type: "error"},
                function(){ 
                    $("#modal-proveedores").modal("show");
                }
            );
            return false;
        }
    });
    $("#searchProductoCompra").autocomplete({
        source:function(request, response){
            $.ajax({
                url: base_url+"movimientos/compras/getProductos",
                type: "POST",
                dataType:"json",
                data:{ valor: request.term},
                success:function(data){
                    response(data);
                }
            });
        },
        minLength:2,
        select:function(event, ui){
            console.log(ui.item);
            html = "<tr>";
            html +="<td><input type='hidden' name='idproductos[]' value='"+ui.item.id+"'>"+ui.item.codigo+"</td>";
            html +="<td>"+ui.item.nombre+"</td>";

            select = "<select id='medida' name='medida' class='form-control medida' required='required'><option value=''>Seleccione..</option>";
            $.each(ui.item.medidas, function(key, value){
                valueOption = value.id + "*" + value.idpum + "*" + value.nombre+ "*" + value.cantidad+ "*" + value.precio;
                select += "<option value='"+valueOption+"'>"+value.nombre+" = "+value.cantidad+" unids."+"</option>";
            });
            select += "</select>"
            html += "<td>"+select;
            html += "<input type='hidden' name='cantidadesMedida[]' class='cantidadesMedida'>";
            html += "<input type='hidden' name='idMedidas[]' class='idMedidas'></"
            html += "</td>";

            html +="<td><input type='text' name='precios[]' readonly='readonly' class='form-control' style='width:100px;'></td>";
            html +="<td><input type='text' name='cantidades[]' class='cantidadesCompra form-control' style='width:100px;'></td>";
            html +="<td><input type='text' name='importes[]' readonly='readonly' class='form-control' style='width:100px;'></td>";
            html +="<td><button type='button' class='btn btn-danger btn-remove-producto-compra'><span class='fa fa-times'></span></button></td>";
            html +="</tr>"

            $("#tbcompras tbody").append(html);
          
            this.value = "";
            return false;
        },
    });

    function sumarCompra(){
        subtotal = 0;
        $("#tbcompras tbody tr").each(function(){
            subtotal = subtotal + Number($(this).children("td:eq(5)").find('input').val());
        });
        $("input[name=subtotal]").val(subtotal.toFixed(2));
        $("input[name=total]").val(subtotal.toFixed(2));
        if (subtotal > 0) {
            $("#btn-guardar-compra").removeAttr("disabled");
        }else{
            $("#btn-guardar-compra").attr("disabled","disabled");
        }
    }

    $(document).on("keyup mouseup","#tbcompras input.cantidadesCompra", function(){
        cantidad = Number($(this).val());
        precio = Number($(this).closest("tr").find("td:eq(3)").children("input").val());
        importe = cantidad * precio;
        $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
        sumarCompra();
    });

    $("#tipo_pago").on("change", function(){
        tipo_pago = $(this).val();
        switch(tipo_pago){
            case '1' :
                $("#content-monto-efectivo").hide();
                $("#content-tarjeta").hide();
                $("#content-monto-tarjeta").hide();

                $("#monto_tarjeta").removeAttr("required");
                $("#monto_efectivo").removeAttr("required");
                $("#monto_efectivo").removeAttr("disabled");
                $("#monto_efectivo").val(null);
                break;
            case '2' :
                $("#content-monto-efectivo").hide();
                $("#content-tarjeta").show();
                $("#content-monto-tarjeta").hide();
                $("#monto_tarjeta").removeAttr("required");
                $("#monto_efectivo").removeAttr("required");
                $("#monto_efectivo").removeAttr("disabled");
                $("#monto_efectivo").val(null);
                break;
            case '3' :
                $("#monto_efectivo").val(null);
                $("#content-monto-efectivo").show();
                $("#content-tarjeta").show();
                $("#content-monto-tarjeta").show();
                $("#monto_tarjeta").attr("required","required");
                $("#monto_efectivo").removeAttr("required");
                $("#monto_efectivo").attr("disabled","disabled");
                break;
            default:
                $("#content-monto-efectivo").show();
                $("#content-tarjeta").hide();
                $("#content-monto-tarjeta").hide();
                $("#monto_tarjeta").removeAttr("required");
                $("#monto_efectivo").removeAttr("required");
                $("#monto_efectivo").removeAttr("disabled");
                $("#monto_efectivo").val(null);
                break;
        }
    });

    $("#monto_tarjeta").on("keyup",function(){
        monto_tarjeta = $(this).val();
        total = $("#total").val();
        $("#monto_efectivo").val((total - monto_tarjeta).toFixed(2));

    });

    $(document).on("click",".btn-edit-medida", function(){
        idMedida = $(this).val();
        nombre = $(this).closest("tr").find("td:eq(1)").text();
        $("#idTarjeta").val(idMedida);
        $("#nombre").val(nombre);
    });
    $(document).on("click",".btn-edit-tarjeta", function(){
        idTarjeta = $(this).val();
        nombre = $(this).closest("tr").find("td:eq(1)").text();
        $("#idTarjeta").val(idTarjeta);
        $("#nombre").val(nombre);
    });
    $("#form-edit-tarjeta").submit(function(e){
        e.preventDefault();
        url = $(this).attr("action");
        data = $(this).serialize();
        $.ajax({
            url: url,
            data: data,
            type: "POST",
            dataType: 'json',
            success: function(resp){
                if (resp.status == 1) {
                    swal({title: "Registro Actualizado", text: resp.message, type: "success"},
                       function(){ 
                           location.reload();
                       }
                    );
                }else{
                    swal("Error",resp.message, "error");
                }
            }
        });
    });
    $(document).on("click",".btn-cerrar-caja", function(){
        idCaja = $(this).val();
        $("#idCaja").val(idCaja);
        $.ajax({
            url: base_url + "caja/apertura_cierre/check_pending_orders",
            type: "POST",
            success: function(resp){
               
                if (resp == 0 ) {
                    $("#modal-cierre").modal('show');
                }else{
                    swal("Error!","Aún hay ordenes pendiente de pago","error");
                }
            }
        });
    });

    $("#form-cerrar-caja").submit(function(e){
        var observaciones = $("#observaciones").val();
        e.preventDefault();
        var dataForm = $(this).serialize();
        $.ajax({
            url: base_url + "caja/apertura_cierre/cerrarCaja",
            type: "POST",
            data: dataForm,
            dataType:'json',
            success: function(resp){
                if (resp.status == 1) {
                    $("table tbody").children("tr:first").find("td:eq(11)").text(observaciones);
                    $("table tbody").children("tr:first").find("td:eq(12)").html('');
                    $("#modal-cierre").modal("hide");
                    showCorte(resp.caja_abierta);
                }else{
                    swal("Error",resp.message,"error");
                }
                
            }
        });
    });
    
    $(document).on("click",".tab-area", function(e){
        idArea = $(this).attr("data-href");
        e.preventDefault();
        $.ajax({
            url: base_url +"movimientos/ordenes/getAreas/"+idArea,
            type:"POST",
            dataType: "json",
            success: function(data){
                html = "";
                $.each(data, function(key, value){
                    var estado = 'mesa-ocupada';
                    if (value.estado == 1) {
                        estado = 'mesa-disponible';
                    }
                    html += '<div class="col-md-3 col-sm-6 col-xs-6">';
                    html += '<div class="numero-mesa '+estado+'">';
                    html += 'MESA<br>';
                    html += value.numero;
                    html += '</div>';
                    html += '</div>';
                });

                $("#mesas-area").html(html);
            }
        });

    });
    $(document).on("click",".check-extra", function(){
        infoCheck = $(this).val();
        dataCheck = infoCheck.split("*");
        tr_id = $("#tr-id").val();
        idProducto = $("#idProducto").val();

        if ($(this).hasClass("btn-warning")) {
            valueInput = dataCheck[0] + "*" + idProducto + "*" + tr_id;
            html = "<input type='hidden' class='e"+dataCheck[0]+tr_id+"' name='extras[]' value='"+valueInput+"' ><p style='margin:0px;' class='e"+dataCheck[0]+tr_id+"'><i>"+dataCheck[1]+"</i></p>";
            $("#"+tr_id).children("td:eq(0)").append(html);
            $(this).removeClass("btn-warning").addClass("btn-success");
            alertify.success("El extra fue agregado al producto");
        }else{
            $(".e"+dataCheck[0]+tr_id).remove();
            $(this).removeClass("btn-success").addClass("btn-warning");
            alertify.error("El extra fue removido del producto");
        }
        sumaExtra(tr_id);
    })

    function sumaExtra(tr_id){
        if ($("#"+tr_id+" input.totalE").length) {
            totalE = 0;
            $("#extras-registrados .btn-success").each(function(){
                data = $(this).val();
                info = data.split("*");
                totalE = totalE + Number(info[2]);
            });
            $("#"+tr_id+" input.totalE").val(totalE);
            precio = Number($("#"+tr_id).children("td:eq(1)").text());
            
            cantidad =  Number($("#"+tr_id).children("td:eq(3)").find("input").val());
            descuento =  Number($("#"+tr_id).children("td:eq(4)").find("input").val());
            nuevoImporte = (cantidad * precio) + (cantidad * totalE) - descuento;
            $("#"+tr_id).children("td:eq(5)").find("input").val(nuevoImporte.toFixed(2));
            $("#"+tr_id).children("td:eq(5)").find("p").text(nuevoImporte.toFixed(2));
            sumar();
        }
    }
    $(document).on("click", ".btn-view-extras", function(){
        idProducto = $(this).val();
        $("#idProducto").val(idProducto);
        tr_id = $(this).closest("tr").attr("id");
        $("#tr-id").val(tr_id);
        nombreProducto = $(this).closest("tr").find("td:eq(0)").children("p").text();
        $("#modal-extras .modal-title").text("Extras del producto "+ nombreProducto);
        $.ajax({
            url: base_url + "movimientos/ordenes/getExtras/"+idProducto,
            type:"POST",
            dataType: 'json',
            success:function(data){
                html = "";
                var extras = extrasAgregados();
         
                $.each(data, function(key, value){
                    var data = value.id +"*"+value.nombre+"*"+value.precio; 
                    var checked = '';

                    if (extras.includes(value.id+"*"+idProducto+"*"+tr_id)) {
                        checked = 'btn-success';
                    } else {
                        checked = 'btn-warning';
                    }
                    html += '<div class="col-md-3 form-group">';
                    html += '<button class="btn '+checked+' btn-block check-extra" value="'+data+'">';
                    html += value.nombre+' <br> Q. '+value.precio;
                    html += '</button>';
                    html += '</div>';
                });
                $("#extras-registrados").html(html);
            }
        });
    });
    $("#form-add-medida").submit(function(e){
        idUnidadMedida = $("#unidad_medida_id").val();
        e.preventDefault();
        if (verificarMedida(idUnidadMedida)) {
            swal("Error", "La unidad de medida seleccionado ya fue agregada", "error");
        }
        else{
            dataForm = $(this).serialize();
            $.ajax({
                url: base_url + "mantenimiento/productos/saveMedida",
                type:"POST",
                data: dataForm,
                dataType: "json",
                success: function(response){
                    if (response.status == 1) {
                        $("#form-add-medida").trigger("reset");
                        getMedidas($("#form-add-medida #idProducto").val());
                        swal("Exito!",response.message,"success");
                    }else{
                        var text = response.error.replace(/<\/?[^>]+(>|$)/g, "");

                        swal("Error!",text,"error");
                    }
                }
            });
        }
        
    });
    $("#form-add-extra").submit(function(e){
        e.preventDefault();
        dataForm = $(this).serialize();
        $.ajax({
            url: base_url + "mantenimiento/productos/saveExtra",
            type:"POST",
            data: dataForm,
            dataType: "json",
            success: function(response){
                if (response.status == 1) {
                    $("#form-add-extra").trigger("reset");
                    getExtras($("#idProducto").val());
                    swal("Exito!",response.message,"success");
                }else{
                    var text = response.error.replace(/<\/?[^>]+(>|$)/g, "");

                    swal("Error!",text,"error");
                }
            }
        });
    });
    $(document).on("click", ".btn-update-extra", function(){
        var idExtra = $(this).val(); 
        var nombre = $(this).closest("tr").find("td:eq(0)").find("input").val();
        var precio = $(this).closest("tr").find("td:eq(1)").find("input").val();
        var dataExtra = {
            idExtra: idExtra,
            nombre: nombre,
            precio: precio
        };
        $.ajax({
            url: base_url + "mantenimiento/productos/updateExtraProducto",
            type: "POST",
            data: dataExtra,
            success: function(resp){
                if (resp==1) {
                    swal("Bien!","La informacion del extra se actualizo correctamente", "success");
                    getExtras($("#idProducto").val());
                }else{
                    swal("Error","No se pudo actualizar la informacion del extra", "error");
                }
            }
        });

    })
    $(document).on("click", ".btn-edit-extra", function(){
        $(".btn-remove-extra").hide();
        $(this).hide();
        $(".btn-update-extra").show();
        $(".btn-cancel-extra").show();
        var nombre = $(this).closest("tr").find("td:eq(0)").text();
        var precio = $(this).closest("tr").find("td:eq(1)").text();
        var inputNombre = "<input type='text' name='nombre' value='"+nombre+"'>";
        var inputPrecio = "<input type='text' name='precio' value='"+precio+"'>";
        $(this).closest("tr").find("td:eq(0)").html(inputNombre);
        $(this).closest("tr").find("td:eq(1)").html(inputPrecio);
    })
    $(document).on("click", ".btn-cancel-extra", function(){
        var idExtra = $(this).val(); 
        getExtras($("#idProducto").val());

    })
    $(document).on("click", ".btn-remove-extra", function(){
        var idExtra = $(this).val(); 
        
        $.ajax({
            url: base_url + 'mantenimiento/productos/deleteExtra/' + idExtra,
            type: "POST",
            success: function(response){
                if (response == 1) {
                    swal("Eliminado","Se ha removido el extra del producto","success");
                    getExtras($("#idProducto").val());
                }else{
                    swal("Error","No se ha podido el eliminar el extra del producto","error");
                }
            }
        });
    })
    $(document).on("click", ".btn-remove-medida", function(){
        var idMedida = $(this).val(); 
        $.ajax({
            url: base_url + 'mantenimiento/productos/deleteUnidadMedida/' + idMedida,
            type: "POST",
            success: function(response){
                if (response == 1) {
                    swal("Eliminado","Se ha removido la unidad de medida del producto","success");
                    getExtras($("#idProducto").val());
                }else{
                    swal("Error","No se ha podido el eliminar la unidad de medida del producto","error");
                }
            }
        });
    })
    $(document).on("click", ".btn-extras", function(){
        var nombreProducto = $(this).closest("tr").children("td:eq(2)").text();
        var idProducto = $(this).attr("data-href");
        $("#modal-extras .modal-title").text("Extras del Producto - "+nombreProducto);
        $("#form-add-extra #idProducto").val(idProducto);
        getExtras(idProducto);
    })

    $(document).on("click", ".btn-medidas", function(){
        var nombreProducto = $(this).closest("tr").children("td:eq(2)").text();
        var idProducto = $(this).attr("data-href");
        $("#nombreProducto").text(nombreProducto);
        $("#form-add-medida #idProducto").val(idProducto);
        getMedidas(idProducto);
    })

    function getMedidas(idProducto){
        $.ajax({
            url: base_url + "mantenimiento/productos/getMedidasProducto/"+idProducto,
            type:"POST",
            dataType: 'json',
            success:function(data){
                if (data.length) {
                    html = "";
                    $.each(data, function(key, value){
                        html += "<tr>";
                        html += "<td><input type='hidden' name='idMedidas[]' value='"+value.id+"'>"+value.nombre+"</td>";
                        html += "<td><input type='number' class='form-control' name='cantidad' id='cantidad' value='"+value.cantidad+"' style='width:70px;'></td>";
                        html += "<td><input type='text' class='form-control' name='precio' id='precio' value='"+value.precio+"' style='width:70px;'></td>";
                        html += "<td>";
                        html += '<button type="button" class="btn btn-primary btn-change-medida" value="'+value.idpum+'">';
                        html += '<span class="fa fa-save"></span>';
                        html += '</button> ';
                        html += '<button type="button" class="btn btn-danger btn-remove-medida" value="'+value.idpum+'">';
                        html += '<span class="fa fa-times"></span>';
                        html += '</button></td>';
                        html += "</tr>";
                    });

                    $("#tbmedidas tbody").html(html);
                }else{
                    html = "<tr><td colspan='3'>No se ha agregado extras para este producto</td></tr>";
                    $("#tbmedidas tbody").html(html);
                }
            }
        });
    }

    function getExtras(idProducto){
        $.ajax({
            url: base_url + "mantenimiento/productos/getExtras/"+idProducto,
            type:"POST",
            dataType: 'json',
            success:function(data){
                console.log(data.length);
                if (data.length > 0) {
                    html = "";
                    $.each(data, function(key, value){
                        html += "<tr>";
                        html += "<td>"+value.nombre+"</td>";
                        html += "<td>"+value.precio+"</td>";
                        html += "<td>";
                        html += '<button type="button" class="btn btn-success btn-update-extra" value="'+value.id+'" style="display:none;">';
                        html += '<span class="fa fa-save"></span>';
                        html += '</button>';
                        html += '<button type="button" class="btn btn-danger btn-cancel-extra" value="'+value.id+'" style="display:none;">';
                        html += '<span class="fa fa-ban"></span>';
                        html +='</button>';
                        html += '<button type="button" class="btn btn-warning btn-edit-extra" value="'+value.id+'">';
                        html += '<span class="fa fa-pencil"></span>';
                        html += '</button>';
                        html += '<button type="button" class="btn btn-danger btn-remove-extra" value="'+value.id+'">';
                        html += '<span class="fa fa-times"></span>';
                        html += '</button></td>';
                        html += "</tr>";
                    });

                    $("#tbextras tbody").html(html);
                }else{
                    html = "<tr><td colspan='3'>No se ha agregado extras para este producto</td></tr>";
                    $("#tbextras tbody").html(html);
                }
            }
        });
    }

    $("#cantEliminar").on("keyup",function(){
        if ($(this).val() != "") {
            value = Number($(this).val());
            maxValue = Number($(this).attr("max"));
            if (value==0) {
                alertify.error("Valor no permitido");
                $(this).val(null);
            }
            if (value!=0 && value < 1) {
                alertify.error("Ud. no puede ingresar un numero menor a 1");
                $(this).val("1");
            }
            if (value > maxValue) {
                alertify.error("Ud. no puede ingresar un numero mayor a "+ maxValue);
                $(this).val(maxValue);
            }
        }
    });
    
     $("#monto_recibido").on("keyup", function(){
        monto_recibido = Number($(this).val());
        total = Number($("input[name=total]").val());
        $("input[name=cambio]").val((monto_recibido - total).toFixed(2));
    });
    
       
    $("#side-bar").mouseleave(function() {
        $("#collapse").trigger("click");
    });

    $("#showCaracteres").on("change", function(){
        if ($(this).is(':checked')) {
            $("#clave").attr("type","text");
        }
        else{
            $("#clave").attr("type","password");
        }
    })

    $(document).on("click","#change-password",function(){
        $("input[name=idusuario]").val($(this).val());
    });

    $(document).on("submit","#form-change-password",function(e){
        e.preventDefault();
        info = $(this).serialize();
        newpassword = $("input[name=newpassword]").val();
        repeatpassword = $("input[name=repeatpassword]").val();
        if (newpassword != repeatpassword) {
            error = '<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> La contraseñas ingresadas no coindicen</div>';
            $(".error").html(error);
        }else{
            $.ajax({
                url: base_url + "administrador/usuarios/changepassword",
                type: "POST",
                data: info,
                success: function(resp){
                    window.location.href = base_url + resp;
                }
            });
        }
    })

    $(document).on("submit","#form-change-password-perfil",function(e){
        e.preventDefault();
        info = $(this).serialize();
        newpassword = $("input[name=newpass]").val();
        repeatpassword = $("input[name=confpass]").val();
        if (newpassword != repeatpassword) {
            swal("Error","Las contraseñas no coindicen", "error");
        }else{
            $.ajax({
                url: base_url + "usuario/perfil/changepassword",
                type: "POST",
                data: info,
                success: function(resp){
                    swal({title: "Bien Hecho!", text: "La contraseña se ha actualizado", type: "success"},
                       function(){ 
                           location.reload();
                       }
                    );
                }
            });
        }
    })

    $("#form-change-image").submit(function(e){
        e.preventDefault();
        var formData = new FormData($("#form-change-image")[0]);
        $.ajax({
            url: base_url + "usuario/perfil/changeImagen",
            type:"POST",
            data: formData,
            cache:false,
            contentType:false,
            processData:false,
            dataType:"json",
            success:function(resp){
                if (resp.status == 1) {
                    swal({
                         title: "Bien Hecho!",
                         text: "Su imagen de Perfil fue actualizada",
                         type: "success",
                         timer: 3000
                         },
                         function () {
                                location.reload(true);
                                tr.hide();
                        });
                }else{
                    swal("Error!", resp.error.replace(/(<([^>]+)>)/ig,""), "error");
                }
            }
        });
    });

    $(document).on("submit","#form-clave", function(e){
        e.preventDefault();
        data = $(this).serialize();
        $.ajax({
            url :  base_url + "movimientos/ordenes/checkClave",
            type:"POST",
            data : data,
            success:function(resp){
                if (resp==1) {
                    location.reload();
                }else if(resp ==2){
                    window.location.href = base_url + "movimientos/ordenes";
                }else{
                    alertify.error("La clave de permiso ingresada no es valida");
                }
            }
        });
    });

    $(document).on("click", ".btn-delete", function(e){
        e.preventDefault();
        url = $(this).attr("href");
        swal({
            title: "Esta seguro que desea eliminar este registro?",
            text: "Esta operacion es irreversible",
            type: "input",
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            confirmButtonText: "Eliminar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false,
            inputPlaceholder: "Indique las observaciones"
        }, function (inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "") {
                swal.showInputError("Es necesario que indique las observaciones");
                return false
            }
            $.ajax({
                url: url,
                type: "POST",
                data:{observaciones:inputValue},
                success: function(resp){
                    window.location.href = base_url + resp;
                }
            });
        });
    });

    $(document).on("click", ".btn-delete-orden", function(e){
        e.preventDefault();
        var configCorreos = $("#configCorreos").val();
        if (configCorreos==1) {
            url = $(this).attr("href");
            swal({
                title: "Esta seguro que desea eliminar este registro?",
                text: "Esta operacion es irreversible",
                type: "input",
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                confirmButtonText: "Eliminar",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false,
                inputPlaceholder: "Indique las observaciones"
            }, function (inputValue) {
                if (inputValue === false) return false;
                if (inputValue === "") {
                    swal.showInputError("Es necesario que indique las observaciones");
                    return false
                }
                $.ajax({
                    url: url,
                    type: "POST",
                    data:{observaciones:inputValue},
                    success: function(resp){
                        window.location.href = base_url + resp;
                    }
                });
            });
        }else{
            $("#modal-msgCorreos").modal('show');
        }
       
    });

    $("#add-orden").submit(function(e){
        $('button[type=submit]').attr('disabled','disabled');
        $('button[type=submit]').text('Procesando...');
        e.preventDefault();
        url = $(this).attr("action");
        data = $(this).serialize();
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            success: function(resp){
                $("#modal-venta").modal({backdrop: 'static', keyboard: false});
                $("#modal-venta .modal-body").html(resp);
            }
        });
    });
    $(document).on("click",".btn-cerrar-imp", function(){
        window.location.href = base_url + "movimientos/ordenes";
    });

    $(document).on("click",".btn-cerrar-modal-vd", function(){
        location.reload();
    });

    $(document).on("click",".btn-info-pedido", function(){
        idpedido = $(this).val();
        $.ajax({
            url:base_url + "movimientos/ordenes/view",
            type: "POST",
            data: {idpedido:idpedido},
            success:function(resp){
                $("#modal-venta .modal-body").html(resp);
                $("#btn-print-orden").attr("href",base_url + "movimientos/ordenes/printOrden/"+idpedido);
            }
        });
    });

    $(document).on("click",".btn-cerrar", function(){
        if ($("#estadoPedido").val() == "1") {
            window.location.href = base_url + "movimientos/ordenes";
        }else{
            location.reload();
        }
    });

    $("#comprobante").on("change", function(){
        id = $(this).val();
        $.ajax({
            url: base_url + "movimientos/ordenes/infoComprobante",
            type: "POST", 
            data:{idcomprobante:id},
            dataType:"json",
            success:function(resp){
                $("#serie").val(resp.serie);
                $("#idComprobante").val(resp.id);
                $("#igv").val(resp.igv);
                numero = Number(resp.cantidad) + 1;
                $("#numero").val(pad(numero,6));
                sumar();
            }
        });
    });
    $(".btn-procesar").on("click", function(){
        $("#tbpago tbody").html("");
        $("#tborden input[type=checkbox]").each(function(){
            data = $(this).val();
            info = data.split("*");
            html="";
            if($(this).is(":checked") && !$(this).is('[disabled]')) {
                dataDescuento = info[6]+"*"+info[7]
                var extras = JSON.parse(info[8]);
                htmlExtras = "";
                totalExtras = 0;
                if (extras.length > 0) {
                    for(var i=0; i< extras.length; i++){
                        htmlExtras += "<p style='margin:0;'><i>"+extras[i].nombre+"</i></p>";
                        totalExtras = totalExtras + Number(extras[i].precio);
                    }
                }
                html = "<tr>";
                html += "<td><input type='hidden' name='pedidoproductos[]' value='"+info[5]+"'><input type='hidden' name='productos[]' value='"+info[0]+"'><input type='hidden' name='totalExtra' value='"+totalExtras+"'><input type='hidden' name='codigos[]' value='"+info[9]+"'>"+info[1]+htmlExtras+"</td>";
                html += "<td><input type='hidden' name='precios[]' value='"+info[2]+"'>"+info[2]+"</td>";
                html += "<td>";
                html += '<div class="input-group">';
                html +='<span class="input-group-btn">'
                html +='<button class="btn btn-danger btn-reducir btn-sm" type="button" value="'+dataDescuento+'"><span class="fa fa-minus"></span></button></span>';
                html +='<input type="number" name="cantidades[]" class="form-control cantidades input-cantidad input-sm" readonly="readonly" style="font-weight: bold;" value="'+(info[3] - info[4])+'" min="1" max="'+(info[3] - info[4])+'">';
                html +='<span class="input-group-btn">'
                html +='<button class="btn btn-primary btn-aumentar btn-sm" type="button" value="'+dataDescuento+'"><span class="fa fa-plus"></span></button></span></div></td>';
                var descuento = obtenerDescuento((info[3] - info[4]),info[6],info[7]);
                html +='<td><input type="text" name="descuentos[]" readonly="readonly" class="form-control descuento input-sm" value="'+descuento+'"></td>'; 
                importe = (info[2] * (info[3] - info[4])) + ((info[3] - info[4])*totalExtras) - descuento;
                html += "<td><input type='hidden' name='importes[]' value='"+importe.toFixed(2)+"'><p>"+importe.toFixed(2)+"</p></td>";
                html += "</tr>";
                $("#tbpago tbody").append(html);
            }
        });
        sumar();
    });

    $("#check-all").on("change",function(){
        if($(this).is(':checked'))
        {
            $("#tborden tbody").find("input[type=checkbox]").attr("checked","checked");
            comprobar();
        }
    });

    $(document).on("change", "#tborden input[type=checkbox]",function(){
        comprobar();
    })

    $(document).on("click", ".product-selected", function(e){
        e.preventDefault();
        valorBtn = $(this).attr('data-href');
        infoBtn = valorBtn.split("*");

        var id = new Date().getUTCMilliseconds();
            if (infoBtn[4] == "N/A") {
                max = "";
            }else{
                max = infoBtn[4];
            }
            html = "<tr id='"+id+"'>";
 /*           html += "<td><img src='"+base_url+"assets/imagenes_productos/"+infoBtn[8]+"' class='img-responsive' width='100px;'></td>"*/
            html += "<td><input type='hidden' name='productos[]' value='"+infoBtn[0]+"'><p style='margin-bottom:0;'>"+infoBtn[2]+"</p></td>";
            html += "<td><input type='hidden' name='codigos[]' value='"+id+"'>"+infoBtn[4]+"</td>";
            html += "<td style='text-align:left;'>";
            html += '<div class="input-group">';
 
            html +='<input type="number" name="cantidades[]" class="form-control input-cantidad input-sm" readonly="readonly" style="font-weight: bold; width:50px;" value="1" min="1" max="'+max+'">';
                       html +='<span class="input-group-btn">'
            html +='<button class="btn btn-warning btn-sm btn-menos" type="button"><span class="fa fa-minus"></span></button></span>';
            html +='<span class="input-group-btn">'
            html +='<button class="btn btn-success btn-sm btn-mas" type="button"><span class="fa fa-plus"></span></button></span></div></td>';
            html +='<td><button class="btn btn-danger btn-delprod btn-sm" type="button" value="'+infoBtn[0]+'"><span class="fa fa-times"></span></button>';
            if (infoBtn[5] > 0) {
                html +='<button class="btn btn-primary btn-sm btn-view-extras" type="button" value="'+infoBtn[0]+'" data-toggle="modal" data-target="#modal-extras">E</button>';
            }
            if (infoBtn[8] > 0) {
                html +='<button class="btn btn-info btn-sm btn-view-combo" type="button" value="'+infoBtn[0]+'" data-toggle="modal" data-target="#modal-combo">C</button>';
                showCategoriasAsociadas(id,infoBtn[0]);//id de tr, id de producto
            }
            html += "</td>";
            html += "</tr>";
            $("#tborden tbody").append(html);
            $(".btn-guardar").removeAttr("disabled");
        
    });

    $(document).on("click",".btn-view-combo", function(){
        var producto_id = $(this).val();
        var tr_id = $(this).closest("tr").attr("id");
        $("#tr_producto").val(tr_id);
        $("#id_producto").val(producto_id);
        $.ajax({
            url: base_url + "movimientos/ordenes/getCategoriasProductos",
            type: "POST",
            data: {
                producto_id: producto_id
            },
            success: function(resp){
                //console.log(resp);
                $("#modal-combo .modal-body").html(resp);
            }
        });
    });

    $(document).on("click", ".btn-product-category" , function(){
        var producto = JSON.parse($(this).val());

        var category = $(this).closest(".tab-pane").find("input").val();//cat5 = categoria 5
        //alert(producto_id + " - " +category);
        var tr_producto = $("#tr_producto").val();
        var id_producto = $("#id_producto").val();
        $("#modal-combo").modal("hide");
        swal({
          title: "Ingrese Cantidad",
          type: "input",
          showCancelButton: true,
          closeOnConfirm: false,
          inputPlaceholder: "Cantidad del producto"
        }, function (inputValue) {
          if (inputValue === false) $("#modal-combo").modal("show");
          if (inputValue === "") {
            swal.showInputError("Es necesario ingresar una cantidad");
            return false
          }
            
          swal.close();
            var total_permitido = Number($("#"+tr_producto).children("td:eq(0)").find("#"+category).val());
            var total_agregado = Number($("#"+tr_producto).children("td:eq(0)").find("."+category).val());
            nuevo_total = total_agregado + Number(inputValue);
            if (total_permitido >= nuevo_total) {
                $("#"+tr_producto).children("td:eq(0)").find("."+category).val(nuevo_total);

                html = "<input type='hidden' class='p"+producto.id+tr_producto+"' name='productosC[]' value='"+producto.id+"*"+id_producto+"*"+tr_producto+"'>";
                html += "<input type='hidden' class='c"+producto.id+tr_producto+"' name='cantidadesC[]' value='"+inputValue+"'>";
                html += "<p style='margin:0px;' class='pc"+producto.id+tr_producto+"'><i>"+producto.nombre+" - "+inputValue+"</i> <button class='btn btn-danger btn-xs btn-delete-pc' value='"+producto.id+tr_producto+"-"+producto.categoria_id+"'><span class='fa fa-times'></span></button></p>";
                $("#"+tr_producto).children("td:eq(0)").append(html);
            }else{
                alertify.error("no se puedo sobrepasar lo permitido");
            }
          
          $("#modal-combo").modal("show");
        });
    });

    $(document).on("click", ".btn-delete-pc", function(){
        var info = $(this).val();
        var data = info.split("-");
        var cantidad = Number($(".c"+data[0]).val());
        var cantidad_agregada = Number($(".cat"+data[1]).val());
        $(".cat"+data[1]).val(cantidad_agregada - cantidad);

        $(".p" + data[0]).remove();
        $(".c" + data[0]).remove();
        $(".pc" + data[0]).remove();



    });

    $(document).on("click", ".product-selected-vd", function(e){
        e.preventDefault();
        valorBtn = $(this).attr('data-href');
        infoBtn = valorBtn.split("*");
        var id = new Date().getUTCMilliseconds();
            dataDescuento = infoBtn[6]+"*"+infoBtn[7]
            if (infoBtn[4] == "N/A") {
                max = "";
            }else{
                max = infoBtn[4];
            }
            html = "<tr id='"+id+"'>";
 
            html += "<td><input type='hidden' name='productos[]' value='"+infoBtn[0]+"'><input type='hidden' class='totalE' value='0'>"+infoBtn[2]+"</td>";
            html += "<td><input type='hidden' name='precios[]' value='"+infoBtn[3]+"'>"+infoBtn[3]+"</td>";
            html += "<td><input type='hidden' name='codigos[]' value='"+id+"'>"+infoBtn[4]+"</td>";
            html += "<td>";
            html += '<div class="input-group" style="width:130px;">';

            html +='<input type="number" name="cantidades[]" class="form-control input-cantidad input-sm" readonly="readonly" style="font-weight: bold; width:50px;" value="1" min="1" max="'+max+'">';
            html +='<span class="input-group-btn">'
            html +='<button class="btn btn-danger btn-sm btn-menos" type="button" value="'+dataDescuento+'"><span class="fa fa-minus"></span></button></span>';
            html +='<span class="input-group-btn">'
            html +='<button class="btn btn-primary btn-sm btn-mas" type="button" value="'+dataDescuento+'"><span class="fa fa-plus"></span></button></span></div></td>';
            var descuento = obtenerDescuento(1,infoBtn[6],infoBtn[7]);
            html +='<td><input type="text" name="descuentos[]" readonly="readonly" class="form-control descuento input-sm" value="'+descuento+'"></td>'; 
            importe = infoBtn[3] - descuento;
            html += "<td><input type='hidden' name='importes[]' value='"+importe.toFixed(2)+"'><p>"+importe.toFixed(2)+"</p></td>";
            html +='<td><div class="btn-group-vertical"><button class="btn btn-danger btn-delprod btn-sm" type="button" value="'+infoBtn[0]+'"><span class="fa fa-times"></span></button>';
            if (infoBtn[5] > 0) {
                html +='<button class="btn btn-warning btn-sm btn-view-extras" type="button" value="'+infoBtn[0]+'" data-toggle="modal" data-target="#modal-extras">E</button>';

            }

            if (infoBtn[8] > 0) {
                html +='<button class="btn btn-info btn-sm btn-view-combo" type="button" value="'+infoBtn[0]+'" data-toggle="modal" data-target="#modal-combo">C</button>';
                showCategoriasAsociadas(id,infoBtn[0]);//id de tr, id de producto
            }
            html += "</div></td>";
            html += "</tr>";
            $("#tb-venta-directa tbody").append(html);
            $(".btn-guardar").removeAttr("disabled");
            sumar();
        
    });

    $(document).on("click", ".btn-categoria", function(){
        id = $(this).val(); 
        formulario = $("#formulario").val();
        if (formulario == "form-orden") {
            classImg = "product-selected";
        }else{
            classImg = "product-selected-vd";
        }
        $.ajax({
            url: base_url + "movimientos/ordenes/getProductosByCategoria",
            type: "POST", 
            data:{idcategoria:id},
            dataType:"json",
            success:function(resp){
                html = "";
                $.each(resp,function(key, value){

                    if (value.condicion == "1") {
                        stock = value.stock;
                    }
                    else{
                        stock = "N/A";
                    }
                    data = value.id + "*"+ value.codigo+ "*"+ value.nombre+ "*"+ value.precio+ "*"+ stock +"*"+value.cantidad_extras+"*"+value.cantidad_descuento+"*"+value.monto_descuento+"*"+value.categorias_asociadas;

                    html+='<a href="'+value.id+'" data-href="'+data+'" class="list-group-item '+classImg+'">'+value.nombre+'</a>';
                });

                $("#lista-productos").html(html);
            }
        });
    });

    $(document).on("click", ".btn-reducir", function(){
        infoDesc =  $(this).val();
        dataDesc = infoDesc.split("*");
        totalExtras = Number($(this).closest("tr").children("td:eq(0)").find("input[name=totalExtra]").val());
        precio = $(this).closest("tr").find("td:eq(1)").text();
        input = $(this).closest(".input-group").find("input");
        valorAct = Number(input.val());
        resto = Number(valorAct - 1);
        if (resto == 0) {
            swal({
                    position: 'center',
                    type: 'warning',
                    title: 'No se puede reducir la cantidad menor a 1',
                    showConfirmButton: false,
                    timer: 1500
                });
        }else{
            input.val(resto);
            descuento = obtenerDescuento(resto,dataDesc[0],dataDesc[1]);
            importe = (resto * precio) + (resto * totalExtras) - descuento;
            $(this).closest("tr").find("td:eq(3)").children("input").val(descuento);

            $(this).closest("tr").find("td:eq(4)").children("p").text(importe.toFixed(2));
            $(this).closest("tr").find("td:eq(4)").children("input").val(importe.toFixed(2));
        }
        sumar();

    });
    $(document).on("click", ".btn-menos", function(){
        infoDesc = $(this).val();
        dataDesc = infoDesc.split("*");
        precio = Number($(this).closest("tr").find("td:eq(2)").text());
        formulario = $("#formulario").val();
        input = $(this).closest(".input-group").find("input");
        valorAct = Number(input.val());
        resto = Number(valorAct - 1);
        if (resto == 0) {
            swal({
                    position: 'center',
                    type: 'warning',
                    title: 'No se puede reducir la cantidad menor a 1',
                    showConfirmButton: false,
                    timer: 1500
                });
        }else{
            input.val(resto);
            if (formulario == "venta_directa") {
                totalE = $(this).closest("tr").children("td:eq(1)").find("input.totalE").val();
                descuento = obtenerDescuento(resto,dataDesc[0],dataDesc[1]);
                importe = (resto * precio) + (resto * totalE) - descuento;
                $(this).closest("tr").find("td:eq(5)").children("input").val(descuento);

                $(this).closest("tr").find("td:eq(6)").children("p").text(importe.toFixed(2));
                $(this).closest("tr").find("td:eq(6)").children("input").val(importe.toFixed(2));
                sumar();
            }
        }
    });

    $(document).on("click", ".btn-aumentar", function(){
        totalExtras = Number($(this).closest("tr").children("td:eq(0)").find("input[name=totalExtra]").val());
        precio = $(this).closest("tr").find("td:eq(1)").text();
        input = $(this).closest(".input-group").find("input");
        valorAct = Number(input.val());
        aumento = Number(valorAct + 1);
        valorMax = input.attr("max");
        if (valorMax=="") {
            input.val(aumento);
        }else{
            if (aumento > Number(valorMax) ) {
                swal({
                    position: 'center',
                    type: 'warning',
                    title: 'No se puede sobrepasar el stock del producto',
                    showConfirmButton: false,
                    timer: 1500
                    });
            }else{
                input.val(aumento);
                
                descuento = obtenerDescuento(aumento,dataDesc[0],dataDesc[1]);
                importe = (aumento * precio) + (aumento*totalExtras) - descuento;
                $(this).closest("tr").find("td:eq(3)").children("input").val(descuento);
                $(this).closest("tr").find("td:eq(4)").children("p").text(importe.toFixed(2));
                $(this).closest("tr").find("td:eq(4)").children("input").val(importe.toFixed(2));
            }
        }  
        sumar();
    });

    $(document).on("click", ".btn-mas", function(){
        infoDesc = $(this).val();
        dataDesc = infoDesc.split("*");
        precio = Number($(this).closest("tr").find("td:eq(1)").text());
        input = $(this).closest(".input-group").find("input");
        valorAct = Number(input.val());
        aumento = Number(valorAct + 1);
        valorMax = input.attr("max");
        if (valorMax=="") {
            input.val(aumento);
            if (formulario == "venta_directa") {
                totalE = $(this).closest("tr").children("td:eq(0)").find("input.totalE").val();

                descuento = obtenerDescuento(aumento,dataDesc[0],dataDesc[1]);
                importe = (aumento * precio)+(totalE * aumento) - descuento;
                $(this).closest("tr").find("td:eq(4)").children("input").val(descuento);
                $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
                $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
                sumar();
            }
        }else{
            if (aumento > Number(valorMax) ) {
                swal({
                    position: 'center',
                    type: 'warning',
                    title: 'No se puede sobrepasar el stock del producto',
                    showConfirmButton: false,
                    timer: 1500
                    });
            }else{
                input.val(aumento);
                if (formulario == "venta_directa") {
                    totalE = $(this).closest("tr").children("td:eq(0)").find("input.totalE").val();
                    descuento = obtenerDescuento(aumento,dataDesc[0],dataDesc[1]);
                    importe = (aumento * precio) + (totalE * aumento) - descuento;
                    $(this).closest("tr").find("td:eq(4)").children("input").val(descuento);
                    $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
                    $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
                    sumar();
                }
            }
        }
    });

    $("#monto_efectivo").on("keyup", function(){
        valor  = Number($(this).val());
        ventas = Number($("#monto_ventas").val());
        apertura = Number($("#monto_apertura").val());
        monto = ventas + apertura;
        if (valor == monto) {
            $("#observacion").val("Cuadre de Caja conforme");
        }else{
            $("#observacion").val("Cuadre de Caja no conforme");
        }
    });

    $("#btn-ver").on("click",function(){
        $.ajax({
        url : base_url + "movimientos/ventas/verStock",
        type: "POST",
        data: {},
        success: function(resp){
            alert(resp);
        }
    });
    });
    $("#btnActualizarApertura").on("click", function(){
        $("#panelApertura").hide();
        $("#formActualizarApertura").show();
    });

    $(".menu-notificaciones li").on("click", function(){
        return false;
    })

    $(".remove-notificacion").on("click", function(e){
        e.preventDefault();
        id = $(this).attr("href");
        $(this).parent().parent().remove();
        $.ajax({
            url: base_url + "notificaciones/delete",
            data: {id:id},
            type: "POST",
            success:function(resp){
                if (resp > 0 ) {
                    $(".notifications-menu a span").text(resp);
                    $(".notifications-menu ul li.header").text("Tienes "+resp+" notificaciones");
                }else{
                    $(".notifications-menu a span").remove();
                    $(".notifications-menu ul li.header").text("Tienes 0 notificaciones");
                    $(".notifications-menu ul li.footer").remove();
                }
            }
        });
        return false;
    });

    $("input[name=condicion]").click(function() {
        condicion = $(this).val();
        if (condicion == "0") {
            $("input[name=stock]").attr("disabled","disabled");
            $("input[name=stockminimo]").attr("disabled","disabled");
            $("input[name=stock]").val(null);
            $("input[name=stockminimo]").val(null);
        }else{
            $("input[name=stock]").removeAttr("disabled");
            $("input[name=stockminimo]").removeAttr("disabled");
        }
    });

    $("#descuento").on("keyup",function(){
        sumar();
    });
    $("#form-comprobar-password").submit(function(e){
        e.preventDefault();
        montoDescuento = $("#montoDescuento").val();
        data = $(this).serialize();
        $.ajax({
            url: base_url + "movimientos/ventas/comprobarPassword",
            type:"POST",
            data: data,
            success:function(resp){
                if (resp == 1) {
                    $('#modal-default2').modal('hide');
                    alertify.success("El descuento se aplico correctamente");
                    $("#descuento").val(montoDescuento);
                    sumar();
                } else {
                    alertify.error("La contraseña no es válida");
                }      
            }
        });
    });

    $("#btn-pagar").on("click", function(){
        idventa = $(this).val();
        $.ajax({
            url: base_url + "movimientos/ventas/pagar",
            type:"POST",
            data: {id:idventa},
            success:function(resp){
                window.location.href = base_url + resp;         
            }
        });
    });

    $("#form-venta").submit(function(e){
        $('button[type=submit]').attr('disabled','disabled');
        $('button[type=submit]').text('Procesando...');
        e.preventDefault();
        formulario = $("#formulario").val();
        if (formulario== "pago") {
            cantidadProductos = $("#tbpago tbody tr").length;
        }else{
            cantidadProductos = $("#tb-venta-directa tbody tr").length;
        }
        if (cantidadProductos < 1) {
            alertify.error("Agregue productos a pagar");
        }else{
            setEstado();
            data = $(this).serialize();
            ruta = $(this).attr("action");
            $.ajax({
                url: ruta,
                type:"POST",
                data: data,
                success:function(resp){
                    if (resp != "0") {
                        alertify.success("La informacion de la venta fue actualizada");
                        $("#modal-venta").modal({backdrop: 'static', keyboard: false});
                        $("#modal-venta .modal-body").html(resp);
                    }else{
                        alertify.error("No se pudo actualizar la informacion de la venta");
                    }            
                }
            });
        }
    });

    $("#form-venta-directa").submit(function(e){
        $('button[type=submit]').attr('disabled','disabled');
        $('button[type=submit]').text('Procesando...');
        e.preventDefault();
        formulario = $("#formulario").val();
        if (formulario== "pago") {
            cantidadProductos = $("#tbpago tbody tr").length;
        }else{
            cantidadProductos = $("#tb-venta-directa tbody tr").length;
        }
        if (cantidadProductos < 1) {
            alertify.error("Agregue productos a pagar");
        }else{
            
            data = $(this).serialize();
            var url = $(this).attr("action");
         
            $.ajax({
                url: url,
                type:"POST",
                data: data,
           
                success:function(resp){
                    if (resp != "0") {
                        alertify.success("La venta rapida fue registrada");
                        $("#modal-venta").modal({backdrop: 'static', keyboard: false});
                        $("#modal-venta .modal-body").html(resp);
                    }else{
                        alertify.error("No se pudo realizar la venta rapida");
                    }            
                }
            });
        } 
    });
    $("#form-cierre").submit(function(e){
        e.preventDefault();
        data = $(this).serialize();
        ruta = $(this).attr("action");
        if ($("#monto_apertura").val() == "") {
            alertify.error("Es necesario establece una apertura de caja.");
        }else{
            alertify.confirm("¿Estas seguro de cerrar la caja?", function(e){
                if (e) 
                {
                    $.ajax({
                        url: ruta,
                        type:"POST",
                        data: data,
                        success:function(resp){
                            window.location.href = base_url + resp;
                        }
                    });
                }
            });
        }
    });
    $("#form-cliente").submit(function(e){
        e.preventDefault();
        data = $(this).serialize();
        ruta = $(this).attr("action");
        $.ajax({
            url: ruta,
            type:"POST",
            data: data,
            dataType: "json",
            success:function(resp){
                alertify.success("El cliente se registro correctamente");
                $('#modal-default').modal('hide');
                $("#cliente").val(resp.nombres);
                $("#idcliente").val(resp.id);
            }
        });
    });

    var year = (new Date).getFullYear();
    if ( $("#grafico").length ) {
        datagrafico(base_url);
    }
    
    $("#year").on("change",function(){
        yearselect = $(this).val();
        datagrafico(base_url,yearselect);
    });
    $(document).on("click", ".btn-remove",function(e){
        e.preventDefault();
        var ruta = $(this).attr("href");
        $.ajax({
            url: ruta,
            type:"POST",
            success:function(resp){
                window.location.href = base_url + resp;
            }
        });
    });

     $(".btn-view-producto").on("click", function(){
        var id = $(this).attr("data-href");
        $.ajax({
            url: base_url + "mantenimiento/productos/view/" + id,
            type:"POST",
            success:function(resp){
                $(".modal-title").text("Informacion del Producto");
                $("#modal-default .modal-body").html(resp);
            }
        });
    });
     $(document).on("click",".btn-view-area", function(){
        var area = $(this).val(); 
        var infoarea = area.split("*");
        html = "<p><strong>ID:</strong>"+infoarea[0]+"</p>"
        html += "<p><strong>NOMBRE:</strong>"+infoarea[1]+"</p>"
        $("#modal-default .modal-body").html(html);
    });
  
    $(document).on("click",".btn-view-cliente", function(){
        var cliente = $(this).val(); 
        var infocliente = cliente.split("*");
        html = "<p><strong>Nombre:</strong>"+infocliente[1]+"</p>"
        html += "<p><strong>Tipo de Cliente:</strong>"+infocliente[2]+"</p>"
        html += "<p><strong>Tipo de Documento:</strong>"+infocliente[3]+"</p>"
        html += "<p><strong>Numero  de Documento:</strong>"+infocliente[4]+"</p>"
        html += "<p><strong>Telefono:</strong>"+infocliente[5]+"</p>"
        html += "<p><strong>Direccion:</strong>"+infocliente[6]+"</p>"
        $("#modal-default .modal-body").html(html);
    });

    $(".btn-view").on("click", function(){
        modulo = $("#modulo").val();
        var id = $(this).val();
        $.ajax({
            url: base_url +modulo+"/view/" + id,
            type:"POST",
            success:function(resp){
                $("#modal-default .modal-body").html(resp);
            }
        });
    });

    $(".btn-view-usuario").on("click", function(){
        var id = $(this).val();
        $.ajax({
            url: base_url + "administrador/usuarios/view",
            type:"POST",
            data:{idusuario:id},
            success:function(resp){
                $("#modal-default .modal-body").html(resp);
            }
        });
    });

    $(document).on("click", ".btn-edit-mesa", function(){
        info = $(this).val();
        data = info.split("*");
        $("#idMesa").val(data[0]);
        $("#numero").val(data[1]);
        $("#area").val(data[2]);
    });

    var traductorDataTables = {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        };
    
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "Listado de Ventas",
                exportOptions: {
                    columns: [ 0, 1,2, 3, 4, 5,6,7 ]
                },
            },
            {
                extend: 'pdfHtml5',
                title: "Listado de Ventas",
                exportOptions: {
                    columns: [ 0, 1,2, 3, 4, 5,6,7 ]
                } 
            }
        ],
        language: traductorDataTables,
    });

    $('#inventario').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "Inventario Quicheladas",
                exportOptions: {
                    columns: [ 2, 4 ]
                },
            },
            {
                extend: 'pdfHtml5',
                title: "Inventario Quicheladas",
                exportOptions: {
                    columns: [2, 4]
                },
                
            },
            {
                extend: 'print',
                title: "Inventario Quicheladas",
                text: 'Imprimir',
                exportOptions: {
                    columns: [2, 4]
                }
            }
        ],

        language: traductorDataTables
    });

    $('#inventario-productos').DataTable( {
       dom: 'Bfrtip',
         "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            $( api.column( 4 ).footer() ).html(
                'Q. '+pageTotal +' ( Q. '+ total +' total)'
            );
        },
        buttons: [
            {
                extend: 'excelHtml5',
                title: "Inventario Productos",
                exportOptions: {
                    columns: [ 1,2,3,4 ]
                },
            },
            {
                extend: 'pdfHtml5',
                title: "Inventario Productos",
                exportOptions: {
                    columns: [1,2,3,4]
                },
            },
            {
                extend: 'print',
                title: " Inventario Productos",
                text: 'Imprimir',
                exportOptions: {
                    columns: [0,2,4]
                }
            }
        ],
        language: traductorDataTables,
    });
 
    $('#example1').DataTable({
        "pageLength": 25,
        "language": traductorDataTables,
    });
    $('.example1').DataTable({
        "language": traductorDataTables,
    });
    $('#tbCaja').DataTable({
        "pageLength": 25,
        "order": [[ 0,"desc" ]],
        "language": traductorDataTables,
    });

    $('.sidebar-menu').tree();

    $("#comprobantes").on("change",function(){
        option = $(this).val();
        if (option != "") {
            infocomprobante = option.split("*");
            $("#idcomprobante").val(infocomprobante[0]);
            $("#iva").val(infocomprobante[2]);
            $("#serie").val(infocomprobante[3]);
            $("#numero").val(generarnumero(infocomprobante[1]));
        }
        else{
            $("#idcomprobante").val(null);
            $("#iva").val(null);
            $("#serie").val(null);
            $("#numero").val(null);
        }
        sumar();
    })

    $(document).on("click",".btn-check",function(){
        cliente = $(this).val();
        infocliente = cliente.split("*");
        $("#idcliente").val(infocliente[0]);
        $("#cliente").val(infocliente[1]);
        $("#modal-default").modal("hide");
    });

    $("#producto").autocomplete({
        source:function(request, response){
            $.ajax({
                url: base_url+"movimientos/ventas/getproductos",
                type: "POST",
                dataType:"json",
                data:{ valor: request.term},
                success:function(data){
                    response(data);
                }
            });
        },
        minLength:2,
        select:function(event, ui){
            if (ui.item.condicion == "1") {
                stock = ui.item.stock;
            }
            else{
                stock = "N/A";
            }
            data = ui.item.id + "*"+ ui.item.codigo+ "*"+ ui.item.label+ "*"+ ui.item.precio+ "*"+ stock + "*" + ui.item.asociado;
            $("#btn-agregar").val(data);
        },
    });

    $("#productosA").autocomplete({
        source:function(request, response){
            $.ajax({
                url: base_url+"movimientos/ventas/getproductosA",
                type: "POST",
                dataType:"json",
                data:{ valor: request.term},
                success:function(data){
                    response(data);
                }
            });
        },
        minLength:2,
        select:function(event, ui){

            html =  '<tr>'+
                        '<td><input type="hidden" name="idproductosA[]" value="'+ ui.item.id +'">'+ ui.item.codigo +'</td>'+
                        '<td>'+ ui.item.label +'</td>'+
                        '<td><input type="number" name="cantidadA[]" class="form-control"  value="1" min="1"></td>'+
                        '<td><button type="button" class="btn btn-danger btn-quitarAsociado"><i class="fa fa-times"></i></button></td>'+
                    '</tr>';
            $("#tbAsociados tbody").append(html);
        },
    });

    $(document).on("click", ".btn-quitarprod", function(){
        data = $(this).val();
        info = data.split("*");
        $("#idOrden").val(info[0]);
        $("#idProducto").val(info[1]);
        $("#cantEliminar").val(info[2]);
        $("#cantEliminar").attr('max',info[2]);
        $("#idPedidoProd").val(info[3]);
    })

    $(document).on("click",".btn-quitarAsociado", function(){
        $(this).closest("tr").remove();
    });
    
    $(document).on("click",".btn-delprod", function(){
        idProducto = $(this).val();
        $(this).closest("tr").remove();
        sumar();
      
    });

    $("#btn-agregar").on("click",function(){
        data = $(this).val();
        if (data !='') {
            infoproducto = data.split("*");
            html = "<tr>";
            html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>";
            html += "<td>"+infoproducto[2]+"</td>";
            html += "<td><input type='hidden' name='precios[]' value='"+infoproducto[3]+"'>"+infoproducto[3]+"</td>";
            html += "<td>"+infoproducto[4]+"</td>";
            html += "<td><input type='number' min='0' name='cantidades[]' value='1' class='cantidades'></td>";
            html += "<td><input type='hidden' name='importes[]' value='"+infoproducto[3]+"'><p>"+infoproducto[3]+"</p></td>";
            html += "</tr>";
            $("#tbventas tbody").append(html);
            sumar();
            $("#btn-agregar").val(null);
            $("#producto").val(null);

        }else{
            alertify.error("Seleccione un producto...");
        }
    });
    $(document).on("click",".btn-remove-medida", function(){
        $(this).closest("tr").remove();
  
    });
    $(document).on("click",".btn-remove-producto-compra", function(){
        $(this).closest("tr").remove();
        sumarCompra();
  
    });

    $(document).on("click",".btn-remove-producto", function(){
        $(this).closest("tr").remove();
        sumar();
    });
    $(document).on("keyup mouseup","#tbventas input.cantidades", function(){
        cantidad = Number($(this).val());
        precio = Number($(this).closest("tr").find("td:eq(2)").text());
        stock = Number($(this).closest("tr").find("td:eq(3)").text());
        if (cantidad > stock) {
            $(this).val(stock);
            alertify.error("La cantidad ingresada no debe sobrepasar el stock del producto");
            importe = stock * precio;
            $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
            $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
            sumar();
        }
        else{
            importe = cantidad * precio;
            $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
            $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
            sumar();
        }
    });

    $(document).on("click",".btn-view-venta",function(){
        valor_id = $(this).val();
        $("#btn-print-venta").attr("href", base_url+ "movimientos/ventas/printVenta/"+valor_id);
        $.ajax({
            url: base_url + "movimientos/ventas/view",
            type:"POST",
            dataType:"html",
            data:{id:valor_id},
            success:function(data){
                $("#modal-venta .modal-body").html(data);
            }
        });
    });

    $(document).on("click",".btn-view-compra",function(){
        valor_id = $(this).val();
        $.ajax({
            url: base_url + "movimientos/compras/view",
            type:"POST",
            dataType:"html",
            data:{id:valor_id},
            success:function(data){
                $("#modal-compra .modal-body").html(data);
            }
        });
    });
    var configPrint = {
            globalStyles: true,
            mediaPrint: false,
            stylesheet: null,
            noPrintSelector: ".no-print",
            append: null,
            prepend: null,
            manuallyCopyFormValues: true,
            deferred: $.Deferred(),
            timeout: 750,
            title: "  ",
            doctype: '<!doctype html>'
        };
    $(document).on("click",".btn-print-pedido",function(){
        $(".contenido-pedido").addClass("impresion");
        $(".contenido-pedido").print(configPrint);


    });

    $(document).on("click",".btn-print",function(){
        $(".contenido").addClass("impresion");
        $(".contenido").print({
            globalStyles: true,
            mediaPrint: false,
            stylesheet: null,
            noPrintSelector: ".hide-cupon",
            append: null,
            prepend: null,
            manuallyCopyFormValues: true,
            deferred: $.Deferred(),
            timeout: 750,
            title: "  ",
            doctype: '<!doctype html>'
        });
    });
    $(document).on("click",".btn-print-modal",function(){
        $("#modal-default .modal-body").print({
            globalStyles: true,
            mediaPrint: false,
            stylesheet: null,
            noPrintSelector: ".hide-cupon",
            append: null,
            prepend: null,
            manuallyCopyFormValues: true,
            deferred: $.Deferred(),
            timeout: 750,
            title: "  ",
            doctype: '<!doctype html>'
        });
    });
    $(document).on("click",".btn-print-ajuste",function(){
        $(".contenido").addClass("impresion");
        $(".contenido").print(configPrint);
    });

    $(document).on("click",".btn-print-cierre",function(){
        $(".contenido-cierre").addClass("impresion");
        $(".contenido-cierre").print(configPrint);
    });

    $(document).on("click",".btn-print-cupon",function(){
        $(".contenido").addClass("impresion");
        $(".contenido").print({
            globalStyles: true,
            mediaPrint: false,
            stylesheet: null,
            noPrintSelector: ".hide-venta",
            append: null,
            prepend: null,
            manuallyCopyFormValues: true,
            deferred: $.Deferred(),
            timeout: 750,
            title: "  ",
            doctype: '<!doctype html>'
        });
    });

    $(document).on("click",".btn-view-pedido", function(){
        var infoPedido = $(this).val();
        var dataPedido = infoPedido.split("*");
        $(".modal-footer .btn-pasar-preparacion").val(dataPedido[0]);
        $(".modal-footer .btn-pasar-entrega").val(dataPedido[0]);
        if (dataPedido[1] == 1) {
            $(".modal-footer .btn-pasar-preparacion").hide();
            $(".modal-footer .btn-pasar-entrega").show();
        }else{
            $(".modal-footer .btn-pasar-preparacion").show();
            $(".modal-footer .btn-pasar-entrega").hide();
        }
        $.ajax({
            url: base_url + "pedidos/cocina/getInfoPedido",
            type: "POST",
            
            data:{
                idPedido: dataPedido[0]
            },
            success: function(resp){
                $("#modal-pedido .modal-body").html(resp);
            }
        });
    })

    $(document).on("click", ".btn-pasar-preparacion", function(){
        var idPedido = $(this).val();
        $.ajax({
            url: base_url + "pedidos/cocina/updatePedido",
            type: "POST",
            data:{idPedido: idPedido, preparado: 1},
            success: function(resp){
                if (resp==1) {
                    $("#pen"+idPedido).remove();
                    swal("Bien","El pedido paso a Preparación","success");
                    cargarPedidosPreparacion();
                    $("#modal-pedido").modal("hide");
                }else{
                    swal("Error","No se pudo pasar a preparación el pedido indicado...inténtalo nuevamente","error");
                }
            }
        });

    });
    $(document).on("click", ".btn-pasar-entrega", function(){
        var idPedido = $(this).val();
        $.ajax({
            url: base_url + "pedidos/cocina/updatePedido",
            type: "POST",
            data:{idPedido: idPedido, preparado: 2},
            success: function(resp){
                if (resp==1) {
                    $("#pep"+idPedido).remove();
                    swal("Bien","El pedido paso a Entrega","success");
                    $("#modal-pedido").modal("hide");
                  
                }else{
                    swal("Error","No se pudo pasar a entrega el pedido indicado...inténtalo nuevamente","error");
                }
            }
        });

    });
});

function showCorte(caja_abierta){
        $.ajax({
            url: base_url + "caja/apertura_cierre/viewCorte/" + caja_abierta,
            type: "POST",
            success: function(resp){
                $("#modal-corte").modal({backdrop: 'static', keyboard: false});
                $('#modal-corte').css('position', 'absolute')
                $("#modal-corte .modal-body").html(resp);
            }
        });
    }

function generarnumero(numero){
    if (numero>= 99999 && numero< 999999) {
        return Number(numero)+1;
    }
    if (numero>= 9999 && numero< 99999) {
        return "0" + (Number(numero)+1);
    }
    if (numero>= 999 && numero< 9999) {
        return "00" + (Number(numero)+1);
    }
    if (numero>= 99 && numero< 999) {
        return "000" + (Number(numero)+1);
    }
    if (numero>= 9 && numero< 99) {
        return "0000" + (Number(numero)+1);
    }
    if (numero < 9 ){
        return "00000" + (Number(numero)+1);
    }
}

function sumar(){
    subtotal = 0;
    formulario = $("#formulario").val();
    if (formulario== "pago") {
        $("#tbpago tbody tr").each(function(){
            subtotal = subtotal + Number($(this).find("td:eq(4)").text());
        });
    }else{
        $("#tb-venta-directa tbody tr").each(function(){
            subtotal = subtotal + Number($(this).find("td:eq(5)").text());
        });
    }
    
    $("input[name=subtotal]").val(subtotal.toFixed(2));
    porcentaje = Number($("#igv").val());
    igv = subtotal * (porcentaje/100);
    $("input[name=iva]").val(igv.toFixed(2));
    descuento = Number($("input[name=descuento]").val());
    total = subtotal + igv - descuento;
    $("input[name=total]").val(total.toFixed(2));
    $(".subtotal").text(subtotal.toFixed(2));
    $(".iva").text(igv.toFixed(2));
    $(".descuento").text(descuento.toFixed(2));
    $(".total").text(total.toFixed(2));
}

function sumar_venta_directa(){
    subtotal = 0;
    $("#tb-venta-directa tbody tr").each(function(){
        subtotal = subtotal + Number($(this).find("td:eq(5)").text());
    });

    $("input[name=subtotal]").val(subtotal.toFixed(2));
    porcentaje = Number($("#igv").val());
    igv = subtotal * (porcentaje/100);
    $("input[name=iva]").val(igv.toFixed(2));
    descuento = Number($("input[name=descuento]").val());
    total = subtotal + igv - descuento;
    $("input[name=total]").val(total.toFixed(2));

    $(".subtotal").text(subtotal.toFixed(2));
    $(".iva").text(igv.toFixed(2));
    $(".descuento").text(descuento.toFixed(2));
    $(".total").text(total.toFixed(2));

}
function datagrafico(base_url){
    $.ajax({
        url: base_url + "Grafico/getData",
        type:"POST",
        dataType:"json",
        success:function(data){
            var dias = new Array();
            var montos = new Array();
            $.each(data,function(key, value){
                dias.push(value.fecha);
                valor = Number(value.monto);
                montos.push(valor);
            });
            graficar(dias,montos);
        }
    });
}

var year = (new Date).getFullYear();
    datagrafico(base_url);
    datagraficoMeses(base_url,year);
    $("#year").on("change",function(){
        yearselect = $(this).val();
        datagrafico(base_url,yearselect);
    });
    
function datagraficoMeses(base_url,year){
    namesMonth= ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Set","Oct","Nov","Dic"];
    $.ajax({
        url: base_url + "dashboard/getData",
        type:"POST",
        data:{year: year},
        dataType:"json",
        success:function(data){
            var meses = new Array();
            var montos = new Array();
            $.each(data,function(key, value){
                meses.push(namesMonth[value.mes - 1]);
                valor = Number(value.monto);
                montos.push(valor);
            });
            graficarMeses(meses,montos,year);
        }
    });
}

function graficar(dias,montos){
    Highcharts.chart('grafico', {
    chart: {
        type: 'column',
    },
    title: {
        text: 'Monto acumulado por ventas diarias'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: dias,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Monto Acumulado (Quetzales)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">Monto: </td>' +
            '<td style="padding:0"><b>{point.y:.2f} Quetzales</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        },
        series:{
            dataLabels:{
                enabled:true,
                formatter:function(){
                    return Highcharts.numberFormat(this.y,2)
                }
            }
        }
    },
    series: [{
        name: 'Dias',
        data: montos
    }],
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'horizontal'
                },
                yAxis: {
                    labels: {
                        align: 'left',
                        x: 0,
                        y: -5
                    },
                    title: {
                        text: null
                    }
                },
                subtitle: {
                    text: null
                },
                credits: {
                    enabled: false
                }
            }
        }]
    }
});
}
function graficarMeses(meses,montos,year){
    Highcharts.chart('graficoMeses', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Monto acumulado de ventas por mes'
    },
    subtitle: {
        text: 'Año:' + year
    },
    xAxis: {
        categories: meses,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Monto Acumulado (Quetzales)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">Monto: </td>' +
            '<td style="padding:0"><b>{point.y:.2f} Quetzales</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        },
        series:{
            dataLabels:{
                enabled:true,
                formatter:function(){
                    return Highcharts.numberFormat(this.y,2)
                }

            }
        }
    },
    series: [{
        name: 'Meses',
        data: montos

    }]
});
}

function descontarStock(id,stock,asociado){
    alert(id + " " +stock + " "+asociado);
    $.ajax({
        url : base_url + "movimientos/ventas/descontarStock",
        type: "POST",
        data: {idproducto:id,stock:stock,asociado:asociado},
        success: function(resp){
            alert(resp);
        }
    });
}

function comprobar(){
    var contador=0;
     $("#tborden input[type=checkbox]").each(function(){
        if($(this).is(":checked"))
            contador++;
    });
    totalfilas = $("#tborden tbody tr").length;

    if (totalfilas == contador) {
        $("#estadoPedido").val("1");
    }else{
        $("#estadoPedido").val("0");
    }

} 

function verificarMedida(medida_id){
    var existe = 0;
    $('input[name^="idMedidas"]').each(function() {
        if ($(this).val() == medida_id) {
            existe = 1;
        }
    });
    return existe;
}

function setEstado(){
    sumaValor = 0;
    $(".cantidades").each(function(){
        valor = Number($(this).val());
        sumaValor = sumaValor + valor;
    });
    sumaPag = Number($("#sumaPag").val());
    sumaCant = Number($("#sumaCant").val());
    totalPag = sumaValor + sumaPag;
    if (sumaCant != totalPag) {
        $("#estadoPedido").val("0");
    }else{
        $("#estadoPedido").val("1");
    }
}

function pad(n, width, z) {
  z = z || '0';
  n = n + '';
  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}

function verificar(producto_id){
    var existe = 0;
    $('input[name^="productos"]').each(function() {
        if ($(this).val() == producto_id) {
            existe = 1;
        }
    });
    return existe;
}

function extrasAgregados(){
    var extras = new Array;
    $('input[name^="extras"]').each(function() {
        info = $(this).val();
        extras.push(info);
    });
    return extras;
}

function obtenerDescuento(cantidadPagar,cantidadDesc,montoDesc){
    descuento = 0;
    cantidad_pagar = Number(cantidadPagar);
    cantidad_descuento = Number(cantidadDesc);
    monto_descuento = Number(montoDesc);
    if (cantidad_descuento > 0) {
        numero_descuento = Math.floor(cantidad_pagar/cantidadDesc);
        descuento = monto_descuento * numero_descuento;
    }
    return descuento.toFixed(2);

}

function cargarPedidosNuevos(){
    $.ajax({
        url: base_url + "pedidos/cocina/getPedidos",
        type:"POST",
        data:{
            preparado: 0
        },
        dataType: "json",
        success: function(data){
            //$("#cocina").html(resp);
            html = "";
            $.each(data, function(key, value){
                html += "<tr id='pen"+value.id+"'>"
                html += "<td>"+value.id+"</td>"
                var num_mesas = "";
                var consumo = "Para llevar";
                if (value.tipo_consumo == 1) {
                    consumo = "Comer en el Restaurante"
                    $.each(value.mesas, function(key2, value2){
                        num_mesas +=  value2.numero +",";
                    });
                }
                html += "<td>"+num_mesas+"</td>";
                html += "<td>"+consumo+"</td>";
                infoPedido = value.id+'*'+value.preparado
                html += "<td><button type='button' class='btn btn-primary btn-sm btn-view-pedido' value='"+infoPedido+"' data-toggle='modal' data-target='#modal-pedido'><span class='fa fa-search'></span></button> <button type='button' class='btn btn-warning btn-sm btn-pasar-preparacion' value='"+value.id+"'><i class='fa fa-long-arrow-right'></i>  a Preparación</button></td>";
                html += "</tr>"

            });
            $("#nuevosPedidos table > tbody").html(html);
            setTimeout(cargarPedidosNuevos, 10000);
        }
    });
}

function cargarPedidosPreparacion(){
    $.ajax({
        url: base_url + "pedidos/cocina/getPedidos",
        type:"POST",
        data:{
            preparado : 1
        },
        dataType: "json",
        success: function(data){
            //$("#cocina").html(resp);
            html = "";
            $.each(data, function(key, value){
                html += "<tr id='pep"+value.id+"'>"
                html += "<td>"+value.id+"</td>"
                var num_mesas = "";
                var consumo = "Para llevar";
                if (value.tipo_consumo == 1) {
                    consumo = "Comer en el Restaurante"
                    $.each(value.mesas, function(key2, value2){
                        num_mesas +=  value2.numero +",";
                    });
                }
                html += "<td>"+num_mesas+"</td>";
                html += "<td>"+consumo+"</td>";
                infoPedido = value.id+'*'+value.preparado
                html += "<td><button type='button' class='btn btn-primary btn-sm btn-view-pedido' value='"+infoPedido+"' data-toggle='modal' data-target='#modal-pedido'><span class='fa fa-search'></span></button> <button type='button' class='btn btn-success btn-sm btn-pasar-entrega' value='"+value.id+"'><i class='fa fa-long-arrow-right'></i> a Entrega</button></td>";
                html += "</tr>"

            });
            $("#pedidosPreparacion table > tbody").html(html);
            setTimeout(cargarPedidosPreparacion, 10000);
        }
    });
}
function cargarListaPedidos(pageCurrent){
    search = $("#search-orden").val();
    records_per_page = $("#records_per_page").val(); 
    $.ajax({
        url: base_url + "movimientos/ordenes/getOrdenes",
        type:"POST",
        dataType: 'json',
        data: {value:search, records_per_page: records_per_page, page_current: pageCurrent},
        success: function(data){
            pagination = '';
            num_links = Math.ceil(data.totalOrdenes / records_per_page);
            if (Number(pageCurrent)==1) {
                pagination += "<li class='disabled'><a href='#'>Anterior</a></li>";
            }else{
                pagination += "<li><a href='"+(pageCurrent-1)+"' class='link'>Anterior</a></li>";
            }
            for( i= 1; i<=num_links; i++){
                active = ((i == Number(pageCurrent)) ? 'active' : '');
                pagination += "<li class='"+active+"'><a href='"+i+"' class='link'>"+i+"</a></li>";
            } 
            if (Number(pageCurrent)==num_links) {
                pagination += "<li class='disabled'><a href='#'>Siguiente</a></li>";
            }else{
                pagination += "<li><a href='"+(pageCurrent+1)+"' class='link'>Siguiente</a></li>";
            }
            $(".pagination").html(pagination);
            html = "";

            if (data.ordenes.length) {
                $.each(data.ordenes, function(key, value){
                    html += "<tr>"; 
                    html += "<td>"+value.mesas+"</td>";
                    estado = '';
                    if (value.preparado == 0) {
                        estado ="<span class='label label-danger'>Pendiente</span>";
                    } else if(value.preparado == 1){
                        estado ="<span class='label label-warning'>En Preparación</span>";
                    } else{
                        estado ="<span class='label label-success'>Listo a Entregar</span>";
                    }
                    html += "<td>"+estado+"</td>";
                    html += "<td>"+value.tipo_consumo+"</td>";  
                    infoPedido = value.id+'*'+value.preparado
                    var permisos = JSON.parse($("#permisos").val());       
                    var btnView = '<button type="button" class="btn btn-primary btn-info-pedido btn-sm" data-toggle="modal" data-target="#modal-venta" value="'+value.id+'"><span class="fa fa-search"></span></button>';
                    var btnEdit = '';
                    var btnPay = '';
                    if (permisos.update == 1) {
                        btnEdit = '<a href="' + base_url +'movimientos/ordenes/edit/'+value.id+'" class="btn btn-warning btn-sm"><span class="fa fa-pencil"></span></a>';
                                                
                        btnPay = '<a href="'+base_url+ 'movimientos/ordenes/pay/'+value.id+'" class="btn btn-success btn-sm"><i class="fa fa-credit-card" aria-hidden="true"></i></a>';
                    }
                    var btnDelete = '';
                    if (permisos.delete == 1) {
                        btnDelete = '<a href="'+base_url+'movimientos/ordenes/delete/'+value.id+'" class="btn btn-danger btn-delete-orden btn-sm"><i class="fa fa-times" aria-hidden="true"></i></a>';

                    }                     
                    html += "<td><div class='btn-group'>" + btnView +" "+btnEdit +" "+btnPay +" "+btnDelete + "</div></td>";
                    html += "</tr>"; 
                });
            } else {
                html = "<tr><td colspan='4' class='text-center'>No hay ordenes</td></tr>";
            }
            
            $("#tbordenesactual tbody").html(html);
            
        }
    });
    
}

function show_products_by_category(categoria_id){
        $.ajax({
            url: base_url + "mantenimiento/productos/getProductosByCategoria",
            data: {categoria_id:categoria_id},
            type:"POST",
            dataType:"json",
            success: function(resp){
                $('#tbProductos').dataTable( {
                    destroy: true,
                    data : resp,
                    columns: [
                        {"data": "nombre"}, 
                        {
                            mRender: function (data, type, row) {
                                var button = "<button type='button' class='btn btn-info btn-xs btn-info-evolucion' data-toggle='modal' data-target='#modal-default' value='"+JSON.stringify(row)+"'><span class='fa fa-check'></span></button>";
                                return button;
                            }
                        },           
                    ],
                    order: [[ 0,"asc" ]]
                });
            }
        });
    }

function showAjuste(id){
    $.ajax({
        url: base_url + "mantenimiento/ajuste/view/" + id,
        type: "POST",
        success: function(resp){
            $("#modal-ajuste").modal("show");
            $("#modal-ajuste .modal-body").html(resp);
        }
    });
}

function showCorte(id){
    $.ajax({
        url: base_url + "caja/apertura_cierre/viewCorte/" + id,
        type: "POST",
        success: function(resp){
            $("#modal-corte").modal("show");
            $("#modal-corte .modal-body").html(resp);
        }
    });
}

function graficoTorta(datos){
    Highcharts.chart('grafico-torta', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Productos'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: datos,
    }]
});
}

function showCategoriasAsociadas(tr_id,producto_id){
    $.ajax({
        url: base_url + "movimientos/ordenes/getCategoriasAsociadas",
        type: "POST",
        data:{
            producto_id: producto_id
        },
        dataType: "json",
        success: function(data){
            html = "";
            $.each(data, function(key, value){
                input = "<input type='hidden' class='cat"+value.categoria_id+"' value='0'>";
                input += "<input type='hidden' id='cat"+value.categoria_id+"' value='"+value.cantidad+"'>";

                html += input;
            });

            $("#"+tr_id+ " td:eq(0)").append(html);
        }
    });
}


