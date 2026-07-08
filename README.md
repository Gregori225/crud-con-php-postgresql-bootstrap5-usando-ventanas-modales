# CRUD de Usuarios en PHP y PostgreSQL

Sistema CRUD completo para gestión de usuarios y departamentos utilizando PHP, PostgreSQL y Bootstrap 5.

## 📋 Requisitos

- PHP 7.4 o superior
- PostgreSQL 12 o superior
- Extensiones PHP: PDO, pdo_pgsql
- Servidor web (Apache/Nginx)

## 🔧 Instalación

### 1. Clonar el repositorio

```bash
git clone <url-del-repositorio>
cd <directorio-del-proyecto>
```

### 2. Configurar variables de entorno

Copia el archivo `.env.example` a `.env` y ajusta las credenciales:

```bash
cp .env.example .env
```

Edita `.env` con tus datos:

```env
DB_HOST=localhost
DB_PORT=5432
DB_USER=postgres
DB_PASSWORD=tu_contraseña_segura
DB_NAME=INFORMESV1
```

### 3. Crear la base de datos

Conéctate a PostgreSQL y ejecuta:

```sql
CREATE DATABASE INFORMESV1;

\c INFORMESV1

-- Tabla de departamentos
CREATE TABLE departamentos (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de usuarios
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    rol VARCHAR(20) DEFAULT 'user',
    cargo VARCHAR(100),
    id_departamento INTEGER REFERENCES departamentos(id),
    activo BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Índices para optimizar consultas
CREATE INDEX idx_usuarios_departamento ON usuarios(id_departamento);
CREATE INDEX idx_usuarios_activo ON usuarios(activo);
CREATE INDEX idx_usuarios_rol ON usuarios(rol);
```

### 4. Configurar el servidor web

**Apache:**
```apache
<VirtualHost *:80>
    DocumentRoot /ruta/al/proyecto
    <Directory /ruta/al/proyecto>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

**Nginx:**
```nginx
server {
    listen 80;
    server_name localhost;
    root /ruta/al/proyecto;
    index index.php;

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass unix:/var/run/php/php-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

### 5. Acceder al sistema

Abre tu navegador y navega a `http://localhost` o la URL configurada.

## 🚀 Características

### Módulo de Usuarios
- ✅ Listado de usuarios con paginación
- ✅ Búsqueda en tiempo real
- ✅ Registro de nuevos usuarios
- ✅ Edición de datos
- ✅ Eliminación con confirmación
- ✅ Vista de detalles completos
- ✅ Exportación a CSV

### Módulo de Departamentos
- ✅ Gestión de departamentos
- ✅ Validación de relaciones (no elimina si tiene usuarios)
- ✅ Contador en tiempo real

## 🔒 Seguridad

- ✅ Contraseñas en variables de entorno (no hardcodeadas)
- ✅ Validación de entrada en todos los endpoints
- ✅ Sentencias preparadas (PDO) para prevenir SQL Injection
- ✅ Sanitización de datos de salida (htmlspecialchars)
- ✅ Manejo adecuado de errores

## 📁 Estructura del Proyecto

```
/workspace
├── config/
│   └── config.php          # Configuración de conexión DB
├── acciones/
│   ├── acciones.php        # Funciones auxiliares
│   ├── addDepartamento.php
│   ├── delete.php
│   ├── deleteDepartamento.php
│   ├── detallesUsuario.php
│   ├── detallesUsuarioCompleto.php
│   ├── exportar.php
│   ├── getEmpleado.php
│   ├── getUltimoUsuario.php
│   └── updateUsuario.php
├── modales/
│   ├── modalAdd.php
│   ├── modalDelete.php
│   ├── modalDeleteDepartamento.php
│   ├── modalDetalles.php
│   └── modalEditar.php
├── assets/
│   ├── css/
│   │   └── home.css
│   ├── js/
│   │   ├── addEmpleado.js
│   │   ├── buscarUsuario.js
│   │   ├── departamentos.js
│   │   ├── detallesEmpleado.js
│   │   ├── editarEmpleado.js
│   │   ├── eliminarEmpleado.js
│   │   ├── refreshTableAdd.js
│   │   └── refreshTableEdit.js
│   └── imgs/
├── index.php               # Página principal
├── usuarios.php            # Vista parcial de usuarios
├── .env.example            # Plantilla de variables de entorno
└── README.md               # Este archivo
```

## 🛠️ Mejoras Implementadas

### Correcciones de Errores
1. ✅ **Contraseña hardcodeada**: Ahora usa variables de entorno
2. ✅ **Enlace roto**: Corregido `exportarCSV.php` → `exportar.php`
3. ✅ **Validación de ID**: Agregada validación robusta en `deleteDepartamento.php`
4. ✅ **Inconsistencia estructural**: Añadidas columnas "Departamento" y "Estado" en `refreshTableEdit.js`
5. ✅ **Uso de alert()**: Reemplazado por `showToast()` en todos los archivos JS

### Mejoras de Seguridad
- Variables de entorno para credenciales sensibles
- Validación de entrada en todos los endpoints POST/GET
- Uso consistente de sentencias preparadas

### Mejoras de UX
- Notificaciones toast en lugar de alertas nativas
- Animaciones suaves en eliminaciones
- Feedback visual consistente

## 📝 Notas Importantes

- **Nunca** subas el archivo `.env` al repositorio
- Cambia la contraseña por defecto en producción
- Considera implementar tokens CSRF para mayor seguridad
- Activa HTTPS en producción

## 🤝 Contribución

1. Fork el proyecto
2. Crea una rama (`git checkout -b feature/nueva-funcionalidad`)
3. Commit tus cambios (`git commit -m 'Añadir nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo la licencia MIT.

---

**Desarrollado con ❤️ usando PHP, PostgreSQL y Bootstrap 5**
