### Restricciones de Integridad Referencial para SQL

#### ¿Qué son las Restricciones de Integridad Referencial?
Las restricciones de integridad referencial son reglas que aseguran que las relaciones entre las tablas en una base de datos permanezcan consistentes.

Cuando trabajamos con bases de datos relacionales, es común que una tabla haga referencia a los datos de otra tabla mediante una clave foránea (foreign key). Las restricciones de integridad referencial garantizan que estas referencias sean válidas.

#### ¿Cómo funciona?

##### Clave Foránea
Una clave foránea es un campo (o combinación de campos) en una tabla que se utiliza para establecer y reforzar un vínculo con otra tabla.

**Ejemplo:**
- En una base de datos de ventas:
  - Tabla `Clientes` (contiene información sobre los clientes).
  - Tabla `Pedidos` (contiene los pedidos que hacen los clientes).
  - El campo `cliente_id` en la tabla `Pedidos` es una clave foránea que apunta a `id` en la tabla `Clientes`.

##### Reglas de Integridad Referencial
Estas reglas aseguran que:
- No se puede insertar un valor en una clave foránea si no existe en la tabla referenciada.
- No se puede eliminar un registro de la tabla referenciada si hay registros en otras tablas que lo estén usando.

#### Tipos de Restricciones en las Claves Foráneas
Cuando defines una clave foránea en SQL, puedes especificar qué pasa si intentas borrar o actualizar un registro en la tabla referenciada. Estas son las principales opciones:

- **CASCADE**
  - Si se elimina o actualiza el registro referenciado, todos los registros relacionados en la tabla secundaria se eliminarán o actualizarán automáticamente.
  - **Ejemplo:** Si eliminas un cliente, sus pedidos también se eliminan.

- **SET NULL**
  - Si se elimina o actualiza el registro referenciado, los valores de la clave foránea en la tabla secundaria se establecerán en `NULL`.
  - **Ejemplo:** Si eliminas un cliente, los pedidos que hizo quedan con `cliente_id = NULL`.

- **SET DEFAULT**
  - Similar a `SET NULL`, pero en lugar de `NULL`, el campo se establece en un valor predeterminado.

- **NO ACTION**
  - Impide que se elimine o actualice el registro referenciado si existen registros relacionados en la tabla secundaria.

- **RESTRICT**
  - Igual que `NO ACTION`, pero se evalúa inmediatamente, no al final de la transacción.