# CRUD de Usuarios en PHP, PostgreSQL y Bootstrap 5

Aplicación web completa para la gestión de usuarios (CRUD - Crear, Leer, Actualizar, Eliminar) desarrollada con **PHP**, **PostgreSQL** y **Bootstrap 5**, utilizando modales para una experiencia de usuario moderna e interactiva.

## 🚀 Características

- ✅ **CRUD completo**: Registro, visualización, edición y eliminación de usuarios
- 🎨 **Interfaz moderna**: Diseño responsivo con Bootstrap 5
- 🔍 **Búsqueda y filtrado**: Búsqueda en tiempo real de usuarios
- 📊 **Exportación a CSV**: Exporta la lista de usuarios a formato CSV
- 💾 **Base de datos PostgreSQL**: Conexión segura mediante PDO
- 🔔 **Alertas modernas**: Notificaciones tipo Next.js para feedback al usuario
- 🪟 **Modales interactivos**: Formularios emergentes para operaciones CRUD

## 📁 Estructura del Proyecto

```
├── index.php                 # Página principal con listado de usuarios
├── usuarios.php              # Vista de la tabla de usuarios
├── config/
│   └── config.php            # Configuración de conexión a PostgreSQL
├── acciones/
│   ├── acciones.php          # Funciones principales del CRUD
│   ├── updateUsuario.php     # Actualización de usuarios
│   ├── delete.php            # Eliminación de usuarios
│   ├── detallesUsuario.php   # Obtener detalles de un usuario
│   ├── exportar.php          # Exportar datos a CSV
│   └── getUltimoUsuario.php  # Obtener el último usuario registrado
├── modales/                  # Modales para formularios
├── assets/
│   ├── css/                  # Estilos personalizados
│   ├── js/                   # Scripts JavaScript (Axios, Bootstrap)
│   └── imgs/                 # Imágenes del proyecto
└── README.md                 # Este archivo
```

## 🛠️ Requisitos Previos

- **PHP** >= 7.4 (recomendado PHP 8.x)
- **PostgreSQL** >= 12
- **Extensión PDO-PgSQL** habilitada en PHP
- **Servidor web** (Apache, Nginx, o XAMPP/WAMP/MAMP)
- **Composer** (opcional, para dependencias futuras)

## ⚙️ Instalación

### 1. Clonar el repositorio

```bash
git clone <url-del-repositorio>
cd <nombre-del-proyecto>
```

### 2. Configurar la base de datos

Crear la base de datos en PostgreSQL:

```sql
CREATE DATABASE INFORMESV1;
```

Ejecutar el script SQL para crear la tabla de usuarios (si está disponible en `/assets/sql/` o similar).

### 3. Configurar la conexión

Editar el archivo `config/config.php` con tus credenciales de PostgreSQL:

```php
$host = "localhost";
$port = "5432";
$usuario = "postgres";
$contrasena = "tu_contraseña";
$base_de_datos = "INFORMESV1";
```

### 4. Permisos

Asegúrate de que el servidor web tenga permisos de lectura en todos los archivos del proyecto.

### 5. Acceder a la aplicación

Abre tu navegador y navega a:

```
http://localhost/<carpeta-del-proyecto>/index.php
```

## 📖 Uso

1. **Listar usuarios**: La página principal muestra todos los usuarios registrados
2. **Registrar nuevo usuario**: Haz clic en el botón verde `+` para abrir el modal de registro
3. **Editar usuario**: Haz clic en el ícono de lápiz junto a cada usuario
4. **Ver detalles**: Haz clic en el ícono de ojo para ver información detallada
5. **Eliminar usuario**: Haz clic en el ícono de basura para eliminar un usuario
6. **Exportar a CSV**: Haz clic en el botón CSV para descargar el listado completo

## 🔧 Tecnologías Utilizadas

| Tecnología | Versión | Descripción |
|------------|---------|-------------|
| PHP | 7.4+ | Lenguaje de programación backend |
| PostgreSQL | 12+ | Sistema de gestión de bases de datos |
| Bootstrap | 5.3.3 | Framework CSS para diseño responsivo |
| Bootstrap Icons | 1.11.3 | Íconos para la interfaz |
| Axios | Latest | Cliente HTTP para peticiones AJAX |
| Next.js Toast Notify | Latest | Sistema de notificaciones |

## 🤝 Contribución

Las contribuciones son bienvenidas. Por favor:

1. Haz un fork del proyecto
2. Crea una rama para tu feature (`git checkout -b feature/NuevaFeature`)
3. Commit tus cambios (`git commit -m 'Add nueva feature'`)
4. Push a la rama (`git push origin feature/NuevaFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo la licencia MIT. Consulta el archivo `LICENSE` si existe.

## 👨‍💻 Autor

Proyecto desarrollado como ejemplo de CRUD completo con PHP, PostgreSQL y Bootstrap 5.

## 🆘 Soporte

Si encuentras algún problema o tienes alguna pregunta:

1. Revisa que la configuración de la base de datos sea correcta
2. Verifica que la extensión `pdo_pgsql` esté habilitada en PHP
3. Revisa los logs de errores de PHP para más detalles

---

**¡Disfruta gestionando tus usuarios de manera eficiente!** 🎉
