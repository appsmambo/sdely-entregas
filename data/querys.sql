SELECT o.id AS 'orden', CONCAT(c.nombres, c.apellidos) AS 'cliente', DATE_FORMAT(o.fecha_hora_entrega, '%d/%m/%Y %h:%i %p') AS 'entrega', o.voucher 
FROM orden o INNER JOIN cliente c 
ON o.id_cliente = c.id 
ORDER BY o.fecha_hora_entrega DESC



/*

$ordenes = DB::table('orden')
	->join('cliente', 'orden.id_cliente', '=', 'cliente.id')
	->select('orden.id', 'orden.voucher', DB::raw('CONCAT(c.nombres, c.apellidos) AS cliente'), DB::raw('DATE_FORMAT(o.fecha_hora_entrega, '%d/%m/%Y %h:%i %p') AS entrega'))
	->orderBy('entrega', 'desc')
	->get();

*/



Claudia Davila enviar el nombre del RDS
La respuesta del modelo considerar el dato: potencial
potencial : 1 si 0 no

