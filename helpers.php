<?php
  function mipos_validate_field($field, $value, $rules, $errors) {
    if(in_array('required', $rules)) {
      if(!isset($value) || trim($value) === '') {
        $errors[$field] = 'Este campo es requerido';
      }
    }

    if(in_array('sucursal_max', $rules)) {
      if(isset($value)) {
        if($value > 999 || $value < 0 || filter_var($value, FILTER_VALIDATE_INT) === false) {
          $errors[$field] = 'La sucursal debe estar entre 1 y 999';
        }
      }
    }

    return $errors;
  }


  function mipos_getUrlApi($modo_hacienda, $miposURL) {
    if($modo_hacienda === 'production') {
        $endpoint = 'https://'.$miposURL.'.mipos.co.cr/api/fe/index.php?funcion=enviar&action=items';
    } else {
        $endpoint = 'https://demo.mipos.co.cr/api/fe/index.php?funcion=enviar&action=items';
    }
    return $endpoint;
  }

  function mipos_cmp($a, $b)
  {
    return $a['codigo'] <=> $b['codigo'];
  }


  function mipos_getEconomicActivitiesHacienda() {
    $array = array(
      array(
        'codigo' => '155101',
        'actividad' => 'Elaborac. rectificac mezcla bebidas alcoholicas/prod. de alcohol etilico (sustan fermentadas)'
      ),
      array(
        'codigo' => '155103',
        'actividad' => 'Elaboracion de bebidas con porcentaje de alcohol por volumen menor al 15%.'
      ),
      array(
        'codigo' => '155301',
        'actividad' => 'Elaboracion de bebidas malteadas y de malta no artesanales'
      ),
      array(
        'codigo' => '155302',
        'actividad' => 'Elaboracion artesanal de bebidas malteadas y de malta.'
      ),
      array(
        'codigo' => '155403',
        'actividad' => 'Elaboracion de bebidas no alcoholicas / gaseosas / agua mineral y de manantial'
      ),
      array(
        'codigo' => '155404',
        'actividad' => 'Elaboracion de concentrado para bebidas naturales y gaseosas'
      ),
      array(
        'codigo' => '160001',
        'actividad' => 'Elaboracion de productos de tabaco'
      ),
      array(
        'codigo' => '171101',
        'actividad' => 'Fabricacion de todo tipo de telas y/o hilos'
      ),
      array(
        'codigo' => '171201',
        'actividad' => 'Maquila de productos textiles'
      ),
      array(
        'codigo' => '171202',
        'actividad' => 'Hidrofugado/impermeabilizado'
      ),
       array(
        'codigo' => '172101',
        'actividad' => 'Fabricacion de articulos confeccionados de materiales textiles, exepto prendas de vestir'
      ),
       array(
        'codigo' => '172103',
        'actividad' => 'Diseño artistico para costura (moldes)'
      ),
       array(
        'codigo' => '172201',
        'actividad' => 'Fabricacion de tapices y alfombras'
      ),
       array(
        'codigo' => '172301',
        'actividad' => 'Fabricacion de cuerdas, cordeles,bramantes y redes'
      ),
       array(
        'codigo' => '172302',
        'actividad' => 'Fabricacion de hilos y cuerdas para uso agricola y pesca'
      ),
       array(
        'codigo' => '172902',
        'actividad' => 'Servicio de bordado a mano o a maquina'
      ),
       array(
        'codigo' => '701001',
        'actividad' => 'Alquiler de casas y otros'
      ),
       array(
        'codigo' => '802202',
        'actividad' => 'Ensenanza secundaria de formacion tecnica y profesional no autorizada por el MEP.'
      ),
       array(
        'codigo' => '101001',
        'actividad' => 'Extraccion y aglomeracion de carbon de piedra'
      ),
       array(
        'codigo' => '111001',
        'actividad' => 'Extraccion de petroleo crudo y gas natural'
      ),
       array(
        'codigo' => '120001',
        'actividad' => 'Extraccion de minerales de uranio y torio'
      ),
       array(
        'codigo' => '141001',
        'actividad' => 'Extraccion de piedra, arena y arcilla'
      ),
       array(
        'codigo' => '142101',
        'actividad' => 'Extraccion de minerales y sustancias para la fabricacion de abonos'
      ),
       array(
        'codigo' => '142201',
        'actividad' => 'Extraccion de sal'
      ),
       array(
        'codigo' => '142901',
        'actividad' => 'Explotacion de otras minas y canteras n.c.p.'
      ),
       array(
        'codigo' => '142902',
        'actividad' => 'Venta de asfalto/mezcla asfaltica'
      ),
       array(
        'codigo' => '151101',
        'actividad' => 'Produccion, procesamiento y conservacion de carnes y embutidos (sin envasar)'
      ),
       array(
        'codigo' => '151103',
        'actividad' => 'Produccion de cueros y pieles sin curtir'
      ),
       array(
        'codigo' => '151105',
        'actividad' => 'Produccion de embutidos empacados, envasado y enlatado'
      ),
       array(
        'codigo' => '151201',
        'actividad' => 'Elaboracion y conservacion de pescado y sus derivados'
      ),
       array(
        'codigo' => '151301',
        'actividad' => 'Elaboracion y conservacion de frutas, legumbres y hortalizas'
      ),
       array(
        'codigo' => '151304',
        'actividad' => 'Produccion de concentrados para jugos (citricultura)'
      ),
       array(
        'codigo' => '151401',
        'actividad' => 'Elaboracion de aceites y grasas de origen vegetal y animal'
      ),
       array(
        'codigo' => '152001',
        'actividad' => 'Produccion de helados y otros productos similares'
      ),
       array(
        'codigo' => '152002',
        'actividad' => 'Elaboracion de productos lacteos gravados con ventas'
      ),
       array(
        'codigo' => '152003',
        'actividad' => 'Elaboracion de productos lacteos exentos de imp. ventas'
      ),
       array(
        'codigo' => '153101',
        'actividad' => 'Servicio de molienda'
      ),
       array(
        'codigo' => '153102',
        'actividad' => 'Elaboracion de harinas premezcladas y preparadas para la fabricacion de productos de panaderia y reposteria'
      ),
       array(
        'codigo' => '153103',
        'actividad' => 'Procesamiento del arroz'
      ),
       array(
        'codigo' => '153104',
        'actividad' => 'Fabricacion de harinas finas y gruesas'
      ),
       array(
        'codigo' => '153201',
        'actividad' => 'Elaboracion de productos derivados de almidon'
      ),
       array(
        'codigo' => '153301',
        'actividad' => 'Elaboracion de alimentos para animales destinados al consumo humano'
      ),
       array(
        'codigo' => '153302',
        'actividad' => 'Elaboracion de pacas de heno'
      ),
       array(
        'codigo' => '154101',
        'actividad' => 'Venta de pan y otros productos similares grabados con ventas'
      ),
       array(
        'codigo' => '154102',
        'actividad' => 'Pasteleria, reposteria o ambas'
      ),
       array(
        'codigo' => '154104',
        'actividad' => 'Venta de pan y otros productos similares exentos de ventas'
      ),
       array(
        'codigo' => '154201',
        'actividad' => 'Elaboracion de azucar y sus derivados'
      ),
       array(
        'codigo' => '154202',
        'actividad' => 'Elaboracion de productos derivados de la caña de azucar'
      ),
       array(
        'codigo' => '154301',
        'actividad' => 'Elaboracion de cacao'
      ),
       array(
        'codigo' => '154302',
        'actividad' => 'Elaboracion de chocolate'
      ),
       array(
        'codigo' => '154303',
        'actividad' => 'Elaboracion de dulces, golosinas y conservas en azucar'
      ),
       array(
        'codigo' => '154401',
        'actividad' => 'Elaboracion de macarrones, fideos, alcuzcuz y productos farinaceos similares'
      ),
       array(
        'codigo' => '154902',
        'actividad' => 'Fabricacion de productos alimenticios preparados n.c.p. (nocontemplados en otra parte)'
      ),
       array(
        'codigo' => '154903',
        'actividad' => 'Fabricacion de hielo'
      ),
       array(
        'codigo' => '154904',
        'actividad' => 'Fabricacion de cafe (excepto el envasado, enlatado, solubley el descafeinado)'
      ),
       array(
        'codigo' => '154905',
        'actividad' => 'Elaboracion de productos de maiz exentos de ventas'
      ),
       array(
        'codigo' => '154908',
        'actividad' => 'Elaboracion de productos de maiz gravados con ventas'
      ),
       array(
        'codigo' => '221101',
        'actividad' => 'Edicion de libros de textos'
      ),
       array(
        'codigo' => '221201',
        'actividad' => 'Edicion de periodicos, revistas y otras publicaciones periodicas'
      ),
       array(
        'codigo' => '221901',
        'actividad' => 'Artes graficas'
      ),
       array(
        'codigo' => '222102',
        'actividad' => 'Tipografia y/o litografia (imprenta)'
      ),
       array(
        'codigo' => '222104',
        'actividad' => 'Impresion digital'
      ),
       array(
        'codigo' => '222105',
        'actividad' => 'Serigrafia'
      ),
       array(
        'codigo' => '223001',
        'actividad' => 'Reproduccion de grabaciones'
      ),
       array(
        'codigo' => '232001',
        'actividad' => 'Refinerias de petroleo'
      ),
       array(
        'codigo' => '232002',
        'actividad' => 'Fabricacion de productos diversos derivados del petroleo'
      ),
       array(
        'codigo' => '232005',
        'actividad' => 'Elaboracion de biocombustibles'
      ),
       array(
        'codigo' => '241101',
        'actividad' => 'Fabricacion de sustancias quimicas y gases industriales excepto abonos'
      ),
       array(
        'codigo' => '241201',
        'actividad' => 'Fabricacion de abonos y compuestos de nitrogeno'
      ),
       array(
        'codigo' => '241301',
        'actividad' => 'Fabricacion de plasticos y caucho sintetico en formas primarias'
      ),
       array(
        'codigo' => '241302',
        'actividad' => 'Fabricacion de resinas'
      ),
       array(
        'codigo' => '242101',
        'actividad' => 'Fabricacion de plaguicidas y otros productos quimicos de uso agropecuario'
      ),
       array(
        'codigo' => '242201',
        'actividad' => 'Fabricacion de pinturas, barnices y productos de revestimi-to similares'
      ),
       array(
        'codigo' => '242202',
        'actividad' => 'Fabricacion de tintas de imprentas'
      ),
       array(
        'codigo' => '242301',
        'actividad' => 'Fabricacion productos farmaceuticos, sustancias quimicas yproductos botanicos'
      ),
       array(
        'codigo' => '292101',
        'actividad' => 'Fabricacion de maquinaria agricola'
      ),
       array(
        'codigo' => '292201',
        'actividad' => 'Fabricacion de maquinas herramienta'
      ),
       array(
        'codigo' => '292301',
        'actividad' => 'Fabricacion de maquinaria metalurgica'
      ),
       array(
        'codigo' => '292401',
        'actividad' => 'Fabricacion de maquinaria para la explotacion de minas y canteras y para obras de construccion'
      ),
       array(
        'codigo' => '292402',
        'actividad' => 'Perforacion de pozos'
      ),
       array(
        'codigo' => '292501',
        'actividad' => 'Fabricacion de maquinaria para la elaboracion de alimentos,bebidas y tabaco'
      ),
       array(
        'codigo' => '292601',
        'actividad' => 'Fabricacion maquinaria para la elaboracion de productos textiles, prendas de vestir y cueros'
      ),
       array(
        'codigo' => '292701',
        'actividad' => 'Fabricacion de armas y municiones'
      ),
       array(
        'codigo' => '292901',
        'actividad' => 'Fabricacion de otros tipos de maquinaria de uso especial'
      ),
       array(
        'codigo' => '331101',
        'actividad' => 'Fabricacion y comercializacion de protesis'
      ),
       array(
        'codigo' => '331102',
        'actividad' => 'Fabricacion y comercializacion de equipo medico'
      ),
       array(
        'codigo' => '331103',
        'actividad' => 'Fabricacion y comercializacion de zapatos ortopedicos'
      ),
       array(
        'codigo' => '331201',
        'actividad' => 'Fabricacion de equipos para medir, verificar, y navegar y de equipos de control'
      ),
       array(
        'codigo' => '332001',
        'actividad' => 'Fabricacion de instrumentos opticos y equipo fotografico'
      ),
       array(
        'codigo' => '333001',
        'actividad' => 'Fabricacion de relojes de todo tipo'
      ),
       array(
        'codigo' => '341001',
        'actividad' => 'Fabricacion de vehiculos automotores'
      ),
       array(
        'codigo' => '342001',
        'actividad' => 'Fabricacion de carrocerias para vehiculos automotores, remolques y semiremolques'
      ),
       array(
        'codigo' => '342002',
        'actividad' => 'Fabricacion de carrocerias para camiones de las partidas arancelarias 870790002 y 870790500029'
      ),
       array(
        'codigo' => '343001',
        'actividad' => 'Fabricacion de partes, piezas y accesorios para vehiculos automotores'
      ),
       array(
        'codigo' => '293001',
        'actividad' => 'Fabricacion de aparatos de uso domestico n.c.p.'
      ),
       array(
        'codigo' => '300001',
        'actividad' => 'Fabricacion de maquinaria de oficina, contabilidad e informatica'
      ),
       array(
        'codigo' => '311001',
        'actividad' => 'Fabricacion de motores, generadores y transformadores electricos, partes y acces'
      ),
       array(
        'codigo' => '313001',
        'actividad' => 'Fabricacion de hilos y cables aislados'
      ),
       array(
        'codigo' => '314001',
        'actividad' => 'Fabricacion de pilas, baterias y acumuladores'
      ),
       array(
        'codigo' => '315001',
        'actividad' => 'Fabricacion de lamparas electricas y equipo de iluminacion'
      ),
        array(
        'codigo' => '319001',
        'actividad' => 'Fabricacion de otros tipos de equipo electrico n.c.p.'
      ),
        array(
        'codigo' => '321001',
        'actividad' => 'Manufactura o fabricacion de otros componentes electronicos'
      ),
        array(
        'codigo' => '321002',
        'actividad' => 'Diseño de componentes electronicos'
      ),
        array(
        'codigo' => '322001',
        'actividad' => 'Fabricacion de transmisores y receptores de radio y television'
      ),
        array(
        'codigo' => '242401',
        'actividad' => 'Fabricacion jabones, detergentes, preparados de tocador, para limpiar pulir y perfumes'
      ),
        array(
        'codigo' => '242404',
        'actividad' => 'Fabricacion de jabones de tocador'
      ),
        array(
        'codigo' => '242405',
        'actividad' => 'Fabricacion de jabones para lavar (excepto preparaciones tenso activas usadas como jabon)'
      ),
        array(
        'codigo' => '242406',
        'actividad' => 'Fabricacion de ceras, abrillantadores, lustradores y preparaciones similares'
      ),
        array(
        'codigo' => '242901',
        'actividad' => 'Fabricacion de otros productos quimicos.'
      ),
        array(
        'codigo' => '242902',
        'actividad' => 'Fabricacion de pegamentos y adhesivos'
      ),
        array(
        'codigo' => '242903',
        'actividad' => 'Reparacion de armas de fuego'
      ),
        array(
        'codigo' => '243001',
        'actividad' => 'Fabricacion de fibras sinteticas'
      ),
        array(
        'codigo' => '251101',
        'actividad' => 'Fabricacion de llantas y cubiertas para equipo y maquinariamovil'
      ),
        array(
        'codigo' => '251102',
        'actividad' => 'Reencauchadora de llantas'
      ),
        array(
        'codigo' => '251901',
        'actividad' => 'Fabricacion de otros productos de caucho'
      ),
        array(
        'codigo' => '252001',
        'actividad' => 'Fabricacion de articulos de plastico'
      ),
        array(
        'codigo' => '261001',
        'actividad' => 'Fabricacion de vidrio y productos de vidrio'
      ),
        array(
        'codigo' => '269101',
        'actividad' => 'Fabricacion productos de ceramica barro loza y/o porcelanano refractaria uso no estructural'
      ),
        array(
        'codigo' => '269201',
        'actividad' => 'Fabricacion de productos de ceramica refractaria'
      ),
        array(
        'codigo' => '269301',
        'actividad' => 'Fabricacion de productos de arcilla y ceramica no refractarias para uso estructural'
      ),
        array(
        'codigo' => '269401',
        'actividad' => 'Fabricacion y/o venta de cemento, cal y yeso'
      ),
        array(
        'codigo' => '269501',
        'actividad' => 'Fabricacion de articulos de cemento, yeso y hormigon para la construccion'
      ),
        array(
        'codigo' => '269601',
        'actividad' => 'Corte, tallado y acabado de la piedra'
      ),
        array(
        'codigo' => '269901',
        'actividad' => 'Fabricacion de otros productos minerales no metalicos n.c.p.'
      ),
        array(
        'codigo' => '271001',
        'actividad' => 'Industrias basicas de hierro y acero'
      ),
        array(
        'codigo' => '272001',
        'actividad' => 'Fabricacion de productos primarios de metales preciosos y metales no ferrosos'
      ),
        array(
        'codigo' => '273101',
        'actividad' => 'Fundicion de hierro y acero'
      ),
        array(
        'codigo' => '273201',
        'actividad' => 'Fundicion de metales no ferrosos'
      ),
        array(
        'codigo' => '281101',
        'actividad' => 'Fabricacion de productos metalicos para uso estructural'
      ),
        array(
        'codigo' => '281201',
        'actividad' => 'Fabricacion de tanques, depositos y recipientes de metal'
      ),
        array(
        'codigo' => '281301',
        'actividad' => 'Fabricacion generadores de vapor, excepto calderas de agua caliente para calefacion central'
      ),
        array(
        'codigo' => '289201',
        'actividad' => 'Servicios de soldadura'
      ),
        array(
        'codigo' => '289202',
        'actividad' => 'Servicio de tratamiento y revestimiento de todo tipo de materiales'
      ),
        array(
        'codigo' => '289302',
        'actividad' => 'Hojalateria'
      ),
        array(
        'codigo' => '289304',
        'actividad' => 'Taller de mecanica de precision'
      ),
        array(
        'codigo' => '289305',
        'actividad' => 'Fabricacion de piezas, articulos y accesorios de metal incluye las cerrajerias.'
      ),
        array(
        'codigo' => '289306',
        'actividad' => 'Servicios de torno (mecanica de precision)'
      ),
        array(
        'codigo' => '289902',
        'actividad' => 'Fabricacion de otros productos elaborados de metal n.c.p.'
      ),
        array(
        'codigo' => '290001',
        'actividad' => 'Servicio de reparacion de maquinaria y equipo.'
      ),
        array(
        'codigo' => '290003',
        'actividad' => 'Servicio de mantenimiento de maquinaria y equipo.'
      ),
        array(
        'codigo' => '291101',
        'actividad' => 'Fabricacion de motores y turbinas, excepto motores para aeronaves, vehiculos automotores y motocicletas'
      ),
        array(
        'codigo' => '291201',
        'actividad' => 'Fabricacion de bombas, compresores, grifos y valvulas'
      ),
        array(
        'codigo' => '291202',
        'actividad' => 'Venta de bombas de agua'
      ),
        array(
        'codigo' => '291401',
        'actividad' => 'Fabricacion de hornos y quemadores'
      ),
        array(
        'codigo' => '291901',
        'actividad' => 'Reparacion de equipo de refrigeracion y congelacion'
      ),
        array(
        'codigo' => '291903',
        'actividad' => 'Instalacion y/o mantenimiento de equipo de refrigeracion y congelacion'
      ),
        array(
        'codigo' => '173001',
        'actividad' => 'Fabricacion de tejdos y articulos de punto y ganchillo'
      ),
        array(
        'codigo' => '181001',
        'actividad' => 'Servicios de costura y sastreria (costureras y sastres)'
      ),
        array(
        'codigo' => '181002',
        'actividad' => 'Fabricacion de prendas de vestir (ropa de todo tipo)'
      ),
        array(
        'codigo' => '182001',
        'actividad' => 'Adobo y teñido de pieles; fabricacion de articulos de piel natural o artificial'
      ),
        array(
        'codigo' => '191101',
        'actividad' => 'Fabricacion de maletas, bolsos de mano y articulos similares'
      ),
        array(
        'codigo' => '192001',
        'actividad' => 'Fabricacion de todo tipo de zapatos exepto el ortopedico'
      ),
        array(
        'codigo' => '201002',
        'actividad' => 'Aserrado y acepilladura de madera'
      ),
        array(
        'codigo' => '202101',
        'actividad' => 'Fabricacion de hojas de madera para enchapado y tableros como plywood, durpanel y similares'
      ),
        array(
        'codigo' => '202201',
        'actividad' => 'Fabricacion de partes y piezas de carpinteria para edificios y construcciones'
      ),
        array(
        'codigo' => '202301',
        'actividad' => 'Fabricacion de tarimas'
      ),
        array(
        'codigo' => '202902',
        'actividad' => 'Fabricacion y/o venta de ataudes (cajas mortuorias, feretros).'
      ),
        array(
        'codigo' => '210101',
        'actividad' => 'Fabricacion de papel y carton y envases de papel y carton'
      ),
        array(
        'codigo' => '210201',
        'actividad' => 'Fabricacion de otros articulos de papel y carton'
      ),
        array(
        'codigo' => '512225',
        'actividad' => 'Comercio al por mayor de bebidas no alcoholicas (jugos defrutas, vegetales) y agua embotellada'
      ),
        array(
        'codigo' => '512232',
        'actividad' => 'Comercio al por mayor de productos sustitutos del azucar'
      ),
        array(
        'codigo' => '512233',
        'actividad' => 'Comercio al por mayor de carnes de todo tipo (preparadas sazonadas condimentadas empanizadas)'
      ),
        array(
        'codigo' => '512234',
        'actividad' => 'Comercio al por mayor de cerveza importada'
      ),
        array(
        'codigo' => '512235',
        'actividad' => 'Venta al por mayor de legumbres y hortalizas grabados en ventas'
      ),
        array(
        'codigo' => '512237',
        'actividad' => 'Comercio al por mayor de alimentos y productos n.c.p. excentos de ventas'
      ),
        array(
        'codigo' => '513101',
        'actividad' => 'Venta al por mayor de calzado, productos textiles; prendasde vestir;'
      ),
        array(
        'codigo' => '513501',
        'actividad' => 'Venta al por mayor de preparados y/o articulos para la limpieza de uso general'
      ),
        array(
        'codigo' => '513601',
        'actividad' => 'Venta al por mayor equipo medico accesorios medicamentos produc farmaceutico exentos de ventas'
      ),
        array(
        'codigo' => '513602',
        'actividad' => 'Comercio al por mayor de productos de veterinaria'
      ),
        array(
        'codigo' => '513604',
        'actividad' => 'Venta al por mayor equipo medico accesorio medicamento produc farmaceutico grabados con ventas'
      ),
        array(
        'codigo' => '513710',
        'actividad' => 'Venta al por mayor de libros y textos educativos'
      ),
        array(
        'codigo' => '513901',
        'actividad' => 'Venta al por menor de articulos deportivos'
      ),
        array(
        'codigo' => '513904',
        'actividad' => 'Venta al por mayor de suministros y articulos de libreria'
      ),
        array(
        'codigo' => '513906',
        'actividad' => 'Venta al por mayor de articulos, artefactos, discos y muebles para el hogar'
      ),
        array(
        'codigo' => '513907',
        'actividad' => 'Venta al por mayor de discos compactos y otros dispositivosde grabacion'
      ),
        array(
        'codigo' => '513910',
        'actividad' => 'Venta al por mayor de todo tipo de articulos por catalogo'
      ),
        array(
        'codigo' => '514101',
        'actividad' => 'Venta al por mayor de combustibles solidos (leña y similares)'
      ),
        array(
        'codigo' => '514103',
        'actividad' => 'Venta al por mayor de combustibles solidos (carbon)'
      ),
        array(
        'codigo' => '514201',
        'actividad' => 'Venta al por mayor de metales y minerales metaliferos'
      ),
        array(
        'codigo' => '514304',
        'actividad' => 'Venta al por mayor de equipo de aire acondicionado y calentadores (electricos, solares, etc.)'
      ),
        array(
        'codigo' => '514308',
        'actividad' => 'Venta al por mayor de materiales para la contruccion, articulos de ferreteria, equipo y materiales de fontaneria y calefaccion'
      ),
        array(
        'codigo' => '514701',
        'actividad' => 'Venta al por mayor de productos,sustancias o reactivos quimicos y solventes en general'
      ),
        array(
        'codigo' => '522002',
        'actividad' => 'Venta de carnes (res, pollo,cerdo) incluidas en la canasta basica'
      ),
        array(
        'codigo' => '522003',
        'actividad' => 'Macrobioticas'
      ),
        array(
        'codigo' => '522004',
        'actividad' => 'Venta de verduras y frutas exentos de ventas'
      ),
        array(
        'codigo' => '522005',
        'actividad' => 'Venta de mariscos y/o pescado (pescaderias o marisquerias)incluidos en la canasta basica'
      ),
        array(
        'codigo' => '522007',
        'actividad' => 'Licorerias y/o deposito de licores (venta al por menor)'
      ),
        array(
        'codigo' => '522008',
        'actividad' => 'Venta al por menor de huevos de gallina incluidos en la canasta basica'
      ),
        array(
        'codigo' => '522009',
        'actividad' => 'Venta de frutas gravadas con ventas'
      ),
        array(
        'codigo' => '522010',
        'actividad' => 'Venta de embutidos y carnes (res, pollo, cerdo)incluidas enla canasta basica'
      ),
        array(
        'codigo' => '522011',
        'actividad' => 'Preparacion, servicio y venta de frutas picadas y bebidas de frutas y/o legumbres.'
      ),
        array(
        'codigo' => '522012',
        'actividad' => 'Comercio al por menor de bebidas gaseosas y carbonatadas'
      ),
        array(
        'codigo' => '522013',
        'actividad' => 'Comercio al por menor de agua embotellada'
      ),
        array(
        'codigo' => '522014',
        'actividad' => 'Venta de frutas incluidas en la nueva canasta basica'
      ),
        array(
        'codigo' => '522015',
        'actividad' => 'Venta al por menor de cafe (excepto el envasado, enlatado, soluble, descafeinado)'
      ),
        array(
        'codigo' => '522016',
        'actividad' => 'Comercio al por menor de productos de tabaco'
      ),
        array(
        'codigo' => '522017',
        'actividad' => 'Venta de embutidos y carnes (res, pollo, cerdo, caballo,etc) gravadas en ventas'
      ),
        array(
        'codigo' => '522018',
        'actividad' => 'Venta de pescados y/o mariscos (pescaderias o marisquerias) gravados en ventas'
      ),
        array(
        'codigo' => '523101',
        'actividad' => 'Farmacias'
      ),
        array(
        'codigo' => '523102',
        'actividad' => 'Venta al por menor de cosmeticos y perfumeria'
      ),
        array(
        'codigo' => '523201',
        'actividad' => 'Bazares'
      ),
        array(
        'codigo' => '523202',
        'actividad' => 'Venta al por menor de ropa (boutique)'
      ),
        array(
        'codigo' => '514901',
        'actividad' => 'Venta al por mayor y al por menor de chatarra'
      ),
        array(
        'codigo' => '514903',
        'actividad' => 'Venta al por mayor de productos para uso agropecuario y venta desechos organicos e inorganicos'
      ),
        array(
        'codigo' => '515001',
        'actividad' => 'Venta al por mayor de maquinaria y equipo industrial, de construccion, ingenieria civil y otros, asi como sus accesorios'
      ),
        array(
        'codigo' => '515002',
        'actividad' => 'Venta al por mayor de repuestos y/o accesorios para maquinaria y equipo agropecuario'
      ),
        array(
        'codigo' => '515003',
        'actividad' => 'Venta al por mayor de maquinaria y equipo agropecuario'
      ),
        array(
        'codigo' => '515004',
        'actividad' => 'Venta al por mayor de extintores y equipo similar'
      ),
        array(
        'codigo' => '515201',
        'actividad' => 'Venta al por mayor de equipo de computo, sus partes y accesorios'
      ),
        array(
        'codigo' => '515203',
        'actividad' => 'Venta al por mayor de equipo y suministros de oficina'
      ),
        array(
        'codigo' => '519003',
        'actividad' => 'Venta al por mayor de equipo, articulos y accesorios de belleza, cosmeticos e higiene personal'
      ),
        array(
        'codigo' => '519005',
        'actividad' => 'Venta al por mayor de equipo para campo de juegos (play)'
      ),
        array(
        'codigo' => '519006',
        'actividad' => 'Distribucion y comercializacion al por mayor de material deempaque'
      ),
        array(
        'codigo' => '519010',
        'actividad' => 'Comercializacion y distribucion al por mayor de alimentos preparados para animales.'
      ),
        array(
        'codigo' => '519011',
        'actividad' => 'Comercio al por mayor de equipo y accesorios para pesca deportiva o artesanal'
      ),
        array(
        'codigo' => '519013',
        'actividad' => 'Comercializacion al por mayor de suplementos alimenticios'
      ),
        array(
        'codigo' => '519014',
        'actividad' => 'Venta al por mayor de polen y/o semillas para uso agricola'
      ),
        array(
        'codigo' => '519015',
        'actividad' => 'Venta al por mayor de otros productos no especializados'
      ),
        array(
        'codigo' => '519016',
        'actividad' => 'Venta al por mayor de articulos y accesorios electronicos'
      ),
        array(
        'codigo' => '521101',
        'actividad' => 'Supermercados y almacenes de abarrotes en cadena'
      ),
        array(
        'codigo' => '521102',
        'actividad' => 'Venta al por menor de especias, salsas y condimentos'
      ),
        array(
        'codigo' => '521201',
        'actividad' => 'Abastecedores, pulperias o mini-super'
      ),
        array(
        'codigo' => '521202',
        'actividad' => 'Pulperias ( mini-super)(sin cantina)'
      ),
        array(
        'codigo' => '521901',
        'actividad' => 'Tiendas o almacenes por departamentos'
      ),
        array(
        'codigo' => '522001',
        'actividad' => 'Comercio al por menor de confites y otros productos relacionados (confiteria)'
      ),
        array(
        'codigo' => '351101',
        'actividad' => 'Servicio de reparacion de embarcaciones y sus partes y/o estructuras flotantes'
      ),
        array(
        'codigo' => '351102',
        'actividad' => 'Construccion de embarcaciones y estructuras flotantes'
      ),
        array(
        'codigo' => '351103',
        'actividad' => 'Venta de embarcaciones de motor y vela'
      ),
        array(
        'codigo' => '352001',
        'actividad' => 'Fabricacion de locomotoras y material rodante para ferrocarriles y tranvias'
      ),
        array(
        'codigo' => '353001',
        'actividad' => 'Fabricacion de aeronaves y naves espaciales y maquinaria conexa'
      ),
        array(
        'codigo' => '359101',
        'actividad' => 'Fabricacion de motocicletas, partes, piezas y sus accesorios'
      ),
        array(
        'codigo' => '359201',
        'actividad' => 'Fabricacion de bicicletas y sillas de ruedas, partes, piezas y sus accesorios'
      ),
        array(
        'codigo' => '359901',
        'actividad' => 'Fabricacion de otros tipos de equipo de transporte n.c.p.'
      ),
        array(
        'codigo' => '361001',
        'actividad' => 'Fabricacion y/o reparacion de muebles y accesorios (incluyecolchones)'
      ),
        array(
        'codigo' => '361002',
        'actividad' => 'Reparacion de tapiceria'
      ),
        array(
        'codigo' => '361004',
        'actividad' => 'Maquila de muebles'
      ),
        array(
        'codigo' => '369101',
        'actividad' => 'Fabricacion de joyas, bisuteria y articulos conexos'
      ),
        array(
        'codigo' => '369201',
        'actividad' => 'Fabricacion de instrumentos musicales, partes y piezas y sus accesorios'
      ),
        array(
        'codigo' => '369301',
        'actividad' => 'Fabricacion de articulos de deporte'
      ),
        array(
        'codigo' => '369401',
        'actividad' => 'Fabricacion de juegos y juguetes'
      ),
        array(
        'codigo' => '369901',
        'actividad' => 'Fabricacion de escobas'
      ),
        array(
        'codigo' => '369902',
        'actividad' => 'Fabricacion de velas (candelas) excepto las perfumadas, coloreadas y decoradas.'
      ),
        array(
        'codigo' => '369903',
        'actividad' => 'Fabricacion de velas coloreadas, perfumadas y decoradas'
      ),
        array(
        'codigo' => '369904',
        'actividad' => 'Fabricacion de sellos de mano, metal o hule (caucho)'
      ),
        array(
        'codigo' => '371001',
        'actividad' => 'Reciclaje de desperdicios y desechos metalicos'
      ),
        array(
        'codigo' => '372001',
        'actividad' => 'Reciclaje de otro tipo de materiales n.c.p.'
      ),
        array(
        'codigo' => '372003',
        'actividad' => 'Reciclaje de papel y plastico y materiales relacionados'
      ),
        array(
        'codigo' => '401002',
        'actividad' => 'Generacion y/o distribucion de energia electrica (hidraulica,convencional, termico, etc)'
      ),
        array(
        'codigo' => '401004',
        'actividad' => 'Fabricacion, ensamble y venta de sistemas para el aprovechamiento de energias renobables'
      ),
        array(
        'codigo' => '402001',
        'actividad' => 'Fabricacion de gas; distribucion de combustibles gaseosos por tuberias'
      ),
        array(
        'codigo' => '402002',
        'actividad' => 'Instalacion y venta de tanques para gas'
      ),
        array(
        'codigo' => '403001',
        'actividad' => 'Suministro de vapor y aire acondicionado'
      ),
        array(
        'codigo' => '410001',
        'actividad' => 'Captacion, tratamiento y distribucion de agua'
      ),
        array(
        'codigo' => '451001',
        'actividad' => 'Demolicion de edificios y otras estructuras'
      ),
        array(
        'codigo' => '451002',
        'actividad' => 'Preparacion de terrenos'
      ),
        array(
        'codigo' => '452002',
        'actividad' => 'Construccion de edificios, apartamentos, condominios y casas de habitacion'
      ),
        array(
        'codigo' => '452003',
        'actividad' => 'Mantenimiento, reparacion y ampliaciones de edificios, apartamentos, condominios y casas'
      ),
        array(
        'codigo' => '452005',
        'actividad' => 'Construccion y mantenimiento de carreteras y otras vias'
      ),
        array(
        'codigo' => '452006',
        'actividad' => 'Actividades de construccion especiales'
      ),
        array(
        'codigo' => '453001',
        'actividad' => 'Reparacion de aire acondicionado'
      ),
        array(
        'codigo' => '453002',
        'actividad' => 'Reparacion de ascensores(elevadores)'
      ),
        array(
        'codigo' => '453003',
        'actividad' => 'Venta e instalacion de alarmas y otros sistemas electricos'
      ),
        array(
        'codigo' => '453004',
        'actividad' => 'Reparacion de cableado de comunicaciones'
      ),
        array(
        'codigo' => '453005',
        'actividad' => 'Instalacion de alarmas y otros sistemas de seguridad'
      ),
        array(
        'codigo' => '453006',
        'actividad' => 'Instalacion y mantenimiento de aire acondicionado'
      ),
        array(
        'codigo' => '453007',
        'actividad' => 'Instalacion y mantenimiento de ascensores (elevadores)'
      ),
        array(
        'codigo' => '453008',
        'actividad' => 'Instalacion y mantenimiento de cableado de comunicaciones y/o energia electrica'
      ),
        array(
        'codigo' => '453009',
        'actividad' => 'Reparacion de portones electricos'
      ),
        array(
        'codigo' => '453010',
        'actividad' => 'Instalacion y mantenimiento de portones electricos'
      ),
        array(
        'codigo' => '453011',
        'actividad' => 'Instalacion y mantenimiento de conmutadores y otros sistemas para telecomunicaciones'
      ),
        array(
        'codigo' => '454001',
        'actividad' => 'Servicios de terminacion y acabado de edificios'
      ),
        array(
        'codigo' => '455001',
        'actividad' => 'Alquiler de equipo de construccion o demolicion con operadores'
      ),
        array(
        'codigo' => '501001',
        'actividad' => 'Venta al por mayor y menor de vehiculos nuevos y/o usados'
      ),
        array(
        'codigo' => '502001',
        'actividad' => 'Lavado, encerado y pulido de automoviles (lava car)'
      ),
        array(
        'codigo' => '502002',
        'actividad' => 'Servicios de alineamiento y reparacion de llantas'
      ),
        array(
        'codigo' => '502003',
        'actividad' => 'Servicio de reparacion de toda clase de vehiculos y sus partes'
      ),
        array(
        'codigo' => '502004',
        'actividad' => 'Servicio de enderezado y pintura para toda clase de vehiculo'
      ),
        array(
        'codigo' => '502007',
        'actividad' => 'Autodecoracion'
      ),
        array(
        'codigo' => '502008',
        'actividad' => 'Servicio de revision tecnica vehicular (diagnosticos por escanner)'
      ),
        array(
        'codigo' => '503002',
        'actividad' => 'Venta de repuestos usados para automoviles'
      ),
        array(
        'codigo' => '503004',
        'actividad' => 'Venta de repuestos nuevos para automoviles'
      ),
        array(
        'codigo' => '503005',
        'actividad' => 'Comercializacion de llantas (neumaticas) para vehiculos automotores'
      ),
        array(
        'codigo' => '503006',
        'actividad' => 'Actividades de desarme de vehiculos y venta de repuestos'
      ),
        array(
        'codigo' => '504001',
        'actividad' => 'Venta de motocicletas'
      ),
        array(
        'codigo' => '504003',
        'actividad' => 'Venta de partes o accesorios de motocicletas'
      ),
        array(
        'codigo' => '504004',
        'actividad' => 'Servicio de reparacion de toda clase de motocicletas y sus partes'
      ),
        array(
        'codigo' => '505001',
        'actividad' => 'Venta de combustibles (conocidas como gasolineras o bombas)'
      ),
        array(
        'codigo' => '505002',
        'actividad' => 'Venta de lubricantes, aceites, grasas y productos de limpieza para automotores'
      ),
        array(
        'codigo' => '505003',
        'actividad' => 'Comercio de combustible sin punto fijo (peddler)'
      ),
        array(
        'codigo' => '511001',
        'actividad' => 'Comisionistas, agentes de ventas, organizadores de subastas,tiqueteras, etc.'
      ),
        array(
        'codigo' => '512102',
        'actividad' => 'Venta al por mayor de flores y plantas de todo tipo'
      ),
        array(
        'codigo' => '512201',
        'actividad' => 'Comercio al por mayor de alimentos, granos basicos, carnes y demas comestibles y articulos de la canasta basica'
      ),
        array(
        'codigo' => '512202',
        'actividad' => 'Venta al por mayor de frutas, verduras frescas y legumbres y hortalizas exenta de ventas'
      ),
        array(
        'codigo' => '512204',
        'actividad' => 'Comercio al por mayor de productos lacteos'
      ),
        array(
        'codigo' => '512208',
        'actividad' => 'Comercio al por mayor de productos de confiteria'
      ),
        array(
        'codigo' => '512209',
        'actividad' => 'Comercio al por mayor de productos de tabaco'
      ),
        array(
        'codigo' => '512210',
        'actividad' => 'Comercio al por mayor de bebidas con contenido alcoholico (importadores)'
      ),
        array(
        'codigo' => '512211',
        'actividad' => 'Comercio al por mayor de otros alimentos n.c.p. grabados con ventas'
      ),
        array(
        'codigo' => '512213',
        'actividad' => 'Comercio al por mayor de bebidas gaseosas y carbonatadas'
      ),
        array(
        'codigo' => '512214',
        'actividad' => 'Venta al por mayor de cafe (excepto el envasado, enlatado, soluble, descafeinado)'
      ),
        array(
        'codigo' => '512217',
        'actividad' => 'Comercio al por mayor de vinos. bebidas fermentadas y no fermentadas'
      ),
        array(
        'codigo' => '523903',
        'actividad' => 'Venta al por menor de flores'
      ),
        array(
        'codigo' => '523904',
        'actividad' => 'Servicios de reparacion de joyeria y relojeria en general'
      ),
        array(
        'codigo' => '523905',
        'actividad' => 'Venta al por menor de joyeria, relojeria y bisuteria'
      ),
        array(
        'codigo' => '523906',
        'actividad' => 'Venta al por menor celulares accesorios equipo y art para comunicaciones incluye la reparacion'
      ),
        array(
        'codigo' => '523907',
        'actividad' => 'Floristeria'
      ),
        array(
        'codigo' => '523908',
        'actividad' => 'Comercio al por menor de animales domesticos para consumo humano'
      ),
        array(
        'codigo' => '523909',
        'actividad' => 'Venta de productos de artesania y souvenir'
      ),
        array(
        'codigo' => '523910',
        'actividad' => 'Venta al por menor de juguetes y/o articulos de esparcimiento'
      ),
        array(
        'codigo' => '523911',
        'actividad' => 'Venta al por menor de pañales desechables, articulos de limpieza y otros (pañalera)'
      ),
        array(
        'codigo' => '523912',
        'actividad' => 'Venta al por menor y mayor de productos e insumos agropecuarios'
      ),
        array(
        'codigo' => '523913',
        'actividad' => 'Venta al por menor de animales domesticos para mascotas.'
      ),
        array(
        'codigo' => '523915',
        'actividad' => 'Distribucion y venta de gas en cilindro'
      ),
        array(
        'codigo' => '523916',
        'actividad' => 'Comercio al por menor de alimentos y productos n.c.p. exentos de ventas'
      ),
        array(
        'codigo' => '523917',
        'actividad' => 'Venta al por menor de bicicletas y sus accesorios'
      ),
        array(
        'codigo' => '523918',
        'actividad' => 'Venta al por menor de equipo de audio y video'
      ),
        array(
        'codigo' => '523919',
        'actividad' => 'Venta al por menor de articulos y accesorios ortopedicos'
      ),
        array(
        'codigo' => '523920',
        'actividad' => 'Venta al por menor de anteojos y articulos opticos (optica)'
      ),
        array(
        'codigo' => '523921',
        'actividad' => 'Venta al por menor de cajas registradoras, calculadoras o maquinas de contabilidad'
      ),
        array(
        'codigo' => '523922',
        'actividad' => 'Venta al por menor de polen y semillas'
      ),
        array(
        'codigo' => '523923',
        'actividad' => 'Venta al por menor de repuestos para electrodomesticos'
      ),
        array(
        'codigo' => '523925',
        'actividad' => 'Venta al por menor de extintores'
      ),
        array(
        'codigo' => '523926',
        'actividad' => 'Mantenimiento de extintores'
      ),
        array(
        'codigo' => '523927',
        'actividad' => 'Reparacion equipo de audio y video'
      ),
        array(
        'codigo' => '523929',
        'actividad' => 'Venta de perros entrenados para seguridad'
      ),
        array(
        'codigo' => '523930',
        'actividad' => 'Venta al por menor de piezas de bambu'
      ),
        array(
        'codigo' => '524001',
        'actividad' => 'Venta de todo tipo de articulos usados'
      ),
        array(
        'codigo' => '524002',
        'actividad' => 'Casa de empeño y afin'
      ),
        array(
        'codigo' => '524004',
        'actividad' => 'Venta de libros usados'
      ),
        array(
        'codigo' => '524005',
        'actividad' => 'Venta de monedas, billetes,estampillas (nuevas y usadas) para coleccion y especies fiscales'
      ),
        array(
        'codigo' => '525101',
        'actividad' => 'Venta al por menor de todo tipo de articulos por catalogo'
      ),
        array(
        'codigo' => '659908',
        'actividad' => 'Fondos de la ley del sistema de banca para el desarrollo'
      ),
        array(
        'codigo' => '659909',
        'actividad' => 'Fideicomisos de la ley del sistema de banca para el desarrollo'
      ),
        array(
        'codigo' => '660101',
        'actividad' => 'Planes de seguros de vida'
      ),
        array(
        'codigo' => '660201',
        'actividad' => 'Operadora de pensiones'
      ),
        array(
        'codigo' => '660202',
        'actividad' => 'Fondos de operadoras de pensiones exentos del 8%'
      ),
        array(
        'codigo' => '660301',
        'actividad' => 'Agentes de seguros'
      ),
        array(
        'codigo' => '660302',
        'actividad' => 'Comercializadores de seguros'
      ),
        array(
        'codigo' => '660303',
        'actividad' => 'Planes de seguros generales'
      ),
        array(
        'codigo' => '671101',
        'actividad' => 'Administracion de mercados financieros'
      ),
        array(
        'codigo' => '671201',
        'actividad' => 'Corredores de bolsa'
      ),
        array(
        'codigo' => '671202',
        'actividad' => 'Puestos de bolsa'
      ),
        array(
        'codigo' => '671901',
        'actividad' => 'Puestos y/o casas de cambio de moneda extranjera'
      ),
        array(
        'codigo' => '671902',
        'actividad' => 'Asesores financieros y actividades auxiliares de la intermediciacion financiera'
      ),
        array(
        'codigo' => '672001',
        'actividad' => 'Actividades auxiliares de la financiacion de planes de seguros y de pensiones'
      ),
        array(
        'codigo' => '701002',
        'actividad' => 'Alquiler de locales comerciales y centros comerciales'
      ),
        array(
        'codigo' => '701003',
        'actividad' => 'Compra y venta de propiedades (inversionistas)'
      ),
        array(
        'codigo' => '701004',
        'actividad' => 'Alquiler de edificios y propiedades diferentes a casas de habitacion'
      ),
        array(
        'codigo' => '701005',
        'actividad' => 'Alquiler de marcas registradas'
      ),
        array(
        'codigo' => '701006',
        'actividad' => 'Alquiler de patentes (de licores, unicamente)'
      ),
        array(
        'codigo' => '701007',
        'actividad' => 'Explotacion de franquicias'
      ),
        array(
        'codigo' => '702001',
        'actividad' => 'Agentes o corredores de bienes raices'
      ),
        array(
        'codigo' => '721001',
        'actividad' => 'Consultores informaticos'
      ),
        array(
        'codigo' => '722003',
        'actividad' => 'Diseñador grafico, de sofware y paginas web'
      ),
        array(
        'codigo' => '723001',
        'actividad' => 'Procesamiento de datos'
      ),
        array(
        'codigo' => '724001',
        'actividad' => 'Actividades relacionadas con bases de datos'
      ),
        array(
        'codigo' => '725001',
        'actividad' => 'Reparacion de equipo de computo'
      ),
        array(
        'codigo' => '725002',
        'actividad' => 'Mantenimiento de equipo de computo'
      ),
        array(
        'codigo' => '725003',
        'actividad' => 'Reparacion cajas registradoras, calculadoras, maquinas de contabilidad y equipo de oficina'
      ),
        array(
        'codigo' => '725004',
        'actividad' => 'Mantenimiento de cajas registradoras, calculadoras, maquinas de contabilidad'
      ),
        array(
        'codigo' => '729001',
        'actividad' => 'Otras actividades de informatica'
      ),
        array(
        'codigo' => '731001',
        'actividad' => 'Investigacion y desarrollo experimental en el campo de las ciencias naturales y la ingenieria'
      ),
        array(
        'codigo' => '731003',
        'actividad' => 'Meteorologo por cuenta propia'
      ),
        array(
        'codigo' => '702002',
        'actividad' => 'Arrendamiento o alquiler de bienes inmuebles mediante contrato verbal o escrito.'
      ),
        array(
        'codigo' => '702003',
        'actividad' => 'Administracion, mantenimiento, reparacion y limpieza de losservicios y bienes comunes de la propiedad en condominio'
      ),
        array(
        'codigo' => '711101',
        'actividad' => 'Alquiler de automoviles de todo tipo'
      ),
        array(
        'codigo' => '711102',
        'actividad' => 'Alquiler de motocicleta/servicio'
      ),
        array(
        'codigo' => '711103',
        'actividad' => 'Alquiler de equipo de transporte por via terrestre, acuatica o aerea'
      ),
        array(
        'codigo' => '711105',
        'actividad' => 'Alquiler de carritos de golf y otros'
      ),
        array(
        'codigo' => '712101',
        'actividad' => 'Alquiler de maquinaria y equipo para uso agricola'
      ),
        array(
        'codigo' => '712201',
        'actividad' => 'Alquiler de maquinaria y equipo de construccion e ingenieria civil'
      ),
        array(
        'codigo' => '712301',
        'actividad' => 'Servicios de internet en locales publicos ( cafe internet )'
      ),
        array(
        'codigo' => '712302',
        'actividad' => 'Alquiler de maquinaria y equipo de oficina'
      ),
        array(
        'codigo' => '712901',
        'actividad' => 'Alquiler de maquinas expendedoras de alimentos y otros'
      ),
        array(
        'codigo' => '712902',
        'actividad' => 'Alquiler de maquinas de entretenimiento (con monedas)'
      ),
        array(
        'codigo' => '712904',
        'actividad' => 'Alquiler de peliculas cinematograficas (video club) y/o video juegos'
      ),
        array(
        'codigo' => '712905',
        'actividad' => 'Alquiler de equipo para radio, television y comunicaciones'
      ),
        array(
        'codigo' => '712906',
        'actividad' => 'Alquiler de equipo para dispensar billetes (cajero automa-tico)'
      ),
        array(
        'codigo' => '712907',
        'actividad' => 'Alquiler maquinaria y equipo para la elaboracion y/o mantenimiento de productos alimenticios'
      ),
        array(
        'codigo' => '712909',
        'actividad' => 'Alquiler de otros tipos de maquinaria y equipo para uso comercial'
      ),
        array(
        'codigo' => '712910',
        'actividad' => 'Alquiler de maquinaria y/o equipo para uso industrial'
      ),
        array(
        'codigo' => '712911',
        'actividad' => 'Alquiler de rampas y similares'
      ),
        array(
        'codigo' => '713001',
        'actividad' => 'Alquiler de menaje'
      ),
        array(
        'codigo' => '713002',
        'actividad' => 'Alquiler de equipo recreativo y deportivo'
      ),
        array(
        'codigo' => '713003',
        'actividad' => 'Alquiler de equipo medico y articulos conexos'
      ),
        array(
        'codigo' => '713012',
        'actividad' => 'Alquiler de trajes de todo tipo'
      ),
        array(
        'codigo' => '713013',
        'actividad' => 'Alquiler de equipo y utensilios para eventos especiales'
      ),
        array(
        'codigo' => '713053',
        'actividad' => 'Alquiler de animales (caballos, serpientes, etc)'
      ),
        array(
        'codigo' => '525201',
        'actividad' => 'Venta de revistas/periodicos (puestos callejeros)'
      ),
        array(
        'codigo' => '525301',
        'actividad' => 'Venta de loteria en agencias o al detalle'
      ),
        array(
        'codigo' => '525303',
        'actividad' => 'Emision de la loteria nacional y similares'
      ),
        array(
        'codigo' => '525901',
        'actividad' => 'Venta de alfombras y tapices'
      ),
        array(
        'codigo' => '525902',
        'actividad' => 'Venta ambulante de articulos para el hogar'
      ),
        array(
        'codigo' => '525903',
        'actividad' => 'Venta de libros a domicilio'
      ),
        array(
        'codigo' => '525904',
        'actividad' => 'Trabajos de manualidades'
      ),
        array(
        'codigo' => '525905',
        'actividad' => 'Venta al por menor de tarjetas telefonicas, pines, tiempo aire y similares'
      ),
        array(
        'codigo' => '526001',
        'actividad' => 'Servicios de reparacion de zapatos'
      ),
        array(
        'codigo' => '526002',
        'actividad' => 'Reparacion de muebles y accesorios domesticos'
      ),
        array(
        'codigo' => '526003',
        'actividad' => 'Reparacion de bicicletas'
      ),
        array(
        'codigo' => '526005',
        'actividad' => 'Electricista, servicios'
      ),
        array(
        'codigo' => '526006',
        'actividad' => 'Reparacion de articulos electricos'
      ),
        array(
        'codigo' => '526008',
        'actividad' => 'Reparacion y mantenimiento de persianas y cortinas'
      ),
        array(
        'codigo' => '526010',
        'actividad' => 'Instalacion y mantenimiento de persianas y cortinas'
      ),
        array(
        'codigo' => '526011',
        'actividad' => 'Reparacion y mantenimiento de equipo para telecomunicaciones'
      ),
        array(
        'codigo' => '526012',
        'actividad' => 'Instalacion y mantenimiento de piscinas,jacuzzis y similares'
      ),
        array(
        'codigo' => '551001',
        'actividad' => 'Alquiler de bienes inmuebles de uso habitacional por periodos inferiores a un mes (casas de estancia transitoria, casa de huespedes, cabinas, campamentos, entre otros)'
      ),
        array(
        'codigo' => '551002',
        'actividad' => 'Hotel'
      ),
        array(
        'codigo' => '551004',
        'actividad' => 'Motel y/o servicio de habitacion ocasional, albergues, posadas y similares'
      ),
        array(
        'codigo' => '551005',
        'actividad' => 'Servicio de salas vip y premiun en aeropuertos'
      ),
        array(
        'codigo' => '552001',
        'actividad' => 'Bares, cantinas o tabernas'
      ),
        array(
        'codigo' => '552002',
        'actividad' => 'Cafeterias'
      ),
        array(
        'codigo' => '552003',
        'actividad' => 'Servicios de catering service'
      ),
        array(
        'codigo' => '552004',
        'actividad' => 'Servicio de restaurante, cafeterias, sodas y otros expendios de comida'
      ),
        array(
        'codigo' => '552007',
        'actividad' => 'Otros expendios de comidas'
      ),
        array(
        'codigo' => '601001',
        'actividad' => 'Servicio de transporte por via ferrea'
      ),
        array(
        'codigo' => '602001',
        'actividad' => 'Servicio de transporte de carga por via terrestre'
      ),
        array(
        'codigo' => '602002',
        'actividad' => 'Transporte de productos derivados del petroleo'
      ),
        array(
        'codigo' => '602101',
        'actividad' => 'Transporte de estudiantes y empleados'
      ),
        array(
        'codigo' => '602102',
        'actividad' => 'Servicio de transporte regular de personas por via terrestre'
      ),
        array(
        'codigo' => '602201',
        'actividad' => 'Servicios de bus/microbus (excursiones)'
      ),
        array(
        'codigo' => '602202',
        'actividad' => 'Servicio de taxi'
      ),
        array(
        'codigo' => '602203',
        'actividad' => 'Servicio especial estable de taxi'
      ),
        array(
        'codigo' => '602301',
        'actividad' => 'Servicio de acarreo y distribucion de todo tipo de mercancia (incluye la mudanza nacional)'
      ),
        array(
        'codigo' => '602302',
        'actividad' => 'Servicios de grua'
      ),
        array(
        'codigo' => '602304',
        'actividad' => 'Servicio de mudanza internacional'
      ),
        array(
        'codigo' => '603001',
        'actividad' => 'Servicio de transporte por tuberias'
      ),
        array(
        'codigo' => '611001',
        'actividad' => 'Servicio de transporte de carga y/o cabotaje de pasajeros por via acuatica'
      ),
        array(
        'codigo' => '621001',
        'actividad' => 'Servicio de transporte de carga por via aerea'
      ),
        array(
        'codigo' => '621002',
        'actividad' => 'Servicio de transporte aereo regulado de pasajeros (lineas aereas)'
      ),
        array(
        'codigo' => '621003',
        'actividad' => 'Servicio de pilotaje'
      ),
        array(
        'codigo' => '622001',
        'actividad' => 'Servicio de transporte aereo no regular de pasajeros'
      ),
        array(
        'codigo' => '630001',
        'actividad' => 'Prestacion de servicios de transito aereo'
      ),
        array(
        'codigo' => '630101',
        'actividad' => 'Servicio de consolidacion de carga y descarga'
      ),
        array(
        'codigo' => '630201',
        'actividad' => 'Servicios de almacenaje'
      ),
        array(
        'codigo' => '630301',
        'actividad' => 'Parqueos/estacionamiento de vehiculos'
      ),
        array(
        'codigo' => '630302',
        'actividad' => 'Funcionamiento de instalaciones terminales como puertos, muelles y aeropuertos'
      ),
        array(
        'codigo' => '630303',
        'actividad' => 'Permiso de paso por propiedades privadas (peaje)'
      ),
        array(
        'codigo' => '630401',
        'actividad' => 'Agencias de viajes y excursiones'
      ),
        array(
        'codigo' => '630403',
        'actividad' => 'Guia de turimo y servicio de asesoria en viajes y turismo'
      ),
        array(
        'codigo' => '630405',
        'actividad' => 'Explotacion de actividades turisticas(cuya pres tacion no sea realizada por un centro de recreo)'
      ),
        array(
        'codigo' => '630901',
        'actividad' => 'Agencias aduanales, almacenes fiscales y estacionamientos transitorios'
      ),
        array(
        'codigo' => '630903',
        'actividad' => 'Agencia de transporte (naviera)'
      ),
        array(
        'codigo' => '630904',
        'actividad' => 'Agente aduanero fisico o juridico'
      ),
        array(
        'codigo' => '641101',
        'actividad' => 'Actividades postales y de correo'
      ),
        array(
        'codigo' => '642001',
        'actividad' => 'Servicios de radio-mensajes, radiolocalizadores y similares'
      ),
        array(
        'codigo' => '642002',
        'actividad' => 'Servicio de television por cable, satelite u otros sistema s similares'
      ),
        array(
        'codigo' => '642003',
        'actividad' => 'Mantenimiento de redes de telecomunicacion'
      ),
        array(
        'codigo' => '642004',
        'actividad' => 'Servicio de radio frecuencia'
      ),
        array(
        'codigo' => '642005',
        'actividad' => 'Servicios telefonicos, telegraficos y por telex'
      ),
        array(
        'codigo' => '642007',
        'actividad' => 'Venta de espacio en el cable submarino'
      ),
        array(
        'codigo' => '642008',
        'actividad' => 'Servicio de transmision de datos, texto, sonido, voz y video por medio de la red de internet'
      ),
        array(
        'codigo' => '651101',
        'actividad' => 'Banca central'
      ),
        array(
        'codigo' => '651901',
        'actividad' => 'Cooperativas de ahorro y credito'
      ),
        array(
        'codigo' => '651903',
        'actividad' => 'Bancos estatales (excepto el banco central)'
      ),
        array(
        'codigo' => '651904',
        'actividad' => 'Entidades financieras privadas (bancos)'
      ),
        array(
        'codigo' => '651905',
        'actividad' => 'Servicio de envio y recibo de dinero'
      ),
        array(
        'codigo' => '651906',
        'actividad' => 'Instituciones de ahorro y credito para vivienda'
      ),
        array(
        'codigo' => '659101',
        'actividad' => 'Arrendamiento operativo en funcion financiera con opcion decompra o renovacion (leasing operativo)'
      ),
        array(
        'codigo' => '659201',
        'actividad' => 'Entidades financieras distintas al sistema bancario nacional'
      ),
        array(
        'codigo' => '659202',
        'actividad' => 'Emisoras y procesadoras de tarjetas de credito'
      ),
        array(
        'codigo' => '659901',
        'actividad' => 'Servicio de prestamo (prestamistas)'
      ),
        array(
        'codigo' => '659902',
        'actividad' => 'Fideicomisos y/o administradores de fondos de inversion'
      ),
        array(
        'codigo' => '659903',
        'actividad' => 'Sociedades de inversion mobiliaria'
      ),
        array(
        'codigo' => '659904',
        'actividad' => 'Servicio recuperacion de deudas (factore0)'
      ),
        array(
        'codigo' => '659905',
        'actividad' => 'Fondos de inversion'
      ),
        array(
        'codigo' => '659906',
        'actividad' => 'Actividades de sociedades de cartera (holding)'
      ),
        array(
        'codigo' => '659907',
        'actividad' => 'Ingresos por intereses diferentes al comercio del prestamo'
      ),
        array(
        'codigo' => '523203',
        'actividad' => 'Venta al por menor de calzado (zapataerias)'
      ),
        array(
        'codigo' => '523204',
        'actividad' => 'Pasamanerias'
      ),
        array(
        'codigo' => '523205',
        'actividad' => 'Venta al por menor de prendas de vestir, ropa y zapatos (tiendas)'
      ),
        array(
        'codigo' => '523206',
        'actividad' => 'Servicio de fotocopiadora'
      ),
        array(
        'codigo' => '523207',
        'actividad' => 'Venta al por menor de articulos de cuero (excepto calzado)'
      ),
        array(
        'codigo' => '523208',
        'actividad' => 'Venta al por menor de productos textiles (telas)'
      ),
        array(
        'codigo' => '523209',
        'actividad' => 'Venta al por menor de materiales para calzado'
      ),
        array(
        'codigo' => '523301',
        'actividad' => 'Comercio al por menor de objetos de ceramica y porcelana'
      ),
        array(
        'codigo' => '523302',
        'actividad' => 'Venta al por menor de cristaleria'
      ),
        array(
        'codigo' => '523303',
        'actividad' => 'Venta al por menor de discos, cds y otros similares'
      ),
        array(
        'codigo' => '523304',
        'actividad' => 'Venta al por menor de electrodomesticos, muebles y articulos para el hogar'
      ),
        array(
        'codigo' => '523306',
        'actividad' => 'Venta al por menor de antiguedades'
      ),
        array(
        'codigo' => '523308',
        'actividad' => 'Venta al por menor de instrumentos musicales, partes y accesorios'
      ),
        array(
        'codigo' => '523309',
        'actividad' => 'Venta de cuadros pinturas hechas por pintores nacionales y extranjeros producidos en el pais'
      ),
        array(
        'codigo' => '523401',
        'actividad' => 'Venta al por menor de deposito de madera'
      ),
        array(
        'codigo' => '523402',
        'actividad' => 'Venta al por menor articulos de ferreteria pinturas madera y materiales para la construccion'
      ),
        array(
        'codigo' => '523403',
        'actividad' => 'Venta de pinturas'
      ),
        array(
        'codigo' => '523404',
        'actividad' => 'Venta al por menor de vidrio para la construccion'
      ),
        array(
        'codigo' => '523405',
        'actividad' => 'Venta al por menor de materiales para la construccion'
      ),
        array(
        'codigo' => '523406',
        'actividad' => 'Venta al por mayor y menor de articulos electronicos, electricos y similares'
      ),
        array(
        'codigo' => '523407',
        'actividad' => 'Venta al por menor de plywood'
      ),
        array(
        'codigo' => '523501',
        'actividad' => 'Venta al por menor realizada dentro del deposito libre comercial de golfito.'
      ),
        array(
        'codigo' => '523601',
        'actividad' => 'Comercio al por menor de computadoras, accesorios, microcomponentes y paquetes de computo'
      ),
        array(
        'codigo' => '523701',
        'actividad' => 'Librerias'
      ),
        array(
        'codigo' => '523702',
        'actividad' => 'Venta al por menor de revistas/periodicos en puestos de ventas o mercados'
      ),
        array(
        'codigo' => '523703',
        'actividad' => 'Venta al por menor de libros y textos educativos exentos de ventas'
      ),
        array(
        'codigo' => '523801',
        'actividad' => 'Venta al por menor de armas (armerias)'
      ),
        array(
        'codigo' => '523803',
        'actividad' => 'Venta al por menor de maquinaria y equipo de todo tipo y articulos conexos'
      ),
        array(
        'codigo' => '523805',
        'actividad' => 'Venta al por menor de purificadores de agua, sus partes y repuestos'
      ),
        array(
        'codigo' => '523806',
        'actividad' => 'Venta al por menor de maquinaria industrial usada'
      ),
        array(
        'codigo' => '523807',
        'actividad' => 'Venta al por menor de repuestos nuevos para maquinaria, equipo y otros'
      ),
        array(
        'codigo' => '523808',
        'actividad' => 'Venta al por menor de repuestos usados para maquinaria, equipo y otros'
      ),
        array(
        'codigo' => '523901',
        'actividad' => 'Venta al por menor de otros productos en almacenes especializados'
      ),
        array(
        'codigo' => '523902',
        'actividad' => 'Venta al por menor de suministros y/0 equipo de oficina'
      ),
        array(
        'codigo' => '851907',
        'actividad' => 'Servicios de enfermeria'
      ),
        array(
        'codigo' => '851908',
        'actividad' => 'Laboratorios medicos - clinicos'
      ),
        array(
        'codigo' => '851909',
        'actividad' => 'Servicios de radiologia, anestesiologia y otros'
      ),
        array(
        'codigo' => '851910',
        'actividad' => 'Transporte en ambulancia terrestre y aereo (servicio privado)'
      ),
        array(
        'codigo' => '851911',
        'actividad' => 'Profesionales en salud ocupacional'
      ),
        array(
        'codigo' => '851912',
        'actividad' => 'Nutricionista'
      ),
        array(
        'codigo' => '851913',
        'actividad' => 'Profesionales en educacion especial'
      ),
        array(
        'codigo' => '851914',
        'actividad' => 'Servicios de paramedicos'
      ),
        array(
        'codigo' => '851915',
        'actividad' => 'Servicios de esterilizacion de productos medicos y farmaceuticos'
      ),
        array(
        'codigo' => '851916',
        'actividad' => 'Otras actividades relacionadas con la salud humana(banco de sangre, banco de piel, etc)'
      ),
        array(
        'codigo' => '852001',
        'actividad' => 'Servicios veterinarios con venta de productos gravados con ventas'
      ),
        array(
        'codigo' => '852002',
        'actividad' => 'Servicios medicos veterinarios'
      ),
        array(
        'codigo' => '853101',
        'actividad' => 'Fundaciones de bien social'
      ),
        array(
        'codigo' => '853102',
        'actividad' => 'Fundaciones de servicio social (privadas)'
      ),
        array(
        'codigo' => '853103',
        'actividad' => 'Residencias universitarias con servicios integrados'
      ),
        array(
        'codigo' => '853201',
        'actividad' => 'Guarderias/centros infantiles y servicios sociales'
      ),
        array(
        'codigo' => '853301',
        'actividad' => 'Asociaciones declaradas de utilidad publica por el poder ejecutivo, incluye las asadas'
      ),
        array(
        'codigo' => '900001',
        'actividad' => 'Asesoramiento y eliminacion de desperdicios, saneamiento (excepto limpieza de tanques septicos)'
      ),
        array(
        'codigo' => '900002',
        'actividad' => 'Limpieza de tanques septicos y aguas redisuales'
      ),
        array(
        'codigo' => '911101',
        'actividad' => 'Actividades de organizaciones empresariales y de empleadores'
      ),
        array(
        'codigo' => '923201',
        'actividad' => 'Galerias de arte'
      ),
        array(
        'codigo' => '923202',
        'actividad' => 'Servicios de restauracion de obras de arte'
      ),
        array(
        'codigo' => '923301',
        'actividad' => 'Actividades de jardines botanicos, zoologicos, parques nacionales y reservas nacionales'
      ),
        array(
        'codigo' => '924101',
        'actividad' => 'Gimnasios'
      ),
        array(
        'codigo' => '924102',
        'actividad' => 'Explotacion de piscinas o albercas de baño'
      ),
        array(
        'codigo' => '924103',
        'actividad' => 'Entrenador, instructores y/o preparadores fisicos por cuenta propia'
      ),
        array(
        'codigo' => '924104',
        'actividad' => 'Actividades de escuelas y clubes deportivos'
      ),
        array(
        'codigo' => '924105',
        'actividad' => 'Explotacion de instalaciones y campos deportivos'
      ),
        array(
        'codigo' => '924106',
        'actividad' => 'Actividades deportivas y otras por cuenta propia'
      ),
        array(
        'codigo' => '924107',
        'actividad' => 'Espectaculos deportivos'
      ),
        array(
        'codigo' => '924901',
        'actividad' => 'Night club/cabarette'
      ),
        array(
        'codigo' => '924902',
        'actividad' => 'Casinos y salas de juegos'
      ),
        array(
        'codigo' => '924903',
        'actividad' => 'Pesca deportiva'
      ),
        array(
        'codigo' => '924904',
        'actividad' => 'Actividades de juegos de billar, pool y otros similares'
      ),
        array(
        'codigo' => '924905',
        'actividad' => 'Sala de video juegos'
      ),
        array(
        'codigo' => '924906',
        'actividad' => 'Grabacion de sonido (musica, etc.) en discos gramofonicos yen cinta magnetofonica'
      ),
        array(
        'codigo' => '924907',
        'actividad' => 'Servicio de enlace de llamadas y casas de apuestas electronicas (sportbooks)'
      ),
        array(
        'codigo' => '924908',
        'actividad' => 'Espectaculos publicos en general excepto los deportivos y el teatro'
      ),
        array(
        'codigo' => '924909',
        'actividad' => 'Otras actividades de esparcimiento'
      ),
        array(
        'codigo' => '911102',
        'actividad' => 'Camaras de comercio'
      ),
        array(
        'codigo' => '911201',
        'actividad' => 'Actividades de organizaciones profesionales'
      ),
        array(
        'codigo' => '912001',
        'actividad' => 'Asociaciones solidaristas'
      ),
        array(
        'codigo' => '912002',
        'actividad' => 'Actividades de sindicatos'
      ),
        array(
        'codigo' => '919101',
        'actividad' => 'Actividades de organizaciones religiosas'
      ),
        array(
        'codigo' => '919201',
        'actividad' => 'Actividades de organizaciones politicas'
      ),
        array(
        'codigo' => '919901',
        'actividad' => 'Asociacion de desarrollo comunal y/o servicios comunitarios'
      ),
        array(
        'codigo' => '919902',
        'actividad' => 'Asociaciones de clubes sociales'
      ),
        array(
        'codigo' => '919903',
        'actividad' => 'Asociaciones o entidades con fines culturales, sociales, recreativos, artesanales, etc.'
      ),
        array(
        'codigo' => '919905',
        'actividad' => 'Asociacion proayuda a personas adictas a drogas e indigentes'
      ),
        array(
        'codigo' => '921101',
        'actividad' => 'Actividades produccion postproduccion y distribucion de peliculas cinematograficas (videos)'
      ),
        array(
        'codigo' => '921201',
        'actividad' => 'Exhibicion de filmes y videocintas (salas de cine)'
      ),
        array(
        'codigo' => '921301',
        'actividad' => 'Radioemosoras'
      ),
        array(
        'codigo' => '921302',
        'actividad' => 'Programacion y transmisiones de radio y television'
      ),
        array(
        'codigo' => '921401',
        'actividad' => 'Teatros (explotacion)'
      ),
        array(
        'codigo' => '921402',
        'actividad' => 'Actividades musicales y artisticas (servicios)'
      ),
        array(
        'codigo' => '921403',
        'actividad' => 'Periodista por cuenta propia'
      ),
        array(
        'codigo' => '921501',
        'actividad' => 'Canales de television'
      ),
        array(
        'codigo' => '921902',
        'actividad' => 'Venta al por menor de discos, grabaciones de musica y de video'
      ),
        array(
        'codigo' => '921903',
        'actividad' => 'Salon de baile y discoteca'
      ),
        array(
        'codigo' => '921904',
        'actividad' => 'Salon de patines'
      ),
        array(
        'codigo' => '922001',
        'actividad' => 'Actividades de agencias de noticias'
      ),
        array(
        'codigo' => '923101',
        'actividad' => 'Actividades de bibliotecas y archivos'
      ),
        array(
        'codigo' => '732001',
        'actividad' => 'Investigaciones y desarrollo experimental en el campo de las ciencias sociales y las humanidades'
      ),
        array(
        'codigo' => '741101',
        'actividad' => 'Buffete de abogado, notario, asesor legal'
      ),
        array(
        'codigo' => '741203',
        'actividad' => 'Actividad de contabilidad (contadores), teneduria de libros, auditoria y asesor fiscal.'
      ),
        array(
        'codigo' => '741301',
        'actividad' => 'Asesores en mercadeo y ventas'
      ),
        array(
        'codigo' => '741302',
        'actividad' => 'Encuestas de opinion publica'
      ),
        array(
        'codigo' => '741401',
        'actividad' => 'Economistas'
      ),
        array(
        'codigo' => '741402',
        'actividad' => 'Asesoramiento empresarial y en materia de gestion (handling)'
      ),
        array(
        'codigo' => '741407',
        'actividad' => 'Asesor aduanero'
      ),
        array(
        'codigo' => '741408',
        'actividad' => 'Corresponsal de radio, television y prensa escrita'
      ),
        array(
        'codigo' => '742102',
        'actividad' => 'Actividades de arquitectura e ingenieria'
      ),
        array(
        'codigo' => '742105',
        'actividad' => 'Servicios de consultoria en mantenimiento industrial y mecanico'
      ),
        array(
        'codigo' => '742107',
        'actividad' => 'Quimicos'
      ),
        array(
        'codigo' => '742108',
        'actividad' => 'Actividades de geografia y/o geologia'
      ),
        array(
        'codigo' => '742110',
        'actividad' => 'Biologo por cuenta propia'
      ),
        array(
        'codigo' => '742112',
        'actividad' => 'Dibujante arquitectonico y/o planos de construccion'
      ),
        array(
        'codigo' => '742201',
        'actividad' => 'Ensayos y analisis tecnicos'
      ),
        array(
        'codigo' => '742202',
        'actividad' => 'Profesionales en tecnologia de alimentos'
      ),
        array(
        'codigo' => '743001',
        'actividad' => 'Publicidad'
      ),
        array(
        'codigo' => '743004',
        'actividad' => 'Servicios de publicidad'
      ),
        array(
        'codigo' => '743005',
        'actividad' => 'Alquiler de espacios publicitarios'
      ),
        array(
        'codigo' => '743006',
        'actividad' => 'Publicidad a traves de medios electronicos'
      ),
        array(
        'codigo' => '749101',
        'actividad' => 'Servicios de administracion de personal'
      ),
        array(
        'codigo' => '749102',
        'actividad' => 'Servicios de bibliotecologia'
      ),
        array(
        'codigo' => '749201',
        'actividad' => 'Servicios de investigacion, seguridad privada, agencias y consultores'
      ),
        array(
        'codigo' => '749204',
        'actividad' => 'Instructor de tiro (manejo de armas).'
      ),
        array(
        'codigo' => '749301',
        'actividad' => 'Servicios de fumigacion (no agricola)'
      ),
        array(
        'codigo' => '749302',
        'actividad' => 'Servicios de limpieza (interiores y exteriores)'
      ),
        array(
        'codigo' => '749401',
        'actividad' => 'Estudios fotograficos'
      ),
        array(
        'codigo' => '749402',
        'actividad' => 'Servicio de fotografia (fotografo)'
      ),
        array(
        'codigo' => '749501',
        'actividad' => 'Servicios de envase y empaque'
      ),
        array(
        'codigo' => '749901',
        'actividad' => 'Servicio de fotocopiado y otros'
      ),
        array(
        'codigo' => '749902',
        'actividad' => 'Servicios de levantado de texto y/o correccion de textos y otros'
      ),
        array(
        'codigo' => '749903',
        'actividad' => 'Servicios secretariales y/o oficinista'
      ),
        array(
        'codigo' => '749904',
        'actividad' => 'Servicio de diseño o decoracion de interiores (por cuenta propia).'
      ),
        array(
        'codigo' => '749905',
        'actividad' => 'Servicio de contestacion de telefonos (call center)'
      ),
        array(
        'codigo' => '749906',
        'actividad' => 'Servicios de traductor'
      ),
        array(
        'codigo' => '749907',
        'actividad' => 'Servicio de inspeccion de todo tipo de mercaderias (incluyedrogas)'
      ),
        array(
        'codigo' => '749908',
        'actividad' => 'Servicio de recoleccion de monedas de los telefonos publicos'
      ),
        array(
        'codigo' => '749911',
        'actividad' => 'Agencias fotograficas por catalogo'
      ),
        array(
        'codigo' => '749914',
        'actividad' => 'Servcicio de cobranza de recibos publicos y otros'
      ),
        array(
        'codigo' => '749917',
        'actividad' => 'Modelaje profesional (modelo)'
      ),
        array(
        'codigo' => '749918',
        'actividad' => 'Agencias de cobro y calificacion crediticia'
      ),
        array(
        'codigo' => '751101',
        'actividad' => 'Actividades de la administracion publica en general'
      ),
        array(
        'codigo' => '751102',
        'actividad' => 'Actividades de la administracion publica en general, no sujetas al impuesto sobre la renta'
      ),
        array(
        'codigo' => '751201',
        'actividad' => 'Juntas de educacion, comedores escolares, patronatos, cooperativas escolares, colegiales, vocacionales'
      ),
        array(
        'codigo' => '751202',
        'actividad' => 'Comites cantonales de deportes y recreacion'
      ),
        array(
        'codigo' => '751301',
        'actividad' => 'Actividades del sector publico relacionadas con la infraestructura'
      ),
        array(
        'codigo' => '751302',
        'actividad' => 'Fondos publicos (actividades del sector publico)'
      ),
        array(
        'codigo' => '751401',
        'actividad' => 'Actividades de servicios auxiliares para la administracion publica en general'
      ),
        array(
        'codigo' => '752101',
        'actividad' => 'Relaciones exteriores'
      ),
        array(
        'codigo' => '752201',
        'actividad' => 'Actividades de defensa'
      ),
        array(
        'codigo' => '752301',
        'actividad' => 'Actividades de mantenimiento del orden publico y de seguridad'
      ),
        array(
        'codigo' => '752302',
        'actividad' => 'Servicios de vigilancia o control portuaria, costera, aerea,y fronteriza'
      ),
        array(
        'codigo' => '753001',
        'actividad' => 'Actividades de planes de seguridad social de afiliacion obligatoria'
      ),
        array(
        'codigo' => '801001',
        'actividad' => 'Enseñanza preescolar y primaria privada'
      ),
        array(
        'codigo' => '802101',
        'actividad' => 'Enseñanza secundaria privada'
      ),
        array(
        'codigo' => '802201',
        'actividad' => 'Enseñanza secundaria de formacion tecnica y profesional'
      ),
        array(
        'codigo' => '803002',
        'actividad' => 'Enseñanza superior privada (universidades)'
      ),
        array(
        'codigo' => '803003',
        'actividad' => 'Ensenanza superior publica (universidades)'
      ),
        array(
        'codigo' => '809001',
        'actividad' => 'Escuelas comerciales (no estatales)'
      ),
        array(
        'codigo' => '809004',
        'actividad' => 'Profesor por cuenta propia'
      ),
        array(
        'codigo' => '809005',
        'actividad' => 'Enseñanza cultural'
      ),
        array(
        'codigo' => '809006',
        'actividad' => 'Enseñanza de la de seguridad privada'
      ),
        array(
        'codigo' => '809007',
        'actividad' => 'Escuela y agencia de modelos'
      ),
        array(
        'codigo' => '851101',
        'actividad' => 'Clinica, centros medicos, hospitales privados y otros'
      ),
        array(
        'codigo' => '851201',
        'actividad' => 'Ginecologo'
      ),
        array(
        'codigo' => '851202',
        'actividad' => 'Servicos de medico general'
      ),
        array(
        'codigo' => '851203',
        'actividad' => 'Neurologos'
      ),
        array(
        'codigo' => '851204',
        'actividad' => 'Servicios de oftalmologo u oculista, optometrista y/o optico'
      ),
        array(
        'codigo' => '851206',
        'actividad' => 'Ortopedista (consulta privada)'
      ),
        array(
        'codigo' => '851207',
        'actividad' => 'Servicios de odontologo y conexos'
      ),
        array(
        'codigo' => '851208',
        'actividad' => 'Otorrinolaringologia, audiologia y servicios conexos.'
      ),
        array(
        'codigo' => '851209',
        'actividad' => 'Farmaceutico o boticario'
      ),
        array(
        'codigo' => '851210',
        'actividad' => 'Cardiologos'
      ),
        array(
        'codigo' => '851212',
        'actividad' => 'Oncologos'
      ),
        array(
        'codigo' => '851213',
        'actividad' => 'Reumatologo'
      ),
        array(
        'codigo' => '851901',
        'actividad' => 'Medicina alternativa'
      ),
        array(
        'codigo' => '851902',
        'actividad' => 'Fisico terapista'
      ),
        array(
        'codigo' => '851905',
        'actividad' => 'Psicologo'
      ),
        array(
        'codigo' => '851906',
        'actividad' => 'Psiquiatria'
      ),
        array(
        'codigo' => '960109',
        'actividad' => 'Distribuidores de mercancias exentas del impuesto de ventas'
      ),
        array(
        'codigo' => '990001',
        'actividad' => 'Actividades de organizaciones y organos extraterritoriales, incluye las embajadas de otros paises'
      ),
        array(
        'codigo' => '930101',
        'actividad' => 'Servicios de lavanderia de todo tipo'
      ),
        array(
        'codigo' => '930102',
        'actividad' => 'Servicio de teñido de prendas de vestir'
      ),
        array(
        'codigo' => '930103',
        'actividad' => 'Servicio de limpieza y lavado de muebles'
      ),
        array(
        'codigo' => '930202',
        'actividad' => 'Salones de belleza, peluqueria y barberia'
      ),
        array(
        'codigo' => '930301',
        'actividad' => 'Servicios funebres y actividades conexas'
      ),
        array(
        'codigo' => '930302',
        'actividad' => 'Cementerio publico (junta administrativa)'
      ),
        array(
        'codigo' => '930303',
        'actividad' => 'Cementerio o camposanto privado'
      ),
        array(
        'codigo' => '930901',
        'actividad' => 'Salas de masajes'
      ),
        array(
        'codigo' => '930903',
        'actividad' => 'Otras actividades de servicios personales n.c.p.'
      ),
        array(
        'codigo' => '930904',
        'actividad' => 'Centro o sala de bronceado'
      ),
        array(
        'codigo' => '930905',
        'actividad' => 'Peluqueria y sala de estetica para animales'
      ),
        array(
        'codigo' => '930906',
        'actividad' => 'Servicio de tatuaje y piercing'
      ),
        array(
        'codigo' => '930907',
        'actividad' => 'Servicio de disco movil'
      ),
        array(
        'codigo' => '930908',
        'actividad' => 'Servicio de herradura'
      ),
        array(
        'codigo' => '930915',
        'actividad' => 'Albergue y cuido de animales a domicilio'
      ),
        array(
        'codigo' => '950001',
        'actividad' => 'Hogares privados con servicio domestico'
      ),
        array(
        'codigo' => '960104',
        'actividad' => 'Impuesto a las personas juridicas'
      ),
        array(
        'codigo' => '960105',
        'actividad' => 'Actividades preoperativas o de organizacion'
      ),
        array(
        'codigo' => '960106',
        'actividad' => 'Exportadores de mercancias exentas del impuesto de ventas'
      ),
        array(
        'codigo' => '960107',
        'actividad' => 'Productores de mercancias exentas del impuesto de ventas'
      ),
        array(
        'codigo' => '960108',
        'actividad' => 'Comercializadores de mercancias exentas del impuesto de ventas'
      ),
        array(
        'codigo' => '11101',
        'actividad' => 'Cultivo de otros productos n.c.p.'
      ),
        array(
        'codigo' => '11102',
        'actividad' => 'Cultivo de palma africana y otros frutos oleaginosos'
      ),
        array(
        'codigo' => '11103',
        'actividad' => 'Cultivo y comercializacion de cesped'
      ),
        array(
        'codigo' => '11201',
        'actividad' => 'Cultivo hortalizas legumbres especialidades horticolas productos de vivero excento de ventas'
      ),
        array(
        'codigo' => '11218',
        'actividad' => 'Produccion de minivegetales'
      ),
        array(
        'codigo' => '11231',
        'actividad' => 'Cultivo hortalizas legumbres especialidades horticolas productos vivero grabados ventas'
      ),
        array(
        'codigo' => '11301',
        'actividad' => 'Cultivo de especias de todo tipo'
      ),
        array(
        'codigo' => '11302',
        'actividad' => 'Cultivo de frutas'
      ),
        array(
        'codigo' => '11322',
        'actividad' => 'Cultivo de semillas comestibles y germinacion de semillas oleaginosas'
      ),
        array(
        'codigo' => '11329',
        'actividad' => 'Cultivo de plantas para preparar bebidas y medicinas'
      ),
        array(
        'codigo' => '11340',
        'actividad' => 'Cultivo de piña'
      ),
        array(
        'codigo' => '11349',
        'actividad' => 'Cultivo de cacao'
      ),
        array(
        'codigo' => '11401',
        'actividad' => 'Cultivo de cafe'
      ),
        array(
        'codigo' => '11501',
        'actividad' => 'Cultivo de banano'
      ),
        array(
        'codigo' => '11701',
        'actividad' => 'Cultivo de caña de azucar'
      ),
        array(
        'codigo' => '11802',
        'actividad' => 'Cultivo de cereales (inclusive el arroz), legumbres y granos basicos'
      ),
        array(
        'codigo' => '11901',
        'actividad' => 'Cultivo de flores de todo tipo'
      ),
        array(
        'codigo' => '11903',
        'actividad' => 'Viveros'
      ),
        array(
        'codigo' => '11907',
        'actividad' => 'Pequenos productores agricolas'
      ),
        array(
        'codigo' => '12101',
        'actividad' => 'Cria de caballos y otros equinos'
      ),
        array(
        'codigo' => '12102',
        'actividad' => 'Produccion de semen bovino, venta de semen congelado y diluyente para semen'
      ),
        array(
        'codigo' => '12103',
        'actividad' => 'Cria de animales domesticos como: ganado vacuno , ovejas y cabras'
      ),
        array(
        'codigo' => '12201',
        'actividad' => 'Cria de cerdos'
      ),
        array(
        'codigo' => '12202',
        'actividad' => 'Cria de animales domesticados (aves de corral)'
      ),
        array(
        'codigo' => '12203',
        'actividad' => 'Cria de mariposas'
      ),
        array(
        'codigo' => '12204',
        'actividad' => 'Cria y venta de otros animales semidomesticados o salvajes'
      ),
        array(
        'codigo' => '12303',
        'actividad' => 'Produccion de queso y otros productos lacteos exentos del impuesto sobre las ventas'
      ),
        array(
        'codigo' => '12401',
        'actividad' => 'Produccion y venta de huevos de cualquier tipo, excepto los de gallina'
      ),
        array(
        'codigo' => '12402',
        'actividad' => 'Produccion y venta de miel de abeja natural'
      ),
        array(
        'codigo' => '12403',
        'actividad' => 'Produccion de huevos de gallina incluidos en la canasta basica'
      ),
        array(
        'codigo' => '13001',
        'actividad' => 'Cultivo de productos agricolas en combinacion con la cria de animales (explotaci'
      ),
        array(
        'codigo' => '14001',
        'actividad' => 'Servicio de jardineria y/o diseño paisajista'
      ),
        array(
        'codigo' => '14002',
        'actividad' => 'Recoleccion de cosechas y actividades conexas'
      ),
        array(
        'codigo' => '14003',
        'actividad' => 'Fumigacion de cultivos'
      ),
        array(
        'codigo' => '14004',
        'actividad' => 'Servicio de plantacion de arboles y similares'
      ),
        array(
        'codigo' => '14005',
        'actividad' => 'Manejo e instalacion de sistemas de riego'
      ),
        array(
        'codigo' => '15001',
        'actividad' => 'Caza ordinaria mediante trampas, y repoblacion de animales de caza, incluso las actividades de servicios conexas.'
      ),
        array(
        'codigo' => '20001',
        'actividad' => 'Venta de arboles en pie (arboles de reforestacion)'
      ),
        array(
        'codigo' => '20002',
        'actividad' => 'Extraccion y/o venta de madera'
      ),
        array(
        'codigo' => '20005',
        'actividad' => 'Actividades de conservacion de bosques. (servicios ambientales, venta de oxigeno).'
      ),
        array(
        'codigo' => '50001',
        'actividad' => 'Pescadores artesanales en peq. escala'
      ),
        array(
        'codigo' => '50002',
        'actividad' => 'Pescadores artesanales medios'
      ),
        array(
        'codigo' => '50003',
        'actividad' => 'Criadero de peces, crustaceos o moluscos. comercializacion de larvas de especies marinas'
      ),
        array(
        'codigo' => '50005',
        'actividad' => 'Pescadores en gran escala'
      ),
        array(
        'codigo' => '12302',
        'actividad' => 'Producción de leche cruda y otros productos lácteos sin procesamiento incluidos en canasta básica'
      ),
        array(
        'codigo' => '853202',
        'actividad' => 'Servicios profesionales no contemplados en otra parte'
      ),
        array(
        'codigo' => '12301',
        'actividad' => 'Cria y venta de ganado bovino (vacuno) y bufalo.'
      )
    );
    
    usort($array,  function ($item1, $item2) {
      if ($item1['codigo'] == $item2['codigo']) return 0;
      return $item1['codigo'] < $item2['codigo'] ? -1 : 1;
    });

    return $array;
  }

  function mipos_getUnidsHacienda() {
    $array = array(
      'Sp' => 'Servicios Profesionales',
      'Al' => 'Alquiler de uso habitacional',
      'Alc' => 'Alquiler de uso comercial',
      'Cm' => 'Comisiones',
      'I' => 'Intereses',
      'Os' => 'Otro tipo de servicio',
      'Spe' => 'Servicios personales',
      'St' => 'Servicios técnicos',
      'm' => 'Metro',
      'kg' => 'Kilogramo',
      'L' => 'Litro',
      't' => 'Tonelada',
      'Unid' => 'Unidad',
      'Gal' => 'Galón',
      'g' => 'Gramo',
      'Km' => 'Kilometro',
      'ln' => 'Pulgada',
      'cm' => 'Centimetro',
      'mL' => 'Mililitro',
      'mm' => 'Milimetro',
      'Oz' => 'Onzas',
      'Otros' => 'Otros'
    );

    return $array;
  }
