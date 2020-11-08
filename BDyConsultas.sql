CREATE DATABASE ICGSoftware
GO
USE ICGSoftware

CREATE TABLE [dbo].[cliente] (
	[cc] int NOT NULL,
  [nombre] varchar(45) NOT NULL,
	[fechaNacimiento] DATE NOT NULL,
	[direccion] varchar(45) NOT NULL,
	[tipoCliente] varchar(45) NOT NULL,
	[estado] varchar(45) NOT NULL,
	[correo] varchar(45) NOT NULL,
	[contrasena] varchar(150) NOT NULL,
  PRIMARY KEY CLUSTERED ([cc])
)

CREATE TABLE [dbo].[compra] (
  [idCompra] int NOT NULL IDENTITY(1,1), 
	[cantidadBoletas] int NOT NULL,
	[valorFactura] FLOAT NOT NULL,
  [ccCliente] int NOT NULL,
  PRIMARY KEY CLUSTERED ([idCompra])
)

CREATE TABLE [dbo].[detalleCompra] (
  [idDetalleCompra ] int NOT NULL IDENTITY(1,1), 
  [idCompra] int NOT NULL,
	[idBoleta ] int NOT NULL 
	PRIMARY KEY CLUSTERED ([idDetalleCompra])
)

CREATE TABLE [dbo].[boleta] (
  [idBoleta ] int NOT NULL IDENTITY(1,1), 
	[numBoleta ] int NOT NULL, 
	[precio] FLOAT NOT NULL,
	[estado] varchar(45) NOT NULL,
	[idCiudad] int NOT NULL
  PRIMARY KEY CLUSTERED ([idBoleta])
)

CREATE TABLE [dbo].[ciudad] (
  [idCiudad ] int NOT NULL IDENTITY(1,1), 
	[nombre] varchar(45) NOT NULL
	PRIMARY KEY CLUSTERED ([idCiudad])
)

ALTER TABLE compra ADD FOREIGN KEY (ccCliente) REFERENCES cliente(cc);
ALTER TABLE detalleCompra ADD FOREIGN KEY (idCompra) REFERENCES compra(idCompra);
ALTER TABLE detalleCompra ADD FOREIGN KEY (idBoleta) REFERENCES boleta(idBoleta);
ALTER TABLE boleta ADD FOREIGN KEY (idCiudad) REFERENCES ciudad(idCiudad);

INSERT INTO [dbo].[cliente]([cc], [nombre], [fechaNacimiento], [direccion], [tipoCliente], [estado], [correo], [contrasena]) VALUES (1214734865, 'Carlos rendon', '2000-10-20', 'calle 13 # 50 33', 'comprador', 'activo', 'carlosrendon1@hotmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3')--Password=123
INSERT INTO [dbo].[cliente]([cc], [nombre], [fechaNacimiento], [direccion], [tipoCliente], [estado], [correo], [contrasena]) VALUES (1214734869, 'einer alean', '1996-06-20', 'calle 19 # 20 33', 'administrador', 'activo', 'eineralean@hotmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3')--Password=123



INSERT INTO [dbo].[compra]([cantidadBoletas], [valorFactura], [ccCliente]) VALUES (1, 10000, 1214734869)
INSERT INTO [dbo].[compra]([cantidadBoletas], [valorFactura], [ccCliente]) VALUES (2, 20000, 1214734865)


INSERT INTO [dbo].[ciudad]([nombre]) VALUES ('Medellin')
INSERT INTO [dbo].[ciudad]([nombre])  VALUES ('Bogota')
INSERT INTO [dbo].[ciudad]([nombre])  VALUES ('Cali')

INSERT INTO [dbo].[boleta]([numBoleta ], [precio], [estado], [idCiudad]) VALUES (1, 10000, 'Disponible', 1)
INSERT INTO [dbo].[boleta]([numBoleta ], [precio], [estado], [idCiudad]) VALUES (2, 10000, 'Disponible', 1)
INSERT INTO [dbo].[boleta]([numBoleta ], [precio], [estado], [idCiudad]) VALUES (3, 10000, 'Disponible', 1)
INSERT INTO [dbo].[boleta]([numBoleta ], [precio], [estado], [idCiudad]) VALUES (4, 10000, 'Disponible', 1)
INSERT INTO [dbo].[boleta]([numBoleta ], [precio], [estado], [idCiudad]) VALUES (5, 10000, 'Disponible', 1)
INSERT INTO [dbo].[boleta]([numBoleta ], [precio], [estado], [idCiudad]) VALUES (1, 10000, 'Disponible', 2)
INSERT INTO [dbo].[boleta]([numBoleta ], [precio], [estado], [idCiudad]) VALUES (2, 10000, 'Disponible', 2)
INSERT INTO [dbo].[boleta]([numBoleta ], [precio], [estado], [idCiudad]) VALUES (3, 10000, 'Disponible', 2)
INSERT INTO [dbo].[boleta]([numBoleta ], [precio], [estado], [idCiudad]) VALUES (4, 10000, 'Disponible', 2)
INSERT INTO [dbo].[boleta]([numBoleta ], [precio], [estado], [idCiudad]) VALUES (5, 10000, 'Disponible', 2)

INSERT INTO [dbo].[detalleCompra]([idCompra], [idBoleta ])  VALUES (1, 2)
INSERT INTO [dbo].[detalleCompra]([idCompra], [idBoleta ])  VALUES (2, 5)
INSERT INTO [dbo].[detalleCompra]([idCompra], [idBoleta ])  VALUES (2, 6)


--------Consultas--------------

----Mostrar el total de las ventas realizadas totalizadas por cliente, mostrando nombres y
----apellidos del cliente y la clasificación del tipo de cliente.

SELECT A.primerNombre,A.segundoNombre,A.primerApellido,A.segundoApellido, SUM(B.valorFactura) TotalVentas,C.nombreTipoCliente
FROM cliente A
INNER JOIN factura B
ON A.idCliente=B.idCliente
INNER JOIN tipoCliente C
ON A.tipoCliente=C.idTipoCliente
GROUP BY A.idCliente,A.primerNombre,A.segundoNombre,A.primerApellido,A.segundoApellido,C.nombreTipoCliente

----Mostrar el nombre de los productos que se han vendido por factura, y el número de factura
----al que corresponde.

SELECT C.nombreProducto,A.numeroFactura
FROM factura A
INNER JOIN detalleFactura B
ON A.idFactura=B.idFactura
INNER JOIN producto C
ON B.idProducto=C.idProducto
ORDER BY C.nombreProducto

----Ordenar de mayor a menor los tipos de cliente que más facturas realizaron mayores a $1.500.000 y menores a $4.500.000,
---- mostrar los tipos de cliente y el valor total de las facturas.
SELECT C.idTipoCliente,SUM(B.valorFactura) TotalVentas
FROM cliente A
INNER JOIN factura B
ON A.idCliente=B.idCliente
INNER JOIN tipoCliente C
ON A.tipoCliente=C.idTipoCliente
GROUP BY C.idTipoCliente
HAVING SUM(B.valorFactura) BETWEEN 1500000 and 4500000
ORDER BY TotalVentas DESC

---- Mostrar el número de factura y la suma del costo de los productos vendidos por factura.
SELECT A.numeroFactura,SUM(C.costoProducto*B.cantidadProductos) SumaCostoProductos
FROM factura A
INNER JOIN detalleFactura B
ON A.idFactura=B.idFactura
INNER JOIN producto C
ON B.idProducto=C.idProducto
GROUP BY B.idFactura,A.numeroFactura



