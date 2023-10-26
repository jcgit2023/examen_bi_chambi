SELECT DISTINCT TABLE_NAME
FROM INFORMATION_SCHEMA.COLUMNS
WHERE COLUMN_NAME = 'id_producto'
AND TABLE_SCHEMA ='proyecto';


SELECT DISTINCT TABLE_NAME
FROM INFORMATION_SCHEMA.COLUMNS
WHERE COLUMN_NAME = 'id_persona'
AND TABLE_SCHEMA ='sistema_notas';

    CREATE TABLE ventas2(
        id_venta INT NOT NULL AUTO_INCREMENT,
        id_empleado INT NOT NULL,
        id_cliente INT NOT NULL,
        dia VARCHAR(10) NOT NULL,
        monto FLOAT NOT NULL,
        fec_insercion TIMESTAMP NOT NULL,
        fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        usuario INT NOT NULL,
        estado CHAR(1) NOT NULL,
        PRIMARY KEY (id_venta),
        FOREIGN KEY (id_empleado) REFERENCES empleados (id_empleado),
        FOREIGN KEY (id_cliente) REFERENCES clientes (id_cliente)
    )ENGINE=INNODB;

    INSERT INTO ventas2 VALUES(1,1,6,'LUNES',7,now(),now(),1,'A');
    INSERT INTO ventas2 VALUES(2,2,2,'MARTES',17,now(),now(),1,'A');
    INSERT INTO ventas2 VALUES(3,2,9,'MIERCOLES',27,now(),now(),1,'A');
    INSERT INTO ventas2 VALUES(4,1,4,'2025',7,now(),now(),1,'A');
    INSERT INTO ventas2 VALUES(5,3,7,'2026',7,now(),now(),1,'A');
    INSERT INTO ventas2 VALUES(6,1,3,'2027',7,now(),now(),1,'A');
    INSERT INTO ventas2 VALUES(7,3,1,'2022-05-08',7,now(),now(),1,'A');
    INSERT INTO ventas2 VALUES(8,2,10,'2022-05-07',7,now(),now(),1,'A');
    INSERT INTO ventas2 VALUES(9,3,5,'2022-05-08',7,now(),now(),1,'A');
    INSERT INTO ventas2 VALUES(10,1,8,'2022-05-09',7,now(),now(),1,'A');