# Surya Store

Tienda online de catálogo de productos creada con HTML, CSS, JavaScript y PHP/MySQL.

## Características
- Catálogo de productos con imagen, nombre, descripción y precio
- Diseño responsivo y moderno
- Carga dinámica desde una base de datos MySQL
- Filtro por categoría

## Requisitos
- PHP 8+
- MySQL o MariaDB
- Servidor local como XAMPP, WAMP o Laragon

## Configuración
1. Inicia tu servidor local con PHP + MySQL
2. Crea una base de datos llamada `surya_store`
3. Ajusta los datos de conexión en `db.php` si es necesario
4. Abre la aplicación en tu navegador desde la carpeta del proyecto

## Estructura del proyecto
- `index.html` - vista principal
- `styles.css` - estilos
- `script.js` - lógica para mostrar productos
- `db.php` - conexión a la base de datos
- `products.php` - consulta y carga de productos desde MySQL

## Base de datos
La tabla `products` se crea automáticamente si no existe, y si está vacía se insertan algunos productos de ejemplo.

## Próximos pasos sugeridos
- Agregar carrito de compras
- Agregar formulario de checkout
- Implementar login de usuarios
- Conectar con un sistema de pago

## Demo rápida
Abre `index.html` en tu navegador y asegúrate de que PHP esté corriendo para que `products.php` funcione correctamente.
